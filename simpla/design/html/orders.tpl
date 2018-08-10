{* Title *}
{$meta_title='Заказы' scope=parent}

{* Поиск *}
<div class="content_header">
    <div id="header">
        <h1>{if $orders_count}{$orders_count}{else}Нет{/if} заказ{$orders_count|plural:'':'ов':'а'}</h1>
    </div>


    {if $label}
        <a href="{url module=OrdersAdmin label=null}">← Назад</a>
    {/if}

    <a href="{url module=OrderAdmin id=null}">+ Добавить заказ</a>

    <div class="search_tools">
        <form method="get" name="search_to">
            <input type="hidden" name="module" value='OrdersAdmin'>
            <input type="text" name="keyword" value="{$keyword|escape}"/>
            <input class="search_button" type="submit" value="Поиск"/>
            <a href="index.php?module=ArticleAdmin" class="refresh_botton">Сбросить</a>
        </form>
    </div>
</div>

{if $message_error}
<div class="message_box message_error">
	<span>{if $message_error=='error_closing'}Нехватка некоторых товаров на складе{/if}</span>
</div>
{/if}

<div class="board">

    {if $orders}
    <div class="board_content">
        <form id="list_form" class="left_board" method="post">
            <input type="hidden" name="session_id" value="{$smarty.session.id}">

            <div class="board_subhead">
                {include file='pagination.tpl'}
            </div>

            <div id="list">
                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="date">№ заказа</div>
                    <div class="user_name">Заказчик</div>
                    <div class="date">Сумма заказа</div>
                    <div class="date">Дата заказа</div>
                </div>

                {foreach $orders as $order}
                <div class="{if $order->paid}green{/if} row">
                    <div class="checkbox cell">
                        <input type="checkbox" name="check[]" value="{$order->id}"/>
                    </div>
                    <div class="date cell">
                        {foreach $order->labels as $l}
                        <span class="order_label" style="background-color:#{$l->color};" title="{$l->name}"></span>
                        {/foreach}
                        <a href="{url module=OrderAdmin id=$order->id return=$smarty.server.REQUEST_URI}">Заказ №{$order->id}</a>
                        {if $order->note}
                        <div class="note">{$order->note|escape}</div>
                        {/if}
                    </div>
                    <div class="user_name cell">
                        {$order->name|escape}
                    </div>
                    <div class="date cell" style='white-space:nowrap;'>
                        {$order->total_price|escape} {$currency->sign}
                    </div>
                    <div class="date cell">
                        {$order->date|date} в {$order->date|time}
                    </div>

                    <div class="icons cell">
                        {if $keyword}
                            {if $order->status == 0}
                                <img src='design/images/new.png' alt='Новый' title='Новый'>
                            {/if}
                            {if $order->status == 1}
                                <img src='design/images/time.png' alt='Принят' title='Принят'>
                            {/if}
                            {if $order->status == 2}
                                <img src='design/images/tick.png' alt='Выполнен' title='Выполнен'>
                            {/if}
                            {if $order->status == 3}
                                <img src='design/images/cross.png' alt='Удалён' title='Удалён'>
                            {/if}
                        {/if}

                        {if $order->paid}
                            <img src='design/images/cash_stack.png' alt='Оплачен' title='Оплачен'>
                        {else}
                            <img src='design/images/cash_stack_gray.png' alt='Не оплачен' title='Не оплачен'>
                        {/if}

                        <a href='{url module=OrderAdmin id=$order->id view=print}'  target="_blank" class="print" title="Печать заказа"></a>
                        <a href='#' class=delete title="Удалить"></a>
                    </div>
                </div>
                {/foreach}
		    </div>
	
            <div id="action">
                <label id='check_all' class="dash_link">Выбрать все</label>

                <span id="select">
                <select name="action">
                    {if $status!==0}<option value="set_status_0">В новые</option>{/if}
                    {if $status!==1}<option value="set_status_1">В принятые</option>{/if}
                    {if $status!==2}<option value="set_status_2">В выполненные</option>{/if}
                    {foreach $labels as $l}
                    <option value="set_label_{$l->id}">Отметить &laquo;{$l->name}&raquo;</option>
                    {/foreach}
                    {foreach $labels as $l}
                    <option value="unset_label_{$l->id}">Снять &laquo;{$l->name}&raquo;</option>
                    {/foreach}
                    <option value="delete">Удалить выбранные заказы</option>
                </select>
                </span>

                <input id="apply_action" class="button_green" type="submit" value="Применить">

            </div>
	    </form>

        <div class="right_board">
            <div id="right_head">Фильтр по меткам</div>

            {if $labels}
            <ul class="filter">
                <li {if !$label}class="selected"{/if}><span class="label"></span> <a href="{url label=null}">Все заказы</a></li>
                {foreach $labels as $l}
                    <li data-label-id="{$l->id}" {if $label->id==$l->id}class="selected"{/if}>
                        <a href="{url label=$l->id}"><span style="background-color:#{$l->color};" class="order_label"></span>{$l->name}</a></li>
                {/foreach}
            </ul>
            {/if}
        </div>
    </div>

    <div class="board_footer">
        {include file='pagination.tpl'}
    </div>

</div>
{else}
    Нет ни одного заказа
{/if}

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
	
	$("#main_list #list .row").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){
			label_id = $(ui.helper).attr('data-label-id');
			$(this).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			$(this).closest("form").find('select[name="action"] option[value=set_label_'+label_id+']').attr("selected", "selected");		
			$(this).closest("form").submit();
			return false;	
		}		
	});


	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});

	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
});

</script>
{/literal}