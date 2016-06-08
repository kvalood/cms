<?php /* Smarty version 3.1.24, created on 2015-09-14 17:03:37
         compiled from "admin/design/html/images.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:807155f671498172a6_70333328%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ef6299e107cc1f7b9d741f1a2c264ef0fc378d7' => 
    array (
      0 => 'admin/design/html/images.tpl',
      1 => 1436816131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '807155f671498172a6_70333328',
  'variables' => 
  array (
    'theme' => 0,
    'message_error' => 0,
    'images_dir' => 0,
    'images' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55f67149ae9183_91865659',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55f67149ae9183_91865659')) {
function content_55f67149ae9183_91865659 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '807155f671498172a6_70333328';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable("Изображения", null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>



<?php echo '<script'; ?>
>
$(function() {

	// Редактировать
	$("a.edit").click(function() {
		name = $(this).closest('li').attr('name');
		inp1 = $('<input type=hidden name="old_name[]">').val(name);
		inp2 = $('<input type=text name="new_name[]">').val(name);
		$(this).closest('li').find("p.name").html('').append(inp1).append(inp2);
		inp2.focus().select();
		return false;
	});
 

	// Удалить 
	$("a.delete").click(function() {
		name = $(this).closest('li').attr('name');
		$('input[name=delete_image]').val(name);
		$(this).closest("form").submit();
	});
	
	// Загрузить
	$("#upload_image").click(function() {
		$(this).closest('div').append($('<input type=file name=upload_images[]>'));
	});
	
	$("form").submit(function() {
		if($('input[name="delete_image"]').val()!='' && !confirm('Подтвердите удаление'))
			return false;	
	});

});
<?php echo '</script'; ?>
>


<div class="capture_head">
    <div id="header">
        <h1>Изображения темы <?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
</h1>
    </div>

	<a href="index.php?module=ThemeAdmin">← Темы</a>
	<a href="index.php?module=TemplatesAdmin">Редактировать шаблон</a>
	<a href="index.php?module=StylesAdmin">CSS шаблона</a>	
</div>



<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<div class="message_box message_error">
	<span class="text"><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'permissions') {?>Установите права на запись для папки <?php echo $_smarty_tpl->tpl_vars['images_dir']->value;?>

	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'name_exists') {?>Файл с таким именем уже существует
	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'theme_locked') {?>Текущая тема защищена от изменений. Создайте копию темы.
	<?php } else {
echo $_smarty_tpl->tpl_vars['message_error']->value;
}?></span>
</div>

<?php }?>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input type="hidden" name="delete_image" value="">
    <!-- Список файлов для выбора -->
    <div class="board_subhead">
        <ul class="theme_images themes">
            <?php
$_from = $_smarty_tpl->tpl_vars['images']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['image']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
$foreach_image_Sav = $_smarty_tpl->tpl_vars['image'];
?>
                <li name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'>
                <a href='#' class='delete' title="Удалить"><img src='design/images/delete.png'></a>
                <a href='#' class='edit' title="Переименовать"><img src='design/images/pencil.png'></a>
                <p class="name"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->name, ENT_QUOTES, 'UTF-8', true),16,'...');?>
</p>
                <div class="theme_image">
                <a class='preview' href='../<?php echo $_smarty_tpl->tpl_vars['images_dir']->value;
echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'><img src='../<?php echo $_smarty_tpl->tpl_vars['images_dir']->value;
echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'></a>
                </div>
                <p class=size><?php if ($_smarty_tpl->tpl_vars['image']->value->size > 1024*1024) {
echo round(($_smarty_tpl->tpl_vars['image']->value->size/1024/1024),2);?>
 МБ<?php } elseif ($_smarty_tpl->tpl_vars['image']->value->size > 1024) {
echo round(($_smarty_tpl->tpl_vars['image']->value->size/1024),2);?>
 КБ<?php } else {
echo $_smarty_tpl->tpl_vars['image']->value->size;?>
 Байт<?php }?>, <?php echo $_smarty_tpl->tpl_vars['image']->value->width;?>
&times;<?php echo $_smarty_tpl->tpl_vars['image']->value->height;?>
 px</p>
                </li>
            <?php
$_smarty_tpl->tpl_vars['image'] = $foreach_image_Sav;
}
?>
        </ul>
    </div>


    <div class="block upload_image">
        <span id="upload_image"><i class="dash_link">Добавить изображение</i></span>
    </div>

    <div id="action"">
        <input class="button_green button_save" type="submit" name="save" value="Сохранить" />
    </div>

</form><?php }
}
?>