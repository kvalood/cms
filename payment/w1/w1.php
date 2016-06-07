<?php

require_once('api/Simpla.php');

class w1 extends Simpla
{	
	public function checkout_form($order_id, $button_text = null)
	{
		if(empty($button_text))
			$button_text = 'Перейти к оплате';
		
		$order = $this->orders->get_order((int)$order_id);
		$payment_method = $this->payment->get_payment_method($order->payment_method_id);
		$settings = $this->payment->get_payment_settings($payment_method->id);
		$price = round($this->money->convert($order->total_price, $payment_method->currency_id, false), 2);

                $form = array();
                
                $form["WMI_MERCHANT_ID"]    = $settings['WMI_MERCHANT_ID'];
                $form["WMI_PAYMENT_AMOUNT"] = $price;
                $form["WMI_CURRENCY_ID"]    = $settings['WMI_CURRENCY_ID'];
                $form["WMI_PAYMENT_NO"]     = $order->id;
                $form["WMI_DESCRIPTION"]    = "BASE64:".base64_encode('Оплата заказа №'.$order->id.' на сайте '.$this->config->root_url);
                $form["WMI_SUCCESS_URL"]    = $this->config->root_url.'/order/'.$order->url;
                $form["WMI_FAIL_URL"]       = $this->config->root_url.'/order/'.$order->url;
		
                if($settings['WMI_SIGNATURE'])
                {
                    foreach ($form as $n=>$val)
                        if(is_array($val))
                        {
                            usort($val, "strcasecmp");
                            $form[$n]=$val;
                        }

                    uksort($form, "strcasecmp");
                    
                    $str = '';
                    foreach ($form as $feald)
                        if(is_array($feald))
                        {
                            foreach ($feald as $val)
                            {
                                $val = iconv("utf-8", "windows-1251", $val);
                                $str .= $val;
                            }
                        }
                        else
                        {
                            $val = iconv("utf-8", "windows-1251", $feald);
                            $str .= $val;
                        }
                    $form['WMI_SIGNATURE'] = base64_encode(pack("H*", md5($str . $settings['WMI_SIGNATURE'])));;
                }
                $result = "<form action=\"https://merchant.w1.ru/checkout/default.aspx\" accept-charset=\"UTF-8\" method=\"POST\">";

                foreach ($form as $name => $value)
                {
                    if(is_array($value))
                        foreach ($value as $v)
                            $result .="<input type=\"hidden\" name=\"$name\"    value=\"$v\" />";
                    else
                        $result .="<input type=\"hidden\" name=\"$name\"    value=\"$value\" />";
                }
                $result .= "<input type=\"submit\" value=\"$button_text\"/>";
                
		return $result;
	}
}
