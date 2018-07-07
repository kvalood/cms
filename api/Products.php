<?php

/**
 * Simpla CMS
 *
 * @copyright	2017 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */

require_once('Simpla.php');

class Products extends Simpla
{

    /**
     * Функция возвращает товары
     * Возможные значения фильтра:
     * id - id товара или их массив
     * category_id - id категории или их массив
     * brand_id - id бренда или их массив
     * page - текущая страница, integer
     * limit - количество товаров на странице, integer
     * sort - порядок товаров, возможные значения: position(по умолчанию), name, price
     * keyword - ключевое слово для поиска
     * features - фильтр по свойствам товара, массив (id свойства => значение свойства)
     * features_range - фильтр по свойствам товара (слайдер диапазон), array(feature name => array(min => '', max => ''))
     * price - фильтр по цене, array(price => array(min => , max => )
     * visible - активный или выключенный товар, integer
     * count_comments - посчитать колличество комментариев к товару, integer
     * in_stock - скрыть товары не в наличии
     * in_stock - товары не в наличии, в конце списка (сопутстующие свойства - limit_diff, in_stock = 0, out_stock = 1
     * ymarket - товары выгружаемые в Yandex Market, integer (0/1)
     * google - товары выгружаемые в Google Merchant, integer (0/1)
     *
     * @param array $filter
     * @return array|bool
     */
    public function get_products($filter = array())
    {

        // По умолчанию
        $limit = 100;
        $page = 1;
        $category_id_filter = '';
        $brand_id_filter = '';
        $product_id_filter = '';
        $features_filter = '';
        $keyword_filter = '';
        $visible_filter = '';
        $is_featured_filter = '';
        $discounted_filter = '';
        $in_stock_filter = '';
        $group_by = 'GROUP BY p.id';
        $export_filter = '';
        $price_filter = '';
        $variant_join = '';
        $order = '';

        $join = '';
        $select = '';
        $where = '';

		if(isset($filter['limit']))
			$limit = max(1, intval($filter['limit']));

		if(isset($filter['page']))
			$page = max(1, intval($filter['page']));

        if(!isset($filter['limit_diff']))
            $filter['limit_diff'] = 0;

		$sql_limit = $this->db->placehold(' LIMIT ?, ? ', ($page-1)*$limit-(int)$filter['limit_diff'], $limit);

		if(!empty($filter['id']))
			$product_id_filter = $this->db->placehold('AND p.id in(?@)', (array)$filter['id']);

		if(!empty($filter['category_id']))
		{
			$category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', (array)$filter['category_id']);
		}

		if(isset($filter['featured']))
			$is_featured_filter = $this->db->placehold('AND p.featured=?', intval($filter['featured']));

		if(isset($filter['discounted']))
			$discounted_filter = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.compare_price>0 LIMIT 1) = ?', intval($filter['discounted']));

		if(isset($filter['in_stock']))
			$in_stock_filter = $this->db->placehold('AND (SELECT count(*)>0 FROM __variants pv WHERE pv.product_id=p.id AND pv.price>0 AND (pv.stock IS NULL OR pv.stock>0) LIMIT 1) = ?', intval($filter['in_stock']));

        // Отсутствующие товары
        if(!empty($filter['out_stock']))
            $where .= $this->db->placehold(' AND (SELECT count(1) FROM __variants pv WHERE pv.product_id=p.id AND pv.price>0 AND (pv.stock IS NULL OR pv.stock>0) LIMIT 1) = 0');

		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND p.visible=?', intval($filter['visible']));

        if(isset($filter['ymarket']))
            $export_filter .= $this->db->placehold(' AND p.ymarket=?', intval($filter['ymarket']));

        if(isset($filter['google']))
            $export_filter .= $this->db->placehold(' AND p.google=?', intval($filter['google']));

        if(isset($filter['count_comments'])) {
            $join .= " LEFT JOIN __comments com ON com.object_id = p.id AND com.approved = 1 AND com.type = 'product'";
            $select .= ', count(distinct com.id) as count_comments';
        }

