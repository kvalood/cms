<?php /* Smarty version 3.1.24, created on 2015-06-15 16:28:36
         compiled from "admin/design/html/user.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:16800557e7094331795_04527237%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd4f8ab37da208cedcac4fdd316ba6d824dcc9555' => 
    array (
      0 => 'admin/design/html/user.tpl',
      1 => 1433758488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16800557e7094331795_04527237',
  'variables' => 
  array (
    'user' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'groups' => 0,
    'g' => 0,
    'orders' => 0,
    'order' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_557e70944528d1_30699843',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_557e70944528d1_30699843')) {
function content_557e70944528d1_30699843 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '16800557e7094331795_04527237';
if ($_smarty_tpl->tpl_vars['user']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable(htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<form method=post id=product>
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1>Редактирование пользователя</h1>
        </div>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>"UsersAdmin"),$_smarty_tpl);?>
">← Назад</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
        <div class="message_box message_success">
            <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Пользователь отредактирован<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message_success']->value, ENT_QUOTES, 'UTF-8', true);
}?></span>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
        <div class="message_box message_error">
            <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'login_exists') {?>Пользователь с таким email уже зарегистрирован
            <?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>Введите имя пользователя
            <?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_email') {?>Введите email пользователя<?php }?></span>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['user']->value->id) {?>
        <div class="board_content">
            <div id="board_column_left">
                <div class="block">
                    <h2>Основная информация</h2>
                    <ul>
                        <li><label class="property">ФИО</label><input class="name" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                        <li><label class=property>Email</label><input name="email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        <li><label class=property>Дата регистрации</label><input name="email" type="text" disabled value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['user']->value->created);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['user']->value->created);?>
" /></li>

                        <?php if ($_smarty_tpl->tpl_vars['groups']->value) {?>
                            <li>
                                <label class=property>Группа</label>
                                <select name="group_id">
                                    <option value='0'>Не входит в группу</option>
                                    <?php
$_from = $_smarty_tpl->tpl_vars['groups']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['g']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
$foreach_g_Sav = $_smarty_tpl->tpl_vars['g'];
?>
                                        <option value='<?php echo $_smarty_tpl->tpl_vars['g']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['user']->value->group_id == $_smarty_tpl->tpl_vars['g']->value->id) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['g']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    <?php
$_smarty_tpl->tpl_vars['g'] = $foreach_g_Sav;
}
?>
                                </select>
                            </li>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <div id="board_column_right">
                <div class="block">
                    <h2>Дополнительная информация</h2>
                    <ul>
                        <li><label class=property>Последний IP</label><input name="email" type="text" disabled value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->last_ip, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        <li><label class=property>Последняя активность</label><input name="email" type="text" disabled value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['user']->value->last_visit);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['user']->value->last_visit);?>
" /></li>

                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="enabled" <?php if ($_smarty_tpl->tpl_vars['user']->value->enabled == 1) {?>checked<?php }?>>
                                <span>Активен</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
        <div class="board_content">
            <h2>Заказы пользователя</h2>
            <div id="list">

                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="name">Номер заказа</div>
                    <div class="order">Дата заказа</div>
                    <div class="order">Сумма заказа</div>
                </div>

                <?php
$_from = $_smarty_tpl->tpl_vars['orders']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['order'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['order']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->_loop = true;
$foreach_order_Sav = $_smarty_tpl->tpl_vars['order'];
?>
                    <div class="<?php if ($_smarty_tpl->tpl_vars['order']->value->paid) {?>green<?php }?> row">
                        <div class="checkbox cell">
                            <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
" />
                        </div>

                        <div class="name cell">
                            <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin','id'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl);?>
">Заказ №<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</a>
                        </div>

                        <div class="order cell">
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['order']->value->date);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['order']->value->date);?>

                        </div>

                        <div class="order cell">
                            <?php echo $_smarty_tpl->tpl_vars['order']->value->total_price;?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                        </div>

                        <div class="icons cell">
                            <?php if ($_smarty_tpl->tpl_vars['order']->value->paid) {?>
                                <img src='design/images/cash_stack.png' alt='Оплачен' title='Оплачен'>
                            <?php } else { ?>
                                <img src='design/images/cash_stack_gray.png' alt='Не оплачен' title='Не оплачен'>
                            <?php }?>

                            <a href='#' class=delete></a>
                        </div>
                    </div>
                <?php
$_smarty_tpl->tpl_vars['order'] = $foreach_order_Sav;
}
?>
            </div>

            <div id="action">
                <label id='check_all' class='dash_link'>Выбрать все</label>

                <span id=select>
                <select name="action">
                    <option value="delete">Удалить</option>
                </select>
                </span>

                <input id="apply_action" class="button_green" name="user_orders" type="submit" value="Применить">
            </div>
        </div>
        <?php }?>
    <?php }?>

</form>


<?php echo '<script'; ?>
>
$(function() {

	// Раскраска строк
	function colorize()
	{
		$("#list div.row:even").addClass('even');
		$("#list div.row:odd").removeClass('even');
	}
	// Раскрасить строки сразу
	colorize();

    // Выделить все
    $("#check_all").click(function() {
        $('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
    });

    // Удалить
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form#list").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form#list").submit();
	});

	// Подтверждение удаления
	$("#list").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});
<?php echo '</script'; ?>
>
<?php }
}
?>