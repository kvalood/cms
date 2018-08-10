<?PHP 


class ArticleAdmin extends Simpla
{
	public function fetch()
	{
        $method = $this->request->get('method');
        $article = new stdClass();
        $category = new stdClass();

		switch ($method){

		    // Страница
            case 'item':
            {
                if($this->request->method('post')) {
                    //Не правильно сохраняется дата в Mysql.
                    //При создании дата указывается правильно, в плоть до секунд, а обновление указывается без точного времени, только дата.
                    //При обновлении материала, дата создания указывается без секунд, а обновления - полная.
                    //Преобразовать хранение даты в strtotime. А при получении, конвернтировать в нужное число.
                    $article->id = $this->request->post('id', 'integer');
                    $article->name = $this->request->post('name');
                    $article->date = date('Y-m-d H:i:s', strtotime($this->request->post('date')));
                    $article->visible = $this->request->post('visible', 'boolean');
                    $article->annotation = $this->request->post('annotation');
                    $article->text = $this->request->post('body');
                    $article->text = $this->request->post('body');
                    $article->category = $this->request->post('article_category');

                    $article->url = trim($this->request->post('url', 'string'));

                    if(empty($article->url))
                        $article->url = $this->translit($article->name);

                    $article->meta_title = $this->request->post('meta_title');
                    $article->meta_keywords = $this->request->post('meta_keywords');
                    $article->meta_description = $this->request->post('meta_description');

                    if($article->id == 0)
                        $article->id = '';

                    // Не допустить одинаковые URL материалов и нельзя создавать материалы с пустым названием
                    if(($a = $this->article->get_article($article->url)) && $a->id!=$article->id)
                    {
                        $messages['error'][] = ['key' => 'url_exists'];
                    }
                    elseif(!$article->name)
                    {
                        $messages['error'][] = ['key' => 'name_empty'];
                    }
                    else
                    {
                        if(empty($article->id))
                        {
                            $article->id = $this->article->add_article($article);
                            $article = $this->article->get_article($article->id);
                            $messages['success'][] = ['key' => 'added'];
                        }
                        else
                        {
                            $this->article->update_article($article->id, $article);
                            $article = $this->article->get_article($article->id);
                            $messages['success'][] = ['key' => 'updated'];
                        }
                    }
                }
                else
                {
                    $article_id = $this->request->get('id', 'integer');
                    $article = $this->article->get_article(intval($article_id));
                }

                // Категории
                $article_categories = $this->article->get_article_category();
                $this->design->assign('article_categories', $article_categories);

                //Получить пункт меню по типу и ID show Для полной ссылки (посмотреть на сайте)
                if(isset($article->id))
                {
                    if($this->settings->home_page == $article->id) {
                        $article->full_url = $this->config->root_url;
                    } elseif(!empty($article->category)) {
                        $article->full_url = $article->category_url . '/' . $article->url;
                    } else {
                        $article->full_url = $article->url;
                    }
                }

                $this->design->assign('article', $article);
                $template = 'article_item.tpl';
                break;
            }


            // категории
            case 'categories':
            {
                //Удаляем категории.
                if($this->request->method('post'))
                {
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

                $article_categories = $this->article->get_article_category();
                $this->design->assign('article_categories', $article_categories);
                $template = 'article_categories.tpl';

                break;
            }

            // Категория
            case 'category':
            {
                if($this->request->method('post'))
                {
                    //При нажатии добавляем или обновляем категорию
                    $category->id = $this->request->post('id');
                    $category->name = $this->request->post('name');
                    $category->url = empty($category->url) ? $this->translit($category->name) : $this->request->post('url');
                    $category->articles_num = $this->request->post('articles_num');
                    $category->template = $this->request->post('template');
                    $category->sorting_method = $this->request->post('sorting_method');
                    $category->sorting_type = $this->request->post('sorting_type');
                    $category->meta_title = $this->request->post('meta_title');
                    $category->meta_keywords = $this->request->post('meta_keywords');
                    $category->meta_description = $this->request->post('meta_description');

                    if(empty($category->name)) {
                        $messages['error'][] = ['key' => 'name_empty'];
                    } elseif(($cat = $this->article->get_category($category->url)) && $cat->id != $category->id) {
                        $messages['error'][] = ['key' => 'url_exists'];
                    } else {
                        //Если категории нет, то создаем её.
                        if(empty($category->id)) {
                            $this->article->add_cat($category);
                            $this->article->get_category($category->id);
                            $messages['success'][] = ['key' => 'added'];
                        } else {
                            $this->article->update_cat($category->id, $category);
                            $category = $this->article->get_category($category->id);
                            $messages['success'][] = ['key' => 'updated'];
                        }
                    }
                }
                else
                {
                    $category->id = $this->request->get('id', 'integer');
                    $category = $this->article->get_category(intval($category->id));
                }

                $this->design->assign('category', $category);
                $template = 'article_category.tpl';

                break;
            }

		    // Список страниц
            default:
            {
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
                $articles = $this->article->get_articles($filter);
                $this->design->assign('articles', $articles);

                //Название всех категории
                $article_categories = $this->article->get_article_category();
                $this->design->assign('article_categories', $article_categories);

                $template = 'articles.tpl';
            }
        }

        if(isset($messages))
            $this->design->assign('messages', $messages);

        return $this->design->fetch($template);
		

	}

}


?>