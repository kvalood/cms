<?php /* Smarty version 3.1.24, created on 2015-06-10 03:01:12
         compiled from "admin/design/html/theme.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1060655771bd8ab4c06_09534395%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '458818512b8867906ad2637fbcfa1f4b3c6a9e93' => 
    array (
      0 => 'admin/design/html/theme.tpl',
      1 => 1433128871,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1060655771bd8ab4c06_09534395',
  'variables' => 
  array (
    'theme' => 0,
    'settings' => 0,
    'message_error' => 0,
    'themes_dir' => 0,
    'message_success' => 0,
    'themes' => 0,
    't' => 0,
    'root_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55771bd8c200d2_09192397',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55771bd8c200d2_09192397')) {
function content_55771bd8c200d2_09192397 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'D:/OpenServer/domains/cms/Smarty/libs/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '1060655771bd8ab4c06_09534395';
if ($_smarty_tpl->tpl_vars['theme']->value->name) {?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable("Тема ".((string)$_smarty_tpl->tpl_vars['theme']->value->name), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<?php echo '<script'; ?>
>

	
$(function() {

	// Выбрать тему
	$('.set_main_theme').click(function() {
     	$("form input[name=action]").val('set_main_theme');
    	$("form input[name=theme]").val($(this).closest('li').attr('theme'));
    	$("form").submit();
	});	
	
	// Клонировать текущую тему
	$('a.add').click(function() {
     	$("form input[name=action]").val('clone_theme');
    	$("form").submit();
	});	
	
	// Редактировать название
	$("a.edit").click(function() {
		name = $(this).closest('li').attr('theme');
		inp1 = $('<input type=hidden name="old_name[]">').val(name);
		inp2 = $('<input type=text name="new_name[]">').val(name);
		$(this).closest('li').find("p.name").html('').append(inp1).append(inp2);
		inp2.focus().select();
		return false;
	});
	
	// Удалить тему
	$('.delete').click(function() {
     	$("form input[name=action]").val('delete_theme');
     	$("form input[name=theme]").val($(this).closest('li').attr('theme'));
   		$("form").submit();
	});	

	$("form").submit(function() {
		if($("form input[name=action]").val()=='delete_theme' && !confirm('Подтвердите удаление'))
			return false;	
	});
	
});

<?php echo '</script'; ?>
>

<div class="capture_head">
	<div id="header">
		<h1 class="<?php if ($_smarty_tpl->tpl_vars['theme']->value->locked) {?>locked<?php }?>">Текущая тема &mdash; <?php echo $_smarty_tpl->tpl_vars['theme']->value->name;?>
</h1>
	</div>

	<a href="index.php?module=TemplatesAdmin">Редактировать шаблон</a>	
	<a href="index.php?module=StylesAdmin">CSS шаблона</a>		
	<a href="index.php?module=ImagesAdmin">Изображения шаблона</a>
	<a class="add" href="#">Создать копию темы <?php echo $_smarty_tpl->tpl_vars['settings']->value->theme;?>
</a>
</div>





<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<!-- Системное сообщение -->
<div class="message_box message_error">
	<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'permissions') {?>Установите права на запись для папки <?php echo $_smarty_tpl->tpl_vars['themes_dir']->value;?>

	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'name_exists') {?>Тема с таким именем уже существует<?php }?></span>
</div>
<!-- Системное сообщение (The End)-->
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'delete_theme') {?>Тема удалена<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'clone_theme') {?>Тема клонирована<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == "set_main_theme") {?>Тема установлена как главная<?php }?></span>
	</div>
<?php }?>

	<form method="post" enctype="multipart/form-data" class="board_subhead">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<input type=hidden name="action">
		<input type=hidden name="theme">

		<ul class="themes">
		<?php
$_from = $_smarty_tpl->tpl_vars['themes']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['t'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['t']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
$foreach_t_Sav = $_smarty_tpl->tpl_vars['t'];
?>
			<li theme='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['t']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'>
				<?php if ($_smarty_tpl->tpl_vars['theme']->value->name == $_smarty_tpl->tpl_vars['t']->value->name) {?><img class="tick" src='design/images/tick.png'> <?php }?>
				<?php if ($_smarty_tpl->tpl_vars['t']->value->locked) {?><img class="tick" src='design/images/lock_small.png'> <?php }?>
				<?php if ($_smarty_tpl->tpl_vars['theme']->value->name != $_smarty_tpl->tpl_vars['t']->value->name && !$_smarty_tpl->tpl_vars['t']->value->locked) {?>
				<a href='#' title="Удалить" class='delete'><img src='design/images/delete.png'></a>
				<a href='#' title="Переименовать" class='edit'><img src='design/images/pencil.png'></a>
				<?php } elseif ($_smarty_tpl->tpl_vars['theme']->value->name != $_smarty_tpl->tpl_vars['t']->value->name) {?>
				
				<?php } elseif (!$_smarty_tpl->tpl_vars['t']->value->locked) {?>
				<a href='#' title="Удалить" class='delete'><img src='design/images/delete.png'></a>
				<a href='#' title="Изменить название" class='edit'><img src='design/images/pencil.png'></a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['theme']->value->name == $_smarty_tpl->tpl_vars['t']->value->name) {?>
				<p class=name><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['t']->value->name, ENT_QUOTES, 'UTF-8', true),16,'...');?>
</p>
				<?php } else { ?>
				<p class=name><a href='#' class='set_main_theme'><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['t']->value->name, ENT_QUOTES, 'UTF-8', true),16,'...');?>
</a></p>
				<?php }?>
				<a href="index.php?module=TemplatesAdmin"><img class="preview" src='<?php echo $_smarty_tpl->tpl_vars['root_dir']->value;?>
../design/<?php echo $_smarty_tpl->tpl_vars['t']->value->name;?>
/preview.png'></a>
			</li>
		<?php
$_smarty_tpl->tpl_vars['t'] = $foreach_t_Sav;
}
?>
		</ul>

		<div class="board_footer">
			<input class="button_green button_save" type="submit" name="save" value="Сохранить" />
		</div>
	
	</form>

<?php }
}
?>