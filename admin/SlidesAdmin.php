<?PHP

require_once('api/Simpla.php');

class SlidesAdmin extends Simpla
{
	function fetch()
	{
	
		if($this->request->method('post'))
		{  	
			// Действия с выбранными
			$ids = $this->request->post('check');
			if(is_array($ids))
			switch($this->request->post('action'))
			{
			    case 'delete':
			    {
			    	foreach($ids as $id)
			    	{
						$this->slides->delete_slide($id);
					}
			        break;
			    }
			}		
	  	
			// Сортировка
			$positions = $this->request->post('positions');
	 		$ids = array_keys($positions);
			sort($positions);
			foreach($positions as $i=>$position)
				$this->slides->update_slide($ids[$i], array('position'=>$position)); 

		} 

		$filter = array();
		$slides = $this->slides->get_slides($filter);
		$this->design->assign('slides', $slides);
		return $this->body = $this->design->fetch('slides.tpl');
	}
}
