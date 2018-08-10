<?PHP 

require_once('api/Simpla.php');

########################################
class ReportStatsAdmin extends Simpla
{
    public function fetch()
    {
         $filter = array();
          
        // Фильтр по метке
        $label = $this->orders->get_label($this->request->get('label'));          
        if(!empty($label))
        {
            $filter['label'] = $label->id;
            $this->design->assign('label', $label);
        }

        $date_filter = $this->request->get('date_filter');    
        if(!empty($date_filter))
          {
              $filter['date_filter'] = $date_filter;

             $this->design->assign('date_filter', $date_filter);
        }
            
        $date_from = $this->request->get('date_from');
        $date_to = $this->request->get('date_to');
        $filter_check = $this->request->get('filter_check');
            
        if(!empty($filter_check)){                
            if(!empty($date_from)){
                $filter['date_from'] = date("Y-m-d 00:00:01",strtotime($date_from));
                $this->design->assign('date_from', $date_from);
            }
    
            if(!empty($date_to)){
                $filter['date_to'] = date("Y-m-d 23:59:00",strtotime($date_to));
                $this->design->assign('date_to', $date_to);
            }
            $this->design->assign('filter_check', $filter_check);                    
        }    

        $status = $this->request->get('status', 'integer');
        if(!empty($status)){
            
            switch($status){
                case '1': $stat_o = 0;
                break;
                case '2': $stat_o = 1;
                break;
                case '3': $stat_o = 2;
                break;
                case '4': $stat_o = 3;
                break;
            }
            $filter['status'] = $stat_o;
             $this->design->assign('status', $status);
        }
        
        $sort_prod = $this->request->get('sort_prod');
        if(!empty($sort_prod))
        {
            $filter['sort_prod'] = $sort_prod;
            $this->design->assign('sort_prod',$sort_prod);
        }else{
            $sort_prod = 'price';
            $this->design->assign('sort_prod',$sort_prod);}            
        
        $report_stat_purchases = $this->reportstat->get_report_purchases($filter);        
        $this->design->assign('report_stat_purchases', $report_stat_purchases);
                
        // Метки заказов
          $labels = $this->orders->get_labels();
         $this->design->assign('labels', $labels);
          
        return $this->design->fetch('reportstats.tpl');
    }
}
