<?php /* Smarty version 3.1.24, created on 2016-06-04 14:56:08
         compiled from "admin/design/html/slider.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2425957525f68ca1d03_37132080%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ae417a8470ecd4052987ca4d648f66005753cae9' => 
    array (
      0 => 'admin/design/html/slider.tpl',
      1 => 1465016139,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2425957525f68ca1d03_37132080',
  'variables' => 
  array (
    'slider' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_57525f6900b278_30193321',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57525f6900b278_30193321')) {
function content_57525f6900b278_30193321 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2425957525f68ca1d03_37132080';
if ($_smarty_tpl->tpl_vars['slider']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование слайдера', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Создание слайдера', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name="id" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slider']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="content_header">
        <h1><?php if ($_smarty_tpl->tpl_vars['slider']->value->id) {?>Редактирование слайдера<?php } else { ?>Создание слайдера<?php }?></h1>

        <div class="buttons">
            <a href="index.php?module=SliderAdmin" class="button back">Назад</a>
            <input class="button save" type="submit" name="save" value="<?php if ($_smarty_tpl->tpl_vars['slider']->value->id) {?>Сохранить<?php } else { ?>Создать<?php }?>" />
        </div>
    </div>

    <div class="board">
        <div class="row">
            <div class="col s12 sm6">
                <label>Название слайда</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value->name;?>
" name="name"/>
            </div>

            <div class="col s12 sm6">
                <label>id слайда</label>
                <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['slider']->value->id;?>
" name="name" disabled/>
            </div>
        </div>
    </div>

</form><?php }
}
?>