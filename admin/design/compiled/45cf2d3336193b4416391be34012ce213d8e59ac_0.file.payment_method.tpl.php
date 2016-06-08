<?php /* Smarty version 3.1.24, created on 2016-04-01 15:44:08
         compiled from "admin/design/html/payment_method.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2698956fe0aa8796488_97080778%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '45cf2d3336193b4416391be34012ce213d8e59ac' => 
    array (
      0 => 'admin/design/html/payment_method.tpl',
      1 => 1432873939,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2698956fe0aa8796488_97080778',
  'variables' => 
  array (
    'payment_method' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'payment_modules' => 0,
    'payment_module' => 0,
    'currencies' => 0,
    'currency' => 0,
    'setting' => 0,
    'option' => 0,
    'payment_settings' => 0,
    'deliveries' => 0,
    'delivery' => 0,
    'payment_deliveries' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_56fe0aa884bb77_54477350',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56fe0aa884bb77_54477350')) {
function content_56fe0aa884bb77_54477350 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2698956fe0aa8796488_97080778';
if ($_smarty_tpl->tpl_vars['payment_method']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['payment_method']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый способ оплаты', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
>
$(function() {
	$('div#module_settings').filter(':hidden').find("input, select, textarea").attr("disabled", true);

	$('select[name=module]').change(function(){
		$('div#module_settings').hide().find("input, select, textarea").attr("disabled", true);
		$('div#module_settings[module='+$(this).val()+']').show().find("input, select, textarea").attr("disabled", false);
	});
});
<?php echo '</script'; ?>
>



<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">

    <div class="capture_head">
        <div id="header">
            <h1><?php if ($_smarty_tpl->tpl_vars['payment_method']->value->id) {?>Редактировать способ оплаты<?php } else { ?>Новый способ оплаты<?php }?></h1>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->id) {?><a id="add_currency" href="#">Добавить еще один способ оплаты</a><?php }?>

        <input id='apply_action' class="button_green button_save" type=submit value="Сохранить">
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Способ оплаты добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Способ оплаты изменен<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>Укажите название способа оплаты<?php }?></span>
    </div>
    <?php }?>


    <div class="board_subhead">
        <div id="name">
            <input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_method']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/>
            <input name=id type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
"/>
            <label class="fancy-checkbox">
                <input type="checkbox" name="enabled" <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->enabled) {?>checked<?php }?>>
                <span>Активен</span>
            </label>
        </div>
    </div>


    <div class="board_subhead">
	    <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li>
                        <label class=property>Обработчик</label>
                        <select name="module">
                            <option value='null'>Ручная обработка</option>
                            <?php
$_from = $_smarty_tpl->tpl_vars['payment_modules']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['payment_module'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['payment_module']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['payment_module']->key => $_smarty_tpl->tpl_vars['payment_module']->value) {
$_smarty_tpl->tpl_vars['payment_module']->_loop = true;
$foreach_payment_module_Sav = $_smarty_tpl->tpl_vars['payment_module'];
?>
                                <option value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_module']->key, ENT_QUOTES, 'UTF-8', true);?>
' <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->module == $_smarty_tpl->tpl_vars['payment_module']->key) {?>selected<?php }?> ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_module']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                            <?php
$_smarty_tpl->tpl_vars['payment_module'] = $foreach_payment_module_Sav;
}
?>
                        </select>
                    </li>
                    <li>
                        <label class=property>Валюта</label>
                        <select name="currency_id">
                            <?php
$_from = $_smarty_tpl->tpl_vars['currencies']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['currency'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['currency']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->_loop = true;
$foreach_currency_Sav = $_smarty_tpl->tpl_vars['currency'];
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['currency']->value->id == $_smarty_tpl->tpl_vars['payment_method']->value->currency_id) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                            <?php
$_smarty_tpl->tpl_vars['currency'] = $foreach_currency_Sav;
}
?>
                        </select>
                    </li>
                </ul>
            </div>

            <?php
$_from = $_smarty_tpl->tpl_vars['payment_modules']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['payment_module'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['payment_module']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['payment_module']->key => $_smarty_tpl->tpl_vars['payment_module']->value) {
$_smarty_tpl->tpl_vars['payment_module']->_loop = true;
$foreach_payment_module_Sav = $_smarty_tpl->tpl_vars['payment_module'];
?>
                <div class="block" <?php if ($_smarty_tpl->tpl_vars['payment_module']->key != $_smarty_tpl->tpl_vars['payment_method']->value->module) {?>style='display:none;'<?php }?> id=module_settings module='<?php echo $_smarty_tpl->tpl_vars['payment_module']->key;?>
'>
                <h2><?php echo $_smarty_tpl->tpl_vars['payment_module']->value->name;?>
</h2>
                
                <ul>
                <?php
$_from = $_smarty_tpl->tpl_vars['payment_module']->value->settings;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['setting'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['setting']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['setting']->value) {
$_smarty_tpl->tpl_vars['setting']->_loop = true;
$foreach_setting_Sav = $_smarty_tpl->tpl_vars['setting'];
?>
                    <?php $_smarty_tpl->tpl_vars['variable_name'] = new Smarty_Variable($_smarty_tpl->tpl_vars['setting']->value->variable, null, 0);?>
                    <?php if (count($_smarty_tpl->tpl_vars['setting']->value->options) > 1) {?>
                    <li><label class=property><?php echo $_smarty_tpl->tpl_vars['setting']->value->name;?>
</label>
                    <select name="payment_settings[<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
]">
                        <?php
$_from = $_smarty_tpl->tpl_vars['setting']->value->options;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['option'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['option']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->_loop = true;
$foreach_option_Sav = $_smarty_tpl->tpl_vars['option'];
?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['option']->value->value;?>
' <?php if ($_smarty_tpl->tpl_vars['option']->value->value == $_smarty_tpl->tpl_vars['payment_settings']->value[$_smarty_tpl->tpl_vars['setting']->value->variable]) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['option'] = $foreach_option_Sav;
}
?>
                    </select>
                    </li>
                    <?php } elseif (count($_smarty_tpl->tpl_vars['setting']->value->options) == 1) {?>
                    <?php $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['first'][0][0]->first_modifier($_smarty_tpl->tpl_vars['setting']->value->options), null, 0);?>
                    <li><label class="property" for="<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</label><input name="payment_settings[<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
]" type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value->value, ENT_QUOTES, 'UTF-8', true);?>
" <?php if ($_smarty_tpl->tpl_vars['option']->value->value == $_smarty_tpl->tpl_vars['payment_settings']->value[$_smarty_tpl->tpl_vars['setting']->value->variable]) {?>checked<?php }?> id="<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
" /> <label for="<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
"><?php echo $_smarty_tpl->tpl_vars['option']->value->name;?>
</label></li>
                    <?php } else { ?>
                    <li><label class="property" for="<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['setting']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</label><input name="payment_settings[<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_settings']->value[$_smarty_tpl->tpl_vars['setting']->value->variable], ENT_QUOTES, 'UTF-8', true);?>
" id="<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
"/></li>
                    <?php }?>
                <?php
$_smarty_tpl->tpl_vars['setting'] = $foreach_setting_Sav;
}
?>
                </ul>
                

                </div>
            <?php
$_smarty_tpl->tpl_vars['payment_module'] = $foreach_payment_module_Sav;
}
?>

            <div <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->module != '') {?>style='display:none;'<?php }?> id=module_settings module='null'></div>
        </div>

        <div id="board_column_right">
            <div class="block">
            <h2>Возможные способы доставки</h2>
            <ul>
            <?php
$_from = $_smarty_tpl->tpl_vars['deliveries']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['delivery'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['delivery']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->value) {
$_smarty_tpl->tpl_vars['delivery']->_loop = true;
$foreach_delivery_Sav = $_smarty_tpl->tpl_vars['delivery'];
?>
                <li>
                <input type=checkbox name="payment_deliveries[]" id="delivery_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" value='<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
' <?php if (in_array($_smarty_tpl->tpl_vars['delivery']->value->id,$_smarty_tpl->tpl_vars['payment_deliveries']->value)) {?>checked<?php }?>> <label for="delivery_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['delivery']->value->name;?>
</label><br>
                </li>
            <?php
$_smarty_tpl->tpl_vars['delivery'] = $foreach_delivery_Sav;
}
?>
            </ul>
            </div>
        </div>
    </div>
	
	<div class="text_block">
		<h2>Описание</h2>
		<textarea name="description" class="editor_small"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_method']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>

    <div class="board_footer">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form><?php }
}
?>