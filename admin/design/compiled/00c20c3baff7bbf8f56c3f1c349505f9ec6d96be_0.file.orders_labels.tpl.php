<?php /* Smarty version 3.1.24, created on 2015-06-23 23:24:09
         compiled from "admin/design/html/orders_labels.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2670055895df9543dc2_11592162%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00c20c3baff7bbf8f56c3f1c349505f9ec6d96be' => 
    array (
      0 => 'admin/design/html/orders_labels.tpl',
      1 => 1435065847,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2670055895df9543dc2_11592162',
  'variables' => 
  array (
    'labels' => 0,
    'label' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55895df99b4a41_30102150',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55895df99b4a41_30102150')) {
function content_55895df99b4a41_30102150 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2670055895df9543dc2_11592162';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Метки заказов', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="capture_head">
    
    <div id="header">
        <h1>
            <?php if ($_smarty_tpl->tpl_vars['labels']->value) {?>Метки заказов<?php } else { ?>Нет меток<?php }?>
        </h1>
    </div>

    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrdersLabelAdmin'),$_smarty_tpl);?>
">+ Созодать метку</a>
</div>


<div class="board">
<?php if ($_smarty_tpl->tpl_vars['labels']->value) {?>
    <div id="main_list">

        <form id="list_form" method="post">
            <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

            <div id="list">
                <?php
$_from = $_smarty_tpl->tpl_vars['labels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['label'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['label']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['label']->value) {
$_smarty_tpl->tpl_vars['label']->_loop = true;
$foreach_label_Sav = $_smarty_tpl->tpl_vars['label'];
?>
                <div class="row">
                    <input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['label']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['label']->value->position;?>
">
                    <div class="move cell"><div class="move_zone"></div></div>
                    <div class="checkbox cell">
                        <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['label']->value->id;?>
" />
                    </div>
                    <div class="name cell">
                        <span style="background-color:#<?php echo $_smarty_tpl->tpl_vars['label']->value->color;?>
;" class="order_label"></span>
                        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrdersLabelAdmin','id'=>$_smarty_tpl->tpl_vars['label']->value->id),$_smarty_tpl);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
                    </div>
                    <div class="icons cell">
                        <a class="delete" title="Удалить" href="#"></a>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
$_smarty_tpl->tpl_vars['label'] = $foreach_label_Sav;
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
	Нет меток
<?php }?>
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

 
	// Раскраска строк
	function colorize()
	{
		$(".row:even").addClass('even');
		$(".row:odd").removeClass('even');
	}
	// Раскрасить строки сразу
	colorize();
 

	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list_form input[type="checkbox"][name*="check"]').attr('checked', false);
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