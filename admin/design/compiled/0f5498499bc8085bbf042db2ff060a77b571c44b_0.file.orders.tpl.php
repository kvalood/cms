<?php /* Smarty version 3.1.24, created on 2016-06-03 04:21:37
         compiled from "admin/design/html/orders.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:259957507931b0d679_19502343%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0f5498499bc8085bbf042db2ff060a77b571c44b' => 
    array (
      0 => 'admin/design/html/orders.tpl',
      1 => 1437073468,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '259957507931b0d679_19502343',
  'variables' => 
  array (
    'orders_count' => 0,
    'label' => 0,
    'keyword' => 0,
    'message_error' => 0,
    'orders' => 0,
    'order' => 0,
    'l' => 0,
    'currency' => 0,
    'status' => 0,
    'labels' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_57507931ea44c8_93477420',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57507931ea44c8_93477420')) {
function content_57507931ea44c8_93477420 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '259957507931b0d679_19502343';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Заказы', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
    <div id="header">
        <h1><?php if ($_smarty_tpl->tpl_vars['orders_count']->value) {
echo $_smarty_tpl->tpl_vars['orders_count']->value;
} else { ?>Нет<?php }?> заказ<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['orders_count']->value,'','ов','а');?>
</h1>
    </div>


    <?php if ($_smarty_tpl->tpl_vars['label']->value) {?>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrdersAdmin','label'=>null),$_smarty_tpl);?>
">← Назад</a>
    <?php }?>

    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin','id'=>null),$_smarty_tpl);?>
">+ Добавить заказ</a>

    <div class="search_tools">
        <form method="get" name="search_to">
            <input type="hidden" name="module" value='OrdersAdmin'>
            <input type="text" name="keyword" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);?>
"/>
            <input class="search_button" type="submit" value="Поиск"/>
            <a href="index.php?module=ArticleAdmin" class="refresh_botton">Сбросить</a>
        </form>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<div class="message_box message_error">
	<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'error_closing') {?>Нехватка некоторых товаров на складе<?php }?></span>
</div>
<?php }?>

<div class="board">

    <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
    <div class="board_content">
        <form id="list_form" class="left_board" method="post">
            <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

            <div class="board_subhead">
                <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            </div>

            <div id="list">
                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="date">№ заказа</div>
                    <div class="user_name">Заказчик</div>
                    <div class="date">Сумма заказа</div>
                    <div class="date">Дата заказа</div>
                </div>

                <?php
$_from = $_smarty_tpl->tpl_vars['orders']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['order'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['order']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->_loop = true;
$foreach_order_Sav = $_smarty_tpl->tpl_vars['order'];
?>
                <div class="<?php if ($_smarty_tpl->tpl_vars['order']->value->paid) {?>green<?php }?> row">
                    <div class="checkbox cell">
                        <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
"/>
                    </div>
                    <div class="date cell">
                        <?php
$_from = $_smarty_tpl->tpl_vars['order']->value->labels;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['l']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
$foreach_l_Sav = $_smarty_tpl->tpl_vars['l'];
?>
                        <span class="order_label" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['l']->value->color;?>
;" title="<?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>
"></span>
                        <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
                        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin','id'=>$_smarty_tpl->tpl_vars['order']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">Заказ №<?php echo $_smarty_tpl->tpl_vars['order']->value->id;?>
</a>
                        <?php if ($_smarty_tpl->tpl_vars['order']->value->note) {?>
                        <div class="note"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->note, ENT_QUOTES, 'UTF-8', true);?>
</div>
                        <?php }?>
                    </div>
                    <div class="user_name cell">
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->name, ENT_QUOTES, 'UTF-8', true);?>

                    </div>
                    <div class="date cell" style='white-space:nowrap;'>
                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->total_price, ENT_QUOTES, 'UTF-8', true);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                    </div>
                    <div class="date cell">
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['order']->value->date);?>
 в <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['order']->value->date);?>

                    </div>

                    <div class="icons cell">
                        <?php if ($_smarty_tpl->tpl_vars['keyword']->value) {?>
                            <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 0) {?>
                                <img src='design/images/new.png' alt='Новый' title='Новый'>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 1) {?>
                                <img src='design/images/time.png' alt='Принят' title='Принят'>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 2) {?>
                                <img src='design/images/tick.png' alt='Выполнен' title='Выполнен'>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 3) {?>
                                <img src='design/images/cross.png' alt='Удалён' title='Удалён'>
                            <?php }?>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['order']->value->paid) {?>
                            <img src='design/images/cash_stack.png' alt='Оплачен' title='Оплачен'>
                        <?php } else { ?>
                            <img src='design/images/cash_stack_gray.png' alt='Не оплачен' title='Не оплачен'>
                        <?php }?>

                        <a href='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin','id'=>$_smarty_tpl->tpl_vars['order']->value->id,'view'=>'print'),$_smarty_tpl);?>
'  target="_blank" class="print" title="Печать заказа"></a>
                        <a href='#' class=delete title="Удалить"></a>
                    </div>
                </div>
                <?php
$_smarty_tpl->tpl_vars['order'] = $foreach_order_Sav;
}
?>
		    </div>
	
            <div id="action">
                <label id='check_all' class="dash_link">Выбрать все</label>

                <span id="select">
                <select name="action">
                    <?php if ($_smarty_tpl->tpl_vars['status']->value !== 0) {?><option value="set_status_0">В новые</option><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['status']->value !== 1) {?><option value="set_status_1">В принятые</option><?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['status']->value !== 2) {?><option value="set_status_2">В выполненные</option><?php }?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['labels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['l']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
$foreach_l_Sav = $_smarty_tpl->tpl_vars['l'];
?>
                    <option value="set_label_<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
">Отметить &laquo;<?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>
&raquo;</option>
                    <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['labels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['l']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
$foreach_l_Sav = $_smarty_tpl->tpl_vars['l'];
?>
                    <option value="unset_label_<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
">Снять &laquo;<?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>
&raquo;</option>
                    <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
                    <option value="delete">Удалить выбранные заказы</option>
                </select>
                </span>

                <input id="apply_action" class="button_green" type="submit" value="Применить">

            </div>
	    </form>

        <div class="right_board">
            <div id="right_head">Фильтр по меткам</div>

            <?php if ($_smarty_tpl->tpl_vars['labels']->value) {?>
            <ul class="filter">
                <li <?php if (!$_smarty_tpl->tpl_vars['label']->value) {?>class="selected"<?php }?>><span class="label"></span> <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('label'=>null),$_smarty_tpl);?>
">Все заказы</a></li>
                <?php
$_from = $_smarty_tpl->tpl_vars['labels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['l']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
$foreach_l_Sav = $_smarty_tpl->tpl_vars['l'];
?>
                    <li data-label-id="<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['label']->value->id == $_smarty_tpl->tpl_vars['l']->value->id) {?>class="selected"<?php }?>>
                        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('label'=>$_smarty_tpl->tpl_vars['l']->value->id),$_smarty_tpl);?>
"><span style="background-color:#<?php echo $_smarty_tpl->tpl_vars['l']->value->color;?>
;" class="order_label"></span><?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>
</a></li>
                <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
            </ul>
            <?php }?>
        </div>
    </div>

    <div class="board_footer">
        <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

    </div>

</div>
<?php } else { ?>
    Нет ни одного заказа
<?php }?>



<?php echo '<script'; ?>
>

$(function() {

	// Сортировка списка
	$("#labels").sortable({
		items:             "li",
		tolerance:         "pointer",
		scrollSensitivity: 40,
		opacity:           0.7
	});
	
	$("#main_list #list .row").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){
			label_id = $(ui.helper).attr('data-label-id');
			$(this).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			$(this).closest("form").find('select[name="action"] option[value=set_label_'+label_id+']').attr("selected", "selected");		
			$(this).closest("form").submit();
			return false;	
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