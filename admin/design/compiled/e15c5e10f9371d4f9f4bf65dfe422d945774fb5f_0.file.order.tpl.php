<?php /* Smarty version 3.1.24, created on 2015-07-17 06:19:21
         compiled from "admin/design/html/order.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:311155a811c935f008_30275409%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e15c5e10f9371d4f9f4bf65dfe422d945774fb5f' => 
    array (
      0 => 'admin/design/html/order.tpl',
      1 => 1437077948,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '311155a811c935f008_30275409',
  'variables' => 
  array (
    'order' => 0,
    'message_error' => 0,
    'message_success' => 0,
    'user' => 0,
    'labels' => 0,
    'l' => 0,
    'order_labels' => 0,
    'purchases' => 0,
    'purchase' => 0,
    'image' => 0,
    'key' => 0,
    'items' => 0,
    'item' => 0,
    'v' => 0,
    'currency' => 0,
    'settings' => 0,
    'loop' => 0,
    'subtotal' => 0,
    'deliveries' => 0,
    'd' => 0,
    'delivery' => 0,
    'payment_methods' => 0,
    'pm' => 0,
    'payment_method' => 0,
    'payment_currency' => 0,
    'prev_order' => 0,
    'next_order' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a811c9524277_11303448',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a811c9524277_11303448')) {
function content_55a811c9524277_11303448 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_math')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/function.math.php';

$_smarty_tpl->properties['nocache_hash'] = '311155a811c935f008_30275409';
if ($_smarty_tpl->tpl_vars['order']->value->id) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable("Заказ №".((string)$_smarty_tpl->tpl_vars['order']->value->id), null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый заказ', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<!-- Основная форма -->
<form method=post id=product enctype="multipart/form-data" >
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1>
                <?php if ($_smarty_tpl->tpl_vars['order']->value->id) {?>Заказ №<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->id, ENT_QUOTES, 'UTF-8', true);
} else { ?>Новый заказ<?php }?>
            </h1>
        </div>

        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrdersAdmin'),$_smarty_tpl);?>
">← Назад</a>

        <?php if ($_smarty_tpl->tpl_vars['order']->value->id) {?>
            <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin'),$_smarty_tpl);?>
">+ Создать заказ</a>
            <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'OrderAdmin','view'=>'print','id'=>$_smarty_tpl->tpl_vars['order']->value->id),$_smarty_tpl);?>
" target="_blank">Печать заказа</a>
        <?php }?>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>


    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
        <div class="message_box message_error">
            <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'error_closing') {?>Нехватка товара на складе<?php }?></span>
        </div>
    <?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value) {?>
        <div class="message_box message_success">
            <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Заказ обновлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Заказ добавлен<?php }?></span>
        </div>
    <?php }?>


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Статус</label>
                        <select class=status name="status">
                            <option value='0' <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 0) {?>selected<?php }?>>Новый</option>
                            <option value='1' <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 1) {?>selected<?php }?>>Принят</option>
                            <option value='2' <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 2) {?>selected<?php }?>>Выполнен</option>
                            <option value='3' <?php if ($_smarty_tpl->tpl_vars['order']->value->status == 3) {?>selected<?php }?>>Удален</option>
                        </select>
                    </li>

                    <li>
                        <label class=property>Покупатель</label>
                        <div class="parameter">
                            <?php if (!$_smarty_tpl->tpl_vars['user']->value) {?>
                                Не зарегистрирован
                            <?php } else { ?>
                                <a href='index.php?module=UserAdmin&id=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
' target=_blank><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a> (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
)
                            <?php }?>
                            <input type=hidden name=user_id value='<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
'><input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </li>

                    <li>
                        <label class=property>Ваше примечание<br/><i>(не видно пользователю)</i></label><textarea name="note"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->note, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                    </li>

                    <?php if ($_smarty_tpl->tpl_vars['labels']->value) {?>
                    <li>
                        <label class=property>Метка заказа</label>
                        <div class="parameter">
                        <ul>
                            <?php
$_from = $_smarty_tpl->tpl_vars['labels']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['l'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['l']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['l']->value) {
$_smarty_tpl->tpl_vars['l']->_loop = true;
$foreach_l_Sav = $_smarty_tpl->tpl_vars['l'];
?>
                                <li>
                                    <label for="label_<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
">
                                        <input id="label_<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
" type="checkbox" name="order_labels[]" value="<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
" <?php if (in_array($_smarty_tpl->tpl_vars['l']->value->id,$_smarty_tpl->tpl_vars['order_labels']->value)) {?>checked<?php }?>>
                                        <span style="background-color:#<?php echo $_smarty_tpl->tpl_vars['l']->value->color;?>
;" class="order_label"></span>
                                        <?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>

                                    </label>
                                </li>
                            <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
                        </ul>
                        </div>
                    </li>
                    <?php }?>

                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Детали заказа</h2>
                <ul>
                    <li><label class=property>Номер заказа</label><input name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li>
                        <label class=property>Дата заказа</label><input name=date data-datetime="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date,'%Y/%m/%d %H:%M');?>
" type="text" value="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value->date,'%Y/%m/%d %H:%M');?>
"/>
                    </li>
                    <li>
                        <label class=property>ФИО заказчика</label><input name="name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>
                    <li>
                        <label class=property>Email заказчика</label><input name="email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->email, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>
                    <li>
                        <label class=property>Телефон</label><input name="phone" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->phone, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>
                    <li>
                        <label class=property>Адрес</label><input name="address" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->address, ENT_QUOTES, 'UTF-8', true);?>
" />
                    </li>
                    <li>
                        <label class=property>Комментарий пользователя</label><textarea name="comment"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['order']->value->comment, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="board_content" id="purchases">
        <h2>Заказы пользователя</h2>

        <div id="list" class="purchases">
            <?php
$_from = $_smarty_tpl->tpl_vars['purchases']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['purchase'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['purchase']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['purchase']->value) {
$_smarty_tpl->tpl_vars['purchase']->_loop = true;
$foreach_purchase_Sav = $_smarty_tpl->tpl_vars['purchase'];
?>
                <div class="row">
                    <div class="image cell">
                        <input type=hidden name=purchases[id][<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
] value='<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
'>
                        <?php $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['first'][0][0]->first_modifier($_smarty_tpl->tpl_vars['purchase']->value->product->images), null, 0);?>
                        <?php if ($_smarty_tpl->tpl_vars['image']->value) {?>
                            <img class=product_icon src='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->tpl_vars['image']->value->filename,35,35);?>
'>
                        <?php }?>
                    </div>
                    <div class="purchase_name cell">

                        <div class='purchase_variant'>
            <span class=edit_purchase style='display:none;'>
            
                <?php if (count($_smarty_tpl->tpl_vars['purchase']->value->product->size_color) > 0) {?>
                    <input type="hidden" name="purchases[variant_id][<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant_id;?>
" />
                    <input type="hidden" name="product_id" value="<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
" />
                    <select class="size">
                        <?php
$_from = $_smarty_tpl->tpl_vars['purchase']->value->product->size_color;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['items'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['items']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
$foreach_items_Sav = $_smarty_tpl->tpl_vars['items'];
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant_name == $_smarty_tpl->tpl_vars['key']->value) {?>selected=""<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['items'] = $foreach_items_Sav;
}
?>
                    </select>
                <?php
$_from = $_smarty_tpl->tpl_vars['purchase']->value->product->size_color;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['items'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['items']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
$foreach_items_Sav = $_smarty_tpl->tpl_vars['items'];
?>
                    <select class="color" for_size="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant_name != $_smarty_tpl->tpl_vars['key']->value || !$_smarty_tpl->tpl_vars['purchase']->value->product->is_show[$_smarty_tpl->tpl_vars['key']->value]) {?>style="display: none;"<?php }?>>
                        <?php
$_from = $_smarty_tpl->tpl_vars['items']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_item_Sav = $_smarty_tpl->tpl_vars['item'];
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant_color == $_smarty_tpl->tpl_vars['item']->value->color) {?>selected=""<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_item_Sav;
}
?>
                    </select>
                <?php
$_smarty_tpl->tpl_vars['items'] = $foreach_items_Sav;
}
?>
            <?php } else { ?>
            
            <select name=purchases[variant_id][<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
] <?php if (count($_smarty_tpl->tpl_vars['purchase']->value->product->variants) == 1 && $_smarty_tpl->tpl_vars['purchase']->value->variant_name == '' && $_smarty_tpl->tpl_vars['purchase']->value->variant->sku == '') {?>style='display:none;'<?php }?>>
                    <?php if (!$_smarty_tpl->tpl_vars['purchase']->value->variant) {?><option price='<?php echo $_smarty_tpl->tpl_vars['purchase']->value->price;?>
' amount='<?php echo $_smarty_tpl->tpl_vars['purchase']->value->amount;?>
' value=''><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->variant_name, ENT_QUOTES, 'UTF-8', true);?>
 <?php if ($_smarty_tpl->tpl_vars['purchase']->value->sku) {?>(арт. <?php echo $_smarty_tpl->tpl_vars['purchase']->value->sku;?>
)<?php }?></option><?php }?>
                    <?php
$_from = $_smarty_tpl->tpl_vars['purchase']->value->product->variants;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['v'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['v']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
$foreach_v_Sav = $_smarty_tpl->tpl_vars['v'];
?>
                        <?php if ($_smarty_tpl->tpl_vars['v']->value->stock > 0 || $_smarty_tpl->tpl_vars['v']->value->id == $_smarty_tpl->tpl_vars['purchase']->value->variant->id) {?>
                            <option price='<?php echo $_smarty_tpl->tpl_vars['v']->value->price;?>
' amount='<?php echo $_smarty_tpl->tpl_vars['v']->value->stock;?>
' value='<?php echo $_smarty_tpl->tpl_vars['v']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['v']->value->id == $_smarty_tpl->tpl_vars['purchase']->value->variant_id) {?>selected<?php }?> >
                                <?php echo $_smarty_tpl->tpl_vars['v']->value->name;?>

                                <?php if ($_smarty_tpl->tpl_vars['v']->value->sku) {?>(арт. <?php echo $_smarty_tpl->tpl_vars['v']->value->sku;?>
)<?php }?>
                            </option>
                        <?php }?>
                    <?php
$_smarty_tpl->tpl_vars['v'] = $foreach_v_Sav;
}
?>
                </select>
                    
                <?php }?>
                
            </span>
            <span class=view_purchase>
                <?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant_name;?>
 <?php if ($_smarty_tpl->tpl_vars['purchase']->value->sku) {?>(арт. <?php echo $_smarty_tpl->tpl_vars['purchase']->value->sku;?>
)<?php }?>
            </span>
                            
                            <?php if (!empty($_smarty_tpl->tpl_vars['purchase']->value->variant_color)) {?>
                                <span class=view_purchase>
                    <?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant_color;?>

                </span>
                            <?php }?>
                            
                        </div>

                        <?php if ($_smarty_tpl->tpl_vars['purchase']->value->product) {?>
                            <a class="related_product_name" href="index.php?module=ProductAdmin&id=<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
&return=<?php echo urlencode($_SERVER['REQUEST_URI']);?>
"><?php echo $_smarty_tpl->tpl_vars['purchase']->value->product_name;?>
</a>
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['purchase']->value->product_name;?>

                        <?php }?>
                    </div>
                    <div class="price cell">
                        <span class=view_purchase><?php echo $_smarty_tpl->tpl_vars['purchase']->value->price;?>
</span>
            <span class=edit_purchase style='display:none;'>
            <input type=text name=purchases[price][<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
] value='<?php echo $_smarty_tpl->tpl_vars['purchase']->value->price;?>
' size=5>
            </span>
                        <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                    </div>
                    <div class="amount cell">
            <span class=view_purchase>
                <?php echo $_smarty_tpl->tpl_vars['purchase']->value->amount;?>
 <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>

            </span>
            <span class=edit_purchase style='display:none;'>
                <?php if ($_smarty_tpl->tpl_vars['purchase']->value->variant) {?>
                    <?php echo smarty_function_math(array('equation'=>"min(max(x,y),z)",'x'=>$_smarty_tpl->tpl_vars['purchase']->value->variant->stock+$_smarty_tpl->tpl_vars['purchase']->value->amount*($_smarty_tpl->tpl_vars['order']->value->closed),'y'=>$_smarty_tpl->tpl_vars['purchase']->value->amount,'z'=>$_smarty_tpl->tpl_vars['settings']->value->max_order_amount,'assign'=>"loop"),$_smarty_tpl);?>

                <?php } else { ?>
                    <?php echo smarty_function_math(array('equation'=>"x",'x'=>$_smarty_tpl->tpl_vars['purchase']->value->amount,'assign'=>"loop"),$_smarty_tpl);?>

                <?php }?>
                <select name=purchases[amount][<?php echo $_smarty_tpl->tpl_vars['purchase']->value->id;?>
]>
                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['name'] = 'amounts';
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'] = (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['loop']->value+1) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'] = ((int) 1) == 0 ? 1 : (int) 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop'];
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['amounts']['total']);
?>
                        <option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['amounts']['index'];?>
" <?php if ($_smarty_tpl->tpl_vars['purchase']->value->amount == $_smarty_tpl->getVariable('smarty')->value['section']['amounts']['index']) {?>selected<?php }?>><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['amounts']['index'];?>
 <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</option>
                    <?php endfor; endif; ?>
                </select>
            </span>
                    </div>
                    <div class="icons cell">
                        <?php if (!$_smarty_tpl->tpl_vars['order']->value->closed) {?>
                            <?php if (!$_smarty_tpl->tpl_vars['purchase']->value->product) {?>
                                <img src='design/images/error.png' alt='Товар был удалён' title='Товар был удалён' >
                            <?php } elseif (!$_smarty_tpl->tpl_vars['purchase']->value->variant) {?>
                                <img src='design/images/error.png' alt='Вариант товара был удалён' title='Вариант товара был удалён' >
                            <?php } elseif ($_smarty_tpl->tpl_vars['purchase']->value->variant->stock < $_smarty_tpl->tpl_vars['purchase']->value->amount) {?>
                                <img src='design/images/error.png' alt='На складе остал<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['purchase']->value->variant->stock,'ся','ось');?>
 <?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant->stock;?>
 товар<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['purchase']->value->variant->stock,'','ов','а');?>
' title='На складе остал<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['purchase']->value->variant->stock,'ся','ось');?>
 <?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant->stock;?>
 товар<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['purchase']->value->variant->stock,'','ов','а');?>
'  >
                            <?php }?>
                        <?php }?>
                        <a href='#' class="delete" title="Удалить"></a>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php
$_smarty_tpl->tpl_vars['purchase'] = $foreach_purchase_Sav;
}
?>
            <div id="new_purchase" class="row" style='display:none;'>
                <div class="image cell">
                    <input type=hidden name=purchases[id][] value=''>
                    <img class=product_icon src=''>
                </div>
                <div class="purchase_name cell">
                    <div class='purchase_variant'>
                        <select name=purchases[variant_id][] style='display:none;'></select>
                    </div>
                    <a class="purchase_name" href=""></a>
                </div>
                <div class="price cell">
                    <input type=text name=purchases[price][] value='' size=5> <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                </div>
                <div class="amount cell">
                    <select name=purchases[amount][]></select>
                </div>
                <div class="icons cell">
                    <a href='#' class="delete" title="Удалить"></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>



        <div class="board_subhead">
            <div id="board_column_left">
                <div class="block">
                    <h2>Детали заказа</h2>
                    <ul>
                        <?php if ($_smarty_tpl->tpl_vars['purchases']->value) {?>
                        <li><label class=property>Сумма заказа</label> <?php echo $_smarty_tpl->tpl_vars['subtotal']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>
                        <?php }?>

                        <li><label class=property>Скидка %</label><input type=text name=discount value='<?php echo $_smarty_tpl->tpl_vars['order']->value->discount;?>
'></li>
                        <li><label class=property>С учетом скидки</label><?php echo round(($_smarty_tpl->tpl_vars['subtotal']->value-$_smarty_tpl->tpl_vars['subtotal']->value*$_smarty_tpl->tpl_vars['order']->value->discount/100),2);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>
                        <li><label class=property>Купон<?php if ($_smarty_tpl->tpl_vars['order']->value->coupon_code) {?> (<?php echo $_smarty_tpl->tpl_vars['order']->value->coupon_code;?>
)<?php }?> <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</label><input type=text name=coupon_discount value='<?php echo $_smarty_tpl->tpl_vars['order']->value->coupon_discount;?>
'></li>
                        <li><label class=property>С учетом купона</label><?php echo round(($_smarty_tpl->tpl_vars['subtotal']->value-$_smarty_tpl->tpl_vars['subtotal']->value*$_smarty_tpl->tpl_vars['order']->value->discount/100-$_smarty_tpl->tpl_vars['order']->value->coupon_discount),2);?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>

                        <li>
                            <label class=property>Доставка</label>
                            <div class="parameter">
                                <select name="delivery_id">
                                    <option value="0">Не выбрана</option>
                                    <?php
$_from = $_smarty_tpl->tpl_vars['deliveries']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['d'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['d']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['d']->value) {
$_smarty_tpl->tpl_vars['d']->_loop = true;
$foreach_d_Sav = $_smarty_tpl->tpl_vars['d'];
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['d']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['d']->value->id == $_smarty_tpl->tpl_vars['delivery']->value->id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['d']->value->name;?>
</option>
                                    <?php
$_smarty_tpl->tpl_vars['d'] = $foreach_d_Sav;
}
?>
                                </select>
                                <input type=text name=delivery_price value='<?php echo $_smarty_tpl->tpl_vars['order']->value->delivery_price;?>
'  placeholder="Значение доставки <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
">
                            </div>
                        </li>
                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="separate_delivery" <?php if ($_smarty_tpl->tpl_vars['order']->value->separate_delivery) {?>checked<?php }?>>
                                <span>Доставка оплачивается отдельно</span>
                            </label>
                            <hr/>
                        </li>

                        <li><label class=property>Итого</label><?php echo $_smarty_tpl->tpl_vars['order']->value->total_price;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>
                    </ul>
                </div>


            </div>

            <div id="board_column_right">
                <div class="block">
                    <h2>Дополнительные детали заказа</h2>
                    <ul>
                        <li>
                            <label class=property>Редактор покупок</label>
                            <div class="parameter">
                                <div id="add_purchase" <?php if ($_smarty_tpl->tpl_vars['purchases']->value) {?>style='display:none;'<?php }?>>
                                    <input type=text name=related id='add_purchase' class="input_autocomplete" placeholder='Выберите товар чтобы добавить его'>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['purchases']->value) {?>
                                    <a href='#' class="dash_link edit_purchases">редактировать покупки</a>
                                <?php }?>
                            </div>
                        </li>

                        <li>
                            <label class=property>Оплата</label>
                            <div class="parameter">
                                <select name="payment_method_id">
                                    <option value="0">Не выбрана</option>
                                    <?php
$_from = $_smarty_tpl->tpl_vars['payment_methods']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['pm'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['pm']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['pm']->value) {
$_smarty_tpl->tpl_vars['pm']->_loop = true;
$foreach_pm_Sav = $_smarty_tpl->tpl_vars['pm'];
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['pm']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['pm']->value->id == $_smarty_tpl->tpl_vars['payment_method']->value->id) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['pm']->value->name;?>
</option>
                                    <?php
$_smarty_tpl->tpl_vars['pm'] = $foreach_pm_Sav;
}
?>
                                </select>

                                <?php if ($_smarty_tpl->tpl_vars['payment_method']->value) {?>
                                    <div class="subtotal layer">
                                        К оплате<b> <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['convert'][0][0]->convert($_smarty_tpl->tpl_vars['order']->value->total_price,$_smarty_tpl->tpl_vars['payment_currency']->value->id);?>
 <?php echo $_smarty_tpl->tpl_vars['payment_currency']->value->sign;?>
</b>
                                    </div>
                                <?php }?>
                            </div>
                        </li>

                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="paid" <?php if ($_smarty_tpl->tpl_vars['order']->value->paid) {?>checked<?php }?>>
                                <span>Заказ оплачен</span>
                            </label>
                        </li>

                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="notify_user" >
                                <span>Уведомить покупателя о состоянии заказа</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>



    <?php if ($_smarty_tpl->tpl_vars['prev_order']->value && $_smarty_tpl->tpl_vars['next_order']->value) {?>
    <div class="board_footer">
        <?php if ($_smarty_tpl->tpl_vars['prev_order']->value) {?>
		<a class=prev_order href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('id'=>$_smarty_tpl->tpl_vars['prev_order']->value->id),$_smarty_tpl);?>
">←</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['next_order']->value) {?>
		<a class=next_order href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('id'=>$_smarty_tpl->tpl_vars['next_order']->value->id),$_smarty_tpl);?>
">→</a>
		<?php }?>
	</div>
    <?php }?>
</form>
<!-- Основная форма (The End) -->




<?php echo '<script'; ?>
 src="/js/autocomplete/jquery.autocomplete.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="design/js/datetimepicker/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link href="design/js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>
<?php echo '<script'; ?>
>
$(function() {

	// Удаление товара
	$(".purchases a.delete").live('click', function() {
		 $(this).closest(".row").fadeOut(200, function() { $(this).remove(); });
		 return false;
	});

	// Добавление товара 
	var new_purchase = $('.purchases #new_purchase').clone(true);
	$('.purchases #new_purchase').remove().removeAttr('id');

	$("input#add_purchase").autocomplete({
  	serviceUrl:'ajax/add_order_product.php',
  	minChars:0,
  	noCache: false,
    maxHeight: 200,
  	onSelect:
  		function(suggestion){
  			new_item = new_purchase.clone().appendTo('.purchases');
  			new_item.removeAttr('id');
  			new_item.find('a.purchase_name').html(suggestion.data.name);
  			new_item.find('a.purchase_name').attr('href', 'index.php?module=ProductAdmin&id='+suggestion.data.id);
  			
  			// Добавляем варианты нового товара
            /*size_color*/
            k = Object.keys(suggestion.data.size_color);
            if (k.length == 0) {
            /*/size_color*/
  			var variants_select = new_item.find('select[name*=purchases][name*=variant_id]');
			for(var i in suggestion.data.variants)
  				variants_select.append("<option value='"+suggestion.data.variants[i].id+"' price='"+suggestion.data.variants[i].price+"' amount='"+suggestion.data.variants[i].stock+"'>"+suggestion.data.variants[i].name+"</option>");
  			
  			if(suggestion.data.variants.length>1 || suggestion.data.variants[0].name != '')
  				variants_select.show();
  				  				
			variants_select.bind('change', function(){change_variant(variants_select);});
				change_variant(variants_select);
            /*size_color*/
            } else {
                if (!size_color[suggestion.data.id]) {
                    size_color[suggestion.data.id] = new Array();
                }
                for(var i in suggestion.data.size_color) {
                    if (!size_color[suggestion.data.id][i]) {
                        size_color[suggestion.data.id][i] = new Array();
                    }
                    for(var j in suggestion.data.size_color[i]) {
                        if (!size_color[suggestion.data.id][i][suggestion.data.size_color[i][j].color]) {
                            size_color[suggestion.data.id][i][suggestion.data.size_color[i][j].color] = new Array();
                        }
                        size_color[suggestion.data.id][i][suggestion.data.size_color[i][j].color]['price'] = suggestion.data.size_color[i][j].price;
                        size_color[suggestion.data.id][i][suggestion.data.size_color[i][j].color]['variant_id'] = suggestion.data.size_color[i][j].id;
                    }
                }
                var size_select = '<select class="size">';
                cnt = 0;
                for(var i in suggestion.data.size_color) {
                    size_select += '<option' + (cnt==0 ? ' selected=""' : '') + ' value="' + i + '">' + i + '</option>';
                    cnt++;
                }
                size_select += '</select>';
                
                var color_selects = '';
                for(var i in suggestion.data.size_color) {
                    color_selects += '<select' + ((color_selects != "" || (Object.keys(suggestion.data.size_color[i]).length == 1 && suggestion.data.size_color[i][0].color == "")) ? ' style="display: none;"' : "") + ' class="color" for_size="' + i + '">';
                    cnt = 0;
                    for(var j in suggestion.data.size_color[i]) {
                        color_selects += '<option' + (cnt==0 ? ' selected=""' : '') + ' value="' + suggestion.data.size_color[i][j].color + '">' + suggestion.data.size_color[i][j].color + '</option>';
                        cnt++;
                    }
                    color_selects += '</select>';
                }
                new_item.find('select[name*=purchases][name*=variant_id]').remove();
                new_item.find('div.purchase_name div.purchase_variant').append('<input type="hidden" name="purchases[variant_id][]" value="' + suggestion.data.size_color[k[0]][0].id + '" />');
                new_item.find('div.purchase_name div.purchase_variant').append('<input type="hidden" name="product_id" value="' + suggestion.data.size_color[k[0]][0].product_id + '" />');
                new_item.find('div.purchase_name div.purchase_variant').append(size_select + color_selects);
                new_item.find('div.price input').val(suggestion.data.size_color[k[0]][0].price);
                
                amount_select = new_item.closest('.row').find('select[name*=purchases][name*=amount]');
        		selected_amount = amount_select.val();
        		amount_select.html('');
        		for(i=1; i<=suggestion.data.variants[0].stock; i++)
        			amount_select.append("<option value='"+i+"'>"+i+" <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</option>");
        		amount_select.val(Math.min(selected_amount, suggestion.data.size_color[k[0]][0].stock));
                sizeBindChange(new_item.find('select.size'));
                colorBindChange(new_item.find('select.color'));
            }
            /*/size_color*/
  			
  			if(suggestion.data.image)
  				new_item.find('img.product_icon').attr("src", suggestion.data.image);
  			else
  				new_item.find('img.product_icon').remove();

			$("input#add_purchase").val('').focus().blur(); 
  			new_item.show();
  		},
		formatResult:
			function(suggestion, currentValue){
				var reEscape = new RegExp('(\\' + ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'].join('|\\') + ')', 'g');
				var pattern = '(' + currentValue.replace(reEscape, '\\$1') + ')';
  				return (suggestion.data.image?"<img align=absmiddle src='"+suggestion.data.image+"'> ":'') + suggestion.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
			}
  		
  });
  
  // Изменение цены и макс количества при изменении варианта
  function change_variant(element)
  {
		price = element.find('option:selected').attr('price');
		amount = element.find('option:selected').attr('amount');
		element.closest('.row').find('input[name*=purchases][name*=price]').val(price);
		
		// 
		amount_select = element.closest('.row').find('select[name*=purchases][name*=amount]');
		selected_amount = amount_select.val();
		amount_select.html('');
		for(i=1; i<=amount; i++)
			amount_select.append("<option value='"+i+"'>"+i+" <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</option>");
		amount_select.val(Math.min(selected_amount, amount));


		return false;
  }
  
  
	// Редактировать покупки
	$("a.edit_purchases").click( function() {
		 $(".purchases span.view_purchase").hide();
		 $(".purchases span.edit_purchase").show();
		 $(".edit_purchases").hide();
		 $("div#add_purchase").show();
		 return false;
	});
  
	// Редактировать получателя
	$("div#order_details a.edit_order_details").click(function() {
		 $("ul.order_details .view_order_detail").hide();
		 $("ul.order_details .edit_order_detail").show();
		 return false;
	});
  
	// Редактировать примечание
	$("div#order_details a.edit_note").click(function() {
		 $("div.view_note").hide();
		 $("div.edit_note").show();
		 return false;
	});
  
	// Редактировать пользователя
	$("div#order_details a.edit_user").click(function() {
		 $("div.view_user").hide();
		 $("div.edit_user").show();
		 return false;
	});
	$("input#user").autocomplete({
		serviceUrl:'ajax/search_users.php',
		minChars:0,
		noCache: false, 
		onSelect:
			function(suggestion){
				$('input[name="user_id"]').val(suggestion.data.id);
			}
	});
  
	// Удалить пользователя
	$("div#order_details a.delete_user").click(function() {
		$('input[name="user_id"]').val(0);
		$('div.view_user').hide();
		$('div.edit_user').hide();
		return false;
	});

	// Посмотреть адрес на карте
	$("a#address_link").attr('href', 'http://maps.yandex.ru/?text='+$('#order_details textarea[name="address"]').val());
  
	// Подтверждение удаления
	$('select[name*=purchases][name*=variant_id]').bind('change', function(){change_variant($(this));});
	$("input[name='status_deleted']").click(function() {
		if(!confirm('Подтвердите удаление'))
			return false;	
	});

});

