<?php

// Базовый класс для всех View

require_once('api/Simpla.php');

class View extends Simpla
{
	/* Смысл класса в доступности следующих переменных в любом View */
	public $currency;
	public $currencies;
	public $user;
	public $group;
    public $manager;
	
	/* Класс View похож на синглтон, храним статически его инстанс */
	private static $view_instance;
	
	public function __construct()
	{
		parent::__construct();
		
		// Если инстанс класса уже существует - просто используем уже существующие переменные
		if(self::$view_instance)
		{
			$this->currency     = &self::$view_instance->currency;
			$this->currencies   = &self::$view_instance->currencies;
			$this->user         = &self::$view_instance->user;
			$this->group        = &self::$view_instance->group;
			$this->manager      = &self::$view_instance->manager;
		}
		else
		{
			// Сохраняем свой инстанс в статической переменной,
			// чтобы в следующий раз использовать его
			self::$view_instance = $this;

            // Если администратор, передадим логин админа в шаблон.
            if(isset($_SESSION['admin']) &&  $_SESSION['admin'] == 'admin') {
                $this->manager = $this->managers->get_manager($_SESSION['admin_login']);
                $this->design->assign('manager', $this->manager->login);
            }

			// Все валюты
			$this->currencies = $this->money->get_currencies(['enabled'=>1]);
	
			// Выбор текущей валюты
			if($currency_id = $this->request->get('currency_id', 'integer'))
			{
				$_SESSION['currency_id'] = $currency_id;
				header("Location: ".$this->request->url(['currency_id'=>null]));
			}

			// Берем валюту из сессии
			if(isset($_SESSION['currency_id']))
				$this->currency = $this->money->get_currency($_SESSION['currency_id']);
			// Или первую из списка
			else
				$this->currency = reset($this->currencies);
	
			// Пользователь, если залогинен
			if(isset($_SESSION['user_id']))
			{
				$u = $this->users->get_user(intval($_SESSION['user_id']));
				if($u && $u->enabled)
				{
					$this->user  = $u;
					$this->group = $this->users->get_group($this->user->group_id);
				}
			}

			// Передаем в дизайн то, что может понадобиться в нем
			$this->design->assign('currencies',	$this->currencies);
			$this->design->assign('currency',	$this->currency);
			$this->design->assign('user',       $this->user);
			$this->design->assign('group',      $this->group);

			// Настраиваем плагины для смарти
			$this->design->smarty->registerPlugin("function", "get_brands",              [$this, 'get_brands_plugin']);
			$this->design->smarty->registerPlugin("function", "get_browsed_products",    [$this, 'get_browsed_products']);
			$this->design->smarty->registerPlugin("function", "get_featured_products",   [$this, 'get_featured_products_plugin']);
			$this->design->smarty->registerPlugin("function", "get_new_products",        [$this, 'get_new_products_plugin']);
			$this->design->smarty->registerPlugin("function", "get_discounted_products", [$this, 'get_discounted_products_plugin']);
			$this->design->smarty->registerPlugin("function", "get_article",             [$this, 'get_article_plugin']);

            // Изображения баннера
			$this->design->smarty->registerPlugin("function", "get_banner_images",       [$this, 'get_banner_images_plugin']);

            // вывод меню
            $this->design->smarty->registerPlugin("function", "get_menu",                [$this, 'get_menu_plugin']);

            // Следующие товары из этой-же категории, если нет связных товаров.
            $this->design->smarty->registerPlugin("function", "get_category_products",   [$this, 'get_category_products_plugin']);
		}
	}
    
	/**
	 *
	 * Отображение
	 *
	 */
	function fetch()
	{
		return false;
	}


    public function get_menu_plugin($params, &$smarty)
    {
        if(!empty($params['var']))
        {
            $menu = $this->menu->list_id($params['id'], ['visible'=>1]);

            foreach($menu as $key => $item) {
                if($item->home)
                    $item->url = '/';
            }

            $smarty->assign($params['var'], $menu);
        }
    }

	/*
	Последние записи из заданой категории с заданым лимитом Absorber 2014
	+ программный вывод УРЛ материалов.
	Плагины для смарти
	*/	
	public function get_article_plugin($params, &$smarty)
	{
		if(!empty($params['var']))
		{
            //all_url - Для вывода урл категории
			$articles = $this->article->get_articles($params);
			
			if($params['all_url'])
				foreach($articles as $key => $a)
					$articles[$key]->url = '/'.$a->category_url.'/'.$a->url;

			$smarty->assign($params['var'], $articles);
		}
	}

