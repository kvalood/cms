<?php /* Smarty version 3.1.24, created on 2015-07-15 13:08:59
         compiled from "admin/design/html/manager.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2893755a5cecbe02d39_61309960%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae527c7c56e78739c74a354e4b6e7b17dce9c004' => 
    array (
      0 => 'admin/design/html/manager.tpl',
      1 => 1432876850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2893755a5cecbe02d39_61309960',
  'variables' => 
  array (
    'm' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'perms' => 0,
    'p' => 0,
    'name' => 0,
    'manager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5cecbe78050_36486743',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5cecbe78050_36486743')) {
function content_55a5cecbe78050_36486743 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2893755a5cecbe02d39_61309960';
if ($_smarty_tpl->tpl_vars['m']->value->login) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['m']->value->login, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый менеджер', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<?php echo '<script'; ?>
>

$(function() {
	// Выделить все
	$("#check_all").click(function() {
		$('input[type="checkbox"][name*="permissions"]:not(:disabled)').attr('checked', $('input[type="checkbox"][name*="permissions"]:not(:disabled):not(:checked)').length>0);
	});

	<?php if ($_smarty_tpl->tpl_vars['m']->value->login) {?>$('#password_input').hide();<?php }?>
	$('#change_password').click(function() {
		$('#password_input').show();
	});
});

<?php echo '</script'; ?>
>

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">

    <div class="capture_head">
        <a href="index.php?module=ManagersAdmin">← Назад</a>
        <a href="index.php?module=ManagerAdmin">+ Добавить менеджера</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Менеджер добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Менеджер обновлен<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message_success']->value, ENT_QUOTES, 'UTF-8', true);
}?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span>
        <?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'login_exists') {?>Менеджер с таким логином уже существует
        <?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_login') {?>Введите логин
        <?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'not_writable') {?>Установите права на запись для файла /admin/.passwd
        <?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message_error']->value, ENT_QUOTES, 'UTF-8', true);
}?>
        </span>
    </div>
    <?php }?>

	<div id="name">
        <label style="display: block;margin-bottom: 2px;">Логин:</label>
		<input class="name_product" name="login" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->login, ENT_QUOTES, 'UTF-8', true);?>
" maxlength="32"/>
		<input name="old_login" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->login, ENT_QUOTES, 'UTF-8', true);?>
"/>

        <br/>
        <label style="display: block;margin-bottom: 2px;">Пароль:</label>
		<?php if ($_smarty_tpl->tpl_vars['m']->value->login) {?><a class="dash_link"id="change_password">изменить</a><?php }?>
		<input id="password_input" class="name_product" name="password" type="password" value=""/>
	</div> 


    <div class="board">
        <div class="block">
            <h2>Права доступа: </h2>

            <label id="check_all" class="dash_link">Выбрать все</label>
            <ul style="margin-top:15px;">
                <?php $_smarty_tpl->tpl_vars['perms'] = new Smarty_Variable(array('products'=>'Товары','categories'=>'Категории товаров','brands'=>'Бренды','features'=>'Свойства товаров','orders'=>'Заказы','labels'=>'Метки заказов','users'=>'Покупатели','groups'=>'Группы покупателей','coupons'=>'Скидочные купоны','comments'=>'Комментарии','feedback'=>'Обратная связь','import'=>'Импорт товаров','export'=>'Экспорт товаров','backup'=>'Бекап товаров','stats'=>'Статистика продаж','design'=>'Управление дизайном сайта','settings'=>'Настройки сайта','currency'=>'Валюты сайта','delivery'=>'Способы доставки','payment'=>'Способы оплаты','managers'=>'Менеджеры','article'=>'Материалы','articlecat'=>'Категории материалов','tags'=>'Теги/метки','slides'=>'Слайдер','menu'=>'Меню'), null, 0);?>

                <?php
$_from = $_smarty_tpl->tpl_vars['perms']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['name'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['name']->_loop = false;
$_smarty_tpl->tpl_vars['p'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->_loop = true;
$foreach_name_Sav = $_smarty_tpl->tpl_vars['name'];
?>
                <li>
                    <label class=property for="<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</label>
                    <input id="<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
" name="permissions[]" type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['m']->value->permissions && in_array($_smarty_tpl->tpl_vars['p']->value,$_smarty_tpl->tpl_vars['m']->value->permissions)) {?>checked<?php }?> <?php if ($_smarty_tpl->tpl_vars['m']->value->login == $_smarty_tpl->tpl_vars['manager']->value->login) {?>disabled<?php }?>/>
                </li>
                <?php
$_smarty_tpl->tpl_vars['name'] = $foreach_name_Sav;
}
?>
            </ul>
        </div>

        <div id="action">
            <input class="button_green button_save" type="submit" name="" value="Сохранить" />
        </div>
    </div>
</form><?php }
}
?>