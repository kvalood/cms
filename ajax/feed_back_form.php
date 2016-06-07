<?php

	require_once('../api/Simpla.php');
	$simpla = new Simpla();
	
	$send = new stdClass;
		
	$send->name         = $simpla->request->post('name');
	$send->email        = $simpla->request->post('email');
	$send->phone		= $simpla->request->post('phone');
	$send->message      = htmlspecialchars($simpla->request->post('message'));
	$product_id   		= $simpla->request->post('product_id');
	
	$error_message = '';
	
	if(strlen($send->name) < 3 && isset($send->name))
	{
		$error_message .= '<br/>'.$simpla->language->message_error_name;
	}
	
	if(!filter_var($send->email, FILTER_VALIDATE_EMAIL) && isset($send->email))
	{
		$error_message .= '<br/>'.$simpla->language->message_error_email;
	}
	
	$send->phone = preg_replace("/\D+/", "", $send->phone);
	$count_phone = (int) strlen($send->phone);
	if(($count_phone > 14 || $count_phone < 6) && isset($send->phone))
	{
		$error_message .= '<br/>'.$simpla->language->message_error_phone;
	}
	
	if($product_id)
	{
		$product = new StdClass();
		$product = $simpla->products->get_product((int)$product_id);
		$send->message .= "\n Интересует товар - <a href=\"$host/products/$product->url\" target=\"blank\">$product->name</a>";
	}
	

	if(!empty($error_message))
	{
		$error_message = $simpla->language->message_error.' '.$simpla->language->message_error_field.' '.$error_message;
		$result = 'error';
		$message = $error_message;
	}
	else
	{
		$result = 'send';
		$message = $simpla->language->message_send;
		
		//Создаем сообщение в админке, и отправляем его на почту. 
		$send->ip = $_SERVER['REMOTE_ADDR'];
		$send_id = $simpla->feedback->add_feedback($send);
		$simpla->notify->email_feedback_admin($send_id);
	}		

	$array = array ('result' => $result, 'message' => $message);
	echo "data=".json_encode($array);
?>