	/**
	 *
	 * Плагины для смарти
	 *
	 */	
	public function get_brands_plugin($params, &$smarty)
	{
		if(!empty($params['var']))
			$smarty->assign($params['var'], $this->brands->get_brands($params));
	}
	
	public function get_browsed_products($params, &$smarty)
	{
		if(!empty($_COOKIE['browsed_products']))
		{
			$browsed_products_ids = explode(',', $_COOKIE['browsed_products']);
			$browsed_products_ids = array_reverse($browsed_products_ids);
			if(isset($params['limit']))
				$browsed_products_ids = array_slice($browsed_products_ids, 0, $params['limit']);

			$products = [];
			foreach($this->products->get_products(['id'=>$browsed_products_ids, 'visible'=>1]) as $p)
				$products[$p->id] = $p;
			
			$browsed_products_images = $this->products->get_images(['product_id'=>$browsed_products_ids]);
			foreach($browsed_products_images as $browsed_product_image)
				if(isset($products[$browsed_product_image->product_id]))
					$products[$browsed_product_image->product_id]->images[] = $browsed_product_image;
			
			foreach($browsed_products_ids as $id)
			{	
				if(isset($products[$id]))
				{
					if(isset($products[$id]->images[0]))
						$products[$id]->image = $products[$id]->images[0];
					$result[] = $products[$id];
				}
			}
			$smarty->assign($params['var'], $result);
		}
	}
	
	
	public function get_featured_products_plugin($params, &$smarty)
	{
		if(!isset($params['visible']))
			$params['visible'] = 1;
		$params['featured'] = 1;
		
		if(!empty($params['var']))
		{
			foreach($this->products->get_products($params) as $p)
				$products[$p->id] = $p;

			if(!empty($products))
			{
				// id выбраных товаров
				$products_ids = array_keys($products);
		
				// Выбираем варианты товаров
				$variants = $this->variants->get_variants(['product_id'=>$products_ids, 'in_stock'=>true]);
				
				// Для каждого варианта
				foreach($variants as &$variant)
				{
					// добавляем вариант в соответствующий товар
					$products[$variant->product_id]->variants[] = $variant;
					/*size_color*/
                    $cur_product = $products[$variant->product_id];
                    if (!isset($cur_product->size_color)) {
                        $cur_product->size_color = [];
                    }
                    if (!empty($variant->name)) {
                        if(empty($cur_product->size_color[$variant->name."__".$cur_product->id])) {
                            $cur_product->size_color[$variant->name."__".$cur_product->id] = [];
                        }
                        $cur_product->size_color[$variant->name."__".$cur_product->id][] = $variant;
                    }
                    /*size_color*/
				}
				
				// Выбираем изображения товаров
				$images = $this->products->get_images(['product_id'=>$products_ids]);
				foreach($images as $image)
					$products[$image->product_id]->images[] = $image;
	
				foreach($products as &$product)
				{
					//Добавляем свойства товарам.
					$product->features = $this->features->get_product_options(['product_id'=>$product->id]);
					
					if(isset($product->variants[0]))
						$product->variant = $product->variants[0];
					if(isset($product->images[0]))
						$product->image = $product->images[0];
				}				
			}

			$smarty->assign($params['var'], $products);
		}
	}


    // Следующие товары из этой-же категории, если нет связных товаров.
    public function get_category_products_plugin($params, &$smarty)
    {
        if(empty($params['limit']))
            $params['limit'] = 10;

        $products = new StdClass;

        $category = $this->categories->get_categories(['product_id' => $params['product_id']]);
        $category = reset($category);

        $products_count = $this->products->count_products(['category_id' => $category->id, 'limit' => count($products->categories), 'in_stock'=>1, 'visible'=>1]);

        $related_products = [];
        $after = false;

        $products = $this->products->get_products(['category_id' => $category->id, 'limit' => $products_count, 'in_stock'=>1, 'visible'=>1]);

        foreach($products as $p)
        {
            if($after && count($related_products) < $params['limit'])
                $related_products[$p->id] = $p;
            elseif($p->id == $params['product_id'])
                $after = true;
        }

        if(count($related_products) < $params['limit'])
            foreach($products as $p)
                if($p->id != $params['product_id'] && count($related_products) < $params['limit'])
                    $related_products[$p->id] = $p;
                else break;

        $related_products_images = $this->products->get_images(['product_id'=>array_keys($related_products)]);

        foreach($related_products_images as $related_product_image) {

            if (isset($related_products[$related_product_image->product_id])) {
                $related_products[$related_product_image->product_id]->images[] = $related_product_image;
            }

            $related_products_variants = $this->variants->get_variants(['product_id' => array_keys($related_products), 'instock' => true]);
        }

        foreach($related_products_variants as $related_product_variant)
        {
            if(isset($related_products[$related_product_variant->product_id]))
            {
                $related_products[$related_product_variant->product_id]->variants[] = $related_product_variant;
            }
        }

        foreach($related_products as $r)
        {
            $r->image = &$r->images[0];
            $r->variant = &$r->variants[0];
        }

        $smarty->assign($params['var'], $related_products);
    }
		


