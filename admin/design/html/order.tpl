{if $order->id}
    {$meta_title = "Заказ №`$order->id`" scope=parent}
{else}
    {$meta_title = 'Новый заказ' scope=parent}
{/if}

<!-- Основная форма -->
<form method=post id=product enctype="multipart/form-data" >
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$order->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>
                {if $order->id}Заказ №{$order->id|escape}{else}Новый заказ{/if}
            </h1>
        </div>

        <a href="{url module=OrdersAdmin}">← Назад</a>

        {if $order->id}
            <a href="{url module=OrderAdmin}">+ Создать заказ</a>
            <a href="{url module=OrderAdmin view=print id=$order->id}" target="_blank">Печать заказа</a>
        {/if}

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>


    {if $message_error}
        <div class="message_box message_error">
            <span>{if $message_error=='error_closing'}Нехватка товара на складе{/if}</span>
        </div>
    {elseif $message_success}
        <div class="message_box message_success">
            <span>{if $message_success=='updated'}Заказ обновлен{elseif $message_success=='added'}Заказ добавлен{/if}</span>
        </div>
    {/if}


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Статус</label>
                        <select class=status name="status">
                            <option value='0' {if $order->status == 0}selected{/if}>Новый</option>
                            <option value='1' {if $order->status == 1}selected{/if}>Принят</option>
                            <option value='2' {if $order->status == 2}selected{/if}>Выполнен</option>
                            <option value='3' {if $order->status == 3}selected{/if}>Удален</option>
                        </select>
                    </li>

                    <li>
                        <label class=property>Покупатель</label>
                        <div class="parameter">
                            {if !$user}
                                Не зарегистрирован
                            {else}
                                <a href='index.php?module=UserAdmin&id={$user->id}' target=_blank>{$user->name|escape}</a> ({$user->email|escape})
                            {/if}
                            <input type=hidden name=user_id value='{$user->id}'><input type=text id='user' class="input_autocomplete" placeholder="Выберите пользователя">
                        </div>
                    </li>

                    <li>
                        <label class=property>Ваше примечание<br/><i>(не видно пользователю)</i></label><textarea name="note">{$order->note|escape}</textarea>
                    </li>

                    {if $labels}
                    <li>
                        <label class=property>Метка заказа</label>
                        <div class="parameter">
                        <ul>
                            {foreach $labels as $l}
                                <li>
                                    <label for="label_{$l->id}">
                                        <input id="label_{$l->id}" type="checkbox" name="order_labels[]" value="{$l->id}" {if in_array($l->id, $order_labels)}checked{/if}>
                                        <span style="background-color:#{$l->color};" class="order_label"></span>
                                        {$l->name}
                                    </label>
                                </li>
                            {/foreach}
                        </ul>
                        </div>
                    </li>
                    {/if}

                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Детали заказа</h2>
                <ul>
                    <li><label class=property>Номер заказа</label><input name=name type="text" value="{$order->id|escape}"/></li>
                    <li>
                        <label class=property>Дата заказа</label><input name=date data-datetime="{$order->date|date_format:'%Y/%m/%d %H:%M'}" type="text" value="{$order->date|date_format:'%Y/%m/%d %H:%M'}"/>
                    </li>
                    <li>
                        <label class=property>ФИО заказчика</label><input name="name" type="text" value="{$order->name|escape}" />
                    </li>
                    <li>
                        <label class=property>Email заказчика</label><input name="email" type="text" value="{$order->email|escape}" />
                    </li>
                    <li>
                        <label class=property>Телефон</label><input name="phone" type="text" value="{$order->phone|escape}" />
                    </li>
                    <li>
                        <label class=property>Адрес</label><input name="address" type="text" value="{$order->address|escape}" />
                    </li>
                    <li>
                        <label class=property>Комментарий пользователя</label><textarea name="comment">{$order->comment|escape}</textarea>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="board_content" id="purchases">
        <h2>Заказы пользователя</h2>

        <div id="list" class="purchases">
            {foreach $purchases as $purchase}
                <div class="row">
                    <div class="image cell">
                        <input type=hidden name=purchases[id][{$purchase->id}] value='{$purchase->id}'>
                        {$image = $purchase->product->images|first}
                        {if $image}
                            <img class=product_icon src='{$image->filename|resize:35:35}'>
                        {/if}
                    </div>
                    <div class="purchase_name cell">

                        <div class='purchase_variant'>
            <span class=edit_purchase style='display:none;'>
            {*size_color*}
                {if $purchase->product->size_color|count > 0}
                    <input type="hidden" name="purchases[variant_id][{$purchase->id}]" value="{$purchase->variant_id}" />
                    <input type="hidden" name="product_id" value="{$purchase->product->id}" />
                    <select class="size">
                        {foreach from=$purchase->product->size_color key=key item=items name=size_color}
                            <option {if $purchase->variant_name == $key}selected=""{/if} value="{$key}">{$key}</option>
                        {/foreach}
                    </select>
                {foreach from=$purchase->product->size_color key=key item=items name=size_color}
                    <select class="color" for_size="{$key}" {if $purchase->variant_name != $key || !$purchase->product->is_show[$key]}style="display: none;"{/if}>
                        {foreach from=$items item=item name=items}
                            <option {if $purchase->variant_color == $item->color}selected=""{/if} value="{$item->color}">{$item->color}</option>
                        {/foreach}
                    </select>
                {/foreach}
            {else}
            {*/size_color*}
                <select name=purchases[variant_id][{$purchase->id}] {if $purchase->product->variants|count==1 && $purchase->variant_name == '' && $purchase->variant->sku == ''}style='display:none;'{/if}>
                    {if !$purchase->variant}<option price='{$purchase->price}' amount='{$purchase->amount}' value=''>{$purchase->variant_name|escape} {if $purchase->sku}(арт. {$purchase->sku}){/if}</option>{/if}
                    {foreach $purchase->product->variants as $v}
                        {if $v->stock>0 || $v->id == $purchase->variant->id}
                            <option price='{$v->price}' amount='{$v->stock}' value='{$v->id}' {if $v->id == $purchase->variant_id}selected{/if} >
                                {$v->name}
                                {if $v->sku}(арт. {$v->sku}){/if}
                            </option>
                        {/if}
                    {/foreach}
                </select>
            {*size_color*}
            {/if}
            {*/size_color*}
            </span>
            <span class=view_purchase>
                {$purchase->variant_name} {if $purchase->sku}(арт. {$purchase->sku}){/if}
            </span>
                {*size_color*}
                {if !empty($purchase->variant_color)}
                    <span class=view_purchase>
                        {$purchase->variant_color}
                    </span>
                {/if}
                {*/size_color*}
                        </div>

                        {if $purchase->product}
                            <a class="related_product_name" href="index.php?module=ProductAdmin&id={$purchase->product->id}&return={$smarty.server.REQUEST_URI|urlencode}">{$purchase->product_name}</a>
                        {else}
                            {$purchase->product_name}
                        {/if}
                    </div>
                    <div class="price cell">
                        <span class=view_purchase>{$purchase->price}</span>
            <span class=edit_purchase style='display:none;'>
            <input type=text name=purchases[price][{$purchase->id}] value='{$purchase->price}' size=5>
            </span>
                        {$currency->sign}
                    </div>
                    <div class="amount cell">
            <span class=view_purchase>
                {$purchase->amount} {$settings->units}
            </span>
            <span class=edit_purchase style='display:none;'>
                {if $purchase->variant}
                    {math equation="min(max(x,y),z)" x=$purchase->variant->stock+$purchase->amount*($order->closed) y=$purchase->amount z=$settings->max_order_amount assign="loop"}
                {else}
                    {math equation="x" x=$purchase->amount assign="loop"}
                {/if}
                <select name=purchases[amount][{$purchase->id}]>
                    {section name=amounts start=1 loop=$loop+1 step=1}
                        <option value="{$smarty.section.amounts.index}" {if $purchase->amount==$smarty.section.amounts.index}selected{/if}>{$smarty.section.amounts.index} {$settings->units}</option>
                    {/section}
                </select>
            </span>
                    </div>
                    <div class="icons cell">
                        {if !$order->closed}
                            {if !$purchase->product}
                                <img src='design/images/error.png' alt='Товар был удалён' title='Товар был удалён' >
                            {elseif !$purchase->variant}
                                <img src='design/images/error.png' alt='Вариант товара был удалён' title='Вариант товара был удалён' >
                            {elseif $purchase->variant->stock < $purchase->amount}
                                <img src='design/images/error.png' alt='На складе остал{$purchase->variant->stock|plural:'ся':'ось'} {$purchase->variant->stock} товар{$purchase->variant->stock|plural:'':'ов':'а'}' title='На складе остал{$purchase->variant->stock|plural:'ся':'ось'} {$purchase->variant->stock} товар{$purchase->variant->stock|plural:'':'ов':'а'}'  >
                            {/if}
                        {/if}
                        <a href='#' class="delete" title="Удалить"></a>
                    </div>
                    <div class="clear"></div>
                </div>
            {/foreach}
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
                    <input type=text name=purchases[price][] value='' size=5> {$currency->sign}
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
                        {if $purchases}
                        <li><label class=property>Сумма заказа</label> {$subtotal} {$currency->sign}</li>
                        {/if}

                        <li><label class=property>Скидка %</label><input type=text name=discount value='{$order->discount}'></li>
                        <li><label class=property>С учетом скидки</label>{($subtotal-$subtotal*$order->discount/100)|round:2} {$currency->sign}</li>
                        <li><label class=property>Купон{if $order->coupon_code} ({$order->coupon_code}){/if} {$currency->sign}</label><input type=text name=coupon_discount value='{$order->coupon_discount}'></li>
                        <li><label class=property>С учетом купона</label>{($subtotal-$subtotal*$order->discount/100-$order->coupon_discount)|round:2} {$currency->sign}</li>

                        <li>
                            <label class=property>Доставка</label>
                            <div class="parameter">
                                <select name="delivery_id">
                                    <option value="0">Не выбрана</option>
                                    {foreach $deliveries as $d}
                                        <option value="{$d->id}" {if $d->id==$delivery->id}selected{/if}>{$d->name}</option>
                                    {/foreach}
                                </select>
                                <input type=text name=delivery_price value='{$order->delivery_price}'  placeholder="Значение доставки {$currency->sign}">
                            </div>
                        </li>
                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="separate_delivery" {if $order->separate_delivery}checked{/if}>
                                <span>Доставка оплачивается отдельно</span>
                            </label>
                            <hr/>
                        </li>

                        <li><label class=property>Итого</label>{$order->total_price} {$currency->sign}</li>
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
                                <div id="add_purchase" {if $purchases}style='display:none;'{/if}>
                                    <input type=text name=related id='add_purchase' class="input_autocomplete" placeholder='Выберите товар чтобы добавить его'>
                                </div>
                                {if $purchases}
                                    <a href='#' class="dash_link edit_purchases">редактировать покупки</a>
                                {/if}
                            </div>
                        </li>

                        <li>
                            <label class=property>Оплата</label>
                            <div class="parameter">
                                <select name="payment_method_id">
                                    <option value="0">Не выбрана</option>
                                    {foreach $payment_methods as $pm}
                                        <option value="{$pm->id}" {if $pm->id==$payment_method->id}selected{/if}>{$pm->name}</option>
                                    {/foreach}
                                </select>

                                {if $payment_method}
                                    <div class="subtotal layer">
                                        К оплате<b> {$order->total_price|convert:$payment_currency->id} {$payment_currency->sign}</b>
                                    </div>
                                {/if}
                            </div>
                        </li>

                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="paid" {if $order->paid}checked{/if}>
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



    {if $prev_order and $next_order}
    <div class="board_footer">
        {if $prev_order}
		<a class=prev_order href="{url id=$prev_order->id}">←</a>
		{/if}
		{if $next_order}
		<a class=next_order href="{url id=$next_order->id}">→</a>
		{/if}
	</div>
    {/if}