<?php echo '</script'; ?>
>
<style>
.autocomplete-suggestions{max-height:250px!important;overflow-y: scroll !important;}
</style>



<?php echo '<script'; ?>
>
    var size_color = new Array();
    <?php
$_from = $_smarty_tpl->tpl_vars['purchases']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['purchase'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['purchase']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['purchase']->value) {
$_smarty_tpl->tpl_vars['purchase']->_loop = true;
$foreach_purchase_Sav = $_smarty_tpl->tpl_vars['purchase'];
?>
        if (!size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']) {
            size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
'] = new Array();
        }
        <?php
$_from = $_smarty_tpl->tpl_vars['purchase']->value->product->size_color;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['items'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['items']->_loop = false;
$_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['items']->value) {
$_smarty_tpl->tpl_vars['items']->_loop = true;
$foreach_items_Sav = $_smarty_tpl->tpl_vars['items'];
?>
            if (!size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
']) {
                size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
'] = new Array();
            }
            <?php
$_from = $_smarty_tpl->tpl_vars['items']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['item']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
$foreach_item_Sav = $_smarty_tpl->tpl_vars['item'];
?>
                if (!size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
']['<?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
']) {
                    size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
']['<?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
'] = new Array();
                }
                size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
']['<?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
']['price'] = '<?php echo $_smarty_tpl->tpl_vars['item']->value->price;?>
';
                size_color['<?php echo $_smarty_tpl->tpl_vars['purchase']->value->product->id;?>
']['<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
']['<?php echo $_smarty_tpl->tpl_vars['item']->value->color;?>
']['variant_id'] = '<?php echo $_smarty_tpl->tpl_vars['item']->value->id;?>
';
            <?php
$_smarty_tpl->tpl_vars['item'] = $foreach_item_Sav;
}
?>
        <?php
$_smarty_tpl->tpl_vars['items'] = $foreach_items_Sav;
}
?>
    <?php
$_smarty_tpl->tpl_vars['purchase'] = $foreach_purchase_Sav;
}
?>
    
    function sizeBindChange(element) {
        $(element).on('change', function() {
            parent = $(this).parents('div.purchase_variant');
            parent.find('select.color').hide();
            color = parent.find('select.color[for_size="' + $(this).val() + '"]');
            k = Object.keys(size_color[parent.find('input[name=product_id]').val()][$(this).val()])
            if (k.length != 1 || k[0] != "") {
                color.show();
            }
            showPrice($(this).val(), color.val(), parent);
        });
    }
    
    function colorBindChange(element) {
        $(element).on('change', function() {
            parent = $(this).parents('div.purchase_variant');
            showPrice(parent.find('select.size').val(), $(this).val(), parent);
        });
    }
    
    function showPrice(size, color, parent) {
        prd_id = parent.find('input[name=product_id]').val();
        price = size_color[prd_id][size][color]['price'];
        variant_id = size_color[prd_id][size][color]['variant_id'];
        parent.find("input[name*=purchases][name*=variant_id]").val(variant_id);
        parent.parents('div.row').find('input[name*=purchases][name*=price]').val(price);
    }
    $(document).ready(function() {
//        $("span.edit_purchase select.size").on('change', function() {
//            parent = $(this).parents('span.edit_purchase');
//            parent.find('select.color').hide();
//            color = parent.find('select.color[for_size="' + $(this).val() + '"]');
//            k = Object.keys(size_color[parent.find('input[name=product_id]').val()][$(this).val()])
//            if (k.length != 1 || k[0] != "") {
//                color.show();
//            }
//            showPrice($(this).val(), color.val(), parent);
//        });
        sizeBindChange($("span.edit_purchase select.size"));
        
//        $("span.edit_purchase select.color").on('change', function() {
//            showPrice($("span.edit_purchase select.size").val(), $(this).val(), $(this).parents('span.edit_purchase'));
//        });
        colorBindChange($("span.edit_purchase select.color"));
    });
    
<?php echo '</script'; ?>
>
<?php }
}
?>