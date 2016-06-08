<?php /* Smarty version 3.1.24, created on 2015-07-15 13:08:43
         compiled from "admin/design/html/delivery.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:993955a5cebb4893c6_65965063%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f964c5650af52a46755d9c21b816ddc4959f475' => 
    array (
      0 => 'admin/design/html/delivery.tpl',
      1 => 1433577025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '993955a5cebb4893c6_65965063',
  'variables' => 
  array (
    'delivery' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'currency' => 0,
    'payment_methods' => 0,
    'payment_method' => 0,
    'delivery_payments' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5cebb81b5a0_87900084',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5cebb81b5a0_87900084')) {
function content_55a5cebb81b5a0_87900084 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '993955a5cebb4893c6_65965063';
if ($_smarty_tpl->tpl_vars['delivery']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['delivery']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый способ доставки', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">

    <div class="capture_head">
        <a href="index.php?module=DeliveriesAdmin">← Назад</a>
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
        <div class="message_box message_success">
            <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Способ доставки добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Способ доставки изменен<?php }?></span>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
        <div class="message_box message_error">
            <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>Не указано название доставки<?php }?></span>
        </div>
    <?php }?>


	<div id="name">
        <label style="display: block;margin-bottom: 2px;">Название способа доставки</label>
        <input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Название способа доставки"/>
		<input name=id type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->id;?>
"/>

        <label class="fancy-checkbox">
            <input type="checkbox" name="enabled" <?php if ($_smarty_tpl->tpl_vars['delivery']->value->enabled) {?>checked<?php }?>>
            <span>Активен</span>
        </label>
	</div>

    <div class="board_subhead">
        <div id="board_column_left">
            <div class="block">
                <h2>Стоимость доставки</h2>
                <ul>
                    <li><label class=property>Стоимость <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</label><input name="price" class="simpla_small_inp" type="text" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->price;?>
" /></li>
                    <li><label class=property>Бесплатна от <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</label><input name="free_from" class="simpla_small_inp" type="text" value="<?php echo $_smarty_tpl->tpl_vars['delivery']->value->free_from;?>
" /></li>
                    <li><label class=property>Сроки доставки дн.</label><input name="period" class="simpla_small_inp" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->period, ENT_QUOTES, 'UTF-8', true);?>
" /></li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="separate_payment" <?php if ($_smarty_tpl->tpl_vars['delivery']->value->separate_payment) {?>checked<?php }?>>
                            <span>Оплачивается отдельно</span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Возможные способы оплаты</h2>
                <ul>
                    <?php
$_from = $_smarty_tpl->tpl_vars['payment_methods']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['payment_method'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['payment_method']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['payment_method']->value) {
$_smarty_tpl->tpl_vars['payment_method']->_loop = true;
$foreach_payment_method_Sav = $_smarty_tpl->tpl_vars['payment_method'];
?>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="delivery_payments[]" value="<?php echo $_smarty_tpl->tpl_vars['payment_method']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['payment_method']->value->id,$_smarty_tpl->tpl_vars['delivery_payments']->value)) {?>checked<?php }?>>
                            <span><?php echo $_smarty_tpl->tpl_vars['payment_method']->value->name;?>
</span>
                        </label>
                    </li>
                    <?php
$_smarty_tpl->tpl_vars['payment_method'] = $foreach_payment_method_Sav;
}
?>
                </ul>
            </div>
        </div>
    </div>

	
	<div class="text_block">
		<h2>Краткое описание</h2>
		<textarea name="description" class="editor_small"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>

    <div class="board_footer">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form><?php }
}
?>