	public function get_new_products_plugin($params, &$smarty)
	{
		if(!isset($params['visible']))
			$params['visible'] = 1;
		if(!isset($params['sort']))
			$params['sort'] = 'created';
		if(!empty($params['var']))
		{
			foreach($this->products->get_products($params) as $p)
				$products[$p->id] = $p;

			if(!empty($products))
			{
				// id выбраных товаров
				$products_ids = array_keys($products);
		
				// Выбираем варианты товаров
				$variants = $this->variants->get_variants(['product_id'=>$products_ids, 'in_stock'=>true]);
				
				// Для каждого варианта
				foreach($variants as &$variant)
				{
					// добавляем вариант в соответствующий товар
					$products[$variant->product_id]->variants[] = $variant;
					/*size_color*/
                    $cur_product = $products[$variant->product_id];
                    if (!isset($cur_product->size_color)) {
                        $cur_product->size_color = [];
                    }
                    if (!empty($variant->name)) {
                        if(empty($cur_product->size_color[$variant->name."__".$cur_product->id])) {
                            $cur_product->size_color[$variant->name."__".$cur_product->id] = [];
                        }
                        $cur_product->size_color[$variant->name."__".$cur_product->id][] = $variant;
                    }
                    /*/size_color*/
				}
				
				// Выбираем изображения товаров
				$images = $this->products->get_images(['product_id'=>$products_ids]);
				foreach($images as $image)
					$products[$image->product_id]->images[] = $image;
	
				foreach($products as &$product)
				{
					//Добавляем свойства товарам.
					$product->features = $this->features->get_product_options(['product_id'=>$product->id]);
					
					if(isset($product->variants[0]))
						$product->variant = $product->variants[0];
					if(isset($product->images[0]))
						$product->image = $product->images[0];
				}			
			}

			$smarty->assign($params['var'], $products);
			
		}
	}
	
	
	public function get_discounted_products_plugin($params, &$smarty)
	{
		if(!isset($params['visible']))
			$params['visible'] = 1;
		$params['discounted'] = 1;
		if(!empty($params['var']))
		{
			foreach($this->products->get_products($params) as $p)
				$products[$p->id] = $p;

			if(!empty($products))
			{
				// id выбраных товаров
				$products_ids = array_keys($products);
		
				// Выбираем варианты товаров
				$variants = $this->variants->get_variants(['product_id'=>$products_ids, 'in_stock'=>true]);
				
				// Для каждого варианта
				foreach($variants as &$variant)
				{
					// добавляем вариант в соответствующий товар
					$products[$variant->product_id]->variants[] = $variant;
					/*size_color*/
                    $cur_product = $products[$variant->product_id];
                    if (!isset($cur_product->size_color)) {
                        $cur_product->size_color = [];
                    }
                    if (!empty($variant->name)) {
                        if(empty($cur_product->size_color[$variant->name."__".$cur_product->id])) {
                            $cur_product->size_color[$variant->name."__".$cur_product->id] = [];
                        }
                        $cur_product->size_color[$variant->name."__".$cur_product->id][] = $variant;
                    }
                    /*/size_color*/
				}
				
				// Выбираем изображения товаров
				$images = $this->products->get_images(['product_id'=>$products_ids]);
				foreach($images as $image)
					$products[$image->product_id]->images[] = $image;
	
				foreach($products as &$product)
				{
					//Добавляем свойства товарам.
					$product->features = $this->features->get_product_options(['product_id'=>$product->id]);

					if(isset($product->variants[0]))
						$product->variant = $product->variants[0];
					if(isset($product->images[0]))
						$product->image = $product->images[0];
				}				
			}

			$smarty->assign($params['var'], $products);			
		}
	}
	
	//Слайдер
	public function get_banner_images_plugin($params,  &$smarty)
	{
		if(!empty($params['var']) AND !empty($params['banner_id'])) {

            // Показываем только видимые слайды
            $params['visible'] = 1;
            $smarty->assign($params['var'], $this->banner->get_banner_images($params));
        }
	}
}