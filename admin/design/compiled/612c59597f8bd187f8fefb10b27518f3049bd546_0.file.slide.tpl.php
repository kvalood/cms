<?php /* Smarty version 3.1.24, created on 2016-06-07 13:38:30
         compiled from "admin/design/html/slide.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:9529575641b69be530_44095982%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '612c59597f8bd187f8fefb10b27518f3049bd546' => 
    array (
      0 => 'admin/design/html/slide.tpl',
      1 => 1465270709,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9529575641b69be530_44095982',
  'variables' => 
  array (
    'slide' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575641b6cedd78_20584370',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575641b6cedd78_20584370')) {
function content_575641b6cedd78_20584370 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '9529575641b69be530_44095982';
if ($_smarty_tpl->tpl_vars['slide']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование слайда', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Создание слайда', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>


    <div class="content_header">
        <h1><?php if ($_smarty_tpl->tpl_vars['slide']->value->id) {?>Редактирование слайда<?php } else { ?>Добавление слайда<?php }?></h1>

        <div class="buttons">
            <a href="index.php?module=SliderAdmin&method=slides<?php if ($_GET['slider_id']) {?>&id=<?php echo $_GET['slider_id'];
}?>" class="button back">Назад</a>
            <input class="button save" type="submit" name="" value="<?php if ($_smarty_tpl->tpl_vars['slide']->value->id) {?>Сохранить<?php } else { ?>Создать<?php }?>" />
        </div>
	</div>

	<div class="board block">

        <h2>Настройки слайда</h2>
        <ul class="row">
            <li class="col s12 sm4">
                <label class="required">Название слайда</label>
                <input name="name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" required/>
            </li>

            <li class="col s12 sm4">
                <label>URL слайда</label>
                <input name="url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" />
            </li>

            <li class="col s12 sm4">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['slide']->value->visible) {?>checked<?php }?>>
                    <span>Активный</span>
                </label>
            </li>

            <li class="col s12">
                <label>Текст на слайде</label>
                <textarea name="description" class="full_text"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
            </li>
        </ul>

        <h2>Изображение слайда</h2>

        <ul class="row">
        <?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?>

            <li class="col s12">
                <input type="submit" name="delete_image" class="button red" value="Удалить изображение и обновить слайд">
            </li>

            <li class="col s12">
                <img src="<?php echo $_smarty_tpl->tpl_vars['slide']->value->image;?>
" alt="" />
            </li>

        <?php } else { ?>
            <li class="col s12">
                <input class='upload_image' name=image type=file value="test">
            </li>
        <?php }?>
        </ul>

    </div>

</form>


<?php echo $_smarty_tpl->getSubTemplate ("admin_tinymce.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>