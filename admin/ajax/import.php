<?php

require_once('../../api/Simpla.php');

class ImportAjax extends Simpla
{
    private $import_files_dir      = '../files/import/'; // Временная папка
    private $import_file           = '';                 // Временный файл
    private $category_delimiter    = ',';                // Разделитель каегорий в файле
    private $subcategory_delimiter = '/';                // Разделитель подкаегорий в файле
    private $column_delimiter      = ';';                // Разделитель колонок
    private $products_count        = 10;                 // Количество импортируемых товаров за раз
    private $identifier            = 'sku';              // Идентифицировать товар по артикулу,названию товара,свойствам (размер+цвет)
    private $columns               = [];

    private $stock_key             = '';                 // Ключ массива значений для определения наличиия товаров.
    private $continue_row          = 0;                  // Пропустить первые N строк файла. (например если первая строка - имена колонок)

    public function import($price_id)
    {
        if(!$this->managers->access('import'))
            return false;

        // Для корректной работы установим локаль UTF-8
        setlocale(LC_ALL, 'ru_RU.UTF-8');

        // Узнаем какой прайс надо импортировать, и обновляем его
        if($price = $this->import->get_price(intval($price_id)))
        {
            $price->last_import = date('Y-m-d H:i:s');
            $this->import->update_price($price->id, $price);
        }
        else
        {
            return false;
        }

        $price->settings = json_decode($price->settings, TRUE);

        // Базовые настройки
        $this->import_file = $price->settings['file_import'];
        $this->columns     = $price->settings['field'];
        $this->stock_key   = array_search('stock', $this->columns);

        $this->continue_row          = isset($price->settings['continue_row']) ? $price->settings['continue_row'] : $this->continue_row;
        $this->category_delimiter    = isset($price->settings['category_delimiter']) ? $price->settings['category_delimiter'] : $this->category_delimiter;
        $this->column_delimiter      = isset($price->settings['column_delimiter']) ? $price->settings['column_delimiter'] : $this->column_delimiter;
        $this->subcategory_delimiter = isset($price->settings['subcategory_delimiter']) ? $price->settings['subcategory_delimiter'] : $this->subcategory_delimiter;
        $this->identifier            = isset($price->settings['identifier']) ? $price->settings['identifier'] : $this->identifier;

        // Если нет артикула - не будем импортировать
        //if(!in_array('name', $this->columns) && !in_array('sku', $this->columns))
        //    return false;

        $result = new stdClass;

        // Определяем колонки из первой строки файла
        $f = fopen($this->import_files_dir.$this->import_file, 'r');

        // Переходим на заданную позицию, если импортируем не сначала
        if($from = $this->request->post('from'))
            fseek($f, $from);

        // Массив импортированных товаров
        $imported_items = [];

        // Проходимся по строкам, пока не конец файла
        // или пока не импортировано достаточно строк для одного запроса
        for($k=0; !feof($f) && $k<$this->products_count; $k++)
        {
            // Читаем строку
            $line = fgetcsv($f, 0, $this->column_delimiter);

            // Если не установлен флаг позиции, пропускаем первые N строк
            if(empty($from) AND $this->continue_row != 0)
                if($k < $this->continue_row) {
                    $this->products_count = $this->products_count + $this->continue_row;
                    continue;
                }

            $product = null;

            if(is_array($line)) {

                // Пропускаем импорт текущего товара, если он не в наличии и в настройках импорта НЕ стоит галочка (импортировать товары НЕ в налчиии)
                if ($price->available_import == 0 AND (empty($line[$this->stock_key]) OR $line[$this->stock_key] == '0')) continue;

                // Проходимся по колонкам строки
                foreach ($this->columns as $i => $col) {

                    // Создаем массив item[название_колонки]=значение
                    if (isset($line[$i]) && !empty($line[$i]) && !empty($col)) {
                        if ($col == 'images' AND !empty($product[$col]))
                            $product[$col] .= ',' . nl2br($line[$i]);
                        else
                            $product[$col] = nl2br($line[$i]);
                    }
                }
            }

            // Импортируем этот товар
            if($imported_item = $this->import_item($product))
                $imported_items[] = $imported_item;
        }

        // Запоминаем на каком месте закончили импорт
        $from = ftell($f);

        // И закончили ли полностью весь файл
        $result->end = feof($f);

        fclose($f);
        $size = filesize($this->import_files_dir.$this->import_file);

        // Создаем объект результата
        $result->from = $from;          // На каком месте остановились
        $result->totalsize = $size;     // Размер всего файла
        $result->items = $imported_items;   // Импортированные товары

        return $result;
    }

