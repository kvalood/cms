<?PHP 
require_once('api/Simpla.php');

class ArticleCategoryAdmin extends Simpla
{
	public function fetch()
	{
		$method = $this->request->get('method');
		$articlecat = new StdClass();
		if($this->request->method('post') && empty($method))
		{
			//Удаляем категории.
			$ids = $this->request->post('check');
			if(is_array($ids))
			switch($this->request->post('action'))
			{
				case 'delete':
				{	
					foreach($ids as $id)
						$this->article->del_cat($id);    
			        break;
				}
			}
		}		
		
		switch($method)
		{
			case 'add_cat':
			{
				if($this->request->method('post'))
				{
					//При нажатии добавляем или обновляем категорию
					$articlecat->id = $this->request->post('id');
					$articlecat->name = $this->request->post('cat_name');
					$articlecat->articles_num = $this->request->post('articles_num');
					$articlecat->meta_title = $this->request->post('meta_title');
					$articlecat->meta_keywords = $this->request->post('meta_keywords');
					$articlecat->meta_description = $this->request->post('meta_description');
					$articlecat->template = $this->request->post('template');
					
					$articlecat->sorting_method = $this->request->post('sorting_method');
					$articlecat->sorting_type = $this->request->post('sorting_type');
					
					if(empty($articlecat->name))
					{	
						$this->design->assign('message_error', 'no_name');
					}
					else
					{
						//Если категории нет, то создаем её.
						if(empty($articlecat->id))
						{					
							$list_cat = $this->article->get_article_category();
							foreach($list_cat as $c)
							{
								if($c->name==$articlecat->name)
								{
									$this->design->assign('message_error', 'exist_name_cat');
									$exist_name_cat = 1;
								}
							}
							
							if(empty($exist_name_cat))
							{
								$this->article->add_cat($articlecat);
								$this->article->get_category($articlecat->id);
								$this->design->assign('message_success', 'cat_add');
							}
						}
						else
						{
							$this->article->update_cat($articlecat->id, $articlecat);
							$articlecat = $this->article->get_category($articlecat->id);
							$this->design->assign('message_success', 'updated');	
						}
					}						
				}
				else
				{
					$articlecat->id = $this->request->get('id', 'integer');
					if(!empty($articlecat->id))
					{
						$articlecat = $this->article->get_category($articlecat->id);
					}
				}
				
				$this->design->assign('articlecat', $articlecat);
				return $this->design->fetch('article_category_edit.tpl');
				
				
				break;
			}
				
			//Список всех категорий
			default:
			{
				$articlecat = $this->article->get_article_category();
				$this->design->assign('articlecat', $articlecat);
				return $this->design->fetch('article_categories.tpl');
			}
				
		}	
	}
		
}

?>