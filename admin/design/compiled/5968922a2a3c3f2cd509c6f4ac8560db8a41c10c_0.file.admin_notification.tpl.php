<?php /* Smarty version 3.1.24, created on 2016-06-04 00:26:48
         compiled from "admin/design/html/admin_notification.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18038575193a8738b87_43920320%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5968922a2a3c3f2cd509c6f4ac8560db8a41c10c' => 
    array (
      0 => 'admin/design/html/admin_notification.tpl',
      1 => 1464963877,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18038575193a8738b87_43920320',
  'variables' => 
  array (
    'messages' => 0,
    'message' => 0,
    'lang' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575193a8759a15_22214061',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575193a8759a15_22214061')) {
function content_575193a8759a15_22214061 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18038575193a8738b87_43920320';
if ($_smarty_tpl->tpl_vars['messages']->value['success']) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['messages']->value['success'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['message']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
$foreach_message_Sav = $_smarty_tpl->tpl_vars['message'];
?>
    <div class="info success clear">
        <i class="icon-check"></i>
        <span><?php echo $_smarty_tpl->tpl_vars['lang']->value->{$_smarty_tpl->tpl_vars['message']->value['key']};?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['message']->value['data']) {?>
            <div class="info__data"><?php echo $_smarty_tpl->tpl_vars['message']->value['data'];?>
</div>
        <?php }?>
    </div>
    <?php
$_smarty_tpl->tpl_vars['message'] = $foreach_message_Sav;
}
?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['messages']->value['error']) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['messages']->value['error'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['message']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
$foreach_message_Sav = $_smarty_tpl->tpl_vars['message'];
?>
    <div class="info warning clear">
        <i class="icon-remove"></i>
        <span><?php echo $_smarty_tpl->tpl_vars['lang']->value->{$_smarty_tpl->tpl_vars['message']->value['key']};?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['message']->value['data']) {?>
            <div class="info__data"><?php echo $_smarty_tpl->tpl_vars['message']->value['data'];?>
</div>
        <?php }?>
    </div>
    <?php
$_smarty_tpl->tpl_vars['message'] = $foreach_message_Sav;
}
?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['messages']->value['notice']) {?>
    <?php
$_from = $_smarty_tpl->tpl_vars['messages']->value['notice'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['message']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->_loop = true;
$foreach_message_Sav = $_smarty_tpl->tpl_vars['message'];
?>
    <div class="info notice clear">
        <i class="icon-warning"></i>
        <span><?php echo $_smarty_tpl->tpl_vars['lang']->value->{$_smarty_tpl->tpl_vars['message']->value['key']};?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['message']->value['data']) {?>
            <div class="info__data"><?php echo $_smarty_tpl->tpl_vars['message']->value['data'];?>
</div>
        <?php }?>
    </div>
    <?php
$_smarty_tpl->tpl_vars['message'] = $foreach_message_Sav;
}
?>
<?php }
}
}
?>