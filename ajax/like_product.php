<?php
	session_start();
	require_once('../api/Simpla.php');
	$simpla = new Simpla();
	
	$product_id = $simpla->request->get('product_id', 'integer');

	if($product_id)
	{
		$product = new StdClass();
		$product = $simpla->products->get_product(intval($product_id));

		//Проверяем, наличие лайка от пользователя по текущему товару
		if(in_array($product_id, (array) $_SESSION['like_product']))
		{
			echo 'done'; // Уже голосовали за этот товар.
		} 
		else
		{
            $new_product = new StdClass;
            $new_product->likes = ++$product->likes;

			$simpla->products->update_product((int)$product_id, $new_product);
			$_SESSION['like_product'][$product_id] = $product_id;
            echo $new_product->likes;
		}
	}