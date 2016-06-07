<?PHP 
require_once('api/Simpla.php');

class TagsAdmin extends Simpla
{
	public function fetch()
	{
		
		$tags = $this->tags->get_tags();
		$this->design->assign('tags', $tags);
		
		return $this->design->fetch('tags.tpl');
		
	}
	
	
	/*
		// Обработка действий
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
						$this->article->delete_article($id);    
			        break;
			    }
			}				
		}		
		
		//Сортировка статей в админ панели
		$filter = array();
		
		if($this->request->method('get'))
		{
			//Сортировка по категориям
			$search_cat = $this->request->get('category');
			if(!empty($search_cat))
			{
				if($search_cat == 'not_cat')
				{
					$cat_id = 0;
				}
				else
				{
					$cat_id = $search_cat;
				}
				
				$filter['id'] = $cat_id;
				$this->design->assign('category',$search_cat);
			}
			
			//Поиск статей в админке
			$keyword = $this->request->get('keyword', 'string');
			if(!empty($keyword))
			{
				$filter['keyword'] = $keyword;
				$this->design->assign('keyword', $keyword);
			}
		}
		
		
		$filter['page'] = max(1, $this->request->get('page', 'integer'));
		$filter['limit'] = $this->settings->articles_num_admin;
		
		
		//Количество статей.
		$count_article = $this->article->count_article($filter);
		$this->design->assign('count_article', $count_article);
		
		// Показать все страницы сразу
		if($this->request->get('page') == 'all')
			$filter['limit'] = $count_article;
		
		if($filter['limit']>0)	  	
		  	$pages_count = ceil($count_article/$filter['limit']);
		else
		  	$pages_count = 0;
	  	$filter['page'] = min($filter['page'], $pages_count);

	 	$this->design->assign('pages_count', $pages_count);
	 	$this->design->assign('current_page', $filter['page']);	

		
		//Получаем статьи и вертим их в шаблон
		$article = $this->article->get_articles($filter);
		$this->design->assign('article', $article);				

		
		//Название всех категории 
		$articlecat = $this->article->get_article_category();
		$this->design->assign('articlecat', $articlecat);
		
		return $this->design->fetch('articles.tpl');
		
		
	}
	*/

}


?>