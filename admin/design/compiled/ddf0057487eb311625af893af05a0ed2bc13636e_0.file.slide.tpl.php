<?php /* Smarty version 3.1.24, created on 2015-07-22 23:30:53
         compiled from "admin/design/html/slide.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:507955af9b0d51fd75_14223049%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddf0057487eb311625af893af05a0ed2bc13636e' => 
    array (
      0 => 'admin/design/html/slide.tpl',
      1 => 1430732202,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '507955af9b0d51fd75_14223049',
  'variables' => 
  array (
    'slide' => 0,
    'message_success' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55af9b0d5fe824_24283068',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55af9b0d5fe824_24283068')) {
function content_55af9b0d5fe824_24283068 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '507955af9b0d51fd75_14223049';
if ($_smarty_tpl->tpl_vars['slide']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование слайда', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый слайд', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>



<?php echo '<script'; ?>
>
$(function() {
	// Удаление изображений
	$("a.button_slide_delete").click( function() {
		$("input[name='delete_image']").val('1');
		$(this).closest("ul").fadeOut(200, function() { $(this).remove(); });
		return false;
	});
});
<?php echo '</script'; ?>
>


<form method=post id="product"  enctype="multipart/form-data">
	
	<div class="capture_head">
		<a href="index.php?module=SlidesAdmin">← Назад</a>
		<a href="index.php?module=SlideAdmin">+ Добавить еще один слайд</a>
		
		<?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?><a href='#' class="button_slide_delete button_red">Удалить изображение слайда</a><?php }?>
		<input class="button_green button_save" type="submit" name="" value="<?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?>Обновить<?php } else { ?>Сохранить<?php }?>" />
	</div>
	
	<h1><?php if ($_smarty_tpl->tpl_vars['slide']->value->id) {?>Редактирование слайда<?php } else { ?>Добавление слайда<?php }?></h1>


	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Слайд добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Слайд обновлен<?php } else {
echo $_smarty_tpl->tpl_vars['message_success']->value;
}?></span>
	</div>
	<?php }?>
	
	<input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
	<input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/> 
	
	<div id="column_left">
		<div class="block layer">
			<h2>Основные настройки</h2>
			<ul>
				<li>
					<label class="property">Название слайда:</label>
					<input class="name" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/> 
				</li>
				<li>
					<label class="property">URL слайда. Что будет открываться по нажатию на слайд.</label>
					
					<input name="url" class="page_url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" />
				</li>
			</ul>
		</div>
	</div>

	<div id="column_right">
		<div class="block layer">
			<ul>
				<li>
					<label>Описание:</label>
					<div>
						<textarea name="description" class="description"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
						<div class="tip">Описание выводится внизу изображения. Можно использовать html/css/js</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
	
	<div class="block">
		<ul>
			<li>
				<input class='upload_image' name=image type=file value="test">	
				<input type=hidden name="delete_image" value="">			
			</li>
		</ul>
		
		<?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?>
		<ul class="slide_file">
			<li>
				<div class="tip">Файл: <?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/<?php echo $_smarty_tpl->tpl_vars['slide']->value->image;?>
</div>
			</li>
			<li class="slide_image">
				<img src="../<?php echo $_smarty_tpl->tpl_vars['slide']->value->image;?>
" alt="" />
			</li>
			
		</ul>
		<?php }?>
	</div>
</form>
<?php }
}
?>