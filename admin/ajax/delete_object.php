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
    case 'feedback':
		if($simpla->managers->access('feedback'))
			$result = $simpla->feedback->delete_feedback($id);
		break;

    case 'article':
        if($simpla->managers->access('article'))
            $result = $simpla->article->delete_article($id);
        break;
	
	case 'article_category':
        if($simpla->managers->access('articlecat'))
            $result = $simpla->article->del_cat($id);
        break;

    case 'menu_item':
		if($simpla->managers->access('menu'))
			$result = $simpla->menu->del_id($id);
        break;
		
	case 'product':
		if($simpla->managers->access('products'))
			$result = $simpla->products->delete_product($id);
        break;
		
	case 'product_categories':
		if($simpla->managers->access('categories'))
			$result = $simpla->categories->delete_category($id);
        break;

    case 'feature':
        if($simpla->managers->access('features'))
            $result = $simpla->features->delete_feature($id);
        break;
		
	case 'tags':
		if($simpla->managers->access('tags'))
			$result = $simpla->tags->remove_tag($id);
        break;
}

header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");		
$json = json_encode($result);
print $json;