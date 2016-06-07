<?php
	session_start();
	chdir('..');
	require_once('api/Simpla.php');
	$simpla = new Simpla();
	$result = array();
	
	//Полученный урл
	$r_1 = $simpla->request->get('url');
	
	//Узнаем тип пункта меню, материал или категория?
	$get_type = $simpla->menu->get_url($r_1);
	$type = $get_type->type;
	//если не удалось узнать тип по меню, значит выводим материал с таким урл.
	if(empty($type))
	{
		$type=1;
		$url = $simpla->article->get_article($r_1);
		$id = $r_1;
	}
	else
	{
		$url = $simpla->menu->get_url($r_1);
		$id = (int) $url->id_show;
	}
				
	switch($type)
	{
		//Материал
		case '1':
		{
			$show_article = $simpla->article->get_article($id);
			if(!empty($show_article))
			{
				//Если меню включены, то показываем. $show_article->visible==1 AND 
				if($url->visible==1)
				{
					//Узнаем какой шаблон задавался для категории в пункте меню
					$item_tpl = $url->template.'.tpl';
					//echo $item_tpl;
					$simpla->design->assign('article', $show_article);
					// Мета-теги
					if(!empty($meta->meta_title)){$meta_title=$show_article->meta_title;}else{$meta_title=$url->name;}
					$simpla->design->assign('meta_title', $meta_title);
					$simpla->design->assign('meta_keywords', $show_article->meta_keywords);
					$simpla->design->assign('meta_description', $show_article->meta_description);
								
					//Проверяем, есть ли темплейт для материала в категории
					if(file_exists($simpla->design->smarty->template_dir.'/'.$item_tpl))
					{
						$result['article'] = $simpla->design->fetch($item_tpl);
					}
					else
					{
						//Если нету, используем дефолтный
						$result['article'] = $simpla->design->fetch('article_item.tpl');
					}
				}
			}
		break;
		}
					
		//Категория
		case '2':
		{
			$filter = array();
			$filter['id']=$id;
			$filter['visible']=1;
			if($url->visible==1)
			{			
				$show_category = $simpla->article->get_articles_cat($filter);
				//Узнаем какой шаблон задавался для категории в пункте меню
				$item_tpl = $url->template.'.tpl';
							
				$simpla->design->assign('article', $show_category);
				// Мета-теги, берем из пункта меню.
				$meta = $simpla->menu->get_url($r_1);
				if(!empty($meta->meta_title)){$meta_title=$meta->meta_title;}else{$meta_title=$meta->name;}
				$simpla->design->assign('meta_title', $meta_title);
				$simpla->design->assign('meta_keywords', $meta->meta_keywords);
				$simpla->design->assign('meta_description', $meta->meta_description);
							
				//Отдадим название категории в шаблон
				$simpla->design->assign('category', $meta);
							
				//Проверяем, есть ли темплейт для материала в категории
				if(file_exists($simpla->design->smarty->template_dir.'/'.$item_tpl))
				{
					$result['article'] = $simpla->design->fetch($item_tpl);
				}
				else
				{
					//Если нету, используем дефолтный
					$result['article'] = $simpla->design->fetch('article.tpl');
					}
				}
		}
	}
	$result['url'] = $get_type->url;
	$result['title'] = $meta_title;
	header("Content-type: application/json; charset=UTF-8");
	header("Cache-Control: must-revalidate");
	header("Pragma: no-cache");
	header("Expires: -1");		
	print json_encode($result);


