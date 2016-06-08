<?php /* Smarty version 3.1.24, created on 2015-07-15 14:06:32
         compiled from "admin/design/html/coupon.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1940655a5dc486b5949_68824744%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7b484b9ed6daf2ee3575a634f1ccd30fd69ac4f9' => 
    array (
      0 => 'admin/design/html/coupon.tpl',
      1 => 1436933181,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1940655a5dc486b5949_68824744',
  'variables' => 
  array (
    'coupon' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5dc4871f0e0_58584031',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5dc4871f0e0_58584031')) {
function content_55a5dc4871f0e0_58584031 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1940655a5dc486b5949_68824744';
if ($_smarty_tpl->tpl_vars['coupon']->value->code) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['coupon']->value->code, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый купон', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<?php echo '<script'; ?>
 src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(function() {

	$('input[name="expire"]').datepicker({
		regional:'ru'
	});
	$('input[name="end"]').datepicker({
		regional:'ru'
	});

	// On change date
	$('input[name="expire"]').focus(function() {
    	$('input[name="expires"]').attr('checked', true);
	});
});
<?php echo '</script'; ?>
>



<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name="id" class="name" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>


    <div class="capture_head">
        <div id="header">
            <h1>
                <?php if ($_smarty_tpl->tpl_vars['coupon']->value->code) {?>
                    Редактирование купона
                <?php } else { ?>
                    Новый купон
                <?php }?>
            </h1>
        </div>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponsAdmin'),$_smarty_tpl);?>
">← Назад</a>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'CouponAdmin','id'=>null),$_smarty_tpl);?>
">+ Добавить еще один купон</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span class="text"><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Купон добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Купон изменен<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span class="text">
            <?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'code_exists') {?>Купон с таким кодом уже существует<?php }?>
            <?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'code_empty') {?>Заполните название купона<?php }?>
        </span>
    </div>
    <?php }?>


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название купона</label><input class="name" name="code" value="<?php echo $_smarty_tpl->tpl_vars['coupon']->value->code;?>
" type="text"></li>

                    <li>
                    <hr/>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="single" <?php if ($_smarty_tpl->tpl_vars['coupon']->value->single) {?>checked<?php }?>>
                        <span>Одноразовый/не одноразовый</span>
                    </label>
                    </li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="expires" <?php if ($_smarty_tpl->tpl_vars['coupon']->value->expire) {?>checked<?php }?>>
                            <span>Истекает?</span>
                        </label>
                        <input type=text name=expire value='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['coupon']->value->expire);?>
'>
                    </li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li>
                        <label class=property>
                            Скидка
                            <select class="coupon_type" name="type">
                                <option value="percentage" <?php if ($_smarty_tpl->tpl_vars['coupon']->value->type == 'percentage') {?>selected<?php }?>>%</option>
                                <option value="absolute" <?php if ($_smarty_tpl->tpl_vars['coupon']->value->type == 'absolute') {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</option>
                            </select>
                        </label><input name="value" class="coupon_value" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->value, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>

                    <li><label class=property>Для заказов от (<?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
)</label><input type="text" name="min_order_price" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon']->value->min_order_price, ENT_QUOTES, 'UTF-8', true);?>
"></li>
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