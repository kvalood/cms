<?php /* Smarty version 3.1.24, created on 2015-07-23 21:34:55
         compiled from "admin/design/html/categories.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:874155b0d15fda8e91_36801206%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b1262b313a4740e07bb609a06bb1d32e79676f0' => 
    array (
      0 => 'admin/design/html/categories.tpl',
      1 => 1437651292,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '874155b0d15fda8e91_36801206',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'level' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55b0d15fdfeda6_03021365',
  'tpl_function' => 
  array (
    'categories_tree' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/7b1262b313a4740e07bb609a06bb1d32e79676f0_0.file.categories.tpl.php',
      'uid' => '7b1262b313a4740e07bb609a06bb1d32e79676f0',
      'call_name' => 'smarty_template_function_categories_tree_874155b0d15fda8e91_36801206',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b0d15fdfeda6_03021365')) {
function content_55b0d15fdfeda6_03021365 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '874155b0d15fda8e91_36801206';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Категории товаров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
	
	<div id="header">
		<h1>Категории товаров</h1>
	</div>
	
	<a href="index.php?module=CategoryAdmin">Добавить категорию +</a>
</div>


<div class="board list_box">
	<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
	<div class="categories">

		<form id="list_form" method="post" data-object="product_categories">
			<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
			
			
			<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

			
			
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
	</div>
	<?php } else { ?>
		Нет категорий
	<?php }?>
</div>


<?php echo '<script'; ?>
>
$(function() {

	// Сортировка списка
	$(".sortable").sortable({
		items:".row",
		handle: ".move_zone",
		tolerance:"pointer",
		scrollSensitivity:40,
		opacity:0.7, 
		axis: "y",
		update:function()
		{
			$("#list_form input[name*='check']").attr('checked', false);
			$("#list_form").ajaxSubmit();
		}
	});
 
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]:not(:disabled)').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:disabled):not(:checked)').length>0);
	});	

	// Показать категорию
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest(".row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'category', 'id': id, 'values': {'visible': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
				{
					line.removeClass('invisible');
					show_modal_message('Категория включена.','message',5000,'bottom-right');
				}
				else
				{
					line.addClass('invisible');
					show_modal_message('Категория выключена.','black',5000,'bottom-right');					
				}
			},
			dataType: 'json'
		});	
		return false;	
	});

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]:first').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});

	
	// Подтвердить удаление
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});

});
<?php echo '</script'; ?>
>
<?php }
}
?><?php
/* smarty_template_function_categories_tree_874155b0d15fda8e91_36801206 */
if (!function_exists('smarty_template_function_categories_tree_874155b0d15fda8e91_36801206')) {
function smarty_template_function_categories_tree_874155b0d15fda8e91_36801206($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
$params = array_merge(array('level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
			<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
			<div id="list" class="sortable">
			
				<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['category']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars['category'];
?>
				<div class="row" data-visible="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->visible, ENT_QUOTES, 'UTF-8', true);?>
">		
					<div class="tree_row">
						<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value->position;?>
">
						<div class="move cell" style="margin-left:<?php echo $_smarty_tpl->tpl_vars['level']->value*20;?>
px"><div class="move_zone"></div></div>
						<div class="checkbox cell">
							<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
" />				
						</div>
						<div class="cell">
							<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CategoryAdmin','id'=>$_smarty_tpl->tpl_vars['category']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a> 	 			
						</div>
						<div class="icons cell">
							<a class="preview" title="Предпросмотр в новом окне" href="../catalog/<?php echo $_smarty_tpl->tpl_vars['category']->value->url;?>
" target="_blank"></a>				
							<a class="enable" title="Активна" href="#"></a>
							<a class="delete" title="Удалить" href="#"></a>
						</div>
						<div class="clear"></div>
					</div>
					<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['category']->value->subcategories,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), false);?>

				</div>
				<?php
$_smarty_tpl->tpl_vars['category'] = $foreach_category_Sav;
}
?>
		
			</div>
			<?php }?>
			<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_categories_tree_874155b0d15fda8e91_36801206 */

?>
