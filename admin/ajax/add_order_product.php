<?php
	require_once('../../api/Simpla.php');
	$simpla = new Simpla();
	$limit = 20;
	
	if(!$simpla->managers->access('orders'))
		return false;
	
	$keyword = $simpla->request->get('query', 'string');

	$keywords = explode(' ', $keyword);
	$keyword_sql = '';
	foreach($keywords as $keyword)
	{
				$kw = $simpla->db->escape(trim($keyword));
				$keyword_sql .= $simpla->db->placehold("AND (p.name LIKE '%$kw%' OR p.meta_keywords LIKE '%$kw%' OR p.id in (SELECT product_id FROM __variants WHERE sku LIKE '%$kw%'))");
	}
	
	
	$simpla->db->query('SELECT p.id, p.name, i.filename as image FROM __products p
	                    LEFT JOIN __images i ON i.product_id=p.id AND i.position=(SELECT MIN(position) FROM __images WHERE product_id=p.id LIMIT 1)
						LEFT JOIN __variants pv ON pv.product_id=p.id AND (pv.stock IS NULL OR pv.stock>0)
	                    WHERE 1 '.$keyword_sql.' AND pv.id
	                    GROUP BY p.id
	                    ORDER BY p.name LIMIT ?', $limit);

	foreach($simpla->db->results() as $product)
		$products[$product->id] = $product;
	
	$variants = array();
	if(!empty($products))
	{
		//Absorber v.color,
		$simpla->db->query('SELECT v.id, v.color, v.name, v.sku, v.price, IFNULL(v.stock, ?) as stock, (v.stock IS NULL) as infinity, v.product_id FROM __variants v WHERE v.product_id in(?@) AND (v.stock IS NULL OR v.stock>0) AND v.price>0 ORDER BY v.position', $simpla->settings->max_order_amount, array_keys($products));
		$variants = $simpla->db->results();
	}
	
	/*size_color*/
//	foreach($variants as $variant)
//		if(isset($products[$variant->product_id]))
//			$products[$variant->product_id]->variants[] = $variant;
    foreach($variants as $variant) {
        if(!empty($products[$variant->product_id])) {
            if (!isset($products[$variant->product_id]->size_color)) {
                $products[$variant->product_id]->size_color = array();
            }
            if (!empty($variant->name)) {
                if(empty($products[$variant->product_id]->size_color[$variant->name])) {
                    $products[$variant->product_id]->size_color[$variant->name] = array();
                }
                $products[$variant->product_id]->size_color[$variant->name][] = $variant;
//                if ($variant->color) {
//                    $products[$variant->product_id]->is_show[$variant->name] = true;
//                } elseif (!$products[$variant->product_id]->is_show[$variant->name]) {
//                    $products[$variant->product_id]->is_show[$variant->name] = false;
//                }
            }
            $products[$variant->product_id]->variants[] = $variant;
        }
    }
    /*/size_color*/

	
	
	$suggestions = array();
	foreach($products as $product)
	{
		if(!empty($product->variants))
		{
			$suggestion = new stdClass;
			if(!empty($product->image))
				$product->image = $simpla->design->resize_modifier($product->image, 35, 35);
			$suggestion->value = $product->name;		
			$suggestion->data = $product;		
			$suggestions[] = $suggestion;
		}
	}

	$res = new stdClass;
	$res->query = $keyword;
	$res->suggestions = $suggestions;
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");		
	print json_encode($res);
