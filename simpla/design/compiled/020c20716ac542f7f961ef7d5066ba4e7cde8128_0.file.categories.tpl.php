<?php
/* Smarty version 3.1.32, created on 2018-07-12 23:11:17
  from 'C:\SERVER\domains\cms\simpla\design\html\categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b475375b035d6_52722588',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '020c20716ac542f7f961ef7d5066ba4e7cde8128' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\categories.tpl',
      1 => 1478846120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b475375b035d6_52722588 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'categories_tree' => 
  array (
    'compiled_filepath' => 'C:\\SERVER\\domains\\cms\\simpla\\design\\compiled\\020c20716ac542f7f961ef7d5066ba4e7cde8128_0.file.categories.tpl.php',
    'uid' => '020c20716ac542f7f961ef7d5066ba4e7cde8128',
    'call_name' => 'smarty_template_function_categories_tree_7206832595b47537589e445_89129722',
  ),
));
$_smarty_tpl->_assignInScope('meta_title', 'Категории товаров' ,false ,2);?>

<div class="content_header">
    <h1>Категории товаров</h1>

    <div class="buttons">
        <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'CategoryAdmin'),$_smarty_tpl ) );?>
" class="button green">Добавить категорию</a>
    </div>
</div>

<div class="board">
	<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
		<form method="post" data-object="category">

			<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

            <div class="listObjects">
                <div class="listBody">
                
                <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'categories_tree', array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

                </div>
			
			
			<div id="action">
                <input type="checkbox" id="check_all" />

				<select name="action">
					<option value="enable">Сделать видимыми</option>
					<option value="disable">Сделать невидимыми</option>
					<option value="delete">Удалить</option>
				</select>
				
				<input class="button green" type="submit" value="Применить">
			</div>
		
		</form>
	<?php } else { ?>
		Категории отсутствуют
	<?php }?>
</div>


<?php echo '<script'; ?>
>
$(function() {

	// Сортировка списка
	$(".sortable").sortable({
		items:".listItem",
		tolerance:"pointer",
		scrollSensitivity:40,
		opacity:0.7, 
		axis: "y",
        placeholder:"clear_state ui-state-highlight",
		update:function()
		{
			$(".board form input[name*='check']").attr('checked', false);
			$(".board form").ajaxSubmit();
		}
	});

});
<?php echo '</script'; ?>
>
<?php }
/* smarty_template_function_categories_tree_7206832595b47537589e445_89129722 */
if (!function_exists('smarty_template_function_categories_tree_7206832595b47537589e445_89129722')) {
function smarty_template_function_categories_tree_7206832595b47537589e445_89129722(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

                <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
                    <ul class="sortable">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
                        <li class="listItem<?php if ($_smarty_tpl->tpl_vars['level']->value) {?> subItem<?php }?>">
                            <div<?php if ($_smarty_tpl->tpl_vars['level']->value) {?> style="padding-left:<?php echo $_smarty_tpl->tpl_vars['level']->value*2;?>
7px"<?php }?>>
                                <input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value->position;?>
">
                                <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
" />
                                <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'CategoryAdmin','id'=>$_smarty_tpl->tpl_vars['category']->value->id),$_smarty_tpl ) );?>
" title="Редактировать категорию"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>

                                <div class="control">
                                    <a class="preview" href="../catalog/<?php echo $_smarty_tpl->tpl_vars['category']->value->url;?>
" target="_blank" title="Посмотреть на сайте" ></a>
                                    <a class="visible<?php if ($_smarty_tpl->tpl_vars['category']->value->visible) {?> on<?php }?>" title="Активна" href="#"></a>
                                    <a class="delete" title="Удалить" href="#"></a>
                                </div>
                            </div>

                            <?php $_smarty_tpl->smarty->ext->_tplFunction->callTemplateFunction($_smarty_tpl, 'categories_tree', array('categories'=>$_smarty_tpl->tpl_vars['category']->value->subcategories,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), true);?>


                        </li>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                <?php }?>
                <?php
}}
/*/ smarty_template_function_categories_tree_7206832595b47537589e445_89129722 */
}
