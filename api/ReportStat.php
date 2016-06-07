<?php

require_once('Simpla.php');

class ReportStat extends Simpla
{
    function get_stat($filter = array()) { //Выборка товара
        $weekdays = array('вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб');
    
        $all_filters = $this->make_filter($filter);
        
        $query = $this->db->placehold("SELECT 
                o.total_price, 
                DATE_FORMAT(o.date,'%d.%m.%y') date, 
                DATE_FORMAT(o.date,'%w') weekday, 
                DATE_FORMAT(o.date,'%H') hour, 
                DATE_FORMAT(o.date,'%d') day, 
                DATE_FORMAT(o.date,'%m') month, 
                DATE_FORMAT(o.date,'%Y') year, 
                o.status 
            FROM __orders o
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters ORDER BY o.date");
        $this->db->query($query);
        $data = $this->db->results();

        $group = 'day';
        if(isset($filter['date_filter']))
        {
            switch ($filter['date_filter']){
                case 'today':       $group = 'hour';    break;
                case 'yesterday':   $group = 'hour';    break;
                case 'last_24hour': $group = 'hour';    break;
                case 'this_year':   $group = 'month';   break;
                case 'last_year':   $group = 'month';   break;
                case 'all':         $group = 'month';   break;
            }
        }        
        
        $results = array();
        
        foreach($data as $d)
        {
            switch($group) {
                case 'hour':
                    $date = $d->year.$d->month.$d->day.$d->hour;
                    $results[$date]['title'] = $d->day.'.'.$d->month.' '.$d->hour.':00';
                    break; 
                case 'day':
                    $date = $d->year.$d->month.$d->day;
                    $results[$date]['title'] = $d->date.' '.$weekdays[$d->weekday];
                    break;
                case 'month':
                    $date = $d->year.$d->month;
                    $results[$date]['title'] = $d->month.'.'.$d->year;
                    break;  
            }

            if(!isset($results[$date]['new'])) 
                $results[$date]['new'] = $results[$date]['confirm'] = $results[$date]['complite'] = $results[$date]['delete'] = 0;     

            switch($d->status) {
                case 0: $results[$date]['new'] += $d->total_price; break;
                case 1: $results[$date]['confirm'] += $d->total_price; break;
                case 2: $results[$date]['complite'] += $d->total_price; break;
                case 3: $results[$date]['delete'] += $d->total_price; break;
            }
        }
        return $results;
    }
    
    function get_stat_orders($filter = array()) { //Выборка товара
        $weekdays = array('вс', 'пн', 'вт', 'ср', 'чт', 'пт', 'сб');
    
        $all_filters = $this->make_filter($filter);
        
        $query = $this->db->placehold("SELECT 
                o.id, 
                DATE_FORMAT(o.date,'%d.%m.%y') date, 
                DATE_FORMAT(o.date,'%w') weekday, 
                DATE_FORMAT(o.date,'%H') hour, 
                DATE_FORMAT(o.date,'%d') day, 
                DATE_FORMAT(o.date,'%m') month, 
                DATE_FORMAT(o.date,'%Y') year, 
                o.status 
            FROM __orders o
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters ORDER BY o.date");
        $this->db->query($query);
        $data = $this->db->results();
        
        $group = 'day';
        if(isset($filter['date_filter']))
        {
            switch ($filter['date_filter']){
                case 'today':       $group = 'hour';    break;
                case 'yesterday':   $group = 'hour';    break;
                case 'last_24hour': $group = 'hour';    break;
                case 'this_year':   $group = 'month';   break;
                case 'last_year':   $group = 'month';   break;
                case 'all':         $group = 'month';   break;
            }
        }        
        
        $results = array();
        
        foreach($data as $d)
        {
            switch($group) {
                case 'hour':
                    $date = $d->year.$d->month.$d->day.$d->hour;
                    $results[$date]['title'] = $d->day.'.'.$d->month.' '.$d->hour.':00';
                    break; 
                case 'day':
                    $date = $d->year.$d->month.$d->day;
                    $results[$date]['title'] = $d->date.' '.$weekdays[$d->weekday];
                    break;
                case 'month':
                    $date = $d->year.$d->month;
                    $results[$date]['title'] = $d->month.'.'.$d->year;
                    break;  
            }        

            if(!isset($results[$date]['new'])) 
                $results[$date]['new'] = $results[$date]['confirm'] = $results[$date]['complite'] = $results[$date]['delete'] = 0;     

            switch($d->status) {
                case 0:
                    $results[$date]['new']++;
                    break;
                case 1:
                    $results[$date]['confirm']++;
                    break;
                case 2:
                    $results[$date]['complite']++;
                    break;
                case 3:
                    $results[$date]['delete']++;
                    break;
            }
        }
        return $results;
    }
    
    function get_report_purchases($filter = array()) { //Выборка товара
        // По умолчанию
        $sort_prod = 'sum_price DESC';

        if(isset($filter['sort_prod'])){
            switch($filter['sort_prod']){
                case 'price':
                    $sort_prod = $this->db->placehold('sum_price DESC');
                break;
                case 'price_in':
                    $sort_prod = $this->db->placehold('sum_price ASC');
                break;
                case 'amount':
                    $sort_prod = $this->db->placehold('amount DESC');
                break;
                case 'amount_in':
                    $sort_prod = $this->db->placehold('amount ASC');
                break;    
            }
        }
        
        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                o.id, 
                p.product_id, 
                p.variant_id, 
                p.product_name, 
                p.variant_name, 
                SUM(p.price * p.amount) as sum_price, 
                SUM(p.amount) as amount, 
                p.sku FROM __purchases AS p 
            LEFT JOIN __orders AS o ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters 
            GROUP BY p.variant_id 
            ORDER BY $sort_prod");
                
        $this->db->query($query);
        return $this->db->results();
    }
    
    function get_report_purchase($filter = array()) { //Связанный товар

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                p.product_id, 
                o.id, p.variant_id, 
                p.product_name, 
                p.variant_name, 
                p.price, 
                p.amount, 
                p.sku 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters");
                
        $this->db->query($query);
        return $this->db->results();
    }
    
    function get_report_purchases_all($filter = array()) { //Сумма продаж

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                SUM(p.price * p.amount) as sum_price, 
                SUM(p.amount) as amount 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters");
                
        $this->db->query($query);
        $report_purchases = array();
        foreach($this->db->results() as $report_purchase)
            $report_purchases[] = $report_purchase;
        return $report_purchases;
    }
    
    function get_products(){ // Товар суммарно
    
        // Выбираем товар
        $query = $this->db->placehold("SELECT COUNT(id) as count_id FROM __products WHERE 1");
                
        $this->db->query($query);
        foreach($this->db->results() as $counts)
            $count = $counts->count_id;
        return $count;        
    }
    
    function get_variants_product($filter = array()){ //Вариаты товара, наличие
    
        $in_stock = '';
        
        if(isset($filter['in_stock']))
            $in_stock = $this->db->placehold('AND stock = 0');
        
        // Считаем товар по вариантам
        $query = $this->db->placehold("SELECT COUNT(id) as count_id FROM __variants WHERE 1 $in_stock");
                
        $this->db->query($query);
        foreach($this->db->results() as $counts)
            $count = $counts->count_id;
        return $count;        
    }

    function get_user_count($filter = array()){ // Пользователи, не активые

        if(isset($filter['enabled']))
            $enabled = $this->db->placehold('AND enabled = 0');
    
        // Считаем пользователей
        $query = $this->db->placehold("SELECT COUNT(id) as count_id FROM __users WHERE 1 $enabled");
                
        $this->db->query($query);
        foreach($this->db->results() as $counts)
            $count = $counts->count_id;
        return $count;        
    }    

    function get_order_count($filter = array()){ //Заказы, период, статусы
        
        $all_filters = $this->make_filter($filter);
    
        // Считаем заказы
        $query = $this->db->placehold("SELECT 
                COUNT(id) as count_id 
            FROM __orders as o 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 $all_filters");
                
        $this->db->query($query);
        foreach($this->db->results() as $counts)
            $count = $counts->count_id;
        return $count;        
    }
    
    function get_report_product($filter = array(), $id) { //Выборка товара для страицы товара
        // По умолчанию
        $variant_id = '';

        if(isset($filter['variant_id']))
            $variant_id = $this->db->placehold('AND p.variant_id = ?', intval($filter['variant_id']));        

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                o.id, 
                DATE(o.date) as date, 
                p.product_id, 
                p.variant_id, 
                p.product_name, 
                p.variant_name, 
                SUM(p.price * p.amount) as price, 
                SUM(p.amount) as amount, 
                p.sku 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 AND p.product_id=? $variant_id $all_filters 
            GROUP BY DATE(o.date) 
            ORDER BY o.date", $id);
     
        $this->db->query($query);
        return $this->db->results();
    }
    

    function get_report_purchase_product($filter = array(),$id) { //Связанный товар
        // По умолчанию
        $variant_id = '';

        if(isset($filter['variant_id']))
            $variant_id = $this->db->placehold('AND variant_id = ?', intval($filter['variant_id']));        

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                p.product_id, 
                o.id, 
                o.total_price, 
                DATE(o.date) as date, 
                p.variant_id, 
                p.product_name, 
                p.variant_name, 
                p.price, 
                p.amount, 
                p.sku 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE p.order_id IN (SELECT order_id FROM s_purchases WHERE product_id=? $variant_id) AND p.product_id!=? $all_filters", $id, $id);    
    
        $this->db->query($query);
        return $this->db->results();
    }
    
    function get_report_purchase_product_summ($filter = array(), $id) { //Связанный товар
        // По умолчанию
        $variant_id = '';

        if(isset($filter['variant_id']))
            $variant_id = $this->db->placehold('AND variant_id = ?', intval($filter['variant_id']));        

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                p.product_id, 
                p.variant_id, 
                p.product_name, 
                SUM(p.amount) as amount, 
                p.variant_name 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 AND p.order_id IN (SELECT order_id FROM s_purchases WHERE product_id=? $variant_id) AND p.product_id!=? $all_filters 
            GROUP BY p.variant_id 
            ORDER BY amount DESC", $id, $id);    
    
        $this->db->query($query);
        return $this->db->results();
    }
    
    function get_report_purchase_product_total($filter = array(),$id) { //Связанный товар
        // По умолчанию
        $variant_id = '';

        if(isset($filter['variant_id']))
            $variant_id = $this->db->placehold('AND p.variant_id = ?', intval($filter['variant_id']));        

        $all_filters = $this->make_filter($filter);
        
        // Выбираем заказы
        $query = $this->db->placehold("SELECT 
                p.product_name, 
                SUM(p.price * p.amount) as price, 
                SUM(p.amount) as amount 
            FROM __orders AS o 
            LEFT JOIN __purchases AS p ON o.id = p.order_id 
            LEFT JOIN __orders_labels AS ol ON o.id=ol.order_id 
            WHERE 1 AND p.product_id = ? $variant_id $all_filters", $id);    
    
        $this->db->query($query);
        return $this->db->results();
    }
    
    private function make_filter($filter = array()) { //Связанный товар
        // По умолчанию
        $label_filter = '';        
        $period_filter = '';
        $date_filter = '';
        $status_filter = '';
        
        if(isset($filter['status']))
            $status_filter = $this->db->placehold('AND o.status = ?', intval($filter['status']));

        if(isset($filter['label']))
            $label_filter = $this->db->placehold('AND ol.label_id = ?', $filter['label']);
        
        if(isset($filter['date_from']) && !isset($filter['date_to'])){
            $period_filter = $this->db->placehold('AND o.date > ?', $filter['date_from']);
        }
        elseif(isset($filter['date_to']) && !isset($filter['date_from'])){
            $period_filter = $this->db->placehold('AND o.date < ?', $filter['date_to']);
        }
        elseif(isset($filter['date_to']) && isset($filter['date_from'])){
            $period_filter = $this->db->placehold('AND (o.date BETWEEN ? AND ?)', $filter['date_from'], $filter['date_to']);
        }
        
        if(isset($filter['date_filter']))
        {
            switch ($filter['date_filter']){
                case 'today':
                    $date_filter = 'AND DATE(o.date) = DATE(NOW())';
                    break;
                case 'this_week':
                    $date_filter = 'AND WEEK(o.date - INTERVAL 1 DAY) = WEEK(now())';
                    break;
                case 'this_month':
                    $date_filter = 'AND MONTH(o.date) = MONTH(now())';
                    break;
                case 'this_year':
                    $date_filter = 'AND YEAR(o.date) = YEAR(now())';
                    break;
                case 'yesterday':
                    $date_filter = 'AND DATE(o.date) = DATE(DATE_SUB(NOW(),INTERVAL 1 DAY))';
                    break;
                case 'last_week':
                    $date_filter = 'AND WEEK(o.date - INTERVAL 1 DAY) = WEEK(DATE_SUB(NOW(),INTERVAL 1 WEEK))';
                    break;
                case 'last_month':
                    $date_filter = 'AND MONTH(o.date) = MONTH(DATE_SUB(NOW(),INTERVAL 1 MONTH))';
                    break;
                case 'last_year':
                    $date_filter = 'AND YEAR(o.date) = YEAR(DATE_SUB(NOW(),INTERVAL 1 YEAR))';
                    break;
                case 'last_24hour':
                    $date_filter = 'AND o.date >= DATE_SUB(NOW(),INTERVAL 24 HOUR)';
                    break;
                case 'last_7day':
                    $date_filter = 'AND DATE(o.date) >= DATE(DATE_SUB(NOW(),INTERVAL 6 DAY))';
                    break;
                case 'last_30day':
                    $date_filter = 'AND DATE(o.date) >= DATE(DATE_SUB(NOW(),INTERVAL 29 DAY))';
                    break;                                                                                                                                                                
            }
        }
        
        return "$status_filter $date_filter $period_filter $label_filter";
    }
        
}
