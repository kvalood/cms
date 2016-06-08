<?php /* Smarty version 3.1.24, created on 2015-06-15 15:13:20
         compiled from "admin/design/html/menu_id_list.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:24057557e5ef0ee0a89_28898169%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df955efa0c465db2aea4c3b37ddaf57cba996d01' => 
    array (
      0 => 'admin/design/html/menu_id_list.tpl',
      1 => 1432912958,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24057557e5ef0ee0a89_28898169',
  'variables' => 
  array (
    'cat_cat' => 0,
    'menu' => 0,
    'm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_557e5ef10715b0_61993908',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_557e5ef10715b0_61993908')) {
function content_557e5ef10715b0_61993908 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24057557e5ef0ee0a89_28898169';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Список меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
    <div id="header">
        <h1>Список пунктов меню <i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat_cat']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</i></h1>
    </div>

	<a href="index.php?module=MenuAdmin">← Назад</a>
	<a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['cat_cat']->value->id;?>
&mode=add" class="add">+ Добавить новый пункт меню</a>
</div>

<?php if ($_smarty_tpl->tpl_vars['menu']->value) {?>
	<form id="list_form" method="post" class="board_content">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<div id="list">		
			<?php
$_from = $_smarty_tpl->tpl_vars['menu']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['m'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['m']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
$foreach_m_Sav = $_smarty_tpl->tpl_vars['m'];
?>
			<div class="<?php if (!$_smarty_tpl->tpl_vars['m']->value->visible) {?>invisible<?php }?> row">
				<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['m']->value->position;?>
">
				<div class="move cell"><div class="move_zone"></div></div>
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
" />				
				</div>
				<div class="name cell">
					<a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['cat_cat']->value->id;?>
&mode=add&id=<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a><br/>
					<div class="sub_name">Тип меню - <?php if ($_smarty_tpl->tpl_vars['m']->value->type == 1) {?>Материал<?php } elseif ($_smarty_tpl->tpl_vars['m']->value->type == 2) {?>Категория материалов<?php } elseif ($_smarty_tpl->tpl_vars['m']->value->type == 3) {?>URL<?php }?></div>
				</div>
				<div class="icons cell">
					<a class="home_page <?php if ($_smarty_tpl->tpl_vars['m']->value->home == 1) {?>home<?php } else { ?>no_home<?php }?>" href="#" title="Главная страница"></a>
					<a class="preview" title="Предпросмотр в новом окне" href="../<?php echo $_smarty_tpl->tpl_vars['m']->value->url;?>
" target="_blank"></a>
					<a class="enable" title="Активна" href="#"></a>
					<a class="delete" title="Удалить" href="#"></a>
				</div>
				<div class="clear"></div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['m'] = $foreach_m_Sav;
}
?>
		</div>
	
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id="select">
            <select name="action">
                <option value="enable">Сделать видимыми</option>
                <option value="disable">Сделать невидимыми</option>
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>	
<?php } else { ?>
	Нет пунктов меню
<?php }?>



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
	

	// Показать
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'menu', 'id': id, 'values': {'visible': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				show_modal_message('Сохранено','message',3000,'bottom-right');
				if(state)
					line.removeClass('invisible');
				else
					line.addClass('invisible');				
			},
			dataType: 'json'
		});	
		return false;	
	});
	
	// Назначить главной страницей
	$('.home_page').click(function(){
		var id = $(this).closest('.row').find('input[name*="check[]"]').val();
		if(confirm('Назначить страницу главной?')){
		$('.row').find('.home_page.home').removeClass('home').addClass('no_home');
		$(this).removeClass('no_home').addClass('home');
		
			$.ajax({
				type: 'POST',
				url: 'ajax/update_object.php',
				data: {'object': 'menu_home', 'id': id, 'values': {'home': 0}, 'values2': {'home': 1}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
				success: function(data){
					show_modal_message('Сохранено','message',3000,'bottom-right');
				},
				dataType: 'json'
			});
		}
	
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