</form>
<!-- Основная форма (The End) -->


{* On document load *}
{literal}
<script src="/js/autocomplete/jquery.autocomplete.min.js"></script>
<script src="design/js/datetimepicker/jquery.datetimepicker.js"></script>
<link href="design/js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>
<script>
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
        			amount_select.append("<option value='"+i+"'>"+i+" {/literal}{$settings->units}{literal}</option>");
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
			amount_select.append("<option value='"+i+"'>"+i+" {/literal}{$settings->units}{literal}</option>");
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

</script>
<style>
.autocomplete-suggestions{max-height:250px!important;overflow-y: scroll !important;}
</style>
{/literal}

{*size_color*}
<script>
    var size_color = new Array();
    {foreach from=$purchases item=purchase}
        if (!size_color['{$purchase->product->id}']) {
            size_color['{$purchase->product->id}'] = new Array();
        }
        {foreach from=$purchase->product->size_color key=key item=items}
            if (!size_color['{$purchase->product->id}']['{$key}']) {
                size_color['{$purchase->product->id}']['{$key}'] = new Array();
            }
            {foreach from=$items item=item}
                if (!size_color['{$purchase->product->id}']['{$key}']['{$item->color}']) {
                    size_color['{$purchase->product->id}']['{$key}']['{$item->color}'] = new Array();
                }
                size_color['{$purchase->product->id}']['{$key}']['{$item->color}']['price'] = '{$item->price}';
                size_color['{$purchase->product->id}']['{$key}']['{$item->color}']['variant_id'] = '{$item->id}';
            {/foreach}
        {/foreach}
    {/foreach}
    {literal}
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
    {/literal}
</script>
{*/size_color*}