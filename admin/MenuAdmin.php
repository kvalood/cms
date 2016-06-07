<?PHP 

require_once('api/Simpla.php');

########################################
class MenuAdmin extends Simpla
{
	public function fetch()
	{
			
		$method = $this->request->get('method');
		$menucat = new StdClass();
		$menu = new stdClass();
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
						$this->menu->del_cat($id);    
			        break;
				}
			}
		}	
		
		switch($method)
		{
			case 'create_menu':
			{
				if($this->request->method('post'))
				{
					//При нажатии добавляем или обновляем категорию
					$menucat->id = $this->request->post('id');
					$menucat->name = $this->request->post('cat_name');
								
					if(empty($menucat->name))
					{	
						$this->design->assign('message_error', 'no_name');
					}
					else
					{
						//Если категории нет, то создаем её.
						if(empty($menucat->id))
						{					
							$list_cat = $this->menu->list_cat_menu();
							foreach($list_cat as $c)
							{
								if($c->name==$menucat->name)
								{
									$this->design->assign('message_error', 'exist_name_cat');
									$exist_name_cat = 1;
								}
							}
							
							if(empty($exist_name_cat))
							{
								$this->menu->add_cat($menucat);
								$this->menu->get_cat($menucat->id);
								$this->design->assign('message_success', 'cat_add');
							}
						}
						else
						{
							$this->menu->update_cat($menucat->id, $menucat);
							$menucat = $this->menu->get_cat($menucat->id);
							$this->design->assign('message_success', 'updated');	
						}
					}						
				}else{
					$menucat->id = $this->request->get('id', 'integer');
					if(!empty($menucat->id))
					{
						$menucat = $this->menu->get_cat($menucat->id);
					}
				}
				
				$this->design->assign('menu', $menucat);
				return $this->design->fetch('menu_category_edit.tpl');				
				break;
			}
			
			case ('list_id_menu'): 
			{
				$id_cat = $this->request->get('id_cat');
				
				//Если нажали удалить пункт меню, то удаляем его нахуй.
				if($this->request->method('post'))
				{
					// Порядок (сортировка)
					$positions = $this->request->post('positions');
					if($positions != 0)
					{
						$ids = array_keys($positions);
						sort($positions);
						foreach($positions as $i=>$position)
							$this->menu->update_id($ids[$i], array('position'=>$position)); 
					}

					//Обрабатываем действия
					$ids = $this->request->post('check');
					if(is_array($ids))
					{
						switch($this->request->post('action'))
						{
							case 'delete':
							{
								foreach($ids as $id)
								{
									$this->menu->del_id($id);
								}
								break;
							}
							case 'disable':
							{
								$this->menu->update_id($ids, array('visible'=>0));
								break;
							}
							case 'enable':
							{
								$this->menu->update_id($ids, array('visible'=>1));	      
								break;
							}
						}
					}
				}	
				
				
				if(!empty($id_cat))
				{
					//Проверяем, задано ли действие с категорией
					$mode = $this->request->get('mode');
					switch($mode)
					{
						//Создание или редактирование пункта меню
						case ('add'):
						{
							//Список всех меню
							$menu_cat =  $this->menu->list_cat_menu();
							$this->design->assign('menu_cat',$menu_cat);
							//Список всех пунктов меню заданной категории
							$menu_list_id = $this->menu->list_id($id_cat);
							$this->design->assign('menu_list_id',$menu_list_id);
							
							//Если нажали сохранить то обновляем или создаем, но прежде проверяем.
							if($this->request->method('post'))
							{
								$menu->id = $this->request->post('id');
								$menu->name = $this->request->post('name');
								$menu->visible = $this->request->post('visible', 'boolean');
								$menu->category = $id_cat;
								$menu->type = $this->request->post('type');
								$menu->id_show = $this->request->post('id_show');

								$menu->url = $this->request->post('url');
								$menu->css = $this->request->post('css');

                                $menu->template = $this->request->post('template');
                                $menu->parent = $this->request->post('parent');

                                $menu->meta_title = $this->request->post('meta_title');
                                $menu->meta_keywords = $this->request->post('meta_keywords');
                                $menu->meta_description = $this->request->post('meta_description');

                                if(empty($menu->id_show) && $menu->type != 3)
                                {
                                    $this->design->assign('message_error', 'no_cat');
                                }
								elseif(empty($menu->name))
								{
									$this->design->assign('message_error', 'no_name');
								}
								elseif($menu->type==0)
								{
									$this->design->assign('message_error', 'no_type');
								}
								else
								{
									//Если меню нет, то создадим его
									if(empty($menu->id))
									{
										//Создаем новый пункт меню
										//Проверяем, есть ли пункт с таким же урл
										$other_url = $this->menu->get_id($menu->url);
										if(empty($menu->url))
										{
											$this->design->assign('message_error', 'no_url');
										}
										elseif($other_url && $menu->type  != 3)
										{
											$this->design->assign('message_error', 'exist_url_menu');
										}
										else
										{
											$menu_id = $this->menu->add_id($menu);
											$menu = $this->menu->get_id($menu_id);
											$this->design->assign('message_success', 'id_add');
										}									
									}
									else
									{
										//Обновляем пункт меню
										$this->menu->update_id($menu->id, $menu);
										$menu = $this->menu->get_id((int)$menu->id);
										$this->design->assign('message_success', 'id_updated');	
										
									}							
								}
							}
                            else
							{
								$menu->id = $this->request->get('id', 'integer');
								$menu = $this->menu->get_id($menu->id);
							}
							
							// Вывод данных в строку быстрого поиска статей/категорий.
							if(isset($menu->id) && $menu->id)
							{
								$id_show = $this->menu->show_data($filter = ['id_show' => $menu->id_show, 'type' => $menu->type]);
								$this->design->assign('id_show', $id_show);
							}

							
							//Работа с категорией
							$cat_cat = $this->menu->get_cat($id_cat);
							$this->design->assign('cat_cat',$cat_cat);
							//Получаем текущее меню
							$this->design->assign('menu', $menu);
							return $this->design->fetch('menu_id_edit.tpl');
							
							break;
						}
						//Список пунктов заданного меню
						default:
						{
							//Работа с категорией
							$cat_cat = $this->menu->get_cat($id_cat);
							$this->design->assign('cat_cat',$cat_cat);
							//скисок всех меню заданной категории
							$menu = $this->menu->list_id($id_cat);
							$this->design->assign('menu', $menu);
							//Список всех меню
							$menu_cat =  $this->menu->list_cat_menu();
							$this->design->assign('menu_cat',$menu_cat);							
							return $this->design->fetch('menu_id_list.tpl');
							break;
						}	
					}
				}
				else
				{
					//Если переменная ИД категории не задана, вывожу просто список меню
					$menu = $this->menu->list_cat_menu();
					$this->design->assign('menu', $menu);
					return $this->design->fetch('menu.tpl');
				}
				break;
			}
	
			//Список всех категорий
			default:
			{
				$menu = $this->menu->list_cat_menu();
				$this->design->assign('menu', $menu);
				return $this->design->fetch('menu.tpl');
			}
		}	
	}
}

?>