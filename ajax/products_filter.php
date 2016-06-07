<?php

	require_once('../api/Simpla.php');
	$simpla = new Simpla();
    $result = new stdClass;
    $result->filter = '';


	$limit = $simpla->settings->products_num;
    $filter_data = $simpla->request->get('filter');
    $category = $simpla->request->get('category', 'integer');

    // Работаем с текущей категорией
    $category = $simpla->categories->get_category((int)$category);

    // Фильтр по товарам
    if(!empty($category))
    {
        //Получим все свойства товаров в нужной категории (нужно для фильтра)
        $all_features = $simpla->features->get_features(['category_id'=>$category->id, 'in_filter'=>1]);

        // Пересоберем его. (для быстрого доступка к свойствам) по ID
        foreach($all_features as $key => $feature)
        {
            $all_features[$feature->id] = $feature;
            unset($all_features[$key]);
        }

        $filter = [];
        $filter['visible'] = 1;

        // Информация о категории
        $filter['category_id'] = $category->children;

        // Получим всевозможные значения свойств, и запишем их в $all_features, для быстрого доступа.
        $features_ids = array_keys($all_features);
        $options = $simpla->features->get_options(['feature_id' => $features_ids, 'category_id' => $category->children]);

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
		
		$result->dump = $filter_data;

        // Разбиваем свойства
        if($filter_data) {

            /* Собираем фильтр для отдачи (что бы сменить урл, динамически) */
            $result->filter = '?f=';

            // Нужно отдать максимальную и минимальную цену товаров в этой категории.
            $price_cat = $simpla->products->max_min_products(['visible' => $filter['visible'], 'category_id' => $category->id]);
            $price_cat->min_price = ceil($price_cat->min_price);
            $price_cat->max_price = ceil($price_cat->max_price);

            // Перебираем входящие свойства
            foreach ($filter_data as $key => $val) {



                // Слайдер диапазон
                if ($all_features[$key]->type == 2) {

                    if(mb_substr($f[1], -1, 1) == '-') {
                        $filter['features_range'][$key] = ['min' => preg_replace('~\D+~', '', $val['min'])];
                        $result->filter .= $key . ':' . $filter['features_range'][$key]['min'] . '-;';
                    }elseif(mb_substr($f[1], 0, 1) == '-') {
                        $filter['features_range'][$key] = ['max' => preg_replace('~\D+~', '', $val['max'])];
                        $result->filter .= $key . ':-' . $filter['features_range'][$key]['max'] . ';';
                    }elseif(count($val) == 2) {
                        $filter['features_range'][$key] = ['min' =>preg_replace('~\D+~','',$val['min']), 'max' => preg_replace('~\D+~','',$val['max'])];
                        $result->filter .= $key . ':' . $filter['features_range'][$key]['min'] . '-' . $filter['features_range'][$key]['max'] . ';';
                    }


                }
                // Если фильтр по цене
                elseif ($key == 'price')
                {
                    // Обработка фильтра по цене.
                    if(mb_substr($f[1], -1, 1) == '-') {
                        $filter['price']['min'] = preg_replace('~\D+~', '', $val['min']);
                        $result->filter .= 'p:' . $filter['price']['min'] . '-;';
                    }elseif(mb_substr($f[1], 0, 1) == '-') {
                        $filter['price']['max'] = preg_replace('~\D+~', '', $val['max']);
                        $result->filter .= 'p:-' . $filter['price']['max'] . ';';
                    }elseif(count($val) == 2) {
                        $filter['price'] = ['min' =>preg_replace('~\D+~','',$val['min']), 'max' => preg_replace('~\D+~','',$val['max'])];
                        $result->filter .= 'p:' . $filter['price']['min'] . '-' . $filter['price']['max'] . ';';
                    }
                }
                // Фильтр по брендам
                elseif ($key == 'brand')
                {
                    $filter['brand_id'] = array_values(array_diff(explode(',', $val), array('')));
                    $result->filter .= 'b:' . implode(',', $filter['brand_id']) . ';';
                }
                // Чекбоксы
                else
                {
                    $valent = [];
                    foreach (array_values(array_diff(explode(',', $val), array(''))) as $v) {
                        if (isset($all_features[$key]->value[$v])) {
                            $valent[$v] = $all_features[$key]->value[$v];
                        }
                    }

                    if (isset($valent)) {
                        $filter['features'][$key] = $valent;
                        $result->filter .= $key . ':' . implode(',', array_keys($valent)) . ';';
                    }
                }
            }

            // Отдаем в фильтр только существующие параметры, что бы отсечь несуществующие товары
            $ids = '';
            foreach($simpla->products->get_products($filter) as $p)
                $ids[$p->id] = $p;

            if(!empty($ids) && $all_features) {
                $ids = array_keys($ids);
                $features_available = $simpla->features->get_options(['product_id' => $ids, 'category_id' => $category->children, 'feature_id' => $features_ids]);
                foreach ($features_available as $key => $f) {
                    $features_available[$f->feature_id][] = $f->value;
                    unset($features_available[$key]);
                }
                $result->cl = $features_available;
            }


            /*
            $features_available = $simpla->features->get_options(['product_id'=>$products_ids]);
            foreach($features_available as $key => $f)
            {
                $features_available[$f->feature_id] = $f;
                unset($features_available[$key]);
            }


            */
        }

        // Сортировка товаров, сохраняем в сесси, чтобы текущая сортировка оставалась для всего сайта
        if(isset($_SESSION['sort']) && !empty($_SESSION['sort']))
            $filter['sort'] = $_SESSION['sort'];
        else
            $filter['sort'] = $simpla->settings->sorting_method;

        $simpla->design->assign('sort', $filter['sort']);


        // Постраничная навигация
        $items_per_page = $simpla->settings->products_num;
        $current_page = 1;
        $simpla->design->assign('current_page_num', $current_page);

        // Отдадим количество найденых товаров
        $result->count = $simpla->products->count_products($filter);

        // Отдадим в шаблон информацию о смене шаблона для пагинации.
        $simpla->design->assign('url', '/catalog/'.$category->url.$result->filter);

        $filter['page'] = $current_page;
        $filter['limit'] = $items_per_page;

        /*** Загружаем товары ***/
        switch($simpla->settings->products_end_list) {

            // Скрываем товары не в наличии
            case 'in_stock' :
                $filter['in_stock'] = 1;
                break;

            // товары не в наличии, в конце списка
            case 'end_list' :
                $filter_end_list = $filter;
                $filter_end_list['in_stock'] = 1;

                $products_in_stock = $simpla->products->get_products($filter_end_list);

                if(count($products_in_stock) < $items_per_page)
                {
                    $count_in_stock = $simpla->products->count_products($filter_end_list);
                    $of_stock_page = floor(($count_in_stock - ($items_per_page * ($current_page))) / $items_per_page) * -1;

                    $filter_end_list['limit_diff'] = (count($products_in_stock) == 0) ? $count_in_stock - ($current_page - $of_stock_page) * $items_per_page : 0;
                    $filter_end_list['page'] = $of_stock_page;
                    $filter_end_list['limit'] -= count($products_in_stock);
                    $filter_end_list['in_stock'] = 0;
                    $filter_end_list['out_stock'] = 1;

                    $products_out_stock = $simpla->products->get_products($filter_end_list);
                    $products_in_stock = array_merge($products_in_stock, $products_out_stock);
                }
                break;
        }

        // Вычисляем количество страниц
        $products_count = $simpla->products->count_products($filter);
        $pages_num = ceil($products_count/$items_per_page);
        $simpla->design->assign('total_pages_num', $pages_num);
        $simpla->design->assign('total_products_num', $products_count);


        // Загружаем товары
        if(!isset($products_in_stock))
            $products_in_stock = $simpla->products->get_products($filter);

        $products = [];
        foreach($products_in_stock as $p)
        {
            $products[$p->id] = $p;
        }

        if(!empty($products))
        {
            $products_ids = array_keys($products);
            foreach($products as &$product)
            {
                $product->variants = array();
                $product->images = array();
                $product->properties = array();
            }

            $variants = $simpla->variants->get_variants(['product_id'=>$products_ids, 'in_stock'=>true]);

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

            $images = $simpla->products->get_images(array('product_id'=>$products_ids));
            foreach($images as $image)
                $products[$image->product_id]->images[] = $image;

            // Получаю все свойства, которые нужно отображать в каталоге у item товара
            $options_item = $simpla->features->get_options(['product_id' => $products_ids, 'visible_feature_item' => 1, 'category_id' => $category->children]);
            foreach($options_item as $option)
                $products[$option->product_id]->features[$option->feature_id] = ['value'=>$option->value, 'name'=>$option->name];


            foreach($products as &$product)
            {
                if(isset($product->variants[0]))
                    $product->variant = $product->variants[0];
                if(isset($product->images[0]))
                    $product->image = $product->images[0];
            }

            $simpla->design->assign('products', $products);
        }




        /*
         * Отдаем дополнительные параметры, которые отдаются во View.php и IndexView.php
         */

        //Валюта
        $currencies = $simpla->money->get_currencies(array('enabled'=>1));
        if(isset($_SESSION['currency_id']))
            $currency = $simpla->money->get_currency($_SESSION['currency_id']);
        else
            $currency = reset($currencies);

        // Отображение товаров (кубиками / списком)
        //Отображение товаров. Блоками или списком.
        if(!isset($_SESSION['model_type']))
        {
            if($simpla->settings->model_type)
            {
                $_SESSION['model_type'] = $simpla->settings->model_type;
            }
            else
            {
                $_SESSION['model_type'] = 'box';
            }
        }

        $simpla->design->assign('category', $category);
        $simpla->design->assign('currency',	$currency);
        $simpla->design->assign('model_type', $_SESSION['model_type']);

        $result->page = $simpla->design->fetch($simpla->config->root_dir.'design/'.$simpla->settings->theme.'/html/products_list.tpl');
    }

    header("Content-type: application/json; charset=UTF-8");
    header("Cache-Control: must-revalidate");
    header("Pragma: no-cache");
    header("Expires: -1");
    print json_encode($result);