        // Сортировка товаров
        if(!empty($filter['sort']))
        {
            $sorting = explode('_', $filter['sort']);

            // Сортировка по типу
            switch(strtolower($sorting[0]))
            {
                case 'name':
                    $order = 'p.name';
                    break;

                case 'created':
                    $order = 'p.created';
                    break;

                case 'likes':
                    $order = 'p.likes';
                    break;

                case 'brand':
                    $order = 'b.name';
                    break;

                case 'price':
                    $order = '(SELECT -pv.price FROM __variants pv WHERE (pv.stock IS NULL OR pv.stock>0) AND p.id = pv.product_id AND pv.position=(SELECT MIN(position) FROM __variants WHERE (stock>0 OR stock IS NULL) AND product_id=p.id LIMIT 1) LIMIT 1)';
                    break;

                case 'position':
                default:
                    $order = 'p.position';
                    break;
            }

            // сортировка по убыванию/возрастанию
            if(isset($sorting[1]))
            {
                switch(strtolower($sorting[1]))
                {
                    case 'asc':
                        $order .= ' ASC';
                        break;
                    case 'desc':
                        $order .= ' DESC';
                        break;
                }
            } else {
                $order .= ' DESC';
            }

            $_SESSION['sort'] = $order;
        }

        /* Сортировка товаров */
        if(empty($order))
            $order = 'p.'.$this->settings->order_by.' '.$this->settings->sort_order;

        // Товары не в наличии в конце списка
        if(!empty($filter['end_list'])){
            $order = 'IF((SELECT COUNT(*) FROM __variants WHERE (stock > 0 OR stock IS NULL) AND product_id=p.id LIMIT 1), 1, 0) DESC, '.$order;
        }


        // Фильтр по ключевому слову
		if(!empty($filter['keyword']))
		{
			$keywords = explode(' ', $filter['keyword']);
			foreach($keywords as $keyword)
			{
				$kw = $this->db->escape(trim($keyword));
				if($kw!=='')
					$keyword_filter .= $this->db->placehold("AND (p.name LIKE '%$kw%' OR p.meta_keywords LIKE '%$kw%' OR p.id in (SELECT product_id FROM __variants WHERE sku LIKE '%$kw%'))");
			}
		}

        // фильтр по бренду
        if(!empty($filter['brand_id']))
            $brand_id_filter = $this->db->placehold('AND p.brand_id in(?@)', (array)$filter['brand_id']);


        // Фильтр по цене
        if(isset($filter['price']))
        {
            if(!empty($filter['price']['min']))
                $price_filter .= $this->db->placehold(' AND pv.price >= ? ', (float) $this->db->escape(trim($filter['price']['min'])));
            if(!empty($filter['price']['max']))
                $price_filter .= $this->db->placehold(' AND pv.price <= ? ', (float) $this->db->escape(trim($filter['price']['max'])));
            $variant_join = 'LEFT JOIN __variants pv ON pv.product_id = p.id';
        }

