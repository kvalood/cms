<?php /* Smarty version 3.1.24, created on 2015-06-24 00:49:00
         compiled from "admin/design/html/orders_label.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3405558971dc3e11b8_12655390%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '13837d109a2fa8a41978b18e1644eb878a1446fd' => 
    array (
      0 => 'admin/design/html/orders_label.tpl',
      1 => 1435070939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3405558971dc3e11b8_12655390',
  'variables' => 
  array (
    'label' => 0,
    'message_success' => 0,
    'message_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558971dc4b0265_30321253',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558971dc4b0265_30321253')) {
function content_558971dc4b0265_30321253 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3405558971dc3e11b8_12655390';
if ($_smarty_tpl->tpl_vars['label']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['label']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новая метка', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<link rel="stylesheet" media="screen" type="text/css" href="design/js/colorpicker/css/colorpicker.css" />
<?php echo '<script'; ?>
 type="text/javascript" src="design/js/colorpicker/js/colorpicker.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(function() {
	$('#color_icon, #color_link').ColorPicker({
		color: $('#color_input').val(),
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#color_icon').css('backgroundColor', '#' + hex);
			$('#color_input').val(hex);
			$('#color_input').ColorPickerHide();
		}
	});
});
<?php echo '</script'; ?>
>



<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1>
                <?php if ($_smarty_tpl->tpl_vars['label']->value->id) {?>
                    Редактирование метки
                <?php } else { ?>
                    Создание метки
                <?php }?>
            </h1>
        </div>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrdersLabelsAdmin'),$_smarty_tpl);?>
">← Назад</a>

        <?php if ($_smarty_tpl->tpl_vars['label']->value->id) {?>
            <a href="index.php?module=OrdersLabelAdmin">+ Создать еще одну метку</a>
        <?php }?>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Метка добавлена<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Метка обновлена<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
        <div class="message_box message_error">
            <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>Название метки не может быть пустым<?php }?></span>
        </div>
    <?php }?>

    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название метки</label><input class="name" name="name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li>
                        <label class=property>Цвет метки</label>
                        <span id="color_icon" style="background-color:#<?php echo $_smarty_tpl->tpl_vars['label']->value->color;?>
;" class="order_label"></span>
                        <input id="color_input" name="color" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['label']->value->color, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="action">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form><?php }
}
?>