<?php /* Smarty version 3.1.24, created on 2016-04-05 22:05:07
         compiled from "admin/design/html/reportstats.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:153905703a9f3a25351_71749409%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db03c3664d78ac1d32d629c63bfb7a35591e2061' => 
    array (
      0 => 'admin/design/html/reportstats.tpl',
      1 => 1436930496,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '153905703a9f3a25351_71749409',
  'variables' => 
  array (
    'sort_prod' => 0,
    'report_stat_purchases' => 0,
    'total_summ' => 0,
    'purchase' => 0,
    'total_amount' => 0,
    'currency' => 0,
    'settings' => 0,
    'status' => 0,
    'labels' => 0,
    'label' => 0,
    'l' => 0,
    'date_filter' => 0,
    'filter_check' => 0,
    'date_from' => 0,
    'date_to' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5703a9f3af83d9_67444803',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5703a9f3af83d9_67444803')) {
function content_5703a9f3af83d9_67444803 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '153905703a9f3a25351_71749409';
?>


<?php echo '<script'; ?>
 src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

$(function() {

$('input[name="date_from"]').datepicker({
regional:'ru'
});

$('input[name="date_to"]').datepicker({
regional:'ru'
});

});
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
function show_fields()
{
document.getElementById("filter_fields").style.display = document.getElementById("check").checked ? 'block' : 'none';
}
<?php echo '</script'; ?>
>

<style>

#list td, #list th { padding: 7px 5px; text-align: left; }
#list td.c, #list th.c { text-align: center; }
.sort.top:before { content:"↑ "; border-bottom:none; }
.sort.bottom:before { content: "↓ "; border-bottom:none; }
#list tfoot { background: #d0d0d0; }

</style>




<?php $_smarty_tpl->_capture_stack[0][] = array('tabs', null, null); ob_start(); ?>
        <li><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'StatsAdmin'),$_smarty_tpl);?>
">Статистика</a></li>
        <li class="active"><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ReportStatsAdmin','filter'=>null,'status'=>null),$_smarty_tpl);?>
">Отчет о продажах</a></li>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Отчет о продажах', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div id="chart_div" style="width:900px;height:900px;display:none;">
    <div id="chart_cont"></div>
    <div id="chart_amount" style="margin-top:25px;"></div>
</div>
    

<div id="header">
    <h1>Отчет по заказам</h1>
</div>    

<div id="main_list">
    <form id="list_form" method="post">
    <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

        <div id="list">
            
            <?php $_smarty_tpl->tpl_vars['total_summ'] = new Smarty_Variable(0, null, 0);?>
            <?php $_smarty_tpl->tpl_vars['total_amount'] = new Smarty_Variable(0, null, 0);?>
            
            <table width="100%">
                <tbody>
                    <thead class="thead">
                        <th width="65%">Наименование товара</th>
                        <th width="20%" class="c"><a class="sort <?php if ($_smarty_tpl->tpl_vars['sort_prod']->value == 'price') {?>top<?php } elseif ($_smarty_tpl->tpl_vars['sort_prod']->value == 'price_in') {?>bottom<?php }?>" href="<?php if ($_smarty_tpl->tpl_vars['sort_prod']->value == 'price') {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort_prod'=>'price_in'),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort_prod'=>'price'),$_smarty_tpl);
}?>">Сумма продаж</a></th>
                        <th width="15%" class="c"><a class="sort <?php if ($_smarty_tpl->tpl_vars['sort_prod']->value == 'amount') {?>top<?php } elseif ($_smarty_tpl->tpl_vars['sort_prod']->value == 'amount_in') {?>bottom<?php }?>" href="<?php if ($_smarty_tpl->tpl_vars['sort_prod']->value == 'amount') {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort_prod'=>'amount_in'),$_smarty_tpl);
} else {
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort_prod'=>'amount'),$_smarty_tpl);
}?>">Кол-во</a></th>
                    <thead>
                    <?php
$_from = $_smarty_tpl->tpl_vars['report_stat_purchases']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['purchase'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['purchase']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['purchase']->value) {
$_smarty_tpl->tpl_vars['purchase']->_loop = true;
$foreach_purchase_Sav = $_smarty_tpl->tpl_vars['purchase'];
?>
                    <?php $_smarty_tpl->tpl_vars['total_summ'] = new Smarty_Variable($_smarty_tpl->tpl_vars['total_summ']->value+$_smarty_tpl->tpl_vars['purchase']->value->sum_price, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['total_amount'] = new Smarty_Variable($_smarty_tpl->tpl_vars['total_amount']->value+$_smarty_tpl->tpl_vars['purchase']->value->amount, null, 0);?>
                    <tr class="row">
                        <td>
                            <a title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['purchase']->value->product_name, ENT_QUOTES, 'UTF-8', true);?>
" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ReportStatsProdAdmin','id'=>$_smarty_tpl->tpl_vars['purchase']->value->product_id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['purchase']->value->product_name;?>
</a> <?php echo $_smarty_tpl->tpl_vars['purchase']->value->variant_name;?>

                            </div>
                        </td>
                        <td class="c"><?php echo $_smarty_tpl->tpl_vars['purchase']->value->sum_price;?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</td>
                        <td class="c"><?php echo $_smarty_tpl->tpl_vars['purchase']->value->amount;?>
 <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</td>
                    </tr>
                    <?php
$_smarty_tpl->tpl_vars['purchase'] = $foreach_purchase_Sav;
}
?>  
                    <tfoot> 
                        <td style="text-align: right">Итого:</td>        
                        <td class="c"><?php echo sprintf('%.2f',$_smarty_tpl->tpl_vars['total_summ']->value);?>
 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</td>        
                        <td class="c"><?php echo $_smarty_tpl->tpl_vars['total_amount']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</td>        
                    </tfoot>         
                </tbody>
            </table>
        </div>
    </form>
        
</div>

<!-- Меню -->
<div id="right_menu">
    
    <h4>Статусы заказов</h4>
    <ul id="status-order">
         <li <?php if (!$_smarty_tpl->tpl_vars['status']->value) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('status'=>null),$_smarty_tpl);?>
">Все заказы</a></li>       
        <li <?php if ($_smarty_tpl->tpl_vars['status']->value == 1) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('status'=>1),$_smarty_tpl);?>
">Новые</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['status']->value == 2) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('status'=>2),$_smarty_tpl);?>
">Принятые</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['status']->value == 3) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('status'=>3),$_smarty_tpl);?>
">Выполенные</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['status']->value == 4) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('status'=>4),$_smarty_tpl);?>
">Удаленные</a></li>
    </ul>
    
    <?php if ($_smarty_tpl->tpl_vars['labels']->value) {?>
    <!-- Метки -->
    <h4>Метки заказов</h4>
    <ul id="labels">
        <li <?php if (!$_smarty_tpl->tpl_vars['label']->value) {?>class="selected"<?php }?>><span class="label"></span> <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('label'=>null),$_smarty_tpl);?>
">Все заказы</a></li>
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
        <li data-label-id="<?php echo $_smarty_tpl->tpl_vars['l']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['label']->value->id == $_smarty_tpl->tpl_vars['l']->value->id) {?>class="selected"<?php }?>>
        <span style="background-color:#<?php echo $_smarty_tpl->tpl_vars['l']->value->color;?>
;" class="order_label"></span>
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('label'=>$_smarty_tpl->tpl_vars['l']->value->id),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['l']->value->name;?>
</a></li>
        <?php
$_smarty_tpl->tpl_vars['l'] = $foreach_l_Sav;
}
?>
    </ul>
    <!-- Метки -->
    <?php }?>
    <h4>Период</h4>
    <ul id="filter-date">
        <li <?php if (!$_smarty_tpl->tpl_vars['date_filter']->value) {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>null,'date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Все заказы</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'today') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'today','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Сегодня</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'this_week') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'this_week','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Текущая неделя</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'this_month') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'this_month','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Текущий месяц</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'this_year') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'this_year','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Текущий год</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'yesterday') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'yesterday','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Вчера</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_week') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_week','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Предыдущая неделя</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_month') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_month','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Предыдущий месяц</a></li>   
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_year') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_year','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Предыдущий год</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_24hour') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_24hour','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Последние 24 часа</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_7day') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_7day','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Последние 7 дней</a></li>
        <li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'last_30day') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'last_30day','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Последние 30 дней</a></li>                                          
    </ul>
    
    <div style="display: block; clear:both; border: 1px solid #C0C0C0; margin: 10px 0; padding: 10px">
    <form method="get">
    <div id='filter_check'>
    <input type="checkbox" name="filter_check" id="check" value='1' <?php if ($_smarty_tpl->tpl_vars['filter_check']->value) {?>checked<?php }?> onclick="show_fields();"/>
    <label for="check">Заданный период</label>
    </div>
    
    <div id='filter_fields' <?php if (!$_smarty_tpl->tpl_vars['filter_check']->value) {?>style="display: none"<?php }?>>
    <input type="hidden" name="module" value="ReportStatsAdmin">
    <input type="hidden" name="date_filter" value="">
    <div style="margin: 15px 0">
    <label>Дата с:&nbsp;</label><input type=text name=date_from value='<?php echo $_smarty_tpl->tpl_vars['date_from']->value;?>
'>&nbsp;
    <label>По:&nbsp;</label><input type=text name=date_to value='<?php echo $_smarty_tpl->tpl_vars['date_to']->value;?>
'>
    </div>
    <input id="apply_action" class="button_green" type="submit" value="Применить">
    </div>
    </form>
    </div>
    
</div>
<!-- Меню  (The End) -->





<?php echo '<script'; ?>
>

$(function() {

    // Сортировка списка
    $("#labels").sortable({
        items:             "li",
        tolerance:         "pointer",
        scrollSensitivity: 40,
        opacity:           0.7
    });

    
    
    {
        $("#list tr.row:even").addClass('even');
        $("#list tr.row:odd").removeClass('even');
    }
    // Раскрасить строки сразу
    colorize();
});

<?php echo '</script'; ?>
>

<?php }
}
?>