        // Фильтр с типом "Группа checkbox"
        if(!empty($filter['features']) && isset($filter['features']))
        {
            foreach($filter['features'] as $feature_id => $value)
            {
                $value = array_values($value);

                $set_filter = '';
                if(count($value) > 1) {
                    foreach ($value as $key => $val) {
                        if ($key == 0) { continue; }
                        $set_filter .= 'OR o.value LIKE "%' . $this->db->escape($val) . '%"';
                    }
                }

                $features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? AND (o.value LIKE "%'.$this->db->escape($value[0]).'%" '.$set_filter.')) ', $feature_id);
            }
        }

        // Фильтр с типом "Слайдер-диапазон"
        if(isset($filter['features_range']) && !empty($filter['features_range']))
        {
            foreach($filter['features_range'] as $feature_id => $val)
            {
                //$features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? AND o.value >= ? AND o.value <= ?)',$feature_id, $this->db->escape(trim($val['min'])), $this->db->escape(trim($val['max'])));
                $features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? ',$feature_id);

                if(isset($val['min']))
                    $features_filter .= $this->db->placehold(" AND o.value >= ?", (float) $this->db->escape(trim($val['min'])));

                if(isset($val['max']))
                    $features_filter .= $this->db->placehold(' AND o.value <= ?', (float) $this->db->escape(trim($val['max'])));

                $features_filter .= $this->db->placehold(')');
            }
        }

        $query = "SELECT
					p.id,
					p.url,
					p.brand_id,
					p.name,
					p.annotation,
					p.body,
					p.position,
					p.created as created,
					p.visible, 
					p.featured, 
					p.meta_title, 
					p.meta_keywords, 
					p.meta_description, 
					p.ymarket,
					p.google,
					p.likes,
					b.name as brand,
					b.url as brand_url,					
					GROUP_CONCAT(DISTINCT pcat.category_id) as category_ids
					$select
				FROM __products p
				$variant_join		
				$join
				$category_id_filter 
				LEFT JOIN __brands b ON p.brand_id = b.id
				LEFT JOIN __products_categories as pcat ON pcat.product_id = p.id
				WHERE 
					1
					$where
					$product_id_filter
					$brand_id_filter
					$features_filter
					$keyword_filter
					$price_filter
					$is_featured_filter
					$discounted_filter
					$in_stock_filter
					$visible_filter
					$export_filter
				$group_by
				ORDER BY $order
					$sql_limit";

		$this->db->query($query);
		return $this->db->results();
	}

    // Выбор максимальной и минимальной цены у заданной категории
    public function max_min_products($filter = []) {
        $category_id_filter = '';
        $where = '';

        if(!empty($filter['category_id']))
            $category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', (array)$filter['category_id']);

        // Фильтр по ключевому слову
        if(!empty($filter['keyword']))
        {
            $keywords = explode(' ', $filter['keyword']);
            foreach($keywords as $keyword)
            {
                $kw = $this->db->escape(trim($keyword));
                if($kw!=='')
                    $where .=  $this->db->placehold(" AND (p.name LIKE '%$kw%' OR p.meta_keywords LIKE '%$kw%' OR p.id in (SELECT product_id FROM __variants WHERE sku LIKE '%$kw%'))");
            }
        }

        if(!empty($filter['visible']))
            $where .= $this->db->placehold(' AND p.visible=?', intval($filter['visible']));

        if(isset($filter['product_id']))
            $where .= $this->db->placehold(' AND pc.product_id in(?@)', (array)$filter['product_id']);

        $query = "SELECT
                        MIN(v.price) as min_price,
                        MAX(v.price) as max_price
                  FROM __products AS p
                  INNER JOIN __variants v ON v.product_id=p.id $category_id_filter
                  WHERE 1 $where";

        $this->db->query($query);
        return $this->db->result();
    }

	/**
	* Функция возвращает количество товаров
	* Возможные значения фильтра:
	* category_id - id категории или их массив
	* brand_id - id бренда или их массив
	* keyword - ключевое слово для поиска
	* features - фильтр по свойствам товара, массив (id свойства => значение свойства)
	*/
	public function count_products($filter = [])
	{		
		$category_id_filter = '';
		$brand_id_filter = '';
		$product_id_filter = '';
        $features_filter = '';
		$keyword_filter = '';
		$visible_filter = '';
		$is_featured_filter = '';
		$discounted_filter = '';
        $in_stock_filter = '';
        $export_filter = '';
		$price_filter = '';
		$variant_join = '';

        $where = '';


        if(!empty($filter['id']))
            $product_id_filter = $this->db->placehold('AND p.id in(?@)', (array)$filter['id']);

        if(!empty($filter['category_id']))
            $category_id_filter = $this->db->placehold('INNER JOIN __products_categories pc ON pc.product_id = p.id AND pc.category_id in(?@)', (array)$filter['category_id']);

        if(isset($filter['featured']))
            $is_featured_filter = $this->db->placehold('AND p.featured=?', intval($filter['featured']));

        if(isset($filter['discounted']))
            $discounted_filter = $this->db->placehold('AND (SELECT 1 FROM __variants pv WHERE pv.product_id=p.id AND pv.compare_price>0 LIMIT 1) = ?', intval($filter['discounted']));

		if(isset($filter['in_stock']))
			$in_stock_filter = $this->db->placehold('AND (SELECT count(*)>0 FROM __variants pv WHERE pv.product_id=p.id AND pv.price>0 AND (pv.stock IS NULL OR pv.stock>0) LIMIT 1) = ?', intval($filter['in_stock']));

        if(!empty($filter['out_stock']))
            $where .= $this->db->placehold(' AND (SELECT count(1) FROM __variants pv WHERE pv.product_id=p.id AND pv.price>0 AND (pv.stock IS NULL OR pv.stock>0) LIMIT 1) = 0');

		if(isset($filter['visible']))
			$visible_filter = $this->db->placehold('AND p.visible=?', intval($filter['visible']));

        if(isset($filter['ymarket']))
            $export_filter .= $this->db->placehold(' AND p.ymarket=?', intval($filter['ymarket']));

        if(isset($filter['google']))
            $export_filter .= $this->db->placehold(' AND p.google=?', intval($filter['google']));

        if(isset($filter['keyword']))
        {
            $keywords = explode(' ', $filter['keyword']);
            foreach($keywords as $keyword)
            {
                $kw = $this->db->escape(trim($keyword));
                if($kw!=='')
                    $keyword_filter .= $this->db->placehold("AND (p.name LIKE '%$kw%' OR p.meta_keywords LIKE '%$kw%' OR p.id in (SELECT product_id FROM __variants WHERE sku LIKE '%$kw%'))");
            }
        }

        // фильтр по бренду
        if(!empty($filter['brand_id']))
            $brand_id_filter = $this->db->placehold('AND p.brand_id in(?@)', (array)$filter['brand_id']);

        // Фильтр по цене
        if(isset($filter['price']))
        {
            if(!empty($filter['price']['min']))
                $price_filter .= $this->db->placehold(' AND pv.price >= ? ', (float) $this->db->escape(trim($filter['price']['min'])));
            if(!empty($filter['price']['max']))
                $price_filter .= $this->db->placehold(' AND pv.price <= ? ', (float) $this->db->escape(trim($filter['price']['max'])));
            $variant_join = 'LEFT JOIN __variants pv ON pv.product_id = p.id';
        }

        // Фильтр с типом "Группа checkbox"
        if(!empty($filter['features']) && isset($filter['features']))
        {
            foreach($filter['features'] as $feature_id => $value)
            {
                $value = array_values($value);

                $set_filter = '';
                if(count($value) > 1) {
                    foreach ($value as $key => $val) {
                        if ($key == 0) { continue; }
                        $set_filter .= 'OR o.value LIKE "%' . $this->db->escape($val) . '%"';
                    }
                }

                $features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? AND (o.value LIKE "%'.$this->db->escape($value[0]).'%" '.$set_filter.')) ', $feature_id);
            }
        }

        // Фильтр с типом "Слайдер-диапазон"
        if(isset($filter['features_range']) && !empty($filter['features_range']))
        {
            foreach($filter['features_range'] as $feature_id => $val)
            {
                //$features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? AND o.value >= ? AND o.value <= ?)',$feature_id, $this->db->escape(trim($val['min'])), $this->db->escape(trim($val['max'])));
                $features_filter .= $this->db->placehold(' AND p.id in (SELECT o.product_id FROM __options o WHERE o.feature_id=? ',$feature_id);

                if(isset($val['min']))
                    $features_filter .= $this->db->placehold(' AND o.value >= ?', (float) $this->db->escape(trim($val['min'])));

                if(isset($val['max']))
                    $features_filter .= $this->db->placehold(' AND o.value <= ?', (float) $this->db->escape(trim($val['max'])));

                $features_filter .= $this->db->placehold(')');
            }
        }

		
		$query = "SELECT count(distinct p.id) as count
				FROM __products AS p
				$variant_join
				$category_id_filter
				WHERE 1
				    $where
					$brand_id_filter
					$product_id_filter
					$keyword_filter
					$price_filter
					$is_featured_filter
					$in_stock_filter
					$discounted_filter
					$visible_filter
					$features_filter
					$export_filter ";

		$this->db->query($query);	
		return $this->db->result('count');
	}


    /**
     * @param  array $filter
     * @return array
     */
    public function get_products_compile($filter = array())
    {
        $products = array();

        foreach ($this->get_products($filter) as $p) {
            $products[$p->id] = $p;
        }
        if (!empty($products)) {
            $products_ids = array_keys($products);
            foreach ($products as &$product) {
                $product->variants = array();
                $product->images = array();
                $product->properties = array();
            }

            $variants = $this->variants->get_variants(array('product_id'=>$products_ids, 'in_stock'=>true));
            foreach ($variants as $variant) {
                $products[$variant->product_id]->variants[$variant->id] = $variant;
            }

            $images = $this->get_images(array('product_id'=>$products_ids));
            foreach ($images as $image) {
                $products[$image->product_id]->images[] = $image;
            }

            foreach ($products as &$product) {
                $product->variant = reset($product->variants);

                if (isset($product->images[0])) {
                    $product->image = $product->images[0];
                }
            }
        }

        return $products;
    }


	/**
	* Функция возвращает товар по id
	* @param	$id
	* @retval	object
	*/
	public function get_product($id)
	{
		if(is_int($id))
			$filter = $this->db->placehold('p.id = ?', $id);
		else
			$filter = $this->db->placehold('p.url = ?', $id);
			
		$query = "SELECT DISTINCT
					p.id,
					p.url,
					p.brand_id,
					p.name,
					p.annotation,
					p.body,
					p.position,
					p.created as created,
					p.visible, 
					p.featured, 
					p.meta_title, 
					p.meta_keywords, 
					p.meta_description,
					p.ymarket,
					p.google,
					p.likes,
					pcat.category_id as category_id, 
					c.name as category_name
				FROM __products AS p
                LEFT JOIN __brands b ON p.brand_id = b.id
				LEFT JOIN __products_categories as pcat ON pcat.product_id = p.id
				LEFT JOIN __categories as c ON c.id = pcat.category_id
                WHERE $filter
                GROUP BY p.id
                LIMIT 1";
		$this->db->query($query);
		$product = $this->db->result();
		return $product;
	}

	public function update_product($id, $product)
	{
		$query = $this->db->placehold("UPDATE __products SET ?% WHERE id in (?@) LIMIT ?", $product, (array)$id, count((array)$id));
        if($this->db->query($query))
			return $id;
		else
			return false;
	}
	
	public function add_product($product)
	{	
		$product = (array) $product;
		
		if(empty($product['url']))
		{
			$product['url'] = preg_replace("/[\s]+/ui", '-', $product['name']);
			$product['url'] = strtolower(preg_replace("/[^0-9a-zа-я\-]+/ui", '', $product['url']));
		}

		// Если есть товар с таким URL, добавляем к нему число
		while($this->get_product((string)$product['url']))
		{
			if(preg_match('/(.+)_([0-9]+)$/', $product['url'], $parts))
				$product['url'] = $parts[1].'_'.($parts[2]+1);
			else
				$product['url'] = $product['url'].'_2';
		}
		
		if($this->db->query("INSERT INTO __products SET ?%", $product))
		{
			$id = $this->db->insert_id();
			$this->db->query("UPDATE __products SET position=id WHERE id=?", $id);	
	
			return $id;
		}
		else
			return false;
	}
	
	
	/*
	*
	* Удалить товар
	*
	*/	
	public function delete_product($id)
	{
		if(!empty($id))
		{
			// Удаляем варианты
			$variants = $this->variants->get_variants(array('product_id'=>$id));
			foreach($variants as $v)
				$this->variants->delete_variant($v->id);
			
			// Удаляем изображения
			$images = $this->get_images(array('product_id'=>$id));
			foreach($images as $i)
				$this->delete_image($i->id);
			
			// Удаляем категории
			$categories = $this->categories->get_categories(array('product_id'=>$id));
			foreach($categories as $c)
				$this->categories->delete_product_category($id, $c->id);

			// Удаляем свойства
			$options = $this->features->get_options(array('product_id'=>$id));
			foreach($options as $o)
				$this->features->delete_option($id, $o->feature_id);
			
			// Удаляем связанные товары
			$related = $this->get_related_products($id);
			foreach($related as $r)
				$this->delete_related_product($id, $r->related_id);
				
			// Удаляем товар из связанных с другими
			$query = $this->db->placehold("DELETE FROM __related_products WHERE related_id=?", intval($id));
			$this->db->query($query);
			
			// Удаляем отзывы
			$comments = $this->comments->get_comments(array('object_id'=>$id, 'type'=>'product'));
			foreach($comments as $c)
				$this->comments->delete_comment($c->id);
			
			// Удаляем из покупок
			$this->db->query('UPDATE __purchases SET product_id=NULL WHERE product_id=?', intval($id));
			
			// Удаляем товар
			$query = $this->db->placehold("DELETE FROM __products WHERE id=? LIMIT 1", intval($id));
			if($this->db->query($query))
				return true;			
		}
		return false;
	}	
	
	public function duplicate_product($id)
	{
    	$product = $this->get_product($id);
    	$product->id = null;
		$product->external_id = '';
    	$product->created = null;
		
		if(!empty($this->config->php_timezone))
		{
			date_default_timezone_set($this->config->php_timezone);
		}
		$last_update = date('Y-m-d H:i:s');
		
    	$product->created = $last_update;
    	$product->last_update = $last_update;
		
		//Удалим из продукта лишние переменные, а то не сможем добавить товар
		unset($product->category_name);
		unset($product->category_id);

		// Сдвигаем товары вперед и вставляем копию на соседнюю позицию
    	$this->db->query('UPDATE __products SET position=position+1 WHERE position>?', $product->position);
    	$new_id = $this->products->add_product($product);
    	$this->db->query('UPDATE __products SET position=? WHERE id=?', $product->position+1, $new_id);
    	
    	// Выключаем товар
    	$this->db->query('UPDATE __products SET visible="0" WHERE id=?', $new_id);
    	
		// Дублируем категории
		$categories = $this->categories->get_product_categories($id);
		foreach($categories as $c)
			$this->categories->add_product_category($new_id, $c->category_id);
    	
    	// Дублируем изображения
    	$images = $this->get_images(array('product_id'=>$id));
    	foreach($images as $image)
    		$this->add_image($new_id, $image->filename);
    		
    	// Дублируем варианты
    	$variants = $this->variants->get_variants(array('product_id'=>$id));
    	foreach($variants as $variant)
    	{
    		$variant->product_id = $new_id;
    		unset($variant->id);
    		if($variant->infinity)
    			$variant->stock = null;
    		unset($variant->infinity);
			$variant->external_id = '';
    		$this->variants->add_variant($variant);
    	}
    	
    	// Дублируем свойства
		$options = $this->features->get_options(array('product_id'=>$id));
		foreach($options as $o)
			$this->features->update_option($new_id, $o->feature_id, $o->value);
			
		// Дублируем связанные товары
		$related = $this->get_related_products($id);
		foreach($related as $r)
			$this->add_related_product($new_id, $r->related_id);
			
    	return $new_id;
	}
	

	
	public function get_related_products($product_id = array())
	{
		if(empty($product_id))
			return array();

		$product_id_filter = $this->db->placehold('AND product_id in(?@)', (array)$product_id);
				
		$query = $this->db->placehold("SELECT product_id, related_id, position
					FROM __related_products
					WHERE 
					1
					$product_id_filter   
					ORDER BY position       
					");
		
		$this->db->query($query);
		return $this->db->results();
	}
	
	// Функция возвращает связанные товары
	public function add_related_product($product_id, $related_id, $position=0)
	{
		$query = $this->db->placehold("INSERT IGNORE INTO __related_products SET product_id=?, related_id=?, position=?", $product_id, $related_id, $position);
		$this->db->query($query);
		return $related_id;
	}
	
	// Удаление связанного товара
	public function delete_related_product($product_id, $related_id)
	{
		$query = $this->db->placehold("DELETE FROM __related_products WHERE product_id=? AND related_id=? LIMIT 1", intval($product_id), intval($related_id));
		$this->db->query($query);
	}

	function get_images($filter = array())
	{
		$product_id_filter = '';
		$group_by = '';

		if(!empty($filter['product_id']))
			$product_id_filter = $this->db->placehold('AND i.product_id in(?@)', (array)$filter['product_id']);

		// images
		$query = $this->db->placehold("SELECT i.id, i.product_id, i.name, i.filename, i.position, i.variant_id
									FROM __images AS i WHERE 1 $product_id_filter $group_by ORDER BY i.product_id, i.position");
		$this->db->query($query);
		return $this->db->results();
	}

	public function add_image($product_id, $filename, $name = '', $variant_id = '')
	{
		$query = $this->db->placehold("SELECT id FROM __images WHERE product_id=? AND filename=?", $product_id, $filename);
		$this->db->query($query);
		$id = $this->db->result('id');
		if(empty($id))
		{
			$query = $this->db->placehold("INSERT INTO __images SET product_id=?, filename=?, variant_id=?", $product_id, $filename, $variant_id);
			$this->db->query($query);
			$id = $this->db->insert_id();
			$query = $this->db->placehold("UPDATE __images SET position=id WHERE id=?", $id);
			$this->db->query($query);
		}
		return($id);
	}
	
	public function update_image($id, $image)
	{
	
		$query = $this->db->placehold("UPDATE __images SET ?% WHERE id=?", $image, $id);
		$this->db->query($query);
		
		return($id);
	}
	
	public function delete_image($id)
	{
		$query = $this->db->placehold("SELECT filename FROM __images WHERE id=?", $id);
		$this->db->query($query);
		$filename = $this->db->result('filename');
		$query = $this->db->placehold("DELETE FROM __images WHERE id=? LIMIT 1", $id);
		$this->db->query($query);
		$query = $this->db->placehold("SELECT count(*) as count FROM __images WHERE filename=? LIMIT 1", $filename);
		$this->db->query($query);
		$count = $this->db->result('count');
		if($count == 0)
		{			
			$file = pathinfo($filename, PATHINFO_FILENAME);
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			
			// Удалить все ресайзы
			$rezised_images = glob($this->config->root_dir.$this->config->resized_images_dir.$file.".*x*.".$ext);
			if(is_array($rezised_images))
			foreach (glob($this->config->root_dir.$this->config->resized_images_dir.$file.".*x*.".$ext) as $f)
				@unlink($f);

			@unlink($this->config->root_dir.$this->config->original_images_dir.$filename);		
		}
	}
		
	/*
	*
	* Следующий товар
	*
	*/	
	public function get_next_product($id)
	{
		$this->db->query("SELECT position FROM __products WHERE id=? LIMIT 1", $id);
		$position = $this->db->result('position');
		
		$this->db->query("SELECT pc.category_id FROM __products_categories pc WHERE product_id=? ORDER BY position LIMIT 1", $id);
		$category_id = $this->db->result('category_id');

		$query = $this->db->placehold("SELECT id FROM __products p, __products_categories pc
										WHERE pc.product_id=p.id AND p.position>? 
										AND pc.position=(SELECT MIN(pc2.position) FROM __products_categories pc2 WHERE pc.product_id=pc2.product_id)
										AND pc.category_id=? 
										AND p.visible ORDER BY p.position limit 1", $position, $category_id);
		$this->db->query($query);
 
		return $this->get_product((integer)$this->db->result('id'));
	}
	
	/*
	*
	* Предыдущий товар
	*
	*/	
	public function get_prev_product($id)
	{
		$this->db->query("SELECT position FROM __products WHERE id=? LIMIT 1", $id);
		$position = $this->db->result('position');
		
		$this->db->query("SELECT pc.category_id FROM __products_categories pc WHERE product_id=? ORDER BY position LIMIT 1", $id);
		$category_id = $this->db->result('category_id');

		$query = $this->db->placehold("SELECT id FROM __products p, __products_categories pc
										WHERE pc.product_id=p.id AND p.position<? 
										AND pc.position=(SELECT MIN(pc2.position) FROM __products_categories pc2 WHERE pc.product_id=pc2.product_id)
										AND pc.category_id=? 
										AND p.visible ORDER BY p.position DESC limit 1", $position, $category_id);
		$this->db->query($query);
 
		return $this->get_product((integer)$this->db->result('id'));	
	}
}