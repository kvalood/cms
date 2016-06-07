{$meta_title='Статистика' scope=parent}

{* On document load *}
{literal}
<script src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">

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
        serie.push([{/literal}'Дата', 'Новые, {$currency->sign|escape}', 'Приняты, {$currency->sign|escape}', 'Выполнены, {$currency->sign|escape}', 'Удалены, {$currency->sign|escape}'{literal}]);
        
        {/literal}
        {foreach $stat as $s}
        serie.push(['{$s.title}', {$s.new}, {$s.confirm}, {$s.complite}, {$s.delete}]);
        {/foreach}
        {literal}

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
        
        {/literal}
        {foreach $stat_orders as $s}
        serie.push(['{$s.title}', {$s.new}, {$s.confirm}, {$s.complite}, {$s.delete}]);
        {/foreach}
        {literal}

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
</script>
{/literal}
 
 
<div>
	<div id="main_list">
		<div id='container'>
		</div>
		<div id='containerOrders'>
		</div>
	</div>
	<!-- Меню -->
	<div id="right_menu">
		
		{if $labels}
		<!-- Метки -->
		<h4>Метки заказов</h4>
		<ul id="labels">
			<li {if !$label}class="selected"{/if}><span class="label"></span> <a href="{url label=null}">Все заказы</a></li>
			{foreach $labels as $l}
			<li data-label-id="{$l->id}" {if $label->id==$l->id}class="selected"{/if}>
			<span style="background-color:#{$l->color};" class="order_label"></span>
			<a href="{url label=$l->id}">{$l->name}</a></li>
			{/foreach}
		</ul>
		<!-- Метки -->
		{/if}    
		
		<h4>Период</h4>
		<ul id="filter-date">
			<li {if $date_filter == today}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=today date_to=null date_from=null filter_check=null}">Сегодня</a></li>
			<li {if $date_filter == this_week}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=this_week date_to=null date_from=null filter_check=null}">Текущая неделя</a></li>
			<li {if $date_filter == this_month}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=this_month date_to=null date_from=null filter_check=null}">Текущий месяц</a></li>
			<li {if $date_filter == this_year}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=this_year date_to=null date_from=null filter_check=null}">Текущий год</a></li>
			<li {if $date_filter == yesterday}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=yesterday date_to=null date_from=null filter_check=null}">Вчера</a></li>
			<li {if $date_filter == last_week}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_week date_to=null date_from=null filter_check=null}">Предыдущая неделя</a></li>
			<li {if $date_filter == last_month}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_month date_to=null date_from=null filter_check=null}">Предыдущий месяц</a></li>   
			<li {if $date_filter == last_year}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_year date_to=null date_from=null filter_check=null}">Предыдущий год</a></li>
			<li {if $date_filter == last_24hour}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_24hour date_to=null date_from=null filter_check=null}">Последние 24 часа</a></li>
			<li {if $date_filter == last_7day}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_7day date_to=null date_from=null filter_check=null}">Последние 7 дней</a></li>
			<li {if $date_filter == last_30day}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=last_30day date_to=null date_from=null filter_check=null}">Последние 30 дней</a></li>  
			<li {if $date_filter == all}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=all date_to=null date_from=null filter_check=null}">Все</a></li>                                          
		</ul>
		{* Фильтр *}
		<div style="display: block; clear:both; border: 1px solid #C0C0C0; margin: 10px 0; padding: 10px">
		<form method="get">
		<div id='filter_check'>
		<input type="checkbox" name="filter_check" id="check" value='1' {if $filter_check}checked{/if} onclick="show_fields();"/>
		<label for="check">Заданный период</label>
		</div>
		
		<div id='filter_fields' {if !$filter_check}style="display: none"{/if}>
		<input type="hidden" name="module" value="StatsAdmin">
		<input type="hidden" name="date_filter" value="">
		<div style="margin: 15px 0">
		<label>Дата с:&nbsp;</label><input type=text name=date_from value='{$date_from}'>&nbsp;
		<label>По:&nbsp;</label><input type=text name=date_to value='{$date_to}'>
		</div>
		<input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
		</form>
		</div>
		
	</div>
	<!-- Меню  (The End) -->
</div>
