<?php /* Smarty version 3.1.24, created on 2016-04-01 14:02:54
         compiled from "admin/design/html/deliveries.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2963156fdf2ee57ed96_00009402%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98b75dd5e5d1dfbaf1fd52eab5a2ea48726802c2' => 
    array (
      0 => 'admin/design/html/deliveries.tpl',
      1 => 1436816796,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2963156fdf2ee57ed96_00009402',
  'variables' => 
  array (
    'deliveries' => 0,
    'delivery' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_56fdf2ee5f1585_44103927',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56fdf2ee5f1585_44103927')) {
function content_56fdf2ee5f1585_44103927 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2963156fdf2ee57ed96_00009402';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Доставка', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<form id="list_form" method="post">
    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

    <div class="capture_head">
        <div id="header">
            <h1>Доставка</h1>
        </div>
        <a href="index.php?module=DeliveryAdmin">Добавить способ доставки</a>

        <input id='apply_action' class="button_green button_save" type=submit value="Сохранить">
    </div>


	<div id="list" class="board_content">

		<?php
$_from = $_smarty_tpl->tpl_vars['deliveries']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['delivery'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['delivery']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->value) {
$_smarty_tpl->tpl_vars['delivery']->_loop = true;
$foreach_delivery_Sav = $_smarty_tpl->tpl_vars['delivery'];
?>
		<div class="<?php if (!$_smarty_tpl->tpl_vars['delivery']->value->enabled) {?>invisible<?php }?> row">
			<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->position;?>
">
			<div class="move cell"><div class="move_zone"></div></div>
	 		<div class="checkbox cell">
				<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" />
			</div>
			<div class="name cell">
				<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'DeliveryAdmin','id'=>$_smarty_tpl->tpl_vars['delivery']->value->id),$_smarty_tpl);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
			</div>
			<div class="icons cell">
				<a class="enable" title="Активен" href="#"></a>
				<a class="delete" title="Удалить" href="#"></a>
			</div>
			<div class="clear"></div>
		</div>
		<?php
$_smarty_tpl->tpl_vars['delivery'] = $foreach_delivery_Sav;
}
?>
	</div>

	<div id="action">
        <label id="check_all" class='dash_link'>Выбрать все</label>

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

	// Скрыт/Видим
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'delivery', 'id': id, 'values': {'enabled': state}, 'session_id': '<?php echo $_SESSION['id'];?>
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