    // Импорт одного товара $item[column_name] = value;
    private function import_item($item)
    {
        $imported_item = new stdClass;

        // Проверим не пустое ли название и артинкул (должно быть хоть что-то из них)
        // if(empty($item['name']) && empty($item['sku']))
        if(empty($item['sku']))
            return false;

        // Подготовим товар для добавления в базу
        $product = [];

        if(isset($item['name']))
            $product['name'] = trim($item['name']);

        if(isset($item['meta_title']))
            $product['meta_title'] = trim($item['meta_title']);

        if(isset($item['meta_keywords']))
            $product['meta_keywords'] = trim($item['meta_keywords']);

        if(isset($item['meta_description']))
            $product['meta_description'] = trim($item['meta_description']);

        if(isset($item['annotation']))
            $product['annotation'] = trim($item['annotation']);

        if(isset($item['description']))
            $product['body'] = trim($item['description']);

        if(isset($item['visible']))
            $product['visible'] = intval($item['visible']);

        if(isset($item['featured']))
            $product['featured'] = intval($item['featured']);

        if(!empty($item['url']))
            $product['url'] = trim($item['url']);
        elseif(!empty($item['name']))
            $product['url'] = $this->translit($item['name']);

        // Если задан бренд
        if(!empty($item['brand']))
        {
            $item['brand'] = trim($item['brand']);
            // Найдем его по имени
            $this->db->query('SELECT id FROM __brands WHERE name=?', $item['brand']);
            if(!$product['brand_id'] = $this->db->result('id'))
                // Создадим, если не найден
                $product['brand_id'] = $this->brands->add_brand(array('name'=>$item['brand'], 'meta_title'=>$item['brand'], 'meta_keywords'=>$item['brand'], 'meta_description'=>$item['brand']));
        }

        if(isset($item['external_id']))
            $product['external_id'] = trim($item['external_id']);

        // Если задана категория
        $category_id = null;
        $categories_ids = [];
        if(!empty($item['category']))
        {
            foreach(explode($this->category_delimiter, $item['category']) as $c)
                $categories_ids[] = $this->import_category($c);
            $category_id = reset($categories_ids);
        }

        // Подготовим вариант товара
        $variant = [];

        if(isset($item['variant']))
            $variant['name'] = trim($item['variant']);

        if(isset($item['color']))
            $variant['color'] = trim($item['color']);

        if(isset($item['price']))
            $variant['price'] = str_replace(',', '.', trim($item['price']));

        if(isset($item['compare_price']))
            $variant['compare_price'] = trim($item['compare_price']);

        if(isset($item['stock'])) {
            if($item['stock'] == '')
                $variant['stock'] = null;
            else
                $variant['stock'] = trim($item['stock']);
        }
        else
        {
            $variant['stock'] = 0;
        }

        if(isset($item['sku']))
            $variant['sku'] = trim($item['sku']);

        // Если задан артикул варианта, найдем этот вариант и соответствующий товар
        // или Идентификация по артикулу + свойства "цвет/размер"
        if(!empty($variant['sku']))
        {
            if($this->identifier == 'sku')
            {
                $this->db->query('SELECT v.id as variant_id, v.product_id FROM __variants v, __products p WHERE v.sku=? AND v.product_id = p.id LIMIT 1', $variant['sku']);
            }
            elseif($this->identifier == 'properties')
            {
                $where = '';

                if(isset($variant['name']))
                    $where .= $this->db->placehold(' AND v.name=?', $variant['name']);

                if(isset($variant['color']))
                    $where .= $this->db->placehold(' AND v.color=?', $variant['color']);

                $this->db->query("SELECT v.id as variant_id, p.id as product_id FROM __products p LEFT JOIN __variants v ON v.product_id=p.id WHERE v.sku=? $where", $variant['sku']);
            }

            if($result = $this->db->result())
            {
                // и обновим товар
                if(!empty($product))
                    $this->products->update_product($result->product_id, $product);
                // и вариант
                if(!empty($variant))
                    $this->variants->update_variant($result->variant_id, $variant);

                $product_id = $result->product_id;
                $variant_id = $result->variant_id;
                // Обновлен
                $imported_item->status = 'updated';
            }
        }

        // Если на прошлом шаге товар не нашелся, и задано хотя бы название товара
        //if((empty($product_id) || empty($variant_id)) && isset($item['name']))
        // $this->db->query('SELECT v.id as variant_id, v.product_id FROM __variants v, __products p WHERE v.sku=? AND (v.name=? OR v.color=?) AND v.product_id = p.id LIMIT 1', $variant['sku'], $variant['name'], $variant['color']);
        if((empty($product_id) || empty($variant_id)) && isset($item['name']))
        {
            if(!empty($variant['sku']) && empty($variant['name']))
                $this->db->query('SELECT v.id as variant_id, p.id as product_id FROM __products p LEFT JOIN __variants v ON v.product_id=p.id WHERE v.sku=? LIMIT 1', $variant['sku']);
            elseif(isset($item['variant']))
                $this->db->query('SELECT v.id as variant_id, p.id as product_id FROM __products p LEFT JOIN __variants v ON v.product_id=p.id AND v.name=? WHERE p.name=? LIMIT 1', $item['variant'], $item['name']);
            else
                $this->db->query('SELECT v.id as variant_id, p.id as product_id FROM __products p LEFT JOIN __variants v ON v.product_id=p.id WHERE p.name=? LIMIT 1', $item['name']);

            $r =  $this->db->result();
            if($r)
            {
                $product_id = $r->product_id;
                $variant_id = $r->variant_id;
            }
            // Если вариант найден и идентификация не по артикулу или свойству
            if(!empty($variant_id) && $this->identifier != 'properties' && $this->identifier != 'sku')
            {
                $this->variants->update_variant($variant_id, $variant);
                $this->products->update_product($product_id, $product);
                $imported_item->status = 'updated';
            }
            // Иначе - добавляем
            elseif(empty($variant_id) || ($this->identifier == 'properties' || $this->identifier == 'sku'))
            {
                if(empty($product_id))
                    $product_id = $this->products->add_product($product);

                $this->db->query('SELECT max(v.position) as pos FROM __variants v WHERE v.product_id=? LIMIT 1', $product_id);
                $pos =  $this->db->result('pos');

                $variant['position'] = $pos+1;
                $variant['product_id'] = $product_id;
                $variant_id = $this->variants->add_variant($variant);
                $imported_item->status = 'added';
            }
        }

        if(!empty($variant_id) && !empty($product_id))
        {
            // Нужно вернуть обновленный товар
            $imported_item->variant = $this->variants->get_variant(intval($variant_id));
            $imported_item->product = $this->products->get_product(intval($product_id));

            // Добавляем категории к товару
            if(!empty($categories_ids))
                foreach($categories_ids as $c_id)
                    $this->categories->add_product_category($product_id, $c_id);

            // Изображения товаров
            if(isset($item['images']))
            {
                // Изображений может быть несколько, через запятую
                $images = explode(',', $item['images']);
                foreach($images as $image)
                {
                    $image = trim($image);
                    if(!empty($image))
                    {
                        // Имя файла
                        $image_filename = pathinfo($image, PATHINFO_BASENAME);

                        // Добавляем изображение только если такого еще нет в этом товаре
                        $this->db->query('SELECT filename FROM __images WHERE product_id=? AND (filename=? OR filename=?) LIMIT 1', $product_id, $image_filename, $image);
                        if(!$this->db->result('filename'))
                        {
                            $this->products->add_image($product_id, $image);
                        }
                    }
                }
            }

            // Свойства товаров
            foreach($item as $option_key => $i) {
                if(strpos($option_key, 'option_') !== FALSE) {
                    $parts_key = explode('_', $option_key);

                    // Свойство добавляем только если для товара указана категория и непустое значение свойства
                    if($category_id && $item[$option_key] !== '') {

                        if($feature = $this->features->get_feature($parts_key[1])) {
                            $this->features->add_feature_category($feature->id, $category_id);
                            $this->features->update_option($product_id, $feature->id, $item[$option_key]);
                        }
                    }
                }
            }

            return $imported_item;
        }
    }


