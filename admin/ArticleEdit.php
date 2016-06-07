<?php

require_once('api/Simpla.php');

class ArticleEdit extends Simpla
{
	public function fetch()
	{
		$article = new stdClass();
		
		if($this->request->method('post'))
		{
			//Не правильно сохраняется дата в Mysql. 
			//При создании дата указывается правильно, в плоть до секунд, а обновление указывается без точного времени, только дата.
			//При обновлении материала, дата создания указывается без секунд, а обновления - полная.
			//Преобразовать хранение даты в strtotime. А при получении, конвернтировать в нужное число.
			$article->id = $this->request->post('id', 'integer');
			$article->name = $this->request->post('name');
			$article->date = date('Y-m-d H:i:s', strtotime($this->request->post('date')));

			$article->visible = $this->request->post('visible', 'boolean');

			$article->url = trim($this->request->post('url', 'string'));
			$article->meta_title = $this->request->post('meta_title');
			$article->meta_keywords = $this->request->post('meta_keywords');
			$article->meta_description = $this->request->post('meta_description');
			
			$article->annotation = $this->request->post('annotation');
			$article->text = $this->request->post('body');
			
			$article->text = $this->request->post('body');
			
			//Категория материала
			$article->category = $this->request->post('article_category');
			
			
		/**
		*	Удаление изображений
		*/
			//Узнаем текущее изображение
			if($article->id)
			{
				$current_prev = $this->article->get_article($article->id);
				$current_prev = $current_prev->prev_images;
				
				//Если есть текущее изображение, то сравниваем его с тем что есть в загруженом поле
				$article_prev_images = $this->request->post('article_prev_images');
				if($current_prev && !$article_prev_images)
				{
					//Удаляем изображение
					$this->article->delete_image($current_prev);
					$article->prev_images = '';
				}				
			}
			
			//Изображение для краткого содержания (prev_images)
			if($this->request->files('prev_images', 'name'))
			{
				$article->prev_images = $this->request->files('prev_images');
				
				if($image_name = $this->image->upload_image($article->prev_images['tmp_name'], $article->prev_images['name'], 'article'))
				{
					if(isset($current_prev) && $current_prev != $image_name)
					{
						//Удаляем старое изображение
						$this->article->delete_image($current_prev);
					}
					
					$article->prev_images = $image_name;
				}
				else
				{
					$this->design->assign('message_error', 'error_uploading_image');
				}
			}
			
			
			
			//Дополнительные поля, обрабатываем их через json
			if(array_filter($this->request->post('field')))
				$article->field = json_encode(array_filter($this->request->post('field')));
			else
				$article->field = '';

			if($article->id == 0)
			{
				$article->id = '';
			}
			
 			// Не допустить одинаковые URL материалов и нельзя создавать материалы с пустым названием
			if(($a = $this->article->get_article($article->url)) && $a->id!=$article->id)
			{			
				$this->design->assign('message_error', 'url_exists');
			}
			elseif(!$article->name)
			{
				$this->design->assign('message_error', 'name_empty');
			}
			else
			{
				if(empty($article->id))
				{
	  				$article->id = $this->article->add_article($article);
	  				$article = $this->article->get_article($article->id);
					$this->design->assign('message_success', 'added');
	  			}
  	    		else
  	    		{
  	    			$this->article->update_article($article->id, $article);
  	    			$article = $this->article->get_article($article->id);
					$this->design->assign('message_success', 'updated');
  	    		}
			}
		}
		else
		{
			$a_id = $this->request->get('id', 'integer');
			$article = $this->article->get_article(intval($a_id));
		}
		
		//Если есть дополнительные поля, добавим
		if(isset($article->field))
			$article->field = json_decode($article->field);
		
		//Название категории 
		$articlecat = $this->article->get_article_category();
		$this->design->assign('articlecat', $articlecat);
		
		//Получить пункт меню по типу и ID show Для полной ссылки (посмотреть на сайте)
		if(isset($article->id))
		{
			if($article->category != 0)
			{
				$params = array('id_show' => (int) $article->category, 'type' => 2);
			}
			else
			{
				$params = array('id_show' => (int) $article->id, 'type' => 1);
			}
			
			$url = $this->menu->get_id_show($params);
			
			if($article->category && !empty($url))
			{					
				$article->full_url = $url->url.'/'.$article->url;
			}
			elseif(!empty($url) && $url->home == 1)
			{
				$article->full_url = '';
			}				
			else
			{
				$article->full_url = $article->url;
			}
		}

		
		if(empty($post->date))
		{	
			$post = new stdClass();
			$post->date = date($this->settings->date_format, time());
		}
 		
		$this->design->assign('article', $article);
		
		
 	  	return $this->design->fetch('article_edit.tpl');
	}
}