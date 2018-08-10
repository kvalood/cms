<?PHP

require_once('api/Simpla.php');


############################################
# Class goodCategories displays a list of products categories
############################################
class StatsAdmin extends Simpla
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
        
        if(empty($filter)) {
            $filter['date_filter'] = 'last_30day';
            $this->design->assign('date_filter', 'last_30day');  
        }
      
        $this->design->assign('stat', $this->reportstat->get_stat($filter));
        $this->design->assign('stat_orders', $this->reportstat->get_stat_orders($filter));
        
        // Метки заказов
        $labels = $this->orders->get_labels();
        $this->design->assign('labels', $labels);        
        
 	    return $this->design->fetch('stats.tpl');
    }
}
