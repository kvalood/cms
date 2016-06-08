<?php /* Smarty version 3.1.24, created on 2016-06-08 03:26:23
         compiled from "admin/design/html/features.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:21827575703bf045e52_34217983%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0641c1d612403ad03cbca75d75887f6d51ead579' => 
    array (
      0 => 'admin/design/html/features.tpl',
      1 => 1464945792,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21827575703bf045e52_34217983',
  'variables' => 
  array (
    'reset' => 0,
    'features' => 0,
    'feature' => 0,
    'categories' => 0,
    'category' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575703bf0b1735_81184743',
  'tpl_function' => 
  array (
    'categories_tree' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/0641c1d612403ad03cbca75d75887f6d51ead579_0.file.features.tpl.php',
      'uid' => '0641c1d612403ad03cbca75d75887f6d51ead579',
      'call_name' => 'smarty_template_function_categories_tree_21827575703bf045e52_34217983',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575703bf0b1735_81184743')) {
function content_575703bf0b1735_81184743 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '21827575703bf045e52_34217983';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Свойства товаров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>



<?php $_smarty_tpl->_capture_stack[0][] = array('option', null, null); ob_start(); ?>
	<h3>Сброс значений свойств <span id="help"><i>?</i><div id="text">Внимание! Сброс значений свойств подразумевает очистку свойств от лишних символов. Удаляется все кроме цифер и точек у свойств с типом 'Слайдер - диапазон'. Запятые преобразуются в точки.</div></span></h3>
	<a href="index.php?module=FeaturesAdmin&method=reset" class="button_green captufe_all">Сбросить</a>	
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


<div class="content_header">
	
	<div id="header">
		<h1>Свойства товаров</h1>
	</div>
	
	<a href="index.php?module=FeatureAdmin">+ Добавить свойство</a>
</div>	

<div class="board">
	<?php if ($_smarty_tpl->tpl_vars['reset']->value) {?>
		<?php echo $_smarty_tpl->tpl_vars['reset']->value;?>

	<?php }?>
	
	
	<?php if ($_smarty_tpl->tpl_vars['features']->value) {?>
	<div class="board_content">		
		<form id="list_form" method="post" class="left_board" data-object="feature">
			<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

			<div id="list">
				<?php
$_from = $_smarty_tpl->tpl_vars['features']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['feature']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
$foreach_feature_Sav = $_smarty_tpl->tpl_vars['feature'];
?>
				<div class="row" data-visible="<?php echo $_smarty_tpl->tpl_vars['feature']->value->in_filter;?>
">
					<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['feature']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['feature']->value->position;?>
">
					<div class="move cell"><div class="move_zone"></div></div>
					<div class="checkbox cell">
						<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['feature']->value->id;?>
" />				
					</div>
					<div class="cell">
						<a href="index.php?module=FeatureAdmin&id=<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
					</div>
					<div class="icons cell">
						<a title="Использовать в фильтре" class="in_filter" href='#' ></a>
						<a title="Удалить" class="delete" href='#' ></a>
					</div>
					<div class="clear"></div>
				</div>
				<?php
$_smarty_tpl->tpl_vars['feature'] = $foreach_feature_Sav;
}
?>
			</div>
			
			<div id="action">
				<label id="check_all" class="dash_link">Выбрать все</label>
		
				<span id="select">
					<select name="action">
						<option value="set_in_filter">Использовать в фильтре</option>
						<option value="unset_in_filter">Не использовать в фильтре</option>
						<option value="delete">Удалить</option>
					</select>
				</span>
		
				<input id="apply_action" class="button_green" type="submit" value="Применить">
			</div>
		</form>
		
		<div class="right_board">
			<div id="right_head">Фильтр по категориям</div>

			
			<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

		</div>

	</div>
	<?php } else { ?>
		Нет свойств
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
		axis: 'y',
		scrollSensitivity: 40,
		opacity:           0.7, 
		forcePlaceholderSize: true,
		
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
?><?php
/* smarty_template_function_categories_tree_21827575703bf045e52_34217983 */
if (!function_exists('smarty_template_function_categories_tree_21827575703bf045e52_34217983')) {
function smarty_template_function_categories_tree_21827575703bf045e52_34217983($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
			<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
			<ul class="filter">
				<?php if ($_smarty_tpl->tpl_vars['categories']->value[0]->parent_id == 0) {?>
				<li <?php if (!$_smarty_tpl->tpl_vars['category']->value->id) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('category_id'=>null),$_smarty_tpl);?>
">Все категории</a></li>	
				<?php }?>
				<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['c']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
$foreach_c_Sav = $_smarty_tpl->tpl_vars['c'];
?>
				<li <?php if ($_smarty_tpl->tpl_vars['category']->value->id == $_smarty_tpl->tpl_vars['c']->value->id) {?>class="selected"<?php }?>><a href="index.php?module=FeaturesAdmin&category_id=<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['c']->value->name;?>
</a></li>
				<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['c']->value->subcategories), false);?>

				<?php
$_smarty_tpl->tpl_vars['c'] = $foreach_c_Sav;
}
?>
			</ul>
			<?php }?>
			<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_categories_tree_21827575703bf045e52_34217983 */

?>
