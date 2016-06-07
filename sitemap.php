<?php

require_once('api/Simpla.php');
$simpla = new Simpla();

header("Content-type: text/xml; charset=UTF-8");
print '<?xml version="1.0" encoding="UTF-8"?>'."\n";
print '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

// Главная страница
$url = $simpla->config->root_url;
$lastmod = date("Y-m-d");
print "\t<url>"."\n";
print "\t\t<loc>$url</loc>"."\n";
print "\t\t<lastmod>$lastmod</lastmod>"."\n";
print "\t</url>"."\n";

// Карта сайта sitemap
$lastmod = date("Y-m-d");
print "\t<url>"."\n";
print "\t\t<loc>".$simpla->config->root_url."/sitemap</loc>"."\n";
print "\t\t<lastmod>$lastmod</lastmod>"."\n";
print "\t</url>"."\n";

// материалы из меню и подкатегорий меню. (Только видимые)
foreach($simpla->menu->all_list_id() as $menu_item)
{
	if($menu_item->home!=1)
	{
		if($menu_item->type==1)
		{
			//Выводим все корневые материалы
			$article = $simpla->article->get_article((int) $menu_item->id_show);
			if($article->visible==1 AND $menu_item->visible==1)
			{
				$url = $simpla->config->root_url.'/'.esc($menu_item->url);
				print "\t<url>"."\n";
				print "\t\t<loc>$url</loc>"."\n";
				if(!empty($article->date_update)){last_update($article->date_update);}
				print "\t</url>"."\n";
			}
		}
		elseif($menu_item->type==2)
		{
			//Выводим все категории (заданные пунктами меню)
			if($menu_item->visible==1)
			{
				$url = $simpla->config->root_url.'/'.$menu_item->url;
				print "\t<url>"."\n";
				print "\t\t<loc>$url</loc>"."\n";
				print "\t</url>"."\n";

			}	
		
			//выводим все материалы категории (С только отображаемой категорией на сайте)
			$filter = array();
			$filter['id'] = $menu_item->id_show;
			$filter['visible'] = 1;
			
			if($menu_item->visible==1)
			{
				foreach($simpla->article->get_articles($filter) as $a_cat)
				{
					
						$url = $simpla->config->root_url.'/'.$menu_item->url.'/'.esc($a_cat->url);
						print "\t<url>"."\n";
						print "\t\t<loc>$url</loc>"."\n";
						if(!empty($a_cat->date_update)){last_update($a_cat->date_update);}
						print "\t</url>"."\n";

				}
			}
		}
	}
}

// Категории Товаров
// Все категории
$all_cat = $simpla->categories->get_categories();
foreach($all_cat as $c)
{
	if($c->visible)
	{
		$url = $simpla->config->root_url.'/catalog/'.esc($c->url);
		print "\t<url>"."\n";
		print "\t\t<loc>$url</loc>"."\n";
		print "\t</url>"."\n";
	}
}

// Бренды
foreach($simpla->brands->get_brands() as $b)
{
	$url = $simpla->config->root_url.'/brands/'.esc($b->url);
	print "\t<url>"."\n";
	print "\t\t<loc>$url</loc>"."\n";
	print "\t</url>"."\n";
}

// Товары
$simpla->db->query("SELECT id, url, created, last_update FROM __products WHERE visible=1");
foreach($simpla->db->results() as $p)
{
	$url = $simpla->config->root_url.'/products/'.esc($p->url);
	
	// ID категории товара
	$category = $simpla->categories->get_product_categories($p->id);
	$cat_id = $category[0]->category_id;
	if($all_cat[$cat_id]->visible)
	{
		print "\t<url>"."\n";
		print "\t\t<loc>$url</loc>"."\n";
		if(!empty($p->last_update)){last_update($p->last_update);}elseif(!empty($p->created)){last_update($p->created);}
		print "\t</url>"."\n";
	}
}
print '</urlset>'."\n";


// Функции.
function esc($s)
{
	return(htmlspecialchars($s, ENT_QUOTES, 'UTF-8'));	
}

function last_update($date)
{
	$date = strtotime($date);
	$date = date('Y-m-d', $date);
	print "\t\t<lastmod>$date</lastmod>"."\n";	
}