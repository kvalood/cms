<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simplacms.ru
 * @author 		Denis Pikusov
 *
 * Этот класс использует шаблон products.tpl
 *
 */
 
require_once('View.php');

class ProductsView extends View
{
 	/**
	 *
	 * Отображение списка товаров
	 *
	 */
	function fetch()
	{
		// GET-Параметры
		$category_url = $this->request->get('category', 'string');
		$brand_url    = $this->request->get('brand', 'string');
		
		$filter = array();
		
		//Фильтр по бренду
		$filter['brand_id'] = $this->request->get('brands');
		$this->design->assign('brands_active', $filter['brand_id']);

		//Фильтр по цене
		$p_filter = array();
		$p_filter = $this->request->get('p');
		
		$filter['visible'] = 1;	

		// Если задан бренд, выберем его из базы
		
		if (!empty($brand_url))
		{
			$brand = $this->brands->get_brand((string)$brand_url);
			if (empty($brand))
				return false;
			$this->design->assign('brand', $brand);
			$filter['brand_id'] = $brand->id;
		}
	
		
		// Выберем текущую категорию
		if (!empty($category_url))
		{
			$category = $this->categories->get_category((string)$category_url);
			if (empty($category) || (!$category->visible && empty($_SESSION['admin'])))
				return false;
			$this->design->assign('category', $category);
			$filter['category_id'] = $category->children;
		}


		// Если задано ключевое слово
		$keyword = $this->request->get('keyword');
		if (!empty($keyword))
		{
			$this->design->assign('keyword', $keyword);
			$filter['keyword'] = $keyword;
		}

		// Сортировка товаров, сохраняем в сесси, чтобы текущая сортировка оставалась для всего сайта
		if($sort = $this->request->get('sort', 'string'))
			$_SESSION['sort'] = $sort;		
		if (!empty($_SESSION['sort']))
			$filter['sort'] = $_SESSION['sort'];			
		else
			$filter['sort'] = $this->settings->sorting_method;
		
		$this->design->assign('sort', $filter['sort']);
		
		// Свойства товаров
		if(!empty($category))
		{
			$features = array();
			foreach($this->features->get_features(array('category_id'=>$category->id, 'in_filter'=>1)) as $feature)
			{ 
				$features[$feature->id] = $feature;
				if(($val = $this->request->get($feature->id))!='')
				{
					$filter['features'][$feature->id] = $val;
				}
			}
			
			
			$options_filter['visible'] = 1;
			
			$features_ids = array_keys($features);
			if(!empty($features_ids))
				$options_filter['feature_id'] = $features_ids;
			$options_filter['category_id'] = $category->children;
			if(isset($filter['features']))
				//$options_filter['features'] = $filter['features'];
			if(!empty($brand))
				$options_filter['brand_id'] = $brand->id;
			
			$options = $this->features->get_options($options_filter);

			//Делаем фильтр правильным. Absorber 2014
			//Группируем значения свойств в массив.
			foreach($options as $option)
			{
				if(isset($features[$option->feature_id]))
				{
					$val[$option->feature_id][]= $option->value;					
				}				
			}			
			//Удаляет повторяющиеся значения в группах свойств
			if(!empty($val))
			{
				foreach($val as $v=>$key)
				{	
					if(count($key)>1)
					{
						$opt = implode(',',$key);
						$string = str_replace(',,', ',',$opt);
						$del_space = str_replace('','', $string);
						$sub = substr($del_space, -1);
						if($sub == ',')
						{	
							$sub_del = substr($del_space, 0,-1);
							$exp = explode(',',$sub_del);					
						}
						else
						{
							$exp = explode(',',$del_space);				
						}
						$arr_uni[$v] = array_unique($exp);
						$optioni[$v] = $this->features->get_feature($v);
						$features[$v]->options = $arr_uni[$v];
					}
				}
			}
			
			foreach($features as $i=>&$feature)
			{ 
				if(empty($feature->options))
					unset($features[$i]);
			}
			
			$this->design->assign('features', $features);			
			$this->design->assign('option', $optioni);
 		}

		// Постраничная навигация
		$items_per_page = $this->settings->products_num;		
		// Текущая страница в постраничном выводе
		$current_page = $this->request->get('page', 'integer');
		// Если не задана, то равна 1
		$current_page = max(1, $current_page);
		$this->design->assign('current_page_num', $current_page);
		// Вычисляем количество страниц
		$products_count = $this->products->count_products($filter);
		
		// Показать все страницы сразу
		if($this->request->get('page') == 'all')
			$items_per_page = $products_count;	
		
		$pages_num = ceil($products_count/$items_per_page);
		$this->design->assign('total_pages_num', $pages_num);
		$this->design->assign('total_products_num', $products_count);

		$filter['page'] = $current_page;
		$filter['limit'] = $items_per_page;
		
		///////////////////////////////////////////////
		// Постраничная навигация END
		///////////////////////////////////////////////
		
		$discount = 0;
		if(isset($_SESSION['user_id']) && $user = $this->users->get_user(intval($_SESSION['user_id'])))
			$discount = $user->discount;
		
		//Фильтр по цене
		if(!empty($category)) 
		{
			$variant_products = array();
				
			foreach($this->products->get_id_products($filter) as $p)
			{
				$variant_products[$p->id] = $p;
			}
			$variant_products_ids = array_keys($variant_products);

			//Absorber 2014			
			//Новый вариант (Статичный диапазон, берется из категории)
			$prices = $this->variants->prices_category($category->id);
				
			$end_price = array();
			$end_price['min'] = round($prices->min);
			$end_price['max'] = round($prices->max);
			if(!empty($p_filter['min']) AND $p_filter['min']>=$end_price['min'] AND $p_filter['min']<=$end_price['max'])
				$end_price['current_min'] = round($p_filter['min']);
			else
				$end_price['current_min']=$end_price['min'];
				
			if(!empty($p_filter['max']) AND $p_filter['max']<=$end_price['max'])
				$end_price['current_max'] = round($p_filter['max']);
			else
				$end_price['current_max']=$end_price['max'];
			
			//Добавляем значения в фильтр для правильного вывода товаров.
			$filter['price']['min'] = $end_price['current_min'];
			$filter['price']['max'] = $end_price['current_max'];
			
			$this->design->assign('prices_range', $end_price);
			
		}
		
		// Товары  Absorber 2014
		$products = array();
		foreach($this->products->get_products($filter) as $p)
		{
			$products[$p->id] = $p;
		}
		// Если искали товар и найден ровно один - перенаправляем на него
		if(!empty($keyword) && $products_count == 1)
			header('Location: '.$this->config->root_url.'/products/'.$p->url);
		
		if(!empty($products))
		{
			$products_ids = array_keys($products);
			foreach($products as &$product)
			{
				$product->variants = array();
				$product->images = array();
				$product->properties = array();
			}
	
			$variants = $this->variants->get_variants(array('product_id'=>$products_ids, 'in_stock'=>true));
			
			foreach($variants as &$variant)
			{
				//$variant->price *= (100-$discount)/100;
				$products[$variant->product_id]->variants[] = $variant;
				/*size_color*/
                $cur_product = $products[$variant->product_id];
                if (!isset($cur_product->size_color)) {
                    $cur_product->size_color = array();
                }
                if (!empty($variant->name)) {
                    if(empty($cur_product->size_color[$variant->name."__".$cur_product->id])) {
                        $cur_product->size_color[$variant->name."__".$cur_product->id] = array();
                    }
                    $cur_product->size_color[$variant->name."__".$cur_product->id][] = $variant;
                }
                /*/size_color*/
			}
	
			$images = $this->products->get_images(array('product_id'=>$products_ids));
			foreach($images as $image)
				$products[$image->product_id]->images[] = $image;

			foreach($products as &$product)
			{
				$product->features = $this->features->get_product_options(array('product_id'=>$product->id));
				
				if(isset($product->variants[0]))
					$product->variant = $product->variants[0];
				if(isset($product->images[0]))
					$product->image = $product->images[0];
			}
	
			/*
			$properties = $this->features->get_options(array('product_id'=>$products_ids));
			foreach($properties as $property)
				$products[$property->product_id]->options[] = $property;
			*/
	
			$this->design->assign('products', $products);
 		}
			
		// Выбираем бренды, они нужны нам в шаблоне	
		if(!empty($category))
			$category->brands = $this->brands->get_brands(['category_id' => $category->children]);

		
		// Устанавливаем мета-теги в зависимости от запроса
		if($this->page)
		{
			$this->design->assign('meta_title', $this->page->meta_title);
			$this->design->assign('meta_keywords', $this->page->meta_keywords);
			$this->design->assign('meta_description', $this->page->meta_description);
		}
		elseif(isset($category))
		{
			$this->design->assign('meta_title', $category->meta_title);
			$this->design->assign('meta_keywords', $category->meta_keywords);
			$this->design->assign('meta_description', $category->meta_description);
		}
		elseif(isset($brand))
		{
			$this->design->assign('meta_title', $brand->meta_title);
			$this->design->assign('meta_keywords', $brand->meta_keywords);
			$this->design->assign('meta_description', $brand->meta_description);
		}
		elseif(isset($keyword) && !empty($keyword))
		{
			$this->design->assign('meta_title', $keyword);
		}
		else
		{
			$this->design->assign('meta_title', $this->language->page_products);
			$this->design->assign('page_products', $this->language->page_products_breadcrumps);
		}
		
			
		$this->body = $this->design->fetch('products.tpl');
		return $this->body;
	}
}
