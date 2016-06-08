<?php /* Smarty version 3.1.24, created on 2015-07-26 16:29:17
         compiled from "admin/design/html/brands.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2554755b47e3d1f4fe0_11545374%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd55c2bdc02849182fc241d27f2ed3fd9c9f4869f' => 
    array (
      0 => 'admin/design/html/brands.tpl',
      1 => 1436816779,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2554755b47e3d1f4fe0_11545374',
  'variables' => 
  array (
    'brands' => 0,
    'brand' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55b47e3d289707_79255795',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b47e3d289707_79255795')) {
function content_55b47e3d289707_79255795 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2554755b47e3d1f4fe0_11545374';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Бренды', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="capture_head">
	
	<div id="header">
		<h1>Бренды</h1> 
	</div>
	
	<a href="index.php?module=BrandAdmin"> +Добавить бренд</a>
</div>


<div class="board list_box">
	<?php if ($_smarty_tpl->tpl_vars['brands']->value) {?>
	<div class="brands">

		<form id="list_form" method="post">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
			
			<div id="list" class="brands">	
				<?php
$_from = $_smarty_tpl->tpl_vars['brands']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['brand'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['brand']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
$_smarty_tpl->tpl_vars['brand']->_loop = true;
$foreach_brand_Sav = $_smarty_tpl->tpl_vars['brand'];
?>
				<div class="row">
					<div class="checkbox cell">
						<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['brand']->value->id;?>
" />				
					</div>
					<div class="cell">
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'BrandAdmin','id'=>$_smarty_tpl->tpl_vars['brand']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a> 	 			
					</div>
					<div class="icons cell">
						<a class="preview" title="Предпросмотр в новом окне" href="../brands/<?php echo $_smarty_tpl->tpl_vars['brand']->value->url;?>
" target="_blank"></a>				
						<a class="delete"  title="Удалить" href="#"></a>
					</div>
					<div class="clear"></div>
				</div>
				<?php
$_smarty_tpl->tpl_vars['brand'] = $foreach_brand_Sav;
}
?>
			</div>
			
			<div id="action">
				<label id="check_all" class="dash_link">Выбрать все</label>
				
				<span id="select">
					<select name="action">
						<option value="delete">Удалить</option>
					</select>
				</span>
				<input id="apply_action" class="button_green" type="submit" value="Применить">
			</div>
			
		</form>
	</div>
	<?php } else { ?>
		Нет брендов
	<?php }?>
</div>


<?php echo '<script'; ?>
>
$(function() {

	
	
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	

	// Удалить
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
 	
});
<?php echo '</script'; ?>
>

<?php }
}
?>