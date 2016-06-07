<?php

// Работаем в корневой директории
chdir ('../../');
    
require_once('api/Simpla.php');
$simpla = new Simpla();


// Получим ид заказа
$order_id      = $simpla->request->post('WMI_PAYMENT_NO','integer');
if(!isset($order_id))
    die('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Не передан номер заказа"));

// Проверим статус оплаты
$status        = $simpla->request->post('WMI_ORDER_STATE'); 
if($status != 'Accepted')
        die('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Заказ еще не оплачен"));


////////////////////////////////////////////////
// Выберем заказ из базы
////////////////////////////////////////////////
$order = $simpla->orders->get_order($order_id);
if(empty($order))
	die('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Оплачиваемый заказ не найден"));
 
////////////////////////////////////////////////
// Выбираем из базы соответствующий метод оплаты
////////////////////////////////////////////////
$method = $simpla->payment->get_payment_method(intval($order->payment_method_id));
if(empty($method))
	die("WMI_RESULT=RETRY&WMI_DESCRIPTION=".urlencode("Неизвестный метод оплаты"));

// Получим настройки способа оплаты
$settings = unserialize($method->settings);
$payment_currency = $simpla->money->get_currency(intval($method->currency_id));
$signature = $simpla->request->post("WMI_SIGNATURE");

if (isset($settings['WMI_SIGNATURE']) && !$signature)
    die('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Не передана сигнатура"));


// Если передана сигнатура, сравним данные формы с ЭПЦ
if($signature)
{
    $form = array();
    foreach($_POST as $name => $value)
        if ($name !== "WMI_SIGNATURE") 
            $form[$name] = $value;

    uksort($form, "strcasecmp");
    
    $post = '';
    
    foreach($form as $k=>$val)
        $post .= $val;
        
    $post_signature = base64_encode(pack("H*", md5($post . $signature)));

    if($post_signature != $signature)
        die ('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Ошибка сигнатуры"));
        
}

// Нельзя оплатить уже оплаченный заказ  
if($order->paid)
	die('WMI_RESULT=RETRY&WMI_DESCRIPTION='.urlencode("Этот заказ уже оплачен"));

// Проверим совпала ли сумма заказа
$amount        = $simpla->request->post('WMI_PAYMENT_AMOUNT'); 
if($amount != round($simpla->money->convert($order->total_price, $method->currency_id, false), 2) || $amount<=0)
	die("WMI_RESULT=RETRY&WMI_DESCRIPTION=".urlencode("Некоректная цена"));


// Установим статус оплачен
$simpla->orders->update_order(intval($order->id), array('paid'=>1));

// Отправим уведомление на email
$simpla->notify->email_order_user(intval($order->id));
$simpla->notify->email_order_admin(intval($order->id));

// Спишем товары  
$simpla->orders->close(intval($order->id));

echo "WMI_RESULT=OK";
//header('Location: '.$simpla->request->root_url.'/order/'.$order->url);
exit();
