<?php
/* Smarty version 3.1.32, created on 2018-07-10 22:10:35
  from 'C:\SERVER\domains\cms\simpla\design\html\admin_menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44a23b414753_12586975',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4abc32fa440afe7c16db7806e8d44ddad93f46e7' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\admin_menu.tpl',
      1 => 1502712669,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b44a23b414753_12586975 (Smarty_Internal_Template $_smarty_tpl) {
?><ul class="list_menu">
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
        <div class="menu-item__title">Заказы</div>
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
        <div class="menu-item__title">Страницы</div>
        <ul>
            <li><a href="index.php?module=ArticleAdmin">Создать страницу</a></li>
            <li><a href="index.php?module=ArticleAdmin">Список страниц</a></li>
            <li class="separator"></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ArticleAdmin','method'=>'category'),$_smarty_tpl ) );?>
">Создать категорию</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ArticleAdmin','method'=>'categories'),$_smarty_tpl ) );?>
">Список категорий</a></li>

        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'menu') {?> active<?php }?>">
        <div class="menu-item__title">Модули</div>
        <ul>
            <li><a href="index.php?module=MenuAdmin">Меню сайта</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=BannerAdmin">Баннеры/Слайдеры</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CommentsAdmin">Комментарии <?php if ($_smarty_tpl->tpl_vars['new_comments_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_comments_counter']->value;?>
</i><?php }?></a></li>
            <li><a href="index.php?module=FeedbackAdmin">Обратная связь <?php if ($_smarty_tpl->tpl_vars['new_feedback_counter']->value) {?><i><?php echo $_smarty_tpl->tpl_vars['new_feedback_counter']->value;?>
</i><?php }?></a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=ImportAdmin">Импорт товаров *.csv</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ExportAdmin'),$_smarty_tpl ) );?>
">Экспорт товаров</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'BackupAdmin'),$_smarty_tpl ) );?>
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
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'UsersAdmin'),$_smarty_tpl ) );?>
">Пользователи</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'GroupsAdmin'),$_smarty_tpl ) );?>
">Группы покупателей</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ExportUsersAdmin'),$_smarty_tpl ) );?>
">Экспорт пользователей</a></li>
        </ul>
    </li>

    <li class="item__menu<?php if ($_smarty_tpl->tpl_vars['module']->value == 'settings' || $_smarty_tpl->tpl_vars['module']->value == 'design' || $_smarty_tpl->tpl_vars['module']->value == 'currency' || $_smarty_tpl->tpl_vars['module']->value == 'delivery' || $_smarty_tpl->tpl_vars['module']->value == 'payment' || $_smarty_tpl->tpl_vars['module']->value == 'managers') {?> active<?php }?>">
        <div class="menu-item__title">Настройки сайта</div>

        <ul>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'SettingsAdmin'),$_smarty_tpl ) );?>
">Общие настройки</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ThemeAdmin'),$_smarty_tpl ) );?>
">Дизайн</a></li>
            <li class="separator"></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'CurrencyAdmin'),$_smarty_tpl ) );?>
">Валюты сайта</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'DeliveriesAdmin'),$_smarty_tpl ) );?>
">Способы доставки</a></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'PaymentMethodsAdmin'),$_smarty_tpl ) );?>
">Способы оплаты</a></li>
            <li class="separator"></li>
            <li><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ManagersAdmin'),$_smarty_tpl ) );?>
">Менеджеры</a></li>
        </ul>
    </li>
</ul><?php }
}
