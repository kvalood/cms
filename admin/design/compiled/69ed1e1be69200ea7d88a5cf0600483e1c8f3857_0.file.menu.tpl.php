<?php /* Smarty version 3.1.24, created on 2015-07-17 04:46:11
         compiled from "admin/design/html/menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:356355a7fbf394bc51_48802292%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69ed1e1be69200ea7d88a5cf0600483e1c8f3857' => 
    array (
      0 => 'admin/design/html/menu.tpl',
      1 => 1437067604,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '356355a7fbf394bc51_48802292',
  'variables' => 
  array (
    'menu' => 0,
    'm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a7fbf398e2e8_89431854',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a7fbf398e2e8_89431854')) {
function content_55a7fbf398e2e8_89431854 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '356355a7fbf394bc51_48802292';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Меню сайта', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
    <div id="header">
        <h1>Управление меню</h1>
    </div>

	<a href="index.php?module=MenuAdmin&method=create_menu">Создать новое меню</a>
</div>



<?php if ($_smarty_tpl->tpl_vars['menu']->value) {?>
	<form id="list_form" method="post" class="board_content">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<div id="list">
			<div class="list_top">
				<div class="checkbox"></div>
				<div class="name">Название</div>
				<div class="id">id</div>
			</div>
			
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
			<div class="row">
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
" />				
				</div>
				<div class="name cell"><a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
" title="Смотреть пункты меню"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['m']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a></div>
				<div class="id cell"><?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#" data="<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
"></a>
					<a class="edit" title="Редактировать меню" href="index.php?module=MenuAdmin&method=create_menu&id=<?php echo $_smarty_tpl->tpl_vars['m']->value->id;?>
"></a>
				</div>			
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
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>
<?php } else { ?>
	Нет созданных меню
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
		$(this).closest(".article_id").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('При удалении меню, все пункты этого меню будут удалены. Удаляем?'))
			return false;	
	});
});

<?php echo '</script'; ?>
>

<?php }
}
?>