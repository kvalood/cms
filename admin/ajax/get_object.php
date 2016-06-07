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

switch ($object)
{
    case 'tags':
    	if($simpla->managers->access('tags'))
        $result = $simpla->tags->get_tag($id);
        break;
}

header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");		
$json = json_encode($result);
print $json;