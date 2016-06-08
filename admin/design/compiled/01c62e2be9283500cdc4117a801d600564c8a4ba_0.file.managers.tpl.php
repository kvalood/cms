<?php /* Smarty version 3.1.24, created on 2015-07-14 05:49:29
         compiled from "admin/design/html/managers.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:99855a416497b7520_99038896%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01c62e2be9283500cdc4117a801d600564c8a4ba' => 
    array (
      0 => 'admin/design/html/managers.tpl',
      1 => 1436816968,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99855a416497b7520_99038896',
  'variables' => 
  array (
    'managers_count' => 0,
    'message_error' => 0,
    'managers' => 0,
    'm' => 0,
    'manager' => 0,
    'user' => 0,
    'groups' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a416498095b9_73527918',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a416498095b9_73527918')) {
function content_55a416498095b9_73527918 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '99855a416497b7520_99038896';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Менеджеры', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>



<div class="capture_head">
    <div id="header">
        <h1><?php echo $_smarty_tpl->tpl_vars['managers_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['managers_count']->value,'менеджер','менеджеров','менеджера');?>
</h1>
    </div>
    <a href="index.php?module=ManagerAdmin">Добавить менеджера</a>
</div>

<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<div class="message_box message_error">
	<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'not_writable') {?>Установите права на запись для файла /admin/.passwd
	<?php }?></span>
</div>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['managers']->value) {?>
<!-- Основная часть -->
<div id="main_list">
	<form id="list_form" method="post">
	    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list" class="board_content">
			<?php
$_from = $_smarty_tpl->tpl_vars['managers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['m']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
$foreach_m_Sav = $_smarty_tpl->tpl_vars['m'];
?>
			<div class="row">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->login, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['manager']->value->login == $_smarty_tpl->tpl_vars['m']->value->login) {?>disabled<?php }?>/>
				</div>
				<div class="user_name cell">
					<a href="index.php?module=ManagerAdmin&login=<?php echo urlencode($_smarty_tpl->tpl_vars['m']->value->login);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->login, ENT_QUOTES, 'UTF-8', true);?>
</a>
				</div>
				<div class="user_email cell">
					<a href="mailto:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true);?>
<<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
</a>	
				</div>
				<div class="user_group cell">
					<?php echo $_smarty_tpl->tpl_vars['groups']->value[$_smarty_tpl->tpl_vars['user']->value->group_id]->name;?>

				</div>
				<div class="icons cell">
					<?php if ($_smarty_tpl->tpl_vars['manager']->value->login != $_smarty_tpl->tpl_vars['m']->value->login) {?>
					<a class="delete" title="Удалить" href="#"></a>
					<?php }?>
				</div>
				<div class="clear"></div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['m'] = $foreach_m_Sav;
}
?>
		</div>
	
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id=select>
            <select name="action">
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>
</div>
<?php }?>



<?php echo '<script'; ?>
>
$(function() {
	
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]:not(:disabled)').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:disabled):not(:checked)').length>0);
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
});
<?php echo '</script'; ?>
>
<?php }
}
?>