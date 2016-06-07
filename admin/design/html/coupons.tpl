{* Title *}
{$meta_title='Купоны' scope=parent}


<div class="content_header">
    <div id="header">
        <h1>
        {if $coupons_count}
           {$coupons_count} {$coupons_count|plural:'купон':'купонов':'купона'}
        {else}
            Нет купонов
        {/if}
        </h1>
    </div>

    <a href="{url module=CouponAdmin}">+ Добавить купон</a>
</div>


{if $coupons}
<div class="board">

	<form id="form_list" method="post">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">
	
		<div id="list">
			{foreach $coupons as $coupon}
			<div class="{if $coupon->valid}green{/if} row">
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$coupon->id}"/>				
				</div>
				<div class="name cell">
	 				<a href="{url module=CouponAdmin id=$coupon->id return=$smarty.server.REQUEST_URI}">{$coupon->code}</a>
                    <br/>
                    {if $coupon->min_order_price>0}
                        <div class="sub_name">Для заказов от {$coupon->min_order_price|escape} {$currency->sign}</div>
                    {/if}
				</div>
				<div class="cat cell">
	 				Скидка {$coupon->value*1} {if $coupon->type=='absolute'}{$currency->sign}{else}%{/if}<br>
				</div>
				<div class="cat cell">
					{if $coupon->single}
	 				Одноразовый
	 				{/if}
	 				{if $coupon->usages>0}
	 				Использован {$coupon->usages|escape} {$coupon->usages|plural:'раз':'раз':'раза'}
	 				{/if}
	 				{if $coupon->expire}
	 				{if $smarty.now|date_format:'%Y%m%d' <= $coupon->expire|date_format:'%Y%m%d'}
	 				Действует до {$coupon->expire|date}
	 				{else}
	 				Истёк {$coupon->expire|date}
	 				{/if}
	 				{/if}
				</div>
				<div class="icons cell">
					<a href='#' class=delete></a>
				</div>
			</div>
			{/foreach}
		</div>
		
	
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id="select">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
				
	</form>

    <div class="board_footer">
        {include file='pagination.tpl'}
    </div>
	
</div>
{/if}


{literal}
<script>
$(function() {

	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
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