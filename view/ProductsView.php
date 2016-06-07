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
        $category_url   = $this->request->get('category', 'string');
        $brand_url      = $this->request->get('brand', 'string');
        $keyword        = $this->request->get('keyword');
        $sort           = $this->request->get('sort', 'string');

        //Фильтр для товаров
        $filter = array();
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

            //Получим все свойства товаров в нужной категории (нужно для фильтра), показываемыые в фильтре
            $all_features = $this->features->get_features(array('category_id'=>$category->id, 'in_filter'=>1));
        }

        // Если задано ключевое слово
        if (!empty($keyword))
        {
            $this->design->assign('keyword', $keyword);
            $filter['keyword'] = $keyword;
        }

        // Свойства товаров
        if(!empty($category) && $all_features)
        {
            // Пересоберем его. (для быстрого доступка к свойствам) по ID
            foreach($all_features as $key => $feature)
            {
                $all_features[$feature->id] = $feature;
                unset($all_features[$key]);
            }


            // выбираем все значения свойств
            $features_ids = array_keys($all_features);
            $options = $this->features->get_options(['feature_id' => $features_ids, 'category_id' => $category->children]);

            // Добавляем значения свойств от товаров в СВОЙСТВО
            $features = [];
            foreach($options as $key => $o)
            {
                if(isset($all_features[$o->feature_id]))
                {
                    // Мультисвойства
                    if($exp = explode(',',$o->value))
                        foreach(array_diff($exp, array('')) as $v)
                            $features[$o->feature_id][] = trim($v);
                    else
                        $features[$o->feature_id][] = $o->value;

                    $all_features[$o->feature_id]->value = array_unique($features[$o->feature_id]);


                    // Добавляем минимальное и максимальное значение для группы слайдера
                    if($all_features[$o->feature_id]->type == 2)
                    {
                        $all_features[$o->feature_id]->min = min($all_features[$o->feature_id]->value);
                        $all_features[$o->feature_id]->max = max($all_features[$o->feature_id]->value);
                    }
                }
            }
        }


        // Фильтр по товарам
        if(($filter_data = $this->request->get('f'))  && !empty($category))
        {
            // Разбиваем свойства
            $filter_data = array_diff(explode(';', $filter_data), array(''));

            foreach($filter_data as $key => $f)
            {
                $f = explode(':', $f);
                $f[1] = preg_replace("/[^0-9-.,]/", '', $f[1]);

                if(isset($all_features[$f[0]]))
                {
                    // Узнаем тип фильтруемого свойства (для передачи в модель) и дизайн
                    switch($all_features[$f[0]]->type)
                    {
                        // Фильтр с типом "Группа checkbox" (Сортировка происходит по очереди свойств)
                        case '1':

                            // Соответствие порядкового номера и значения
                            $valent = [];
                            foreach(array_values(array_diff(explode(',', $f[1]), array(''))) as $v) {
                                if (isset($all_features[$f[0]]->value[$v])) {
                                    $valent[$v] = $all_features[$f[0]]->value[$v];
                                    //$valent[$v] = $all_features[$f[0]]->value[$v];
                                }
                            }

                            if(isset($valent))
                                $filter['features'][$f[0]] = $valent;
                            break;

                        // Фильтр с типом "Слайдер-диапазон"
                        case '2':

                            // Если значение вида 200:-100; или 200:50-; или 2 параметра 200:50-100;
                            if(mb_substr($f[1], -1, 1) == '-') {
                                $filter['features_range'][$f[0]] = ['min' => preg_replace('~\D+~', '', $f[1])];
                            }elseif(mb_substr($f[1], 0, 1) == '-') {
                                $filter['features_range'][$f[0]] = ['max' => preg_replace('~\D+~', '', $f[1])];
                            }elseif(count($val) == 2) {
                                $val = array_values(array_diff(explode('-', $f[1]), array('')));
                                $filter['features_range'][$f[0]] = ['min' =>preg_replace('~\D+~','',$val[0]), 'max' => preg_replace('~\D+~','',$val[1])];
                            }

                            break;
                    }
                }

                // фильтр по цене
                if($f[0] == 'p') {
                    $val = array_values(array_diff(explode('-', $f[1]), array('')));

                    if(mb_substr($f[1], -1, 1) == '-') {
                        $filter['price']['min'] = $val[0];
                    }elseif(mb_substr($f[1], 0, 1) == '-') {
                        $filter['price']['max'] = $val[0];
                    }elseif(count($val) == 2) {
                        $filter['price'] = ['min' =>preg_replace('~\D+~','',$val[0]), 'max' => preg_replace('~\D+~','',$val[1])];
                    }
                }

                // Фильтр по бренду
                if($f[0] == 'b') {
                    $filter['brand_id'] = array_values(array_diff(explode(',', $f[1]), array('')));
                    // $this->design->assign('brands_active', $filter['brand_id']);
                }
            }
        }


        // Нужно отдать максимальную и минимальную цену товаров в этой категории.
        $price_filter['visible'] = $filter['visible'];

        if(isset($category->id))
            $price_filter['category_id'] = $category->id;
        elseif(isset($filter['keyword']))
            $price_filter['keyword'] = $filter['keyword'];

        $price_cat = $this->products->max_min_products($price_filter);
        $price_cat->min_price = ceil($price_cat->min_price);
        $price_cat->max_price = ceil($price_cat->max_price);
        $this->design->assign('price_cat', $price_cat);


        // Отдаем в фильтр только существующие параметры, что бы отсечь несуществующие товары
        if(!empty($category) && $all_features)
        {
            $ids = '';
            foreach ($this->products->get_products($filter) as $p)
                $ids[$p->id] = $p;

            if (!empty($ids)) {
                $ids = array_keys($ids);
                $features_available = $this->features->get_options(['product_id' => $ids, 'category_id' => $category->children, 'feature_id' => $features_ids]);
                foreach ($features_available as $key => $f) {
                    $features_available[$f->feature_id][] = $f->value;
                    unset($features_available[$key]);
                }
                $this->design->assign('f_av', $features_available);
            }

            $this->design->assign('features', $all_features);

            // Отдаем все устанолвеные Параметры $filter в дизайн, для фильтра.
            $this->design->assign('filter', $filter);
        }



        // ???
        $discount = 0;
        if(isset($_SESSION['user_id']) && $user = $this->users->get_user(intval($_SESSION['user_id'])))
            $discount = $user->discount;



        // Сортировка товаров, сохраняем в сесси, чтобы текущая сортировка оставалась для всего сайта
        if($sort)
            $_SESSION['sort'] = $sort;
        if (!empty($_SESSION['sort']))
            $filter['sort'] = $_SESSION['sort'];
        else
            $filter['sort'] = $this->settings->sorting_method;

        $this->design->assign('sort', $filter['sort']);


        /*** Постраничная навигация ***/
        $items_per_page = $this->settings->products_num;
        // Текущая страница в постраничном выводе
        $current_page = $this->request->get('page', 'integer');
        // Если не задана, то равна 1
        $current_page = max(1, $current_page);
        $this->design->assign('current_page_num', $current_page);

        $filter['page'] = $current_page;
        $filter['limit'] = $items_per_page;


        /*** Загружаем товары ***/
        switch($this->settings->products_end_list) {

            // Скрываем товары не в наличии
            case 'in_stock' :
                $filter['in_stock'] = 1;
                break;

            // товары не в наличии, в конце списка
            case 'end_list' :
                $filter_end_list = $filter;
                $filter_end_list['in_stock'] = 1;

                $products_in_stock = $this->products->get_products($filter_end_list);

                if(count($products_in_stock) < $items_per_page)
                {
                    $count_in_stock = $this->products->count_products($filter_end_list);
                    $of_stock_page = floor(($count_in_stock - ($items_per_page * ($current_page))) / $items_per_page) * -1;

                    $filter_end_list['limit_diff'] = (count($products_in_stock) == 0) ? $count_in_stock - ($current_page - $of_stock_page) * $items_per_page : 0;
                    $filter_end_list['page'] = $of_stock_page;
                    $filter_end_list['limit'] -= count($products_in_stock);
                    $filter_end_list['in_stock'] = 0;
                    $filter_end_list['out_stock'] = 1;

                    $products_out_stock = $this->products->get_products($filter_end_list);
                    $products_in_stock = array_merge($products_in_stock, $products_out_stock);
                }
                break;
        }

        /*** Постраничная навигация ***/
        // Вычисляем количество страниц
        $products_count = $this->products->count_products($filter);

        // Показать все страницы сразу
        if($this->request->get('page') == 'all')
            $items_per_page = $products_count;

        $pages_num = ceil($products_count/$items_per_page);
        $this->design->assign('total_pages_num', $pages_num);
        $this->design->assign('total_products_num', $products_count);


        // Загружаем товары
        if(!isset($products_in_stock))
            $products_in_stock = $this->products->get_products($filter);

        $products = [];
        foreach($products_in_stock as $p)
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
                $products[$variant->product_id]->variants[] = $variant;
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
            }

            $images = $this->products->get_images(array('product_id'=>$products_ids));
            foreach($images as $image)
                $products[$image->product_id]->images[] = $image;


            // Получаю все свойства, которые нужно отображать в каталоге у item товара
            $option_filter = ['product_id' => $products_ids, 'visible_feature_item' => 1];

            if(!empty($category))
                $option_filter['category_id'] = $category->children;

            $options_item = $this->features->get_options($option_filter);
            foreach($options_item as $option)
                $products[$option->product_id]->features[$option->feature_id] = ['value'=>$option->value, 'name'=>$option->name];

            foreach($products as &$product)
            {
                if(isset($product->variants[0]))
                    $product->variant = $product->variants[0];
                if(isset($product->images[0]))
                    $product->image = $product->images[0];
            }

            $this->design->assign('products', $products);
        }

        // Выбираем бренды, они нужны нам в шаблоне
        if(!empty($category))
            $category->brands = $this->brands->get_brands(['category_id' => $category->children]);

        // Устанавливаем мета-теги в зависимости от запроса
        if(isset($category))
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


        return $this->design->fetch('products.tpl');
    }
}