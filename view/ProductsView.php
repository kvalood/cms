<?php

/**
 * Simpla CMS
 *
 * @copyright	2017 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */

require_once('View.php');

class ProductsView extends View
{

    public function fetch()
    {
        // GET-Параметры
        $category_url    = $this->request->get('category', 'string');
        $brand_url       = $this->request->get('brand', 'string');

        //Фильтр для товаров
        $filter = array();
        $filter['visible'] = 1;

        // Если задан бренд, выберем его из базы
        if (!empty($brand_url)) {
            $brand = $this->brands->get_brand((string)$brand_url);
            if (empty($brand)) {
                return false;
            }
            $this->design->assign('brand', $brand);
            $filter['brand_id'] = $brand->id;
        }

        // Выберем текущую категорию
        if (!empty($category_url)) {
            $category = $this->categories->get_category((string)$category_url);
            if (empty($category) || (!$category->visible && empty($_SESSION['admin']))) {
                return false;
            }
            $this->design->assign('category', $category);
            $filter['category_id'] = $category->children;
        }

        // Если задано ключевое слово
        $keyword = $this->request->get('keyword');
        if (!empty($keyword)) {
            $this->design->assign('keyword', $keyword);
            $filter['keyword'] = $keyword;
        }

        // Свойства товаров
        if (!empty($category)) {

            // Получим все свойства товаров в нужной категории (нужно для фильтра), показываемыые в фильтре
            $all_features = [];
            foreach ($this->features->get_features(['category_id'=>$category->id, 'in_filter'=>1]) as $feature) {
                $all_features[$feature->id] = $feature;
            }

            // выбираем все значения свойств
            $features_ids = array_keys($all_features);
            $options = $this->features->get_options(['feature_id' => $features_ids, 'category_id' => $category->children]);

            // Перебираем все свойства
            $features = [];
            foreach($options as $key => $o) {
                if (isset($all_features[$o->feature_id])) {

                    // Мультисвойства
                    // if($exp = explode(',',$o->value))
                    //    foreach(array_diff($exp, array('')) as $v)
                    //        $features[$o->feature_id][] = trim($v);
                    // else

                    if ($all_features[$o->feature_id]->type == 2) {
                        $features[$o->feature_id][] = preg_replace("/[^0-9-.,]/", '', str_replace(',', '.', $o->value));
                    } else {
                        $features[$o->feature_id][] = $o->value;
                    }
                }
            }

            foreach ($features as $feature_id => $feature) {
                asort($feature);
                $all_features[$feature_id]->values = array_unique(array_values($feature));

                if ($all_features[$o->feature_id]->type == 2) {
                    $all_features[$o->feature_id]->min = min($all_features[$feature_id]->values);
                    $all_features[$o->feature_id]->max = max($all_features[$feature_id]->values);
                }
            }
        }


        /**
         * Фильтр товаров
         */
        $result = new stdClass();
        $url_features = $this->request->parseUrl();

        if($url_features) {
            foreach ($url_features as $feature_name => $f) {

                $f = preg_replace("/[^0-9-.,]/", '', urldecode($f));
                $feature_name = preg_replace("/[^a-zA-Z0-9_]/", '', $feature_name);

                if (isset($all_features[$feature_name])) {
                    // Узнаем тип фильтруемого свойства (для передачи в модель) и дизайн
                    switch ($all_features[$feature_name]->type) {
                        // Фильтр с типом "Группа checkbox" (Сортировка происходит по очереди свойств)
                        case '1':

                            // Соответствие порядкового номера и значения
                            $valent = [];
                            foreach (array_values(array_diff(explode(',', $f), [''])) as $v) {
                                if (isset($all_features[$feature_name]->values[$v])) {
                                    $valent[$v] = $all_features[$feature_name]->values[$v];
                                }
                            }

                            if (isset($valent))
                                $filter['features'][$feature_name] = $valent;

                            break;

                        // Фильтр с типом "Слайдер-диапазон"
                        // значение вида 21=50-100 или 2.15-2.45
                        case '2':

                            $val = explode('-', $f);

                            if (!empty($val[0]))
                                $filter['features_range'][$feature_name]['min'] = preg_replace("/[^0-9-.,]/", '', $val[0]);

                            if (!empty($val[1]))
                                $filter['features_range'][$feature_name]['max'] = preg_replace("/[^0-9-.,]/", '', $val[1]);

                            break;
                    }
                }

                // фильтр по цене
                if ($feature_name == 'price') {

                    $val = explode('-', $f);

                    if (!empty($val[0]))
                        $filter['price']['min'] = preg_replace('/[^0-9.]/', '', $val[0]);

                    if (!empty($val[1]))
                        $filter['price']['max'] = preg_replace('/[^0-9.]/', '', $val[1]);
                }

                // Фильтр по бренду
                if ($feature_name == 'brands') {
                    $filter['brand_id'] = explode(',', $f);
                }

                $result->url[$feature_name] = $f;
            }
        }


        // Нужно отдать максимальную и минимальную цену товаров в этой категории.
        $price_filter['visible'] = $filter['visible'];

        if(isset($category->id))
            $price_filter['category_id'] = $category->children;
        elseif(isset($filter['keyword']))
            $price_filter['keyword'] = $filter['keyword'];

        /*
        $price_cat = $this->products->max_min_products($price_filter);
        $price_cat->min_price = ceil($price_cat->min_price);
        $price_cat->max_price = ceil($price_cat->max_price);
        */

        $prices_step_values = array_map(function($line) {
            return round($line, 2);
        }, $this->products->prices_products($price_filter));

        $price_cat = new stdClass();
        $price_cat->min_price = min($prices_step_values);
        $price_cat->max_price = max($prices_step_values);
        $price_cat->step_values = $prices_step_values;
        $this->design->assign('price_cat', $price_cat);



        // Сортировка товаров, сохраняем в сесси, чтобы текущая сортировка оставалась для всего сайта
        if ($sort = $this->request->get('sort', 'string')) {
            $_SESSION['sort'] = $sort;
        }
        elseif(!empty($category))
        {
            $order_by = !empty($category->order_by) ? $category->order_by : $this->settings->order_by;
            $sort_order = !empty($category->sort_order) ? $category->sort_order : $this->settings->sort_order;
            $sort = strtolower($order_by) . '_' . strtolower($sort_order);
            $_SESSION['sort'] = $sort;
        }

        if (!empty($_SESSION['sort']))
            $filter['sort'] = $_SESSION['sort'];

        $this->design->assign('sort', $filter['sort']);

        // Порядок товаров
        switch($this->settings->products_end_list) {
            // Скрываем товары не в наличии
            case 'in_stock' :
                $filter['in_stock'] = 1;
                break;

            // товары не в наличии, в конце списка
            case 'end_list' :
                $filter['end_list'] = 1;
                break;
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
        if ($this->request->get('page') == 'all') {
            $items_per_page = $products_count;
        }

        $pages_num = ceil($products_count/$items_per_page);
        $this->design->assign('total_pages_num', $pages_num);
        $this->design->assign('total_products_num', $products_count);

        $filter['page'] = $current_page;
        $filter['limit'] = $items_per_page;

        ///////////////////////////////////////////////
        // Постраничная навигация END
        ///////////////////////////////////////////////

        // Товары
        $products = $this->products->get_products_compile($filter);

        // Выбираем бренды, они нужны нам в шаблоне
        if (!empty($category)) {
            $brands = $this->brands->get_brands(array('category_id'=>$category->children, 'visible'=>1));
            $category->brands = $brands;
        }


        /**
         * Отдаем available options
         * все опции свойств идут в формате
         * type - 1
         *      id опции = true/false
         * type - 2
         *      max/min
         */
        $available_options = [];
        if (!empty($category)) {

            $filter['limit'] = $products_count;
            unset($filter['page']);
            $all_products = $this->products->get_products_compile($filter);

            if ($all_products) {
                $av_options = [];

                if ($all_features) {

                    foreach ($as_optins = $this->features->get_options(['product_id' => array_keys($all_products), 'category_id' => $category->children, 'feature_id' => $features_ids]) as $o) {

                        if ($all_features[$o->feature_id]->type == 1) {
                            $found_id = array_search($o->value, $all_features[$o->feature_id]->values);
                            $av_options[$o->feature_id]->value[$found_id] = $o->value;
                            // $av_options[$o->feature_id]->count = $o->count;
                        }

                        // Добавляем минимальное и максимальное значение для группы слайдера
                        if ($all_features[$o->feature_id]->type == 2) {
                            $o->value = preg_replace("/[^0-9-.,]/", '', str_replace(',', '.', $o->value));
                            $av_options[$o->feature_id]->value[] = $o->value;
                            $available_options[$o->feature_id]['min'] = min($av_options[$o->feature_id]->value);
                            $available_options[$o->feature_id]['max'] = max($av_options[$o->feature_id]->value);
                        }
                    }

                    // Собираем единый фильтр (существующие и не существующие опции
                    foreach ($all_features as $feature_key => $feature) {
                        // Если клиент фильтрует по определенному свойству, то это свойство выключаем из фильтра
                        if ($feature->type == 1) {
                            if (!empty($feature->value)) {
                                foreach ($feature->value as $o_key => $o_val) {
                                    if (isset($av_options[$feature_key]->value[$o_key]) OR isset($filter['features'][$feature_key])) {
                                        $available_options[$feature_key][$o_key] = true;
                                    } else {
                                        $available_options[$feature_key][$o_key] = false;
                                    }
                                }
                            }
                        }
                    }
                }

                // то-же самое делаем для брендов
                if($brands) {
                    $available_brands = [];
                    foreach ($all_products as $ap) {
                        $available_brands[$ap->brand_id] = true;
                    }
                    foreach ($brands as $brand) {
                        if (isset($filter['brand_id']) OR isset($available_brands[$brand->id])) {
                            $available_options['brands'][$brand->id] = true;
                        } else {
                            $available_options['brands'][$brand->id] = false;
                        }
                    }
                }

                $this->design->assign('available_options', $available_options);
            }

            $this->design->assign('features', $all_features);

            // Отдаем все устанолвеные Параметры $filter в дизайн, для фильтра.
            $this->design->assign('filter', $filter);
        }

        // Если искали товар и найден ровно один - перенаправляем на него
        if (!empty($keyword) && !empty($products) && $products_count == 1) {
            $p = reset($products);
            header('Location: '.$this->config->root_url.'/products/'.$p->url);
            exit();
		}

        $this->design->assign('products', $products);


        // ajax запрос, пагинация, фильтр, сортировка
        if($this->request->ajax()) {
            $result->url['page'] = $current_page;
            $result->url['sort'] = $filter['sort'];
            $result->count = $products_count;
            $result->product_list = $this->design->fetch('products_list.tpl');
            $result->pagination = $this->design->fetch('pagination.tpl');
            $result->available_options = $available_options;
            $result->url = urldecode(http_build_query($result->url));
            return json_encode($result);
            exit();
        }

        // Устанавливаем мета-теги в зависимости от запроса
        if ($this->page) {
            $this->design->assign('meta_title', $this->page->meta_title);
            $this->design->assign('meta_keywords', $this->page->meta_keywords);
            $this->design->assign('meta_description', $this->page->meta_description);
        } elseif (isset($category)) {
            $this->design->assign('meta_title', $category->meta_title);
            $this->design->assign('meta_keywords', $category->meta_keywords);
            $this->design->assign('meta_description', $category->meta_description);
        } elseif (isset($brand)) {
            $this->design->assign('meta_title', $brand->meta_title);
            $this->design->assign('meta_keywords', $brand->meta_keywords);
            $this->design->assign('meta_description', $brand->meta_description);
        } elseif (isset($keyword)) {
            $this->design->assign('meta_title', $keyword);
        }

        return $this->design->fetch('products.tpl');
    }
}
