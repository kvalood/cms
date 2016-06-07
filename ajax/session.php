<?php
	//Скрипт установки сессии показа товаров в категории. 2 варианта, списком и кубиками.
	session_start();
	require_once('../api/Simpla.php');
	$simpla = new Simpla();
	
	switch($simpla->request->post('model_type', 'string')){
		case 'box':
			$_SESSION['model_type'] = 'box';
		break;
		
		case 'list':
			$_SESSION['model_type'] = 'list';
		break;
	}