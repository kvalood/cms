{if $coupon->code}
    {$meta_title = $coupon->code scope=parent}
{else}
    {$meta_title = 'Новый купон' scope=parent}
{/if}

<script src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"></script>
{literal}
<script>
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
</script>
{/literal}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name="id" class="name" type="hidden" value="{$coupon->id|escape}"/>


    <div class="content_header">
        <div id="header">
            <h1>
                {if $coupon->code}
                    Редактирование купона
                {else}
                    Новый купон
                {/if}
            </h1>
        </div>
        <a href="{url module=CouponsAdmin}">← Назад</a>
        <a href="{url module=CouponAdmin id=null}">+ Добавить еще один купон</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span class="text">{if $message_success == 'added'}Купон добавлен{elseif $message_success == 'updated'}Купон изменен{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span class="text">
            {if $message_error == 'code_exists'}Купон с таким кодом уже существует{/if}
            {if $message_error == 'code_empty'}Заполните название купона{/if}
        </span>
    </div>
    {/if}


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название купона</label><input class="name" name="code" value="{$coupon->code}" type="text"></li>

                    <li>
                    <hr/>
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="single" {if $coupon->single}checked{/if}>
                        <span>Одноразовый/не одноразовый</span>
                    </label>
                    </li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="expires" {if $coupon->expire}checked{/if}>
                            <span>Истекает?</span>
                        </label>
                        <input type=text name=expire value='{$coupon->expire|date}'>
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
                                <option value="percentage" {if $coupon->type=='percentage'}selected{/if}>%</option>
                                <option value="absolute" {if $coupon->type=='absolute'}selected{/if}>{$currency->sign}</option>
                            </select>
                        </label><input name="value" class="coupon_value" type="text" value="{$coupon->value|escape}" />
                    </li>

                    <li><label class=property>Для заказов от ({$currency->sign})</label><input type="text" name="min_order_price" value="{$coupon->min_order_price|escape}"></li>
                </ul>
            </div>
        </div>
	</div>


    <div id="action">
	    <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
	
</form>