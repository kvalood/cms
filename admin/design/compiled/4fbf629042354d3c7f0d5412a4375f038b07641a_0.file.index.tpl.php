<?php /* Smarty version 3.1.24, created on 2016-01-25 01:16:59
         compiled from "admin/design/html/index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3238356a4eaeb7dc7a4_70732078%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fbf629042354d3c7f0d5412a4375f038b07641a' => 
    array (
      0 => 'admin/design/html/index.tpl',
      1 => 1451730969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3238356a4eaeb7dc7a4_70732078',
  'variables' => 
  array (
    'meta_title' => 0,
    'new_orders_counter' => 0,
    'new_feedback_counter' => 0,
    'manager' => 0,
    'config' => 0,
    'module' => 0,
    'menu' => 0,
    'm' => 0,
    'new_comments_counter' => 0,
    'content' => 0,
    'settings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_56a4eaeba7c373_53827031',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56a4eaeba7c373_53827031')) {
function content_56a4eaeba7c373_53827031 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3238356a4eaeb7dc7a4_70732078';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
</title>
<link rel="icon" href="design/images/favicon.png" type="image/x-icon">
<link href="design/css/style.css" rel="stylesheet" type="text/css" />

<?php echo '<script'; ?>
 src="design/js/jquery/jquery.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="design/js/jquery/jquery.form.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="design/js/jquery/jquery-ui.min.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 src="/js/modal_message.js"><?php echo '</script'; ?>
>
<link href="/js/default.css" rel="stylesheet" type="text/css" media="screen"/>
<link rel="stylesheet" type="text/css" href="design/js/jquery/jquery-ui.css" media="screen" />


<?php echo '<script'; ?>
 src="design/js/jquery.mobile.custom.min.js"><?php echo '</script'; ?>
>


<?php echo '<script'; ?>
 src="design/js/core.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="/js/jquery.cookie.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['new_orders_counter']->value || $_smarty_tpl->tpl_vars['new_feedback_counter']->value) {?>

<?php echo '<script'; ?>
 type="text/javascript">
var new_orders_counter = parseInt('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['new_orders_counter']->value, ENT_QUOTES, 'UTF-8', true);?>
'), new_feedback_counter = parseInt('<?php echo $_smarty_tpl->tpl_vars['new_feedback_counter']->value;?>
');
var prefix_orders = String('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['new_orders_counter']->value,"новый заказ","новых заказов","новых заказа");?>
');
var prefix_feedback = String('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['new_feedback_counter']->value,"новое сообщение","новых сообщений","новых сообщения");?>
');

$(function(){
	//Выводим уведомление о заказах и сообщениях в "обратной связи"
	$(document).ready(function(){
		if (!$.cookie('admin_new_message')) {
			if(new_orders_counter > 0) {
				show_modal_message('У вас '+new_orders_counter+' '+prefix_orders+'<br/><a href="index.php?module=OrdersAdmin">Перейти к заказам</a>','black',9000,'bottom-right');
			}
			if(new_feedback_counter > 0) {
				show_modal_message(new_feedback_counter+' '+prefix_feedback+' обратной связи <a href="index.php?module=FeedbackAdmin">Посмотреть сообщения</a>','message',9000,'bottom-right');
			}
			// Запомним в куках, что сообщения вылазили
			$.cookie('admin_new_message', true, {
				expires: 1/288,  
				path: '/'  
			}); 
		}
	});
});

<?php echo '</script'; ?>
>

<?php }?>


<?php echo '<script'; ?>
>
$(function() {
	$(document).on('click', '.menu_id', function(){
		var tag = $(this).closest('li');
		if(!tag.hasClass('act'))
		{
			tag.closest('ul').find('li.act').removeClass('act');
			tag.addClass('act');
			//return false;
			//tag.removeClass('act');
		}
	});
});

<?php echo '</script'; ?>
>

</head>
<body>

	<div class="page">
		<header>

            <div class="menu_mobile"></div>

            <?php if (in_array('orders',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
			<a href="index.php?module=OrdersAdmin" class="header_link">Новых заказов <span><?php echo $_smarty_tpl->tpl_vars['new_orders_counter']->value;?>
</span></a>
            <?php }?>

            <?php if (in_array('feedback',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
			<a href="index.php?module=FeedbackAdmin" class="header_link">Обратная связь <span><?php echo $_smarty_tpl->tpl_vars['new_feedback_counter']->value;?>
</span></a>
            <?php }?>
		
			<div class="user_profile">
				<a href="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
" id="go_home" target="_blank">На главную</a>
				<a href='<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
?logout' id="logout">Выход</a>
				<b><?php echo $_smarty_tpl->tpl_vars['manager']->value->login;?>
</b>				
				<i></i>
			</div>
		</header>
		
		
		<div class="content_box">
			<div class="root_menu">
				<ul class="list_li">
					<?php if (in_array('products',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('categories',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('brands',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('features',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'products' || $_smarty_tpl->tpl_vars['module']->value == 'categories' || $_smarty_tpl->tpl_vars['module']->value == 'brands' || $_smarty_tpl->tpl_vars['module']->value == 'features') {?> class="act"<?php }?>>
						<div class="menu_id catalog"><i></i><b>Каталог</b></div>
						<ul class="hidden">
						<?php if (in_array('products',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=ProductsAdmin">Товары</a></li>
						<?php }?>
						<?php if (in_array('categories',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="index.php?module=CategoriesAdmin">Категории товаров</a></li>
						<?php }?>
						<?php if (in_array('brands',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=BrandsAdmin">Бренды</a></li>
						<?php }?>
						<?php if (in_array('features',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="index.php?module=FeaturesAdmin">Свойства товаров</a></li>
						<?php }?>
							
						</ul>
					</li>
					<?php }?>
					
					<?php if (in_array('orders',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('labels',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'orders' || $_smarty_tpl->tpl_vars['module']->value == 'labels') {?> class="act"<?php }?>>
						<div class="menu_id order"><i></i><b>Заказы<?php if ($_smarty_tpl->tpl_vars['new_orders_counter']->value) {?><span class="new_orders"><?php echo $_smarty_tpl->tpl_vars['new_orders_counter']->value;?>
</span><?php }?></b></div>
						<ul class="hidden">
						<?php if (in_array('orders',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=OrdersAdmin">Новые заказы</a></li>
							<li><a href="index.php?module=OrdersAdmin&status=1">Принятые заказы</a></li>
							<li><a href="index.php?module=OrdersAdmin&status=2">Выполненные заказы</a></li>
							<li><a href="index.php?module=OrdersAdmin&status=3">Удаленные заказы</a></li>
						<?php }?>
						<?php if (in_array('labels',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="index.php?module=OrdersLabelsAdmin">Метки заказов</a></li>
						<?php }?>				
						</ul>
					</li>
					<?php }?>
					
					<?php if (in_array('article',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('articlecat',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('slides',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('tags',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'article' || $_smarty_tpl->tpl_vars['module']->value == 'articlecat' || $_smarty_tpl->tpl_vars['module']->value == 'slides' || $_smarty_tpl->tpl_vars['module']->value == 'tags') {?> class="act"<?php }?>><div class="menu_id articles"><i></i><b>Контент</b></div>
						<ul class="hidden">
						<?php if (in_array('article',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=ArticleAdmin">Материалы</a></li>
						<?php }?>
						<?php if (in_array('articlecat',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=ArticleCategoryAdmin">Категории материалов</a></li>
						<?php }?>
						<?php if (in_array('tags',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=TagsAdmin">Метки</a></li>
						<?php }?>
					
						<?php if (in_array('slides',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=SlidesAdmin">Слайдер</a></li>
						<?php }?>			
						</ul>
					</li>
					<?php }?>
					
					
					<?php if (in_array('menu',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'menu') {?> class="act"<?php }?>><a href="index.php?module=MenuAdmin" class="menu_id menu"><i></i><b>Меню сайта</b></a>
						<?php if ($_smarty_tpl->tpl_vars['menu']->value) {?>
						<ul class="hidden">
							<li><a href="index.php?module=MenuAdmin&method=create_menu">Создать новое меню</a></li>
							<?php
$_from = $_smarty_tpl->tpl_vars['menu']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['m']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
$foreach_m_Sav = $_smarty_tpl->tpl_vars['m'];
?>
							<li class="separator"><a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></li>
							<?php
$_smarty_tpl->tpl_vars['m'] = $foreach_m_Sav;
}
?>
						</ul>
						<?php }?>		
					</li>
					<?php }?>
					
					
					<?php if (in_array('feedback',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('comments',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'comments' || $_smarty_tpl->tpl_vars['module']->value == 'feedback') {?> class="act"<?php }?>><div class="menu_id feedback"><i></i><b>Обратная связь</b></div>
						<ul class="hidden">
						<?php if (in_array('comments',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=CommentsAdmin">Комментарии <?php if ($_smarty_tpl->tpl_vars['new_comments_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_comments_counter']->value;?>
</i><?php }?></a></li>
						<?php }?>
						<?php if (in_array('feedback',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="index.php?module=FeedbackAdmin">Обратная связь <?php if ($_smarty_tpl->tpl_vars['new_feedback_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_feedback_counter']->value;?>
</i><?php }?></a></li>
						<?php }?>
						</ul>
					</li>
					<?php }?>

					<?php if (in_array('import',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('export',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('backup',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'import' || $_smarty_tpl->tpl_vars['module']->value == 'export' || $_smarty_tpl->tpl_vars['module']->value == 'backup') {?> class="act"<?php }?>><div class="menu_id import"><i></i><b>Автоматизация</b></div>
						<ul class="hidden">
						<?php if (in_array('import',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ImportAdmin'),$_smarty_tpl);?>
">Импорт товаров *.csv</a></li>
						<?php }?>
						<?php if (in_array('export',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ExportAdmin'),$_smarty_tpl);?>
">Экспорт товаров</a></li>
						<?php }?>
						<?php if (in_array('backup',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'BackupAdmin'),$_smarty_tpl);?>
">Бекап товаров</a></li>
						<?php }?>
						</ul>
					</li>
					<?php }?>
					
					<?php if (in_array('coupons',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
						<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'coupons') {?> class="act"<?php }?>><a href="index.php?module=CouponsAdmin" class="menu_id coupon"><i></i><b>Промо-коды</b></a></li>
					<?php }?>
					
					<?php if (in_array('stats',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
						<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'stats') {?> class="act"<?php }?>><a href="index.php?module=StatsAdmin" class="menu_id stats"><i></i><b>Статистика</b></a>
							<ul class="hidden">
								<li><a href="index.php?module=ReportStatsAdmin">Отчет по заказам</a></li>
							</ul>
						</li>
					<?php }?>
					
					<?php if (in_array('users',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('groups',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'groups' || $_smarty_tpl->tpl_vars['module']->value == 'users') {?> class="act"<?php }?>>
						<?php if (in_array('users',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'UsersAdmin'),$_smarty_tpl);?>
" class="menu_id users"><i></i><b>Пользователи</b></a>
						<?php } else { ?>
							<div class="menu_id users"><i></i>Покупатели</div>
						<?php }?>
						<?php if (in_array('groups',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
						<ul class="hidden">
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'GroupsAdmin'),$_smarty_tpl);?>
">Группы покупателей</a></li>
                            <li class="separator"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ExportUsersAdmin'),$_smarty_tpl);?>
">Экспорт пользователей</a></li>
						</ul>
						<?php }?>
					</li>
					<?php }?>
					
					<?php if (in_array('settings',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('design',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('currency',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('delivery',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('payment',$_smarty_tpl->tpl_vars['manager']->value->permissions) || in_array('managers',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
					<li<?php if ($_smarty_tpl->tpl_vars['module']->value == 'settings' || $_smarty_tpl->tpl_vars['module']->value == 'design' || $_smarty_tpl->tpl_vars['module']->value == 'currency' || $_smarty_tpl->tpl_vars['module']->value == 'delivery' || $_smarty_tpl->tpl_vars['module']->value == 'payment' || $_smarty_tpl->tpl_vars['module']->value == 'managers') {?> class="act"<?php }?>>
						<?php if (in_array('settings',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<a href="index.php?module=SettingsAdmin" class="menu_id settings"><i></i><b>Настройки</b></a>
						<?php } else { ?>
							<div class="menu_id settings"><i></i><b>Настройки</b></div>
						<?php }?>		
						
						<ul class="hidden">
						<?php if (in_array('design',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ThemeAdmin'),$_smarty_tpl);?>
">Дизайн</a></li>
						<?php }?>
						<?php if (in_array('currency',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CurrencyAdmin'),$_smarty_tpl);?>
">Валюты сайта</a></li>
						<?php }?>
						<?php if (in_array('delivery',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'DeliveriesAdmin'),$_smarty_tpl);?>
">Способы доставки</a></li>
						<?php }?>
						<?php if (in_array('payment',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'PaymentMethodsAdmin'),$_smarty_tpl);?>
">Способы оплаты</a></li>
						<?php }?>
						<?php if (in_array('managers',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?>
							<li class="separator"><a href="index.php?module=ManagersAdmin">Менеджеры</a></li>
						<?php }?>
						</ul>			
					</li>
					<?php }?>
				</ul>
				
				<?php if (!empty(Smarty::$_smarty_vars['capture']['option'])) {?>
				<div class="capture">
					<?php echo Smarty::$_smarty_vars['capture']['option'];?>

				</div>
				<?php }?>
				
				
			</div>
			
			<div class="content">
				<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

			</div>
		</div>
	</div>

	<div id="footer">
		&copy; 2015 <a href="http://pulse-studio.ru" target="_blank">Sergey Sysa.</a> Core Simpla <?php echo $_smarty_tpl->tpl_vars['config']->value->version;?>
 (mod. <?php echo $_smarty_tpl->tpl_vars['config']->value->mod_version;?>
)
	</div>

</body>
</html>


<?php if ($_smarty_tpl->tpl_vars['settings']->value->pz_server && $_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login]) {?>
<?php echo '<script'; ?>
 src="design/js/prostiezvonki/prostiezvonki.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var pz_type = 'simpla';
var pz_password = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_password;?>
';
var pz_server = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_server;?>
';
var pz_phone = '<?php echo $_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login];?>
';

function NotificationBar(message)
{
	ttop = $('body').height()-110;
	var HTMLmessage = "<div class='notification-message' style='  text-align:center; line-height: 40px;'> " + message + " </div>";
	if ($('#notification-bar').size() == 0)
	{
		$('body').prepend("<div id='notification-bar' style='-moz-border-radius: 5px 5px 5px 5px; -webkit-border-radius: 5px 5px 5px 5px; display:none;  height: 40px; padding: 20px; background-color: #fff; position: fixed; top:"+ttop+"px; right:30px; z-index: 100; color: #000;border: 1px solid #cccccc;'>" + HTMLmessage + "</div>");
	}
	else
    {
    	$('#notification-bar').html(HTMLmessage);
    }
    $('#notification-bar').slideDown();
}

$(window).on("blur focus", function (e) {
    if ($(this).data('prevType') !== e.type) {
        $(this).data('prevType', e.type);

        switch (e.type) {
        case 'focus':
            if (!pz.isConnected()) {
				pz.connect({
				            client_id: pz_password,
				            client_type: pz_type,
				            host: pz_server
				});
            }
            break;
        }
    }
});

$(function() {
	// Простые звонки
	pz.setUserPhone(pz_phone);
	pz.connect({
                client_id: pz_password,
                client_type: pz_type,
                host: pz_server
	});
    pz.onConnect(function () {
        $(".ip_call").addClass('phone');
    });
    pz.onDisconnect(function () {
        $(".ip_call").removeClass('phone');
    });
	
    $(".ip_call").click( function() {
        var phone = $(this).attr('data-phone').trim();
        pz.call(phone);
        return false;
    });

    pz.onEvent(function (event) {
        if (event.isIncoming()) {
			$.ajax({
				type: "GET",
				url: "ajax/search_orders.php",
				data: { keyword: event.from, limit:"1"},
				dataType: 'json'
			}).success(function(data){
				if(event.to == pz_phone)
				if(data.length>0)
				{
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонит <a href="index.php?module=OrderAdmin&id='+data[0].id+'">'+data[0].name+'</a>');
				}
				else
				{
					NotificationBar('<img src="design/images/phone_sound.png" align=absmiddle> Звонок с '+event.from+'. <a href="index.php?module=OrderAdmin&phone='+event.from+'">Создать заказ</a>');
				}
			});        	     
        }
    });

});
<?php echo '</script'; ?>
>
<?php }
}
}
?>