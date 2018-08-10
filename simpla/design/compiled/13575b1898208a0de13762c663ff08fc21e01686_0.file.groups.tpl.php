<?php
/* Smarty version 3.1.32, created on 2018-08-10 14:24:55
  from 'C:\SERVER\domains\cms\simpla\design\html\groups.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b6d1397795e18_81612688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '13575b1898208a0de13762c663ff08fc21e01686' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\groups.tpl',
      1 => 1464945792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b6d1397795e18_81612688 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', 'Группы пользователей' ,false ,2);?>

<div class="content_header">
    <div id="header">
        <h1>Группы пользователей</h1>
    </div>

    <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'GroupAdmin'),$_smarty_tpl ) );?>
">+ Добавить группу</a>
</div>


<!-- Основная часть -->
<?php if ($_smarty_tpl->tpl_vars['groups']->value) {?>
	<form id="list_form" method="post">
        <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
        <div id="list">

            <div class="list_top">
                <div class="checkbox"></div>
                <div class="name">Название группы</div>
                <div class="date">Скидка</div>
            </div>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'group');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['group']->value) {
?>
            <div class="row">
                <div class="checkbox cell">
                    <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"/>
                </div>
                <div class="name cell">
                    <a href="index.php?module=GroupAdmin&id=<?php echo $_smarty_tpl->tpl_vars['group']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
</a>
                </div>
                <div class="date cell">
                    <?php echo $_smarty_tpl->tpl_vars['group']->value->discount;?>
 %
                </div>
                <div class="icons cell">
                    <a class="delete" title="Удалить" href="#"></a>
                </div>
            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>

        <div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id=select>
            <select name="action">
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
        </div>
	</form>
<?php }?>



<?php echo '<script'; ?>
>
$(function() {
	
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
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
