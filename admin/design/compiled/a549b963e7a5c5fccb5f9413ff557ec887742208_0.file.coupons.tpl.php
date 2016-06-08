<?php /* Smarty version 3.1.24, created on 2015-07-15 13:33:56
         compiled from "admin/design/html/coupons.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1229255a5d4a4a964e0_69422854%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a549b963e7a5c5fccb5f9413ff557ec887742208' => 
    array (
      0 => 'admin/design/html/coupons.tpl',
      1 => 1436931234,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1229255a5d4a4a964e0_69422854',
  'variables' => 
  array (
    'coupons_count' => 0,
    'coupons' => 0,
    'coupon' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5d4a4b03af3_46936791',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5d4a4b03af3_46936791')) {
function content_55a5d4a4b03af3_46936791 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '1229255a5d4a4a964e0_69422854';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Купоны', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
    <div id="header">
        <h1>
        <?php if ($_smarty_tpl->tpl_vars['coupons_count']->value) {?>
           <?php echo $_smarty_tpl->tpl_vars['coupons_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['coupons_count']->value,'купон','купонов','купона');?>

        <?php } else { ?>
            Нет купонов
        <?php }?>
        </h1>
    </div>

    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin'),$_smarty_tpl);?>
">+ Добавить купон</a>
</div>


<?php if ($_smarty_tpl->tpl_vars['coupons']->value) {?>
<div class="board">

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
				<div class="name cell">
	 				<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','id'=>$_smarty_tpl->tpl_vars['coupon']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['coupon']->value->code;?>
</a>
                    <br/>
                    <?php if ($_smarty_tpl->tpl_vars['coupon']->value->min_order_price > 0) {?>
                        <div class="sub_name">Для заказов от <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->min_order_price, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div>
                    <?php }?>
				</div>
				<div class="cat cell">
	 				Скидка <?php echo $_smarty_tpl->tpl_vars['coupon']->value->value*1;?>
 <?php if ($_smarty_tpl->tpl_vars['coupon']->value->type == 'absolute') {
echo $_smarty_tpl->tpl_vars['currency']->value->sign;
} else { ?>%<?php }?><br>
				</div>
				<div class="cat cell">
					<?php if ($_smarty_tpl->tpl_vars['coupon']->value->single) {?>
	 				Одноразовый
	 				<?php }?>
	 				<?php if ($_smarty_tpl->tpl_vars['coupon']->value->usages > 0) {?>
	 				Использован <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->usages, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['coupon']->value->usages,'раз','раз','раза');?>

	 				<?php }?>
	 				<?php if ($_smarty_tpl->tpl_vars['coupon']->value->expire) {?>
	 				<?php if (smarty_modifier_date_format(time(),'%Y%m%d') <= smarty_modifier_date_format($_smarty_tpl->tpl_vars['coupon']->value->expire,'%Y%m%d')) {?>
	 				Действует до <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['coupon']->value->expire);?>

	 				<?php } else { ?>
	 				Истёк <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['coupon']->value->expire);?>

	 				<?php }?>
	 				<?php }?>
				</div>
				<div class="icons cell">
					<a href='#' class=delete></a>
				</div>
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

    <div class="board_footer">
        <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    </div>
	
</div>
<?php }?>



<?php echo '<script'; ?>
>
$(function() {

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