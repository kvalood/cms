<?php /* Smarty version 3.1.24, created on 2016-06-04 19:46:03
         compiled from "admin/design/html/sliders.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:170175752a35b9330a7_10377213%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5098a63710ec7de0220e1782d6f6f9714466956' => 
    array (
      0 => 'admin/design/html/sliders.tpl',
      1 => 1465033561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170175752a35b9330a7_10377213',
  'variables' => 
  array (
    'sliders' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5752a35b972542_70307407',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5752a35b972542_70307407')) {
function content_5752a35b972542_70307407 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '170175752a35b9330a7_10377213';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Список слайдеров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="content_header">
    <h1>Список слайдеров</h1>

    <div class="buttons">
        <a href="index.php?module=SliderAdmin&method=slider" class="button green">Создать слайдер</a>
    </div>
</div>

<div class="board">
<?php if ($_smarty_tpl->tpl_vars['sliders']->value) {?>
    <div class="list_items">
        <div class="row header_list">
             <div class="col s2 control">Инструменты</div>
             <div class="col s1">ID</div>
             <div class="col s9">Наименование</div>
        </div>

        <?php
$_from = $_smarty_tpl->tpl_vars['sliders']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_item_Sav = $_smarty_tpl->tpl_vars['item'];
?>
        <div class="row list_item">
            <div class="col s2 control">
                <a href="index.php?module=SliderAdmin&method=slider&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" class="icon-cog" title="Редактировать слайдер"></a>
            </div>
            <div class="col s1"><?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
</div>
            <div class="col s9">
                <a href="index.php?module=SliderAdmin&method=slides&id=<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
" title="Список слайдов" class="link"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
            </div>
        </div>
        <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_item_Sav;
}
?>
    </div>
<?php } else { ?>
	Слайдеры отсутствуют
<?php }?>
</div><?php }
}
?>