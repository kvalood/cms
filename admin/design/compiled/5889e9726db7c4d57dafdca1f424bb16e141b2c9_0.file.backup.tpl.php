<?php /* Smarty version 3.1.24, created on 2015-06-25 17:24:16
         compiled from "admin/design/html/backup.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14183558baca0c19672_37632076%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5889e9726db7c4d57dafdca1f424bb16e141b2c9' => 
    array (
      0 => 'admin/design/html/backup.tpl',
      1 => 1433087150,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14183558baca0c19672_37632076',
  'variables' => 
  array (
    'message_error' => 0,
    'message_success' => 0,
    'backup_files_dir' => 0,
    'backups' => 0,
    'backup' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558baca0d07b30_31710630',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558baca0d07b30_31710630')) {
function content_558baca0d07b30_31710630 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14183558baca0c19672_37632076';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Бекап', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?><a href="" class="add">+ Создать бекап</a><?php }?>
</div>


<div id="header">
	<h1>Бекап</h1>
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
	
	<form id="hidden" method="post">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<input type="hidden" name="action" value="">
		<input type="hidden" name="name" value="">
	</form>
	<?php }?>
</div>	

<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
<!-- Системное сообщение -->
<div class="message_box message_success">
	<span class="text"><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'created') {?>Бекап создан<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'restored') {?>Бекап восстановлен<?php }?></span>
	<?php if ($_GET['return']) {?>
	<a class="button" href="<?php echo $_GET['return'];?>
">Вернуться</a>
	<?php }?>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<!-- Системное сообщение -->
<div class="message_box message_error">
	<span class="text">
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'no_permission') {?>Установите права на запись в папку <?php echo $_smarty_tpl->tpl_vars['backup_files_dir']->value;?>

	<?php } else {
echo $_smarty_tpl->tpl_vars['message_error']->value;
}?>
	</span>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['backups']->value) {?>
	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

		<div id="list">			
			<?php
$_from = $_smarty_tpl->tpl_vars['backups']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['backup'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['backup']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['backup']->value) {
$_smarty_tpl->tpl_vars['backup']->_loop = true;
$foreach_backup_Sav = $_smarty_tpl->tpl_vars['backup'];
?>
			<div class="row">
				<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['backup']->value->name;?>
"/>				
				</div>
				<?php }?>
				<div class="name cell">
	 				<a href="files/backup/<?php echo $_smarty_tpl->tpl_vars['backup']->value->name;?>
"><?php echo $_smarty_tpl->tpl_vars['backup']->value->name;?>
</a>
					(<?php if ($_smarty_tpl->tpl_vars['backup']->value->size > 1024*1024) {
echo round(($_smarty_tpl->tpl_vars['backup']->value->size/1024/1024),2);?>
 МБ<?php } else {
echo round(($_smarty_tpl->tpl_vars['backup']->value->size/1024),2);?>
 КБ<?php }?>)
				</div>
				<div class="icons cell">
					<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
					<a class="delete" title="Удалить" href="#"></a>
					<?php }?>
		 		</div>
				<div class="icons cell">
					<a class="restore" title="Восстановить этот бекап" href="#"></a>
				</div>
		 		<div class="clear"></div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['backup'] = $foreach_backup_Sav;
}
?>
		</div>
		
		<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
		<div id="action">
		<label id="check_all" class="dash_link">Выбрать все</label>
	
		<span id="select">
		<select name="action">
			<option value="delete">Удалить</option>
		</select>
		</span>
	
		<input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
		<?php }?>
	
	</form>
<?php }?>



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
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});

	// Восстановить 
	$("a.restore").click(function() {
		file = $(this).closest(".row").find('[name*="check"]').val();
		$('form#hidden input[name="action"]').val('restore');
		$('form#hidden input[name="name"]').val(file);
		$('form#hidden').submit();
		return false;
	});

	// Создать бекап 
	$("a.add").click(function() {
		$('form#hidden input[name="action"]').val('create');
		$('form#hidden').submit();
		return false;
	});

	$("form#hidden").submit(function() {
		if($('input[name="action"]').val()=='restore' && !confirm('Текущие данные будут потеряны. Подтвердите восстановление'))
			return false;	
	});
	
	$("form#list_form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
	

});

<?php echo '</script'; ?>
>
<?php }
}
?>