<?PHP 

require_once('api/Simpla.php');

########################################
class FeedbackAdmin extends Simpla
{


  function fetch()
  {
  
    // Поиск
  	$keyword = $this->request->get('keyword', 'string');
  	if(!empty($keyword))
  	{
	  	$filter['keyword'] = $keyword;
 		$this->design->assign('keyword', $keyword);
	}

  
  	// Обработка действий 	
  	if($this->request->method('post'))
  	{
		// Действия с выбранными
		$ids = $this->request->post('check');
		if(!empty($ids))
		switch($this->request->post('action'))
		{
		    case 'delete':
		    {
				foreach($ids as $id)
					$this->feedbacks->delete_feedback($id);
		        break;
		    }
		}		
		
 	}

  	// Отображение
	$filter = array();
	$filter['page'] = max(1, $this->request->get('page', 'integer')); 		
	$filter['limit'] = 40;

  	$feedback_count = $this->feedbacks->count_feedback();
	// Показать все страницы сразу
	if($this->request->get('page') == 'all')
		$filter['limit'] = $feedback_count;	
  	
  	$feedback = $this->feedbacks->get_feedbacks($filter, true);

 	$this->design->assign('pages_count', ceil($feedback_count/$filter['limit']));
 	$this->design->assign('current_page', $filter['page']);

 	$this->design->assign('Feedbacks', $feedback);
 	$this->design->assign('feedback_count', $feedback_count);

	return $this->design->fetch('feedback.tpl');
  }
}


?>