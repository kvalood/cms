<?php /* Smarty version 3.1.24, created on 2015-07-14 05:03:42
         compiled from "admin/design/html/styles.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2909255a40b8e5e2140_09892272%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5cf228c5b9689c2e944ff388a38502459fc26229' => 
    array (
      0 => 'admin/design/html/styles.tpl',
      1 => 1436814220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2909255a40b8e5e2140_09892272',
  'variables' => 
  array (
    'style_file' => 0,
    'theme' => 0,
    'message_error' => 0,
    'styles' => 0,
    's' => 0,
    'style_content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a40b8e628657_69779978',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a40b8e628657_69779978')) {
function content_55a40b8e628657_69779978 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2909255a40b8e5e2140_09892272';
if ($_smarty_tpl->tpl_vars['style_file']->value) {?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable("Стиль ".((string)$_smarty_tpl->tpl_vars['style_file']->value), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<link rel="stylesheet" href="design/js/codemirror/lib/codemirror.css">
<?php echo '<script'; ?>
 src="design/js/codemirror/lib/codemirror.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="design/js/codemirror/mode/css/css.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="design/js/codemirror/addon/selection/active-line.js"><?php echo '</script'; ?>
>
 

<style type="text/css">

.CodeMirror{
	font-family:'Courier New';
	margin-bottom:10px;
	border:1px solid #c0c0c0;
	background-color: #ffffff;
	height: auto;
	min-height: 300px;
	width:100%;
}
.CodeMirror-scroll
{
	overflow-y: hidden;
	overflow-x: auto;
}
</style>

<?php echo '<script'; ?>
>
$(function() {	
	// Сохранение кода аяксом
	function save()
	{
		$('.CodeMirror').css('background-color','#e0ffe0');
		content = editor.getValue();
		
		$.ajax({
			type: 'POST',
			url: 'ajax/save_style.php',
			data: {'content': content, 'theme':'<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
', 'style': '<?php echo $_smarty_tpl->tpl_vars['style_file']->value;?>
', 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
			
				$('.CodeMirror').animate({'background-color': '#ffffff'});
			},
			dataType: 'json'
		});
	}

	// Нажали кнопку Сохранить
	$('input[name="save"]').click(function() {
		save();
	});
	
	// Обработка ctrl+s
	var isCtrl = false;
	var isCmd = false;
	$(document).keyup(function (e) {
		if(e.which == 17) isCtrl=false;
		if(e.which == 91) isCmd=false;
	}).keydown(function (e) {
		if(e.which == 17) isCtrl=true;
		if(e.which == 91) isCmd=true;
		if(e.which == 83 && (isCtrl || isCmd)) {
			save();
			e.preventDefault();
		}
	});
});
<?php echo '</script'; ?>
>


<div class="capture_head">
    <div id="header">
        <h1>Тема <?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
, стиль <?php echo $_smarty_tpl->tpl_vars['style_file']->value;?>
</h1>
    </div>

	<a href="index.php?module=ThemeAdmin">← Темы</a>
	<a href="index.php?module=TemplatesAdmin">Редактировать шаблон</a>	
	<a href="index.php?module=ImagesAdmin">Изображения шаблона</a>	
</div>



<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<div class="message_box message_error">
	<span class="text">
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'permissions') {?>Установите права на запись для файла <?php echo $_smarty_tpl->tpl_vars['style_file']->value;?>

	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'theme_locked') {?>Текущая тема защищена от изменений. Создайте копию темы.
	<?php } else {
echo $_smarty_tpl->tpl_vars['message_error']->value;
}?>
	</span>
</div>

<?php }?>

<!-- Список файлов для выбора -->
<div class="board_head">
	<div class="templates_names">
		<?php
$_from = $_smarty_tpl->tpl_vars['styles']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['s']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
$foreach_s_Sav = $_smarty_tpl->tpl_vars['s'];
?>
			<a <?php if ($_smarty_tpl->tpl_vars['style_file']->value == $_smarty_tpl->tpl_vars['s']->value) {?>class="selected"<?php }?> href='index.php?module=StylesAdmin&file=<?php echo $_smarty_tpl->tpl_vars['s']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['s']->value;?>
</a>
		<?php
$_smarty_tpl->tpl_vars['s'] = $foreach_s_Sav;
}
?>
	</div>
</div>

<?php if ($_smarty_tpl->tpl_vars['style_file']->value) {?>
<div class="block">
    <form>
        <textarea id="content" name="content" style="width:700px;height:500px;"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['style_content']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
    </form>
</div>

<div id="action"">
    <input class="button_green button_save" type="submit" name="save" value="Сохранить" />
</div>



<?php echo '<script'; ?>
>

var editor = CodeMirror.fromTextArea(document.getElementById("content"), {
		mode: "css",		
		lineNumbers: true,
		styleActiveLine: true,
		matchBrackets: false,
		enterMode: 'keep',
		indentWithTabs: false,
		indentUnit: 1,
		tabMode: 'classic'
	});
<?php echo '</script'; ?>
>


<?php }
}
}
?>