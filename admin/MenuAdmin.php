<?PHP 

require_once('api/Simpla.php');

########################################
class MenuAdmin extends Simpla
{
	public function fetch()
	{
		$method = $this->request->get('method');

		$menu = new stdClass();
        $item = new stdClass();
		
		switch($method)
		{
		    // Создание меню
			case 'menu':
			{
				if($this->request->method('post'))
				{
					$menu->id = $this->request->post('id');
					$menu->name = $this->request->post('name');
								
					if(empty($menu->name))
					{
                        $messages['error'][] = ['key' => 'name_empty'];
					}
					else
					{
						if(empty($menu->id))
						{
                            $this->menu->add_cat($menu);
                            $this->menu->get_cat($menu->id);
                            $messages['success'][] = ['key' => 'added'];
						}
						else
						{
							$this->menu->update_cat($menu->id, $menu);
							$menu = $this->menu->get_cat($menu->id);
                            $messages['success'][] = ['key' => 'updated'];
						}
					}						
				}
				else
                {
					$menu->id = $this->request->get('menu_id', 'integer');
					if(!empty($menu->id))
					{
						$menu = $this->menu->get_cat($menu->id);
					}
				}
				
				$this->design->assign('menu', $menu);
                $template = 'menu_edit.tpl';
				break;
			}

            // Создание/редактирование пункта меню
            case 'item':
            {
                $menu = $this->request->get('menu_id');
                if($menu = $this->menu->get_cat($menu))
                {
                    // Если нажали сохранить то обновляем или создаем, но прежде проверяем.
                    if($this->request->method('post'))
                    {
                        $item->id = $this->request->post('id');
                        $item->name = $this->request->post('name');
                        $item->visible = $this->request->post('visible', 'boolean');
                        $item->category = $menu->id;
                        $item->type = $this->request->post('type');
                        $item->id_show = $this->request->post('id_show');
                        $item->css = $this->request->post('css');
                        $item->parent = $this->request->post('parent');
                        $item->url = ($item->type == 3) ? $this->request->post('url') : '';

                        if(empty($item->type) || $item->type < 1 || $item->type > 3) {
                            $messages['error'][] = ['key' => 'error'];
                        }
                        elseif(empty($item->id_show) && $item->type == 1)
                        {
                            $messages['error'][] = ['key' => 'empty_selected'];
                        }
                        elseif(empty($item->id_show) && $item->type == 2)
                        {
                            $messages['error'][] = ['key' => 'empty_selected_category'];
                        }
                        elseif(empty($item->url) && $item->type == 3)
                        {
                            $messages['error'][] = ['key' => 'empty_url'];
                        }
                        elseif(empty($item->name))
                        {
                            $messages['error'][] = ['key' => 'name_empty'];
                        }
                        else
                        {

                            if(empty($item->id))
                            {
                                $item = $this->menu->add_id($item);
                                $item = $this->menu->get_id($item);
                                $messages['success'][] = ['key' => 'added'];
                            }
                            else
                            {
                                $this->menu->update_id($item->id, $item);
                                $item = $this->menu->get_id((int)$item->id);
                                $messages['success'][] = ['key' => 'updated'];
                            }

                            print_r($item);
                        }
                    }
                    else
                    {
                        $item->id = $this->request->get('id', 'integer');
                        $item = $this->menu->get_id($item->id);
                    }

                    $this->design->assign('item', $item);

                    // Список всех пунктов в этом меню
                    $menu_items = $this->menu->list_id($menu->id);
                    $this->design->assign('menu_items', $menu_items);

                    $this->design->assign('menu', $menu);

                    // Список всех материалов сайта
                    $articles = $this->article->get_articles();
                    $this->design->assign('articles', $articles);

                    // Список всех категорий материалов сайта
                    $article_categories = $this->article->get_article_category();
                    $this->design->assign('article_categories', $article_categories);


                    $template = 'menu_item.tpl';

                } else {
                    header('Location: ' . $this->config->root_url . '/admin/index.php?module=MenuAdmin');
                }
                break;
            }

			// Список пунктов меню в меню
			case 'items':
			{
				$menu = $this->request->get('menu_id');
                if($menu = $this->menu->get_cat($menu)) {

                    if ($this->request->method('post')) {
                        // Порядок (сортировка)
                        $positions = $this->request->post('positions');
                        if ($positions != 0) {
                            $ids = array_keys($positions);
                            sort($positions);
                            foreach ($positions as $i => $position)
                                $this->menu->update_id($ids[$i], array('position' => $position));
                        }

                        //Обрабатываем действия
                        $ids = $this->request->post('check');
                        if (is_array($ids)) {
                            switch ($this->request->post('action')) {
                                case 'delete': {
                                    foreach ($ids as $id) {
                                        $this->menu->del_id($id);
                                    }
                                    break;
                                }
                                case 'disable': {
                                    $this->menu->update_id($ids, array('visible' => 0));
                                    break;
                                }
                                case 'enable': {
                                    $this->menu->update_id($ids, array('visible' => 1));
                                    break;
                                }
                            }
                        }
                    }

                    $items = $this->menu->list_id($menu->id);
                    $this->design->assign('items', $items);

                    $this->design->assign('menu', $menu);

                }

                $template = 'menu_items.tpl';
				break;
			}
	
			// Список всех меню
			default:
			{
                if($this->request->method('post'))
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

                $menu = $this->menu->list_cat_menu();
				$this->design->assign('menu', $menu);
                $template = 'menu.tpl';
                break;
			}
		}

        if(isset($messages))
            $this->design->assign('messages', $messages);

        return $this->design->fetch($template);
	}
}

?>