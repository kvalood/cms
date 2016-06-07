<?PHP

/**
 * Simpla CMS
 *
 * @copyright 	2011 Denis Pikusov
 * @link 		http://simplacms.ru
 * @author 		Denis Pikusov
 *
 * Этот класс использует шаблон product.tpl
 *
 */

require_once('View.php');


class ProductView extends View
{

	function fetch()
	{   
		$product_url = $this->request->get('product_url', 'string');
		
		if(empty($product_url))
			return false;

		// Выбираем товар из базы
		$product = $this->products->get_product((string)$product_url);
		if(empty($product) || (!$product->visible && empty($_SESSION['admin'])))
			return false;
			
		// Получим категорию товара, и узнаем, включена она или нет. (если нет, товар не отображается)
		$product->categories = $this->categories->get_categories(array('product_id'=>$product->id));
		$key = array_keys($product->categories);
		if(!$product->categories[$key[0]]->visible && empty($_SESSION['admin']))
			return false;

		
		$product->images = $this->products->get_images(array('product_id'=>$product->id));
		$product->image = reset($product->images);

		$variants = array();
		foreach($this->variants->get_variants(array('product_id'=>$product->id, 'in_stock'=>true)) as $v)
			$variants[$v->id] = $v;
		
		$product->variants = $variants;
		/*size_color*/
        $product->size_color = array();
        foreach($product->variants as $variant) {
            if (!empty($variant->name)) {
                if(empty($product->size_color[$variant->name."__".$product->id])) {
                    $product->size_color[$variant->name."__".$product->id] = array();
                }
                $product->size_color[$variant->name."__".$product->id][] = $variant;
            }
        }
        /*size_color*/
		
		// Вариант по умолчанию
		if(($v_id = $this->request->get('variant', 'integer'))>0 && isset($variants[$v_id]))
			$product->variant = $variants[$v_id];
		else
			$product->variant = reset($variants);
					
		$product->features = $this->features->get_product_options(['product_id'=>$product->id], ['visible'=>1]);


        // Принимаем комментарий
        if ($this->request->method('post') && $this->request->post('comment') && $this->settings->comment_product) {

            $comment = new stdClass;
            $comment->text = $this->request->post('text');
            $comment->parent = $this->request->post('reply_comment', 'int');
            $captcha_code = $this->request->post('captcha_code', 'string');

            if($this->manager)
            {
                $comment->name = $this->manager->login;
                $comment->email = $this->settings->comment_email;
            }
            else if(!$this->user)
            {
                $comment->name = $this->request->post('name');
                $comment->email = $this->request->post('email_comment');
            }
            else
            {
                $comment->name = $this->user->name;
                $comment->email = $this->user->email;
            }

            // Передадим комментарий обратно в шаблон
            $this->design->assign('comment_text', $comment->text);
            $this->design->assign('comment_name', $comment->name);
            $this->design->assign('comment_email', $comment->email);
            $this->design->assign('comment_retly', $this->comments->get_comment($comment->parent));
            $this->design->assign('comment_parent', $comment->parent);


            // Проверяем капчу и заполнение формы
            if($_SESSION['captcha_code'] != $captcha_code || empty($captcha_code))
            {
                $this->design->assign('error', 'captcha');
            }
            elseif(!$this->user)
            {
                if(empty($comment->name))
                {
                    $this->design->assign('error', 'empty_name');
                }
                elseif (!filter_var($comment->email, FILTER_VALIDATE_EMAIL))
                {
                    $this->design->assign('error', 'empty_email');
                }
            }
            elseif (empty($comment->text))
            {
                $this->design->assign('error', 'empty_comment');
            }
            else
            {
                // Создаем комментарий
                $comment->object_id = $product->id;
                $comment->type = 'product';
                $comment->ip = $_SERVER['REMOTE_ADDR'];


                // Модерировать комментарии?
                if($this->settings->comment_moderate and !$this->manager->login)
                {
                    $comment->approved = 0;

                    // Если были одобренные комментарии от текущего ip, одобряем сразу
                    if(!$this->settings->comment_moderate_valid)
                    {
                        $this->db->query("SELECT 1 FROM __comments WHERE approved=1 AND ip=? LIMIT 1", $comment->ip);
                        if ($this->db->num_rows() > 0)
                            $comment->approved = 1;
                    }
                }
                else
                {
                    $comment->approved = 1;
                }

                // Добавляем комментарий в базу
                $comment_id = $this->comments->add_comment($comment);

                //Отправляем email уведомление, тому, на чей комментарий ответили. (админу не присылать)
                if (!empty($comment->parent) and !$this->manager->login)
                    $this->notify->email_comment_retly($comment->parent);

                // Отправляем email администратору
                if($this->settings->comment_notice)
                    $this->notify->email_comment_admin($comment_id);

                // Приберем сохраненную капчу, иначе можно отключить загрузку рисунков и постить старую
                unset($_SESSION['captcha_code']);
                header('location: ' . $_SERVER['REQUEST_URI'] . '#comment_' . $comment_id);
            }
        }


        // Выводим комментарии
        $comments = $this->comments->get_comments_tree(array('type' => 'product', 'object_id' => $product->id, 'approved' => 1, 'ip' => $_SERVER['REMOTE_ADDR']));
        $this->design->assign('comments', $comments);


		// Связанные товары
		$related_ids = array();
		$related_products = array();
		foreach($this->products->get_related_products($product->id) as $p)
		{
			$related_ids[] = $p->related_id;
			$related_products[$p->related_id] = null;
		}
		if(!empty($related_ids))
		{
			foreach($this->products->get_products(array('id'=>$related_ids, 'in_stock'=>1, 'visible'=>1)) as $p)
				$related_products[$p->id] = $p;
			
			$related_products_images = $this->products->get_images(array('product_id'=>array_keys($related_products)));
			foreach($related_products_images as $related_product_image)
				if(isset($related_products[$related_product_image->product_id]))
					$related_products[$related_product_image->product_id]->images[] = $related_product_image;
			$related_products_variants = $this->variants->get_variants(array('product_id'=>array_keys($related_products), 'in_stock'=>1));
			foreach($related_products_variants as $related_product_variant)
			{
				if(isset($related_products[$related_product_variant->product_id]))
				{
					$related_products[$related_product_variant->product_id]->variants[] = $related_product_variant;
					/*size_color*/
                    $cur_product = $related_products[$related_product_variant->product_id];
                    if (!isset($cur_product->size_color)) {
                        $cur_product->size_color = array();
                    }
                    if (!empty($related_product_variant->name)) {
                        if(empty($cur_product->size_color[$related_product_variant->name."__".$cur_product->id])) {
                            $cur_product->size_color[$related_product_variant->name."__".$cur_product->id] = array();
                        }
                        $cur_product->size_color[$related_product_variant->name."__".$cur_product->id][] = $related_product_variant;
                    }
                    /*/size_color*/
				}
			}
			foreach($related_products as $id=>$r)
			{
				if(is_object($r))
				{
					$r->image = &$r->images[0];
					$r->variant = &$r->variants[0];
				}
				else
				{
					unset($related_products[$id]);
				}
			}
			$this->design->assign('related_products', $related_products);
		}



		// Соседние товары
		$this->design->assign('next_product', $this->products->get_next_product($product->id));
		$this->design->assign('prev_product', $this->products->get_prev_product($product->id));

		// И передаем его в шаблон
		$this->design->assign('product', $product);
		
		// Категория и бренд товара
		$this->design->assign('brand', $this->brands->get_brand(intval($product->brand_id)));		
		$this->design->assign('category', reset($product->categories));		
		

		// Добавление в историю просмотров товаров
		$max_visited_products = 100; // Максимальное число хранимых товаров в истории
		$expire = time()+60*60*24*30; // Время жизни - 30 дней
		if(!empty($_COOKIE['browsed_products']))
		{
			$browsed_products = explode(',', $_COOKIE['browsed_products']);
			// Удалим текущий товар, если он был
			if(($exists = array_search($product->id, $browsed_products)) !== false)
				unset($browsed_products[$exists]);
		}
		// Добавим текущий товар
		$browsed_products[] = $product->id;
		$cookie_val = implode(',', array_slice($browsed_products, -$max_visited_products, $max_visited_products));
		setcookie("browsed_products", $cookie_val, $expire, "/");
		
		$this->design->assign('meta_title', $product->meta_title);
		$this->design->assign('meta_keywords', $product->meta_keywords);
		$this->design->assign('meta_description', $product->meta_description);
		
		return $this->design->fetch('product.tpl');
	}
}
