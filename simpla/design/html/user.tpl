{if $user->id}
    {$meta_title = $user->name|escape scope=parent}
{/if}

<form method=post id=product>
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$user->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>Редактирование пользователя</h1>
        </div>
        <a href="{url module="UsersAdmin"}">← Назад</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
        <div class="message_box message_success">
            <span>{if $message_success=='updated'}Пользователь отредактирован{else}{$message_success|escape}{/if}</span>
        </div>
    {/if}

    {if $message_error}
        <div class="message_box message_error">
            <span>{if $message_error=='login_exists'}Пользователь с таким email уже зарегистрирован
            {elseif $message_error=='empty_name'}Введите имя пользователя
            {elseif $message_error=='empty_email'}Введите email пользователя{/if}</span>
        </div>
    {/if}

    {if $user->id}
        <div class="board_content">
            <div id="board_column_left">
                <div class="block">
                    <h2>Основная информация</h2>
                    <ul>
                        <li><label class="property">ФИО</label><input class="name" name=name type="text" value="{$user->name|escape}"/></li>
                        <li><label class=property>Email</label><input name="email" type="text" value="{$user->email|escape}" /></li>
                        <li><label class=property>Дата регистрации</label><input name="email" type="text" disabled value="{$user->created|date} {$user->created|time}" /></li>

                        {if $groups}
                            <li>
                                <label class=property>Группа</label>
                                <select name="group_id">
                                    <option value='0'>Не входит в группу</option>
                                    {foreach $groups as $g}
                                        <option value='{$g->id}' {if $user->group_id == $g->id}selected{/if}>{$g->name|escape}</option>
                                    {/foreach}
                                </select>
                            </li>
                        {/if}
                    </ul>
                </div>
            </div>

            <div id="board_column_right">
                <div class="block">
                    <h2>Дополнительная информация</h2>
                    <ul>
                        <li><label class=property>Последний IP</label><input name="email" type="text" disabled value="{$user->last_ip|escape}" /></li>
                        <li><label class=property>Последняя активность</label><input name="email" type="text" disabled value="{$user->last_visit|date} {$user->last_visit|time}" /></li>

                        <li>
                            <hr/>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="enabled" {if $user->enabled==1}checked{/if}>
                                <span>Активен</span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {if $orders}
        <div class="board_content">
            <h2>Заказы пользователя</h2>
            <div id="list">

                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="name">Номер заказа</div>
                    <div class="order">Дата заказа</div>
                    <div class="order">Сумма заказа</div>
                </div>

                {foreach $orders as $order}
                    <div class="{if $order->paid}green{/if} row">
                        <div class="checkbox cell">
                            <input type="checkbox" name="check[]" value="{$order->id}" />
                        </div>

                        <div class="name cell">
                            <a href="{url module=OrderAdmin id=$order->id}">Заказ №{$order->id}</a>
                        </div>

                        <div class="order cell">
                            {$order->date|date} {$order->date|time}
                        </div>

                        <div class="order cell">
                            {$order->total_price}&nbsp;{$currency->sign}
                        </div>

                        <div class="icons cell">
                            {if $order->paid}
                                <img src='design/images/cash_stack.png' alt='Оплачен' title='Оплачен'>
                            {else}
                                <img src='design/images/cash_stack_gray.png' alt='Не оплачен' title='Не оплачен'>
                            {/if}

                            <a href='#' class=delete></a>
                        </div>
                    </div>
                {/foreach}
            </div>

            <div id="action">
                <label id='check_all' class='dash_link'>Выбрать все</label>

                <span id=select>
                <select name="action">
                    <option value="delete">Удалить</option>
                </select>
                </span>

                <input id="apply_action" class="button_green" name="user_orders" type="submit" value="Применить">
            </div>
        </div>
        {/if}
    {/if}

</form>

{literal}
<script>
$(function() {

    // Выделить все
    $("#check_all").click(function() {
        $('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
    });

    // Удалить
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form#list").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form#list").submit();
	});

	// Подтверждение удаления
	$("#list").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});
</script>
{/literal}