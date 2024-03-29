<?php

/**
 * Simpla CMS
 *
 * @copyright	2017 Denis Pikusov
 * @link		http://simplacms.ru
 * @author		Denis Pikusov
 *
 */


require_once('View.php');

class IndexView extends View
{
    public $modules_dir = 'view/';

    public function __construct()
    {
        parent::__construct();
    }


    public function fetch()
    {
        // Содержимое корзины
        $this->design->assign('cart', $this->cart->get_cart());

        // Категории товаров
        $this->design->assign('categories', $this->categories->get_categories_tree());

        // Текущий дизайн сайта
        $this->design->assign('THEME', 'design/' . $this->settings->theme . '/');

		//Отображение товаров. Блоками или списком.
		if(!isset($_SESSION['model_type']))
		{
			if($this->settings->model_type)
				$_SESSION['model_type'] = $this->settings->model_type;
			else
				$_SESSION['model_type'] = 'box';
		}
		$this->design->assign('model_type', $_SESSION['model_type']);


        //Отдаем урл адреса, для меню
        $url = isset($_SERVER['REDIRECT_URL']) ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'];
        $url = array_filter(explode('/', $url));
			
		if($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '/index.php')
			$url = null;

        if(isset($url[1]))
            $this->design->assign('r_1', $url[1]);

        if(isset($url[2]))
            $this->design->assign('r_2', $url[2]);
		
		// Отдаем для проверки главную страницу
        $this->design->assign('is_home', (!empty($url) ? 0 : 1));


		// Текущий модуль (для отображения центрального блока) + Передаем название модуля в шаблон, это может пригодиться
        $module = $this->request->get('module', 'string');
        $module = preg_replace("/[^A-Za-z0-9]+/", "", $module);
        $this->design->assign('module', $module);


        // Если не задан - берем из настроек
        if (empty($module)) {
            return false;
        }
        //$module = $this->settings->main_module;

        // Создаем соответствующий класс
        if (is_file($this->modules_dir."$module.php")) {
            include_once($this->modules_dir."$module.php");
            if (class_exists($module)) {
                $view = new $module($this);
            } else {
                return false;
            }
        } else {
            return false;
        }

        // Создаем основной блок страницы
        if (!$content = $view->fetch()) {
            return false;
        }

        // Передаем основной блок в шаблон
        $this->design->assign('content', $content);

        // Передаем название модуля в шаблон, это может пригодиться
        $this->design->assign('module', $module);

        // Создаем текущую обертку сайта (обычно index.tpl)
        $wrapper = $this->design->get_var('wrapper');
        if (is_null($wrapper)) {
            $wrapper = 'index.tpl';
        }

        if (!empty($wrapper) AND !$this->request->ajax()) {
            return $this->design->fetch($wrapper);
        } else {
            return trim($content);
        }
    }
}
