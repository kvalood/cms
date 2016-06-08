<?php /* Smarty version 3.1.24, created on 2015-07-14 05:49:01
         compiled from "admin/design/html/payment_methods.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2105755a4162de3cf19_82101135%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f71e0f4f9f83905ffce92061409c5997d458d2b5' => 
    array (
      0 => 'admin/design/html/payment_methods.tpl',
      1 => 1436816835,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2105755a4162de3cf19_82101135',
  'variables' => 
  array (
    'payment_methods' => 0,
    'payment_method' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a4162de7f5a0_75158388',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a4162de7f5a0_75158388')) {
function content_55a4162de7f5a0_75158388 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2105755a4162de3cf19_82101135';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Способы оплаты', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
    <div id="header">
        <h1>Способы оплаты</h1>
    </div>
    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'PaymentMethodAdmin'),$_smarty_tpl);?>
">Добавить способ оплаты</a>
</div>

<div id="main_list" class="board_content">
	<form id="list_form" method="post">
	    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list">			
			<?php
$_from = $_smarty_tpl->tpl_vars['payment_methods']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['payment_method'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['payment_method']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->_loop = true;
$foreach_payment_method_Sav = $_smarty_tpl->tpl_vars['payment_method'];
?>
			<div class="<?php if (!$_smarty_tpl->tpl_vars['payment_method']->value->enabled) {?>invisible<?php }?> row">
				<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->position;?>
">
				<div class="move cell"><div class="move_zone"></div></div>
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
" />				
				</div>
				<div class="name cell">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'PaymentMethodAdmin','id'=>$_smarty_tpl->tpl_vars['payment_method']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['payment_method']->value->name;?>
</a>
				</div>
				<div class="icons cell">
					<a class="enable" title="Активен" href="#"></a>
					<a class="delete" title="Удалить" href="#"></a>
				</div>
				<div class="clear"></div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['payment_method'] = $foreach_payment_method_Sav;
}
?>
		</div>
	
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id="select">
            <select name="action">
                <option value="enable">Включить</option>
                <option value="disable">Выключить</option>
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>
</div>



<?php echo '<script'; ?>
>
$(function() {

	// Сортировка списка
	$("#list").sortable({
		items:             ".row",
		tolerance:         "pointer",
		handle:            ".move_zone",
		scrollSensitivity: 40,
		opacity:           0.7, 
		forcePlaceholderSize: true,
		axis: 'y',
		
		helper: function(event, ui){		
			if($('input[type="checkbox"][name*="check"]:checked').size()<1) return ui;
			var helper = $('<div/>');
			$('input[type="checkbox"][name*="check"]:checked').each(function(){
				var item = $(this).closest('.row');
				helper.height(helper.height()+item.innerHeight());
				if(item[0]!=ui[0]) {
					helper.append(item.clone());
					$(this).closest('.row').remove();
				}
				else {
					helper.append(ui.clone());
					item.find('input[type="checkbox"][name*="check"]').attr('checked', false);
				}
			});
			return helper;			
		},	
 		start: function(event, ui) {
  			if(ui.helper.children('.row').size()>0)
				$('.ui-sortable-placeholder').height(ui.helper.height());
		},
		beforeStop:function(event, ui){
			if(ui.helper.children('.row').size()>0){
				ui.helper.children('.row').each(function(){
					$(this).insertBefore(ui.item);
				});
				ui.item.remove();
			}
		},
		update:function(event, ui)
		{
			$("#list_form input[name*='check']").attr('checked', false);
			$("#list_form").ajaxSubmit(function() {
				colorize();
			});
		}
	}); 


	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});

	// Показать товар
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'payment', 'id': id, 'values': {'enabled': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
					line.removeClass('invisible');
				else
					line.addClass('invisible');				
			},
			dataType: 'json'
		});	
		return false;	
	});

	
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});
<?php echo '</script'; ?>
>
<?php }
}
?>