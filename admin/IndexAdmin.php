<?PHP


require_once('api/Simpla.php');

// Этот класс выбирает модуль в зависимости от параметра Section и выводит его на экран
class IndexAdmin extends Simpla
{
	// Соответсвие модулей и названий соответствующих прав
	private $modules_permissions = [
		'ProductsAdmin'       => 'products',
		'ProductAdmin'        => 'products',
		'CategoriesAdmin'     => 'categories',
		'CategoryAdmin'       => 'categories',
		'BrandsAdmin'         => 'brands',
		'BrandAdmin'          => 'brands',
		'FeaturesAdmin'       => 'features',
		'FeatureAdmin'        => 'features',
		'OrdersAdmin'         => 'orders',
		'OrderAdmin'          => 'orders',
		'OrdersLabelsAdmin'   => 'labels',
		'OrdersLabelAdmin'    => 'labels',
		'UsersAdmin'          => 'users',
		'UserAdmin'           => 'users',
		'ExportUsersAdmin'    => 'users',
		'GroupsAdmin'         => 'groups',
		'GroupAdmin'          => 'groups',
		'CouponsAdmin'        => 'coupons',
		'CouponAdmin'         => 'coupons',
		'CommentsAdmin'       => 'comments',
		'FeedbackAdmin'       => 'feedback',
		'ImportAdmin'         => 'import',
		'ExportAdmin'         => 'export',
		'BackupAdmin'         => 'backup',
		'ThemeAdmin'          => 'design',
		'StylesAdmin'         => 'design',
		'TemplatesAdmin'      => 'design',
		'ImagesAdmin'         => 'design',
		'SettingsAdmin'       => 'settings',
		'CurrencyAdmin'       => 'currency',
		'DeliveriesAdmin'     => 'delivery',
		'DeliveryAdmin'       => 'delivery',
		'PaymentMethodAdmin'  => 'payment',
		'PaymentMethodsAdmin' => 'payment',
		'ManagersAdmin'       => 'managers',
		'ManagerAdmin'        => 'managers',

		'StatsAdmin'          => 'stats',
		'ReportStatsAdmin'    => 'stats',
		'ReportStatsProdAdmin'=> 'stats',
		
		'SlideAdmin'	      => 'slides',
		'SlidesAdmin'	      => 'slides',
		
		'ArticleAdmin'        => 'article',
		'ArticleEdit'	  	  => 'article',
		'ArticleCategoryAdmin'=> 'articlecat',
		'MenuAdmin'           => 'menu',
		'TagsAdmin'			  => 'tags'
	];

	// Конструктор
	public function __construct()
	{
	    // Вызываем конструктор базового класса
		parent::__construct();
		
		$this->design->set_templates_dir('admin/design/html');
		$this->design->set_compiled_dir('admin/design/compiled');
		
		$this->design->assign('settings', $this->settings);
		$this->design->assign('config',	$this->config);
		
		// Администратор
		$this->manager = $this->managers->get_manager();
		$this->design->assign('manager', $this->manager);
		
        // Запоминаем администратора, для фронтенда
        $_SESSION['admin_login'] = $this->manager->login;

 		// Берем название модуля из get-запроса
		$module = $this->request->get('module', 'string');
		$module = preg_replace("/[^A-Za-z0-9]+/", "", $module);
		
		// Если не запросили модуль - используем модуль первый из разрешенных
		if(empty($module) || !is_file('admin/'.$module.'.php'))
		{
			foreach($this->modules_permissions as $m=>$p)
			{
				if($this->managers->access($p))
				{
					$module = $m;
					break;
				}
			}
		}
		
		if(empty($module))
			$module = 'ProductsAdmin';
		
		//Отдадим название модуля в шаблон
		if(!empty($this->modules_permissions[$module]))
		{
			$this->design->assign("module", $this->modules_permissions[$module]);
		}
			
		// Подключаем файл с необходимым модулем
		require_once('admin/'.$module.'.php');  
		
		// Создаем соответствующий модуль
		if(class_exists($module))
			$this->module = new $module();
		else
			die("Error creating $module class");

	}

	function fetch()
	{
		$currency = $this->money->get_currency();
		$this->design->assign("currency", $currency);
		
		// Проверка прав доступа к модулю
        /*
		if(isset($this->modules_permissions[get_class($this->module)])
		&& $this->managers->access($this->modules_permissions[get_class($this->module)]))
		{
			$content = $this->module->fetch();
			$this->design->assign("content", $content);
		}
		else
		{
			$this->design->assign("content", "Доступ запрещен");
		}
        */
        $content = $this->module->fetch();
        $this->design->assign("content", $content);

        $this->design->assign("lang", $this->lang);

		// Отдаем созданные меню для быстрого управления
		$menu = $this->menu->list_cat_menu();
		$this->design->assign('menu', $menu);
				
		// Счетчики для верхнего меню
		$new_orders_counter = $this->orders->count_orders(['status' => 0]);
		$this->design->assign("new_orders_counter", $new_orders_counter);
		
		// Создаем текущую обертку сайта (обычно index.tpl)
		$wrapper = $this->design->smarty->getTemplateVars('wrapper');
		if(is_null($wrapper))
			$wrapper = 'index.tpl';
			
		if(!empty($wrapper))
			return $this->body = $this->design->fetch($wrapper);
		else
			return $this->body = $content;
	}
}