<?php /* Smarty version 3.1.24, created on 2016-03-31 11:19:31
         compiled from "admin/design/html/articles.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:302656fc7b23dff682_05897920%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4500a6de2df5325d521fec18a1354515e191864b' => 
    array (
      0 => 'admin/design/html/articles.tpl',
      1 => 1437896481,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '302656fc7b23dff682_05897920',
  'variables' => 
  array (
    'count_article' => 0,
    'category' => 0,
    'articlecat' => 0,
    'cat' => 0,
    'keyword' => 0,
    'article' => 0,
    'a' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_56fc7b23e6dc11_25630757',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56fc7b23e6dc11_25630757')) {
function content_56fc7b23e6dc11_25630757 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '302656fc7b23dff682_05897920';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Материалы', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="capture_head">
    <div id="header">
        <?php if ($_smarty_tpl->tpl_vars['count_article']->value) {?>
            <h1><?php echo $_smarty_tpl->tpl_vars['count_article']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['count_article']->value,'материал','материалов','материала');?>
</h1>
        <?php } else { ?>
            <h1>Нет материалов.</h1>
        <?php }?>
    </div>

	<a href="index.php?module=ArticleEdit">+ Добавить материал</a>
	
	<div class="search_tools">
	<form method="get" name="search_to">
		<input type="hidden" name="module" value='ArticleAdmin'>
		<div class="select_box">
			<select name="category" class="select_row">
				<option value="">--Все категории--</option>
				<option value="not_cat"<?php if ($_smarty_tpl->tpl_vars['category']->value == 'not_cat') {?> selected="selected"<?php }?>>Без категории</option>
				<?php
$_from = $_smarty_tpl->tpl_vars['articlecat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['cat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
$foreach_cat_Sav = $_smarty_tpl->tpl_vars['cat'];
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['cat']->value->id == $_smarty_tpl->tpl_vars['category']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cat']->value->name;?>
</option>
				<?php
$_smarty_tpl->tpl_vars['cat'] = $foreach_cat_Sav;
}
?>
			</select>
		</div>
		<input type="text" name="keyword" value="<?php if ($_smarty_tpl->tpl_vars['keyword']->value) {
echo $_smarty_tpl->tpl_vars['keyword']->value;
}?>" placeholder="Название материала"/>
		<input class="search_button" type="submit" value="Поиск"/>
		<a href="index.php?module=ArticleAdmin" class="refresh_botton">Сбросить</a>
	</form>
	</div>
</div>


<?php if ($_smarty_tpl->tpl_vars['article']->value) {?>
	<form id="list_form" method="post" data-object="article">
	    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
		<div id="list">
			<div class="list_top">
				<div class="checkbox"></div>
				<div class="name">Название</div>
				<div class="cat">Категория</div>
				<div class="date">Дата создания</div>
				<div class="id">id</div>
			</div>
			
			<?php
$_from = $_smarty_tpl->tpl_vars['article']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['a']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->_loop = true;
$foreach_a_Sav = $_smarty_tpl->tpl_vars['a'];
?>
			<div class="row" data-visible="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value->visible, ENT_QUOTES, 'UTF-8', true);?>
">
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['a']->value->id;?>
" />				
				</div>
				<div class="name cell"><a href="index.php?module=ArticleEdit&id=<?php echo $_smarty_tpl->tpl_vars['a']->value->id;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></div>
				<div class="cat cell">
					<?php
$_from = $_smarty_tpl->tpl_vars['articlecat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['cat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
$foreach_cat_Sav = $_smarty_tpl->tpl_vars['cat'];
?>
						<?php if ($_smarty_tpl->tpl_vars['cat']->value->id == $_smarty_tpl->tpl_vars['a']->value->category) {
echo $_smarty_tpl->tpl_vars['cat']->value->name;
}?>
					<?php
$_smarty_tpl->tpl_vars['cat'] = $foreach_cat_Sav;
}
?>
					<?php if ($_smarty_tpl->tpl_vars['a']->value->category == 0) {?>Без категории<?php }?>
				</div>
				<div class="date cell"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['a']->value->date);?>
</div>
				<div class="id cell"><?php echo $_smarty_tpl->tpl_vars['a']->value->id;?>
</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#"></a>
					<a class="enable" title="Активность" href="#"></a>
				</div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['a'] = $foreach_a_Sav;
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

        <div class="board_footer">
            <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

        </div>
	</form>
<?php }?>




<?php echo '<script'; ?>
>
$(function() {
    
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
	$("form#list_form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});

<?php echo '</script'; ?>
>
<?php }
}
?>