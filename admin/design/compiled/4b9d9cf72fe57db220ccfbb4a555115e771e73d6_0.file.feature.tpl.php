<?php /* Smarty version 3.1.24, created on 2016-05-13 11:42:22
         compiled from "admin/design/html/feature.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:13881573530fe7d13a5_85928373%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4b9d9cf72fe57db220ccfbb4a555115e771e73d6' => 
    array (
      0 => 'admin/design/html/feature.tpl',
      1 => 1448715901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13881573530fe7d13a5_85928373',
  'variables' => 
  array (
    'feature' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'product_category' => 0,
    'categories' => 0,
    'category' => 0,
    'feature_categories' => 0,
    'selected_id' => 0,
    'level' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_573530fe884fd1_20259900',
  'tpl_function' => 
  array (
    'category_select' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/4b9d9cf72fe57db220ccfbb4a555115e771e73d6_0.file.feature.tpl.php',
      'uid' => '4b9d9cf72fe57db220ccfbb4a555115e771e73d6',
      'call_name' => 'smarty_template_function_category_select_13881573530fe7d13a5_85928373',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_573530fe884fd1_20259900')) {
function content_573530fe884fd1_20259900 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '13881573530fe7d13a5_85928373';
if ($_smarty_tpl->tpl_vars['feature']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable(htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->name, ENT_QUOTES, 'UTF-8', true), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новое свойство', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php $_smarty_tpl->_capture_stack[0][] = array('option', null, null); ob_start(); ?>
	<h3>Сброс значений свойств <span id="help"><i>?</i><div id="text">Внимание! Сброс значений свойств подразумевает очистку свойств от лишних символов. Удаляется все кроме цифер и точек у свойств с типом 'Слайдер - диапазон'. Запятые преобразуются в точки.</div></span></h3>
	<a href="index.php?module=FeaturesAdmin&method=reset" class="button_green captufe_all">Сбросить</a>	
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>



<form method=post id="product" class="board">
	<input type=hidden name='session_id' value='<?php echo $_SESSION['id'];?>
'>
	<input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/> 
	
	<div class="capture_head">
		<a href="index.php?module=FeaturesAdmin">← Назад</a>	
		<a href="index.php?module=FeatureAdmin">+ Добавить еще одно свойство</a>	
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>
	
	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Свойство добавлено<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Свойство обновлено<?php }?></span>
	</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
	<div class="message_box message_error">
		<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>У свойства должно быть название<?php }?></span>
	</div>
	<?php }?>

	<div id="name">
		<label style="display: block;margin-bottom: 2px;">Название свойства</label>
		<input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Название свойства"/> 
	</div> 

	<div class="board_subhead">
		<div id="board_column_left">
			<div class="block">
				<h2>Использовать в категориях</h2>
				
				<ul class="list_checkbox">
				
				<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

				</ul>
				
			</div>
		</div>

		<div id="board_column_right">
			<div class="block">
				<h2>Настройки свойства</h2>
				<ul>
					<li>
						<label class="fancy-checkbox">
							<input type="checkbox" name="in_filter" <?php if ($_smarty_tpl->tpl_vars['feature']->value->in_filter || !$_smarty_tpl->tpl_vars['feature']->value->id) {?>checked<?php }?>>
							<span>Использовать в фильтре</span>
						</label>
					</li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['feature']->value->visible || !$_smarty_tpl->tpl_vars['feature']->value->id) {?>checked<?php }?>>
                            <span>Показывать/не показывать на странице товара</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible_category" <?php if ($_smarty_tpl->tpl_vars['feature']->value->visible_category) {?>checked<?php }?>>
                            <span>Показывать/не показывать в каталоге у товара</span>
                        </label>
                    </li>
				</ul>
			</div>
			
			
			<div class="block">
				<h2>Настройки отображения в фильтре</h2>
				<ul>
					<li>
						<label class="fancy-radio">
							<input name="type" type="radio" value="1" <?php if ($_smarty_tpl->tpl_vars['feature']->value->type == 1 || !$_smarty_tpl->tpl_vars['feature']->value->id) {?>checked<?php }?>>
							<span>Группа checkbox</span>
						</label>
						
						<label class="fancy-radio" title="При заполнении свойства, исспользуйте только числовые значения.">
							<input name="type" type="radio" value="2" <?php if ($_smarty_tpl->tpl_vars['feature']->value->type == 2) {?>checked<?php }?>>
							<span>Слайдер - диапазон</span>
						</label>
					</li>
					<li>
						<label class="property">Единица измерения</label><input type="text" name="units" value="<?php echo $_smarty_tpl->tpl_vars['feature']->value->units;?>
"/>
					</li>
					<li>
						<label class="fancy-checkbox">
							<input type="checkbox" name="on_show" <?php if ($_smarty_tpl->tpl_vars['feature']->value->on_show) {?>checked<?php }?>>
							<span>Развернутое/свернутое свойство</span>
						</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="text_block">		
		<h2>Описание свойства</h2>
		<textarea name="text" class="editor_large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value->text, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>

</form><?php }
}
?><?php
/* smarty_template_function_category_select_13881573530fe7d13a5_85928373 */
if (!function_exists('smarty_template_function_category_select_13881573530fe7d13a5_85928373')) {
function smarty_template_function_category_select_13881573530fe7d13a5_85928373($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
$params = array_merge(array('selected_id'=>$_smarty_tpl->tpl_vars['product_category']->value,'level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
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
					<li>
						<label>
							<input type="checkbox" value="<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
" name="feature_categories[]" <?php if (in_array($_smarty_tpl->tpl_vars['category']->value->id,$_smarty_tpl->tpl_vars['feature_categories']->value)) {?>checked<?php }?>/>
							<span><?php echo $_smarty_tpl->tpl_vars['category']->value->name;?>
</span>
						</label>
						
						<?php if ($_smarty_tpl->tpl_vars['category']->value->subcategories) {?>
						<ul>
							<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['category']->value->subcategories,'selected_id'=>$_smarty_tpl->tpl_vars['selected_id']->value,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), false);?>

						</ul>
						<?php }?>
					</li>
				<?php
$_smarty_tpl->tpl_vars['category'] = $foreach_category_Sav;
}
?>
				<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_category_select_13881573530fe7d13a5_85928373 */

?>
