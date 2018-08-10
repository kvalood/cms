<?php

session_start();

require_once('../../api/Simpla.php');

$simpla = new Simpla();

// Проверка сессии для защиты от xss
if(!$simpla->request->check_session())
{
	trigger_error('Session expired', E_USER_WARNING);
	exit();
}

$id = intval($simpla->request->post('id'));
$object = $simpla->request->post('object');
$values = $simpla->request->post('values');
$values2 = $simpla->request->post('values2');

switch ($object)
{
    case 'product':
    	if($simpla->managers->access('products'))
			$result = $simpla->products->update_product($id, $values);
        break;
    case 'category':
    	if($simpla->managers->access('categories'))
			$result = $simpla->categories->update_category($id, $values);
        break;
    case 'brands':
    	if($simpla->managers->access('brands'))
			$result = $simpla->brands->update_brand($id, $values);
        break;
    case 'feature':
    	if($simpla->managers->access('features'))
			$result = $simpla->features->update_feature($id, $values);
        break;
    case 'article':
    	if($simpla->managers->access('article'))
			$result = $simpla->article->update_article($id, $values);
        break;
    case 'delivery':
    	if($simpla->managers->access('delivery'))
			$result = $simpla->delivery->update_delivery($id, $values);
        break;
    case 'payment':
    	if($simpla->managers->access('payment'))
			$result = $simpla->payment->update_payment_method($id, $values);
        break;
    case 'currency':
    	if($simpla->managers->access('currency'))
			$result = $simpla->money->update_currency($id, $values);
        break;
    case 'comment':
    	if($simpla->managers->access('comments'))
			$result = $simpla->comments->update_comment($id, $values);
        break;
    case 'user':
    	if($simpla->managers->access('users'))
			$result = $simpla->users->update_user($id, $values);
        break;
    case 'label':
    	if($simpla->managers->access('labels'))
			$result = $simpla->orders->update_label($id, $values);
        break;
	case 'Feedbacks':
		if($simpla->managers->access('Feedbacks'))
			$result = $simpla->feedbacks->update_feedback($id, $values);
		break;
	case 'menu_item':
    	if($simpla->managers->access('menu'))
			$result = $simpla->menu->update_id($id, $values);
        break;
	case 'menu_home':
    	if($simpla->managers->access('menu'))
			$home_id = $simpla->menu->get_home();
			$simpla->menu->update_id($home_id, $values);
			$result = $simpla->menu->update_id($id, $values2);
        break;
	case 'tags':
		if($simpla->managers->access('tags'))
		{
			$array = array();	
			foreach (explode('&', urldecode($values)) as $v) {		
				$name = explode("=", $v);
				$array[$name[0]]=$name[1];
			}
			$values = $simpla->tags->update_tag($array);			
		}
		break;
}

header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");		
$json = json_encode($result);
print $json;