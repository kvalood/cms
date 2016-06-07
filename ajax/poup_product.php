<?php
	session_start();
	require_once('../api/Simpla.php');
	$simpla = new Simpla();
	
	$product_id = $simpla->request->get('product_id', 'integer');
	
	if($product_id)
	{
		//Товар
		$product = new StdClass();
		$product = $simpla->products->get_product($product_id);
		
		//Изображения товаров
		$product->images = $simpla->products->get_images(array('product_id'=>$product->id));
		$product->image = reset($product->images);
		
		//Свойства товара
		$product->features = $simpla->features->get_product_options(array('product_id'=>$product->id));
		
		//Отдаем количество комментов к товару.
		$product->count_comments = $simpla->comments->count_comments(array('type'=>'product', 'object_id'=>$product->id, 'approved'=>1));
		
		//Валюта
		$currencies = $simpla->money->get_currencies(array('enabled'=>1));
		if(isset($_SESSION['currency_id']))
			$currency = $simpla->money->get_currency($_SESSION['currency_id']);
		else
			$currency = reset($currencies);
		
		//Варианты (что бы показывать цену и наличие)
		$variants = array();
		foreach($simpla->variants->get_variants(array('product_id'=>$product_id, 'in_stock'=>true)) as $v)
			$variants[$v->id] = $v;
		
		$product->variants = $variants;
		
		// Вариант по умолчанию
		if(($v_id = $simpla->request->get('variant', 'integer'))>0 && isset($variants[$v_id]))
			$product->variant = $variants[$v_id];
		else
			$product->variant = reset($variants);
			
		// Соседние товары + изображения для них
		$next_product = $simpla->products->get_next_product($product->id);
		$prev_product = $simpla->products->get_prev_product($product->id);
		
		if(!empty($next_product))
		{		
			$next_product->images = $simpla->products->get_images(array('product_id'=>$next_product->id));
			$next_product->image = reset($next_product->images);
		}
		
		if(!empty($prev_product))
		{		
			$prev_product->images = $simpla->products->get_images(array('product_id'=>$prev_product->id));
			$prev_product->image = reset($prev_product->images);
		}
		
		$simpla->design->assign('next_product', $next_product);
		$simpla->design->assign('prev_product', $prev_product);
		
		//Выбираем категорию товара
		$category = $simpla->categories->get_category((int)$product->category_id);
		
		//Отдаем в дизайн.
		$simpla->design->assign('currency',	$currency);
		$simpla->design->assign('product', $product);
		$simpla->design->assign('category', $category);
		
		
		echo $simpla->design->fetch($simpla->config->root_dir.'design/'.$simpla->settings->theme.'/html/poup_product.tpl');
	}