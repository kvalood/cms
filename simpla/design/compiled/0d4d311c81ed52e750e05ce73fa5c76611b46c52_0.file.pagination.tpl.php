<?php
/* Smarty version 3.1.32, created on 2018-07-12 21:18:50
  from 'C:\SERVER\domains\cms\simpla\design\html\pagination.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b47391a2e76b6_58099542',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d4d311c81ed52e750e05ce73fa5c76611b46c52' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\pagination.tpl',
      1 => 1430670289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b47391a2e76b6_58099542 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['pages_count']->value > 1) {?>

<?php echo '<script'; ?>
 type="text/javascript" src="design/js/ctrlnavigate.js"><?php echo '</script'; ?>
>           

<!-- Листалка страниц -->
<div id="pagination">
	
		<?php $_smarty_tpl->_assignInScope('visible_pages', 3);?>

		<?php $_smarty_tpl->_assignInScope('page_from', 1);?>
	
		<?php if ($_smarty_tpl->tpl_vars['current_page']->value > floor($_smarty_tpl->tpl_vars['visible_pages']->value/2)) {?>
		<?php $_smarty_tpl->_assignInScope('page_from', max(1,$_smarty_tpl->tpl_vars['current_page']->value-floor($_smarty_tpl->tpl_vars['visible_pages']->value/2)-1));?>
	<?php }?>	
	
		<?php if ($_smarty_tpl->tpl_vars['current_page']->value > $_smarty_tpl->tpl_vars['pages_count']->value-ceil($_smarty_tpl->tpl_vars['visible_pages']->value/2)) {?>
		<?php $_smarty_tpl->_assignInScope('page_from', max(1,$_smarty_tpl->tpl_vars['pages_count']->value-$_smarty_tpl->tpl_vars['visible_pages']->value-1));?>
	<?php }?>
	
		<?php $_smarty_tpl->_assignInScope('page_to', min($_smarty_tpl->tpl_vars['page_from']->value+$_smarty_tpl->tpl_vars['visible_pages']->value,$_smarty_tpl->tpl_vars['pages_count']->value-1));?>

		<a class="<?php if ($_smarty_tpl->tpl_vars['current_page']->value == 1) {?>selected<?php } else { ?>droppable<?php }?>" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>1),$_smarty_tpl ) );?>
">1</a>
	
		
	<?php
$__section_pages_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['page_to']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_pages_2_start = (int)@$_smarty_tpl->tpl_vars['page_from']->value < 0 ? max(0, (int)@$_smarty_tpl->tpl_vars['page_from']->value + $__section_pages_2_loop) : min((int)@$_smarty_tpl->tpl_vars['page_from']->value, $__section_pages_2_loop);
$__section_pages_2_total = min(($__section_pages_2_loop - $__section_pages_2_start), $__section_pages_2_loop);
$_smarty_tpl->tpl_vars['__smarty_section_pages'] = new Smarty_Variable(array());
if ($__section_pages_2_total !== 0) {
for ($__section_pages_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_pages']->value['index'] = $__section_pages_2_start; $__section_pages_2_iteration <= $__section_pages_2_total; $__section_pages_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_pages']->value['index']++){
?>
			
		<?php $_smarty_tpl->_assignInScope('p', (isset($_smarty_tpl->tpl_vars['__smarty_section_pages']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_pages']->value['index'] : null)+1);?>	
			
		<?php if (($_smarty_tpl->tpl_vars['p']->value == $_smarty_tpl->tpl_vars['page_from']->value+1 && $_smarty_tpl->tpl_vars['p']->value != 2) || ($_smarty_tpl->tpl_vars['p']->value == $_smarty_tpl->tpl_vars['page_to']->value && $_smarty_tpl->tpl_vars['p']->value != $_smarty_tpl->tpl_vars['pages_count']->value-1)) {?>	
		<a class="<?php if ($_smarty_tpl->tpl_vars['p']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>selected<?php }?>" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['p']->value),$_smarty_tpl ) );?>
">...</a>
		<?php } else { ?>
		<a class="<?php if ($_smarty_tpl->tpl_vars['p']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>selected<?php } else { ?>droppable<?php }?>" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['p']->value),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
</a>
		<?php }?>
	<?php
}
}
?>

		<a class="<?php if ($_smarty_tpl->tpl_vars['current_page']->value == $_smarty_tpl->tpl_vars['pages_count']->value) {?>selected<?php } else { ?>droppable<?php }?>"  href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['pages_count']->value),$_smarty_tpl ) );?>
"><?php echo $_smarty_tpl->tpl_vars['pages_count']->value;?>
</a>
	
	<a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>'all'),$_smarty_tpl ) );?>
">все сразу</a>
	<?php if ($_smarty_tpl->tpl_vars['current_page']->value > 1) {?><a id="PrevLink" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page']->value-1),$_smarty_tpl ) );?>
">←назад</a><?php }?>
	<?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['pages_count']->value) {?><a id="NextLink" href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('page'=>$_smarty_tpl->tpl_vars['current_page']->value+1),$_smarty_tpl ) );?>
">вперед→</a><?php }?>	
	
</div>
<!-- Листалка страниц (The End) -->
<?php }
}
}
