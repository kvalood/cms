<?php /* Smarty version 3.1.24, created on 2015-06-25 17:24:49
         compiled from "admin/design/html/stats.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17853558bacc1e72900_35001909%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66cbed98160b87592a4734189543e13c11aad52d' => 
    array (
      0 => 'admin/design/html/stats.tpl',
      1 => 1425327412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17853558bacc1e72900_35001909',
  'variables' => 
  array (
    'currency' => 0,
    'stat' => 0,
    's' => 0,
    'stat_orders' => 0,
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
  'unifunc' => 'content_558bacc2022837_24787190',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558bacc2022837_24787190')) {
function content_558bacc2022837_24787190 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17853558bacc1e72900_35001909';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Статистика', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>



<?php echo '<script'; ?>
 src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="https://www.google.com/jsapi"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">

    $(function() {
        $('input[name="date_from"]').datepicker({regional:'ru'});
        $('input[name="date_to"]').datepicker({regional:'ru'});
    });

    function show_fields() {
        document.getElementById("filter_fields").style.display = document.getElementById("check").checked ? 'block' : 'none';
    }

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {  
        var serie = [];
        serie.push(['Дата', 'Новые, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
', 'Приняты, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
', 'Выполнены, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
', 'Удалены, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
']);
        
        
        <?php
$_from = $_smarty_tpl->tpl_vars['stat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['s']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
$foreach_s_Sav = $_smarty_tpl->tpl_vars['s'];
?>
        serie.push(['<?php echo $_smarty_tpl->tpl_vars['s']->value['title'];?>
', <?php echo $_smarty_tpl->tpl_vars['s']->value['new'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['confirm'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['complite'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['delete'];?>
]);
        <?php
$_smarty_tpl->tpl_vars['s'] = $foreach_s_Sav;
}
?>
        

        var options = {
            width:720,
            height:600,
            legend: { position: "bottom" },
            colors:['#357EC7','#FFF380','#6CBB3C','#B6B6B4'],
            bar: {groupWidth: '90%'},
            chartArea: {width: 640, height: 420},
            hAxis: {slantedText:true, slantedTextAngle:90, textStyle: {fontSize: 11}}, 
            vAxis: {minValue: 0, textStyle: {fontSize: 11}},
            backgroundColor: '#f7f7f7',
            title: 'Статистика по сумме заказов',
            isStacked: true,
            titleTextStyle: {fontSize: '27', bold: false}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('container'));
        chart.draw(google.visualization.arrayToDataTable(serie), options);        
    }

    google.setOnLoadCallback(drawChartOrders);
    function drawChartOrders() {  
        var serie = [];
        serie.push(['Дата', 'Новые', 'Приняты', 'Выполнены', 'Удалены']);
        
        
        <?php
$_from = $_smarty_tpl->tpl_vars['stat_orders']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['s'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['s']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
$foreach_s_Sav = $_smarty_tpl->tpl_vars['s'];
?>
        serie.push(['<?php echo $_smarty_tpl->tpl_vars['s']->value['title'];?>
', <?php echo $_smarty_tpl->tpl_vars['s']->value['new'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['confirm'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['complite'];?>
, <?php echo $_smarty_tpl->tpl_vars['s']->value['delete'];?>
]);
        <?php
$_smarty_tpl->tpl_vars['s'] = $foreach_s_Sav;
}
?>
        

        var options = {
            width: 720,
            height: 600,
            legend: { position: "bottom" },
            colors:['#357EC7','#FFF380','#6CBB3C','#B6B6B4'],
            bar: {groupWidth: '90%'},
            chartArea: {width: 600, height: 380},
            hAxis: {slantedText:true, slantedTextAngle:90, textStyle: {fontSize: 11}}, 
            vAxis: {minValue: 0, textStyle: {fontSize: 11}},
            backgroundColor: '#f7f7f7',
            title: 'Статистика по количеству заказов',
            isStacked: true,
            titleTextStyle: {fontSize: 27, bold: false}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('containerOrders'));
        chart.draw(google.visualization.arrayToDataTable(serie), options);        
    }    
<?php echo '</script'; ?>
>

 
 
<div>
	<div id="main_list">
		<div id='container'>
		</div>
		<div id='containerOrders'>
		</div>
	</div>
	<!-- Меню -->
	<div id="right_menu">
		
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
			<li <?php if ($_smarty_tpl->tpl_vars['date_filter']->value == 'all') {?>class="selected"<?php }?>><a onclick="show_fields();" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('date_filter'=>'all','date_to'=>null,'date_from'=>null,'filter_check'=>null),$_smarty_tpl);?>
">Все</a></li>                                          
		</ul>
		
		<div style="display: block; clear:both; border: 1px solid #C0C0C0; margin: 10px 0; padding: 10px">
		<form method="get">
		<div id='filter_check'>
		<input type="checkbox" name="filter_check" id="check" value='1' <?php if ($_smarty_tpl->tpl_vars['filter_check']->value) {?>checked<?php }?> onclick="show_fields();"/>
		<label for="check">Заданный период</label>
		</div>
		
		<div id='filter_fields' <?php if (!$_smarty_tpl->tpl_vars['filter_check']->value) {?>style="display: none"<?php }?>>
		<input type="hidden" name="module" value="StatsAdmin">
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
</div>
<?php }
}
?>