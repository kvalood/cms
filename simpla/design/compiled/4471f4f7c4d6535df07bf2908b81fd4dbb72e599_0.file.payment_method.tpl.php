<?php
/* Smarty version 3.1.32, created on 2018-07-10 23:50:15
  from 'C:\SERVER\domains\cms\simpla\design\html\payment_method.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44b99786d635_91082062',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4471f4f7c4d6535df07bf2908b81fd4dbb72e599' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\payment_method.tpl',
      1 => 1531230613,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:tinymce_init.tpl' => 1,
  ),
),false)) {
function content_5b44b99786d635_91082062 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['payment_method']->value->id) {?>
    <?php $_smarty_tpl->_assignInScope('meta_title', $_smarty_tpl->tpl_vars['payment_method']->value->name ,false ,2);
} else { ?>
    <?php $_smarty_tpl->_assignInScope('meta_title', 'Новый способ оплаты' ,false ,2);
}?>

<?php $_smarty_tpl->_subTemplateRender('file:tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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

    <div class="content_header">
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_modules']->value, 'payment_module');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_module']->key => $_smarty_tpl->tpl_vars['payment_module']->value) {
$__foreach_payment_module_0_saved = $_smarty_tpl->tpl_vars['payment_module'];
?>
                                <option value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_module']->key, ENT_QUOTES, 'UTF-8', true);?>
' <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->module == $_smarty_tpl->tpl_vars['payment_module']->key) {?>selected<?php }?> ><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_module']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                            <?php
$_smarty_tpl->tpl_vars['payment_module'] = $__foreach_payment_module_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </li>
                    <li>
                        <label class=property>Валюта</label>
                        <select name="currency_id">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'currency');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
?>
                                <option value='<?php echo $_smarty_tpl->tpl_vars['currency']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['currency']->value->id == $_smarty_tpl->tpl_vars['payment_method']->value->currency_id) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </select>
                    </li>
                </ul>
            </div>

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_modules']->value, 'payment_module');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['payment_module']->key => $_smarty_tpl->tpl_vars['payment_module']->value) {
$__foreach_payment_module_2_saved = $_smarty_tpl->tpl_vars['payment_module'];
?>
                <div class="block" <?php if ($_smarty_tpl->tpl_vars['payment_module']->key != $_smarty_tpl->tpl_vars['payment_method']->value->module) {?>style='display:none;'<?php }?> id=module_settings module='<?php echo $_smarty_tpl->tpl_vars['payment_module']->key;?>
'>
                <h2><?php echo $_smarty_tpl->tpl_vars['payment_module']->value->name;?>
</h2>
                                <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['payment_module']->value->settings, 'setting');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['setting']->value) {
?>
                    <?php $_smarty_tpl->_assignInScope('variable_name', $_smarty_tpl->tpl_vars['setting']->value->variable);?>
                    <?php if (isset($_smarty_tpl->tpl_vars['setting']->value->options) && count($_smarty_tpl->tpl_vars['setting']->value->options) > 1) {?>
                    <li><label class=property><?php echo $_smarty_tpl->tpl_vars['setting']->value->name;?>
</label>
                    <select name="payment_settings[<?php echo $_smarty_tpl->tpl_vars['setting']->value->variable;?>
]">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['setting']->value->options, 'option');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['option']->value) {
?>
                        <option value='<?php echo $_smarty_tpl->tpl_vars['option']->value->value;?>
' <?php if ($_smarty_tpl->tpl_vars['option']->value->value == $_smarty_tpl->tpl_vars['payment_settings']->value[$_smarty_tpl->tpl_vars['setting']->value->variable]) {?>selected<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['option']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </select>
                    </li>
                    <?php } elseif (isset($_smarty_tpl->tpl_vars['setting']->value->options) && count($_smarty_tpl->tpl_vars['setting']->value->options) == 1) {?>
                    <?php $_smarty_tpl->_assignInScope('option', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'first' ][ 0 ], array( $_smarty_tpl->tpl_vars['setting']->value->options )));?>
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
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
                
                </div>
            <?php
$_smarty_tpl->tpl_vars['payment_module'] = $__foreach_payment_module_2_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

            <div <?php if ($_smarty_tpl->tpl_vars['payment_method']->value->module != '') {?>style='display:none;'<?php }?> id=module_settings module='null'></div>
        </div>

        <div id="board_column_right">
            <div class="block">
            <h2>Возможные способы доставки</h2>
            <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['deliveries']->value, 'delivery');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['delivery']->value) {
?>
                <li>
                <input type=checkbox name="payment_deliveries[]" id="delivery_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
" value='<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
' <?php if (in_array($_smarty_tpl->tpl_vars['delivery']->value->id,$_smarty_tpl->tpl_vars['payment_deliveries']->value)) {?>checked<?php }?>> <label for="delivery_<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['delivery']->value->name;?>
</label><br>
                </li>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
