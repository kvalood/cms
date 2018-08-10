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

$object = $simpla->request->post('object');
$values = $simpla->request->post('values');

switch ($object)
{
    case 'tags':
		if($simpla->managers->access('tags'))
		{
			$array = array();	
			foreach (explode('&', urldecode($values)) as $v) {		
				$name = explode("=", $v);
				$array[$name[0]]=$name[1];
			}
			$result = $simpla->tags->add_tag($array);			
		}
        $result = $simpla->tags->add_tag($values);
        break;
}

header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");		
$json = json_encode($result);
print $json;