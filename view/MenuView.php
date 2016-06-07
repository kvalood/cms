<?PHP

require_once('View.php');

class MenuView extends View
{
	function fetch()
	{		
		$r_1 = $this->request->get('r_1','string');
		$r_2 = $this->request->get('r_2','string');	
		
		if($r_1 == '404')
		{
			return $this->design->fetch('system/404.tpl');
		}
		
		if($r_1!='admin' OR $r_1!='order' OR $r_1!='cart')
		{
			//Если задан р2, сразу отображаем материал
			if(!empty($r_2))
			{
				$get_article = $this->article->get_article($r_2);
				
				if(!empty($get_article))
				{
					//Если материал и пункт меню включены, то показываем.
					$menu_visible = $this->menu->get_id($r_1);
					if($get_article->visible==1 AND $menu_visible->visible==1)
					{
						// Мета-теги
						$meta_title = $get_article->meta_title;
						if(!empty($menu_visible->meta_title)){$meta_title .= ' - '.$menu_visible->meta_title;}else{$meta_title .= ' - '.$menu_visible->name;}
						$meta_keywords = $get_article->meta_keywords;
						$meta_description = $get_article->meta_description;
						
						$this->design->assign('meta_title', $meta_title);
						$this->design->assign('meta_keywords', $meta_keywords);
						$this->design->assign('meta_description', $meta_description);
						
						
						//Отдадим категорию в шаблон.
						$category = $this->article->get_category($get_article->category);
						$category->url = $r_1;
						if($menu_visible->name){$category->name = $menu_visible->name;}
						$this->design->assign('category_article', $category);
						
						//Дополнительные поля
						if(isset($get_article->field))
							$get_article->field = json_decode($get_article->field);
						
						
						//Предварительное изображение prev_images
						if(isset($get_article->prev_images))
							$get_article->prev_images = $this->config->article_images_dir.$get_article->prev_images;
						
						//Отдаем статью в шаблон
						$this->design->assign('article', $get_article);
						
						
						//Узнаем какой шаблон для отображения
						$template = $menu_visible->template;
						if(!$template)
							$template = $category->template;

						$tpl = $template.'_item.tpl';						

						//Проверяем, есть ли темплейт для материала в категории
						if(file_exists($this->design->smarty->template_dir[0].$tpl))
						{
							return $this->design->fetch($tpl);
						}
						else
						{
							//Если нету, используем дефолтный
							return $this->design->fetch('article_item.tpl');
						}
					}
				}
			}
			elseif(empty($r_2) AND !empty($r_1))
			{

				//Узнаем тип пункта меню, материал или категория?
				$get_type = $this->menu->get_id($r_1);

				if(!empty($get_type))
					$type = $get_type->type;
				else
					return false;
			

				//если не удалось узнать тип по меню, значит ошибка.		
				if(empty($type) || $get_type->home == 1)
				{
					//Пробуем найти материал, который не показывается через меню.
					$url = $this->article->get_article($r_1);
					if(!empty($url))
					{
						$type = 1;
						$id = (int) $url->id;
					}
					else
					{
						return $this->design->fetch('system/404.tpl');
					}
				}
				else
				{
					$url = $this->menu->get_id($r_1);
					$id = (int) $url->id_show;
				}
				
				switch($type)
				{
					//Материал
					case '1':
					{
						$get_article = $this->article->get_article($id);
						if(!empty($get_article))
						{
							//Если меню включены, то показываем. $get_article->visible==1 AND 
							if($url->visible==1)
							{
								//Дополнительные поля
								if(isset($get_article->field))
									$get_article->field = json_decode($get_article->field);
								
								//Предварительное изображение prev_images
								if(isset($get_article->prev_images))
									$get_article->prev_images = $this->config->article_images_dir.$get_article->prev_images;

								$this->design->assign('article', $get_article);
								
								// Мета-теги
								if(!empty($get_article->meta_title)){$meta_title=$get_article->meta_title;}else{$meta_title=$url->name;}
								$this->design->assign('meta_title', $meta_title);
								$this->design->assign('meta_keywords', $get_article->meta_keywords);
								$this->design->assign('meta_description', $get_article->meta_description);
								
								//Узнаем какой шаблон задавался для категории в пункте меню
								$tpl = $url->template.'.tpl';
								
								//Проверяем, есть ли темплейт для материала в категории
								if(file_exists($this->design->smarty->template_dir[0].$tpl))
								{
									return $this->design->fetch($tpl);
								}
								else
								{
									//Если нету, используем дефолтный
									return $this->design->fetch('article_item.tpl');
								}
							}
						}
						break;
					}
					
					//Категория
					case '2':
					{
						$filter = array();
						$filter['id']=$id;
						$filter['visible']=1;
						$filter['category_search']=$id;
						if($url->visible==1)
						{	
							//Категория материалов
							$category = $this->article->get_category($filter['id']);
	
							// Фильтруем по страницам 
							// Количество постов на 1 странице
							if($category->articles_num)
							{
								$items_per_page = $category->articles_num;
							}
							else
							{
								$items_per_page = $this->settings->articles_num;
							}
							
							
							// Текущая страница в постраничном выводе
							$current_page = $this->request->get('page', 'integer');
							
							// Если не задана, то равна 1
							$current_page = max(1, $current_page);
							$this->design->assign('current_page_num', $current_page);
							
							//Количество страниц
							$article_count = $this->article->count_article($filter);

							//Отдаем в шаблон
							$pages_num = ceil($article_count/$items_per_page);
							$this->design->assign('total_pages_num', $pages_num);
							
							$filter['page'] = $current_page;
							$filter['limit'] = $items_per_page;
						
							//Выбираем материалы
							$show_category = $this->article->get_articles($filter);
							
							foreach($show_category as $p)
							{
								//Дополнительные поля
								if(isset($p->field))
									$p->field = json_decode($p->field);
								
								
								//Предварительное изображение prev_images
								if(isset($p->prev_images))
									$p->prev_images = $this->config->article_images_dir.$p->prev_images;
							}
							
							//Отдаем материалы
							$this->design->assign('articles', $show_category);
							
							// Мета-теги, берем из пункта меню.
							$menu_visible = $this->menu->get_id($r_1);
							
							if(!empty($menu_visible->meta_title)){$meta_title=$menu_visible->meta_title;}elseif(!empty($category->meta_title)){$meta_title=$category->meta_title;}else{$meta_title=$menu_visible->name;}
							if($menu_visible->meta_keywords){$meta_keywords=$menu_visible->meta_keywords;}elseif(!empty($category->meta_keywords)){$meta_keywords=$category->meta_keywords;}
							if($menu_visible->meta_description){$meta_description=$menu_visible->meta_description;}elseif(!empty($category->meta_description)){$meta_description=$category->meta_description;}
							
							$this->design->assign('meta_title', $meta_title);
							$this->design->assign('meta_keywords', $menu_visible->meta_keywords);
							$this->design->assign('meta_description', $menu_visible->meta_description);
							

							//Отдадим название категории в шаблон (По названию пункта меню)
							$this->design->assign('category_article', $menu_visible);
							
							
							//Узнаем какой шаблон для отображения
							$template = $menu_visible->template;
							if(!$template)
								$template = $category->template;
								
							$tpl = $template.'.tpl';
							//Проверяем, есть ли темплейт для материала в категории
							if(file_exists($this->design->smarty->template_dir[0].$tpl))
							{
								return $this->design->fetch($tpl);
							}
							else
							{
								return $this->design->fetch('articles.tpl');
							}
						}
					}
				}
			}
			else
			{
				//Главная страница
				
				$all_menu = $this->menu->all_list_id();
				foreach($all_menu as $a)
				{
					if($a->home==1)
					{
						$home_page_id = (int) $a->id_show;
						$menu_visible = $a;
						$get_article = $this->article->get_article($home_page_id);
					}
				}
				
				// Мета-теги
                $meta_title = $meta_keywords = $meta_description = '';

                if(isset($menu_visible)) {
                    if ($menu_visible->meta_title) {
                        $meta_title = $menu_visible->meta_title;
                    } elseif (!empty($get_article->meta_title)) {
                        $meta_title = $get_article->meta_title;
                    } elseif (!empty($get_article->name)) {
                        $meta_title = $get_article->name;
                    } else {
                        $meta_title = $this->settings->site_name;
                    }
                    if ($menu_visible->meta_keywords) {
                        $meta_keywords = $menu_visible->meta_keywords;
                    } elseif (!empty($get_article->meta_keywords)) {
                        $meta_keywords = $get_article->meta_keywords;
                    }
                    if ($menu_visible->meta_description) {
                        $meta_description = $menu_visible->meta_description;
                    } elseif (!empty($get_article->meta_description)) {
                        $meta_description = $get_article->meta_description;
                    }
                }

				$this->design->assign('meta_title', $meta_title);
				$this->design->assign('meta_keywords', $meta_keywords);
				$this->design->assign('meta_description', $meta_description);				

                if(isset($get_article))
				    $this->design->assign('article', $get_article);
				
				return $this->design->fetch('main.tpl');
			}
		}
	}

}