<?php

	require_once('../api/Simpla.php');
	$simpla = new Simpla();
	$limit = 15;
	
	//найдем товары по ключам
	$keyword = $simpla->request->get('query', 'string');
	$kw = $simpla->db->escape($keyword);
	$simpla->db->query("SELECT p.id, p.name, i.filename as image FROM __products p
	                    LEFT JOIN __images i ON i.product_id=p.id AND i.position=(SELECT MIN(position) FROM __images WHERE product_id=p.id LIMIT 1)
	                    WHERE (p.name LIKE '%$kw%' OR p.meta_keywords LIKE '%$kw%' OR p.id in (SELECT product_id FROM __variants WHERE sku LIKE '%$kw%')) 
	                    AND visible=1 
	                    GROUP BY p.id
	                    ORDER BY p.name 
	                    LIMIT ?", $limit);
						
	$products = $simpla->db->results();

	$suggestions = array();
	
	foreach($products as $product)
	{
		$suggestion = new stdClass();
		if(!empty($product->image))
			$product->image = $simpla->design->resize_modifier($product->image, 35, 35);
			
		$suggestion->value = $product->name;
		
		//Получим цену, старую цену, артикул
		$simpla->db->query('SELECT price,compare_price,sku FROM __variants WHERE product_id=?', (int) $product->id);
		$pr = $simpla->db->results();
		
		//$product->price = round($pr[0]->price);
		//$product->compareprice = round($pr[0]->compare_price);
		
		if(!empty($pr[0]->compare_price) AND round($pr[0]->compare_price)>0)
		{
			$product->price=round($pr[0]->compare_price);
			$product->css = 'sale';
		}
		else
		{
			$product->price = round($pr[0]->price);
			$product->css = 'normal';
		}
		
		
		$product->sku = $pr[0]->sku;
		
		//Узнаем категорию товара
		$simpla->db->query('SELECT category_id FROM __products_categories WHERE product_id=?', (int) $product->id);
		$p_cat_id = $simpla->db->results();	
		//Получаем данные о категории.
		$simpla->db->query('SELECT name,url FROM __categories WHERE id=?', $p_cat_id[0]->category_id);
		$p_cat_info = $simpla->db->results();
		
		$product->catname = $p_cat_info[0]->name;
		$product->caturl = $p_cat_info[0]->url;
		

		$suggestion->data = $product;
		$suggestions[] = $suggestion;
	}
	
	//Найдем категории по ключам
	//$simpla->db->query('SELECT name,url FROM __categories WHERE name LIKE "%'.$simpla->db->escape($keyword).'%" AND visible=1');
	//$categories = $simpla->db->results();
	
	
	$res = new stdClass;
	$res->query = $keyword;
	$res->suggestions = $suggestions;
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");		
	print json_encode($res);
