{* On document load *}
{literal}
<script src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"></script>

<script>

$(function() {

$('input[name="date_from"]').datepicker({
regional:'ru'
});

$('input[name="date_to"]').datepicker({
regional:'ru'
});

});
</script>
<script type="text/javascript">
function show_fields()
{
document.getElementById("filter_fields").style.display = document.getElementById("check").checked ? 'block' : 'none';
}
</script>

<style>

#list td, #list th { padding: 7px 5px; text-align: left; }
#list td.c, #list th.c { text-align: center; }
.sort.top:before { content:"↑ "; border-bottom:none; }
.sort.bottom:before { content: "↓ "; border-bottom:none; }
#list tfoot { background: #d0d0d0; }

</style>

{/literal}

{* Вкладки *}
{capture name=tabs}
        <li><a href="{url module=StatsAdmin}">Статистика</a></li>
        <li class="active"><a href="{url module=ReportStatsAdmin filter=null status=null}">Отчет о продажах</a></li>
{/capture}

{* Title *}
{$meta_title='Отчет о продажах' scope=parent}

<div id="chart_div" style="width:900px;height:900px;display:none;">
    <div id="chart_cont"></div>
    <div id="chart_amount" style="margin-top:25px;"></div>
</div>
    
{* Заголовок *}
<div id="header">
    <h1>Отчет по заказам</h1>
</div>    

<div id="main_list">
    <form id="list_form" method="post">
    <input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div id="list">
            
            {assign 'total_summ' 0}
            {assign 'total_amount' 0}
            
            <table width="100%">
                <tbody>
                    <thead class="thead">
                        <th width="65%">Наименование товара</th>
                        <th width="20%" class="c"><a class="sort {if $sort_prod=='price'}top{elseif $sort_prod=='price_in'}bottom{/if}" href="{if $sort_prod=='price'}{url sort_prod=price_in}{else}{url sort_prod=price}{/if}">Сумма продаж</a></th>
                        <th width="15%" class="c"><a class="sort {if $sort_prod=='amount'}top{elseif $sort_prod=='amount_in'}bottom{/if}" href="{if $sort_prod=='amount'}{url sort_prod=amount_in}{else}{url sort_prod=amount}{/if}">Кол-во</a></th>
                    <thead>
                    {foreach $report_stat_purchases as $purchase}
                    {assign 'total_summ' $total_summ+$purchase->sum_price}
                    {assign 'total_amount' $total_amount+$purchase->amount}
                    <tr class="row">
                        <td>
                            <a title="{$purchase->product_name|escape}" href="{url module=ReportStatsProdAdmin id=$purchase->product_id return=$smarty.server.REQUEST_URI}">{$purchase->product_name}</a> {$purchase->variant_name}
                            </div>
                        </td>
                        <td class="c">{$purchase->sum_price} {$currency->sign|escape}</td>
                        <td class="c">{$purchase->amount} {$settings->units}</td>
                    </tr>
                    {/foreach}  
                    <tfoot> 
                        <td style="text-align: right">Итого:</td>        
                        <td class="c">{$total_summ|string_format:'%.2f'} {$currency->sign|escape}</td>        
                        <td class="c">{$total_amount} {$settings->units}</td>        
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
         <li {if !$status}class="selected"{/if}><a href="{url status=null}">Все заказы</a></li>       
        <li {if $status==1}class="selected"{/if}><a href="{url status=1}">Новые</a></li>
        <li {if $status==2}class="selected"{/if}><a href="{url status=2}">Принятые</a></li>
        <li {if $status==3}class="selected"{/if}><a href="{url status=3}">Выполенные</a></li>
        <li {if $status==4}class="selected"{/if}><a href="{url status=4}">Удаленные</a></li>
    </ul>
    
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
        <li {if !$date_filter}class="selected"{/if}><a onclick="show_fields();" href="{url date_filter=null date_to=null date_from=null filter_check=null}">Все заказы</a></li>
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
    </ul>
    {* Фильтр *}
    <div style="display: block; clear:both; border: 1px solid #C0C0C0; margin: 10px 0; padding: 10px">
    <form method="get">
    <div id='filter_check'>
    <input type="checkbox" name="filter_check" id="check" value='1' {if $filter_check}checked{/if} onclick="show_fields();"/>
    <label for="check">Заданный период</label>
    </div>
    
    <div id='filter_fields' {if !$filter_check}style="display: none"{/if}>
    <input type="hidden" name="module" value="ReportStatsAdmin">
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



{* On document load *}
{literal}
<script>

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

</script>
{/literal}