    // Отдельная функция для импорта категории
    private function import_category($category)
    {
        // Поле "категория" может состоять из нескольких имен, разделенных subcategory_delimiter-ом
        // Только неэкранированный subcategory_delimiter может разделять категории
        $delimiter = $this->subcategory_delimiter;
        $regex = "/\\DELIMITER((?:[^\\\\\DELIMITER]|\\\\.)*)/";
        $regex = str_replace('DELIMITER', $delimiter, $regex);
        $names = preg_split($regex, $category, 0, PREG_SPLIT_DELIM_CAPTURE);
        $id = null;
        $parent = 0;

        // Для каждой категории
        foreach($names as $name)
        {
            // Заменяем \/ на /
            $name = trim(str_replace("\\$delimiter", $delimiter, $name));
            if(!empty($name))
            {
                // Найдем категорию по имени
                $this->db->query('SELECT id FROM __categories WHERE name=? AND parent_id=?', $name, $parent);
                $id = $this->db->result('id');

                // Если не найдена - добавим ее
                if(empty($id))
                    $id = $this->categories->add_category(array('name'=>$name, 'parent_id'=>$parent, 'meta_title'=>$name,  'meta_keywords'=>$name,  'meta_description'=>$name, 'url'=>$this->translit($name)));

                $parent = $id;
            }
        }
        return $id;
    }
}

$import_ajax = new ImportAjax();
header("Content-type: application/json; charset=UTF-8");
header("Cache-Control: must-revalidate");
header("Pragma: no-cache");
header("Expires: -1");

$price_id = $import_ajax->request->post('price_id', 'integer');
$json = json_encode($import_ajax->import($price_id));
print $json;