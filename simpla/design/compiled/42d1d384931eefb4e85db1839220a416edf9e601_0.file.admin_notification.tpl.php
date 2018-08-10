<?php
/* Smarty version 3.1.32, created on 2018-07-10 22:10:35
  from 'C:\SERVER\domains\cms\simpla\design\html\admin_notification.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44a23b42afa5_84571229',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42d1d384931eefb4e85db1839220a416edf9e601' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\admin_notification.tpl',
      1 => 1472740767,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b44a23b42afa5_84571229 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['messages']->value['success']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['success'], 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
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
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<?php if ($_smarty_tpl->tpl_vars['messages']->value['error']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['error'], 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
?>
    <div class="info warning clear">
        <i class="icon-close"></i>
        <span><?php echo $_smarty_tpl->tpl_vars['lang']->value->{$_smarty_tpl->tpl_vars['message']->value['key']};?>
</span>
        <?php if ($_smarty_tpl->tpl_vars['message']->value['data']) {?>
            <div class="info__data"><?php echo $_smarty_tpl->tpl_vars['message']->value['data'];?>
</div>
        <?php }?>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>

<?php if ($_smarty_tpl->tpl_vars['messages']->value['notice']) {?>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value['notice'], 'message');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
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
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
}
