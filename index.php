<?php
// Засекаем время

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_errors','On');


$time_start = microtime(true);

session_start();

require_once('view/IndexView.php');

$view = new IndexView();

/*
//Текущая ерундя для роутинга.
Если она не включена, значит надо исспользовать .htaccess.
Так-как все это не протестировано, пока не работает.

	$url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'];
	
	if ( strpos($url, '?') ) {
		$url = substr($url, 0, strpos($url, '?'));
	}
	if ( preg_match( '/catalog\/([^\/]+)\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
		$_GET['category'] 	= $matches[1];
		$_GET['brand'] 	= $matches[2];
	}
	else
	if ($url == '/') {
		$_GET['module'] 	= 'MenuView';
	}
	else
	if ( preg_match( '/catalog\/(.+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
		$_GET['category'] 	= $matches[1];
	}
	else
	if ( preg_match( '/products\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	 = 'ProductView';
		$_GET['product_url'] = $matches[1];
	}
	else
	if ( preg_match( '/goods\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	 = 'ProductView';
		$_GET['product_url'] = $matches[1];
	}
	else
	if ( preg_match( '/brands\/([^\/]+)\/page_([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
		$_GET['brand'] 		= $matches[1];
		$_GET['page'] 		= $matches[2];
	}
	else
	if ( preg_match( '/brands\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
		$_GET['brand'] 		= $matches[1];
	}
	else
	if ( preg_match( '/blog\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'BlogView';
		$_GET['url'] 		= $matches[1];
	}
	else
	if ( preg_match( '/blog\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'BlogView'; 
	}
	else
	if ( preg_match( '/news\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'BlogView';
		$_GET['url'] 		= $matches[1];
	}
	else
	if ( preg_match( '/news\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'BlogView';
	}
	else
	if ( preg_match( '/order\/([^\/]+)\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'OrderView';
		$_GET['url'] 		= $matches[1];
		$_GET['file'] 		= $matches[2];
	}
	else
	if ( preg_match( '/order\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'OrderView';
		$_GET['url'] 		= $matches[1];
	}
	else
	if ( preg_match( '/order\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'OrderView';
	}
	else
	if ( preg_match( '/cart\/remove\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 		= 'CartView';
		$_GET['delete_variant'] = $matches[1];
	}
	else
	if ( preg_match( '/cart\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'CartView';
		$_GET['add_variant']= $matches[1];
	}
	else
	if ( preg_match( '/cart\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'CartView';
	}
	else
	if ( preg_match( '/search\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
		$_GET['keyword']	= $matches[1];
	}
	else
	if ( preg_match( '/contact\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'FeedbackView';
	}
	else
	if ( preg_match( '/user\/register\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'RegisterView';
	}
	else
	if ( preg_match( '/user\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'UserView';
	}
	else
	if ( preg_match( '/user\/login\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'LoginView';
	}
	else
	if ( preg_match( '/user\/logout\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'LoginView';
		$_GET['action']		= 'logout';
	}
	else
	if ( preg_match( '/user\/password_remind\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'LoginView';
		$_GET['action']		= 'password_remind';
	}
	else
	if ( preg_match( '/user\/password_remind\/([^\/]+)\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'LoginView';
		$_GET['action']		= 'password_remind';
		$_GET['code']		= $matches[1];
	}
	else
	if ( preg_match( '/search\/?$/', $url, $matches) || preg_match( '/products\/?$/', $url, $matches) ) {
		$_GET['module'] 	= 'ProductsView';
	}
	else{
		preg_match( '/([^\/]+)\/([^\/]+)\/?$/', $url, $matches);
		$_GET['module'] 	= 'MenuView';
		$_GET['r_1'] 	= $matches[1];
		$_GET['r_2'] 	= $matches[2];
	}
*/

if(isset($_GET['logout']))
{
    header('WWW-Authenticate: Basic realm="Login"');
    header('HTTP/1.0 401 Unauthorized');
	unset($_SESSION['admin']);
}

// Если все хорошо
if(($res = $view->fetch()) !== false)
{
	// Выводим результат
	header("Content-type: text/html; charset=UTF-8");	
	print $res;

	// Сохраняем последнюю просмотренную страницу в переменной $_SESSION['last_visited_page']
	if(empty($_SESSION['last_visited_page']) || empty($_SESSION['current_page']) || $_SERVER['REQUEST_URI'] !== $_SESSION['current_page'])
	{
		if(!empty($_SESSION['current_page']) && !empty($_SESSION['last_visited_page']) && $_SESSION['last_visited_page'] !== $_SESSION['current_page'])
			$_SESSION['last_visited_page'] = $_SESSION['current_page'];
		$_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
	}		
}
else 
{ 
	// Иначе страница об ошибке
	header("http/1.0 404 not found");
	// Подменим переменную GET, чтобы вывести страницу 404
	$_GET['r_1'] = '404';
	$_GET['module'] = 'MenuView';		
	print $view->fetch();	
}

// Отладочная информация
if(1)
{
	print "<!--\r\n";
	$time_end = microtime(true);
	$exec_time = $time_end-$time_start;
  
  	if(function_exists('memory_get_peak_usage'))
		print "memory peak usage: ".memory_get_peak_usage()." bytes\r\n";  
	print "page generation time: ".$exec_time." seconds\r\n";  
	print "-->";
}
