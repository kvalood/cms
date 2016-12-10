<?PHP

require_once('api/Simpla.php');

############################################
# Class Properties displays a list of product parameters
############################################
class FeaturesAdmin extends Simpla
{
	function fetch()
	{	
	
		$method = $this->request->get('method');

		switch($method)
		{
			case 'reset':
                $count[1] = $count[2] = 0;
                foreach($this->features->get_options_cleaner() as $key => $o)
                {
                    switch($o->type) {
                        case '1':
                            if(strpos($o->value, ',') > 0) {
                                $this->features->update_option_new($o->product_id, $o->feature_id, str_replace(',', '.', $o->value));
                                $count[1]++;
                            }
                            break;

                        case '2':
                            if(preg_match('/[^\d.]/', $o->value)) {
                                $this->features->update_option_new($o->product_id, $o->feature_id, preg_replace('/[^\d.]/', '', $o->value));
                                $count[2]++;
                            }
                            break;
                    }
                }

                $this->design->assign('message', $count);
			break;
			
		}
	
		if($this->request->method('post'))
		{  	
			// Действия с выбранными
			$ids = $this->request->post('check');
			if(is_array($ids))
			switch($this->request->post('action'))
			{
			    case 'set_in_filter':
			    {
			    	$this->features->update_feature($ids, array('in_filter'=>1));    
					break;
			    }
			    case 'unset_in_filter':
			    {
			    	$this->features->update_feature($ids, array('in_filter'=>0));    
					break;
			    }
                case 'set_in_yandex':
                {
                    $this->features->update_feature($ids, array('in_yandex'=>1));
                    break;
                }
                case 'unset_in_yandex':
                {
                    $this->features->update_feature($ids, array('in_yandex'=>0));
                    break;
                }
			    case 'delete':
			    {
			    	$current_cat = $this->request->get('category_id', 'integer');
			    	foreach($ids as $id)
			    	{
			    		// текущие категории
			    		$cats = $this->features->get_feature_categories($id);
			    		
			    		// В каких категориях оставлять
			    		$diff = array_diff($cats, (array)$current_cat);
			    		if(!empty($current_cat) && !empty($diff))
			    		{
			    			$this->features->update_feature_categories($id, $diff);
			    		}
			    		else
			    		{
			    			$this->features->delete_feature($id); 
			    		}
					}
			        break;
			    }
			}		
	  	
			// Сортировка
			$positions = $this->request->post('positions');
	 		$ids = array_keys($positions);
			sort($positions);
			foreach($positions as $i=>$position)
				$this->features->update_feature($ids[$i], array('position'=>$position)); 

		}
		
		
		
	
		$categories = $this->categories->get_categories_tree();
		$category = null;
		
		$filter = array();
		$category_id = $this->request->get('category_id', 'integer');
		if($category_id)
		{
			$category = $this->categories->get_category($category_id);
			$filter['category_id'] = $category->id;
		}
		
		$features = $this->features->get_features($filter);
		
		$this->design->assign('categories', $categories);
		$this->design->assign('category', $category);
		$this->design->assign('features', $features);
		return $this->body = $this->design->fetch('features.tpl');
	}
}
