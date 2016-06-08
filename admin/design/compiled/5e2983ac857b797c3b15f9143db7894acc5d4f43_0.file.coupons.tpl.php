<?php /* Smarty version 3.1.24, created on 2015-06-25 17:24:18
         compiled from "admin/design/html/coupons.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:10516558baca23e8139_68252627%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5e2983ac857b797c3b15f9143db7894acc5d4f43' => 
    array (
      0 => 'admin/design/html/coupons.tpl',
      1 => 1426185905,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10516558baca23e8139_68252627',
  'variables' => 
  array (
    'coupons_count' => 0,
    'coupons' => 0,
    'coupon' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558baca2514df7_91970332',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558baca2514df7_91970332')) {
function content_558baca2514df7_91970332 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/OpenServer/domains/cms/Smarty/libs/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '10516558baca23e8139_68252627';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Купоны', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
		

<div id="header">
	<?php if ($_smarty_tpl->tpl_vars['coupons_count']->value) {?>
	<h1><?php echo $_smarty_tpl->tpl_vars['coupons_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['coupons_count']->value,'купон','купонов','купона');?>
</h1>
	<?php } else { ?>
	<h1>Нет купонов</h1>
	<?php }?>
	<a class="add" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">Новый купон</a>
</div>	

<?php if ($_smarty_tpl->tpl_vars['coupons']->value) {?>
<div id="main_list">
	
	<!-- Листалка страниц -->
	<?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
	
	<!-- Листалка страниц (The End) -->

	<form id="form_list" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list">
			<?php
$_from = $_smarty_tpl->tpl_vars['coupons']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['coupon'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['coupon']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['coupon']->value) {
$_smarty_tpl->tpl_vars['coupon']->_loop = true;
$foreach_coupon_Sav = $_smarty_tpl->tpl_vars['coupon'];
?>
			<div class="<?php if ($_smarty_tpl->tpl_vars['coupon']->value->valid) {?>green<?php }?> row">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['coupon']->value->id;?>
"/>				
				</div>
				<div class="coupon_name cell">			 	
	 				<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','id'=>$_smarty_tpl->tpl_vars['coupon']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['coupon']->value->code;?>
</a>
				</div>
				<div class="coupon_discount cell">			 	
	 				Скидка <?php echo $_smarty_tpl->tpl_vars['coupon']->value->value*1;?>
 <?php if ($_smarty_tpl->tpl_vars['coupon']->value->type == 'absolute') {
echo $_smarty_tpl->tpl_vars['currency']->value->sign;
} else { ?>%<?php }?><br>
	 				<?php if ($_smarty_tpl->tpl_vars['coupon']->value->min_order_price > 0) {?>
	 				<div class="detail">
	 				Для заказов от <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->min_order_price, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

	 				</div>
	 				<?php }?>
				</div>
				<div class="coupon_details cell">			 	
					<?php if ($_smarty_tpl->tpl_vars['coupon']->value->single) {?>
	 				<div class="detail">
	 				Одноразовый
	 				</div>
	 				<?php }?>
	 				<?php if ($_smarty_tpl->tpl_vars['coupon']->value->usages > 0) {?>
	 				<div class="detail">
	 				Использован <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->usages, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['coupon']->value->usages,'раз','раз','раза');?>

	 				</div>
	 				<?php }?>
	 				<?php if ($_smarty_tpl->tpl_vars['coupon']->value->expire) {?>
	 				<div class="detail">
	 				<?php if (smarty_modifier_date_format(time(),'%Y%m%d') <= smarty_modifier_date_format($_smarty_tpl->tpl_vars['coupon']->value->expire,'%Y%m%d')) {?>
	 				Действует до <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['coupon']->value->expire);?>

	 				<?php } else { ?>
	 				Истёк <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['coupon']->value->expire);?>

	 				<?php }?>
	 				</div>
	 				<?php }?>
				</div>
				<div class="icons cell">
					<a href='#' class=delete></a>
				</div>
				<div class="name cell" style='white-space:nowrap;'>
					
	 				
				</div>
				<div class="clear"></div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['coupon'] = $foreach_coupon_Sav;
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

	<!-- Листалка страниц -->
	<?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
	
	<!-- Листалка страниц (The End) -->
	
</div>
<?php }?>




<?php echo '<script'; ?>
>
$(function() {

	// Раскраска строк
	function colorize()
	{
		$("#list div.row:even").addClass('even');
		$("#list div.row:odd").removeClass('even');
	}
	// Раскрасить строки сразу
	colorize();

	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
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