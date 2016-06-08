<?php /* Smarty version 3.1.24, created on 2016-06-04 02:37:12
         compiled from "admin/design/html/menu_id_list.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:102785751b2381f9f78_70860592%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bfe2ae54173891819a8f76c5ed2ec289fce84bb5' => 
    array (
      0 => 'admin/design/html/menu_id_list.tpl',
      1 => 1464945792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '102785751b2381f9f78_70860592',
  'variables' => 
  array (
    'cat_cat' => 0,
    'menu' => 0,
    'm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5751b238250eb1_52560360',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5751b238250eb1_52560360')) {
function content_5751b238250eb1_52560360 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '102785751b2381f9f78_70860592';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Список пунктов меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="content_header">
    <div id="header">
        <h1>Список пунктов меню <i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat_cat']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</i></h1>
    </div>

	<a href="index.php?module=MenuAdmin">← Назад</a>
	<a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['cat_cat']->value->id;?>
&mode=add" class="add">+ Добавить новый пункт меню</a>
</div>

<?php if ($_smarty_tpl->tpl_vars['menu']->value) {?>
	<form id="list_form" method="post" class="board_content" data-object="menu_item">
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
			<div class="row" data-visible="<?php echo $_smarty_tpl->tpl_vars['m']->value->visible;?>
">
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
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
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