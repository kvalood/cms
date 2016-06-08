<?php /* Smarty version 3.1.24, created on 2015-06-25 16:58:26
         compiled from "admin/design/html/menu_category_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14267558ba692ce5e38_16406888%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2ffecaf30ba96e2127a7c46efdefdca153deac9' => 
    array (
      0 => 'admin/design/html/menu_category_edit.tpl',
      1 => 1432913361,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14267558ba692ce5e38_16406888',
  'variables' => 
  array (
    'menu' => 0,
    'message_success' => 0,
    'message_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558ba692ddfe77_75472745',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558ba692ddfe77_75472745')) {
function content_558ba692ddfe77_75472745 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14267558ba692ce5e38_16406888';
?>

<?php if ($_smarty_tpl->tpl_vars['menu']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Создание меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name="id" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1><?php if ($_smarty_tpl->tpl_vars['menu']->value->name) {?>Редактирование меню<?php } else { ?>Создание меню<?php }?></h1>
        </div>

        <a href="index.php?module=MenuAdmin">← Назад</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'cat_add') {?>Меню добавлено<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Меню обновлено<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'no_name') {?>Вы не указали название меню<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'exist_name_cat') {?>Меню с таким именем уже существует<?php }?></span>
    </div>
    <?php }?>

    <div class="board_subhead">
        <div id="board_column_left">
            <div class="block">
                <h2>Параметры</h2>
                <ul>
                    <li><label class=property>Название</label><input class="name" name="cat_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['menu']->value->name;?>
"/></li>
                    <li><label class=property>id (no edit)</label><input name="id_no_edit" type="text" value="<?php echo $_smarty_tpl->tpl_vars['menu']->value->id;?>
" disabled /></li>
                </ul>
            </div>
        </div>
    </div>
</form><?php }
}
?>