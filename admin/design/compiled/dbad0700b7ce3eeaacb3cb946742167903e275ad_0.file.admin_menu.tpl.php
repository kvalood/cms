<?php /* Smarty version 3.1.24, created on 2016-06-08 03:30:37
         compiled from "admin/design/html/admin_menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10923575704bde92f55_53899778%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dbad0700b7ce3eeaacb3cb946742167903e275ad' => 
    array (
      0 => 'admin/design/html/admin_menu.tpl',
      1 => 1465320636,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10923575704bde92f55_53899778',
  'variables' => 
  array (
    'module' => 0,
    'new_orders_counter' => 0,
    'new_comments_counter' => 0,
    'new_feedback_counter' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575704bdef2d12_37928321',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575704bdef2d12_37928321')) {
function content_575704bdef2d12_37928321 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '10923575704bde92f55_53899778';
?>
<ul class="list_menu">
    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'products' || $_smarty_tpl->tpl_vars['module']->value == 'categories' || $_smarty_tpl->tpl_vars['module']->value == 'brands' || $_smarty_tpl->tpl_vars['module']->value == 'features') {?> active<?php }?>">
        <div class="menu-item__title">Каталог товаров</div>
        <ul>           
            <li><a href="index.php?module=ProductsAdmin">Товары</a></li>
            <li><a href="index.php?module=FeaturesAdmin">Свойства товаров</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CategoriesAdmin">Категории товаров</a></li>        
            <li><a href="index.php?module=BrandsAdmin">Бренды</a></li>        

        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'orders' || $_smarty_tpl->tpl_vars['module']->value == 'labels') {?> active<?php }?>">
        <div class="menu-item__title">Заказы<?php if ($_smarty_tpl->tpl_vars['new_orders_counter']->value) {?><span class="new_orders"><?php echo $_smarty_tpl->tpl_vars['new_orders_counter']->value;?>
</span><?php }?></div>
        <ul>
            <li><a href="index.php?module=OrdersAdmin">Новые заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=1">Принятые заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=2">Выполненные заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=3">Удаленные заказы</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=OrdersLabelsAdmin">Метки заказов</a></li>
        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'article' || $_smarty_tpl->tpl_vars['module']->value == 'articlecat' || $_smarty_tpl->tpl_vars['module']->value == 'slides' || $_smarty_tpl->tpl_vars['module']->value == 'tags') {?> active<?php }?>">
        <div class="menu-item__title">Материалы</div>
        <ul>
            <li><a href="index.php?module=ArticleAdmin">Создать страницу</a></li>
            <li><a href="index.php?module=ArticleAdmin">Список страниц</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=ArticleCategoryAdmin">Создать категорию</a></li>
            <li><a href="index.php?module=ArticleCategoryAdmin">Список категорий</a></li>

        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'menu') {?> active<?php }?>">
        <div class="menu-item__title">Модули</div>
        <ul>
            <li><a href="index.php?module=MenuAdmin">Меню сайта</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=SliderAdmin">Слайдеры</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CommentsAdmin">Комментарии <?php if ($_smarty_tpl->tpl_vars['new_comments_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_comments_counter']->value;?>
</i><?php }?></a></li>
            <li><a href="index.php?module=FeedbackAdmin">Обратная связь <?php if ($_smarty_tpl->tpl_vars['new_feedback_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_feedback_counter']->value;?>
</i><?php }?></a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=ImportAdmin">Импорт товаров *.csv</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ExportAdmin'),$_smarty_tpl);?>
">Экспорт товаров</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'BackupAdmin'),$_smarty_tpl);?>
">Бекап товаров</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CouponsAdmin">Промо-коды</a></li>
        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'stats') {?> active<?php }?>">
        <div class="menu-item__title">Статистика</div>
        <ul>
            <li><a href="index.php?module=ReportStatsAdmin">Отчет по заказам</a></li>
            <li><a href="index.php?module=StatsAdmin">Статистика</a></li>
        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'groups' || $_smarty_tpl->tpl_vars['module']->value == 'users') {?> active<?php }?>">
        <div class="menu-item__title">Пользователи</div>
        <ul>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'UsersAdmin'),$_smarty_tpl);?>
">Пользователи</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'GroupsAdmin'),$_smarty_tpl);?>
">Группы покупателей</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ExportUsersAdmin'),$_smarty_tpl);?>
">Экспорт пользователей</a></li>
        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'settings' || $_smarty_tpl->tpl_vars['module']->value == 'design' || $_smarty_tpl->tpl_vars['module']->value == 'currency' || $_smarty_tpl->tpl_vars['module']->value == 'delivery' || $_smarty_tpl->tpl_vars['module']->value == 'payment' || $_smarty_tpl->tpl_vars['module']->value == 'managers') {?> active<?php }?>">
        <div class="menu-item__title">Настройки сайта</div>

        <ul>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'SettingsAdmin'),$_smarty_tpl);?>
">Общие настройки</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ThemeAdmin'),$_smarty_tpl);?>
">Дизайн</a></li>
            <li class="separator"></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CurrencyAdmin'),$_smarty_tpl);?>
">Валюты сайта</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'DeliveriesAdmin'),$_smarty_tpl);?>
">Способы доставки</a></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'PaymentMethodsAdmin'),$_smarty_tpl);?>
">Способы оплаты</a></li>
            <li class="separator"></li>
            <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ManagersAdmin'),$_smarty_tpl);?>
">Менеджеры</a></li>
        </ul>
    </li>
</ul><?php }
}
?>