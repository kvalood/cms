{if $delivery->id}
    {$meta_title = $delivery->name scope=parent}
{else}
    {$meta_title = 'Новый способ доставки' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">

    <div class="content_header">
        <a href="index.php?module=DeliveriesAdmin">← Назад</a>
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
        <div class="message_box message_success">
            <span>{if $message_success == 'added'}Способ доставки добавлен{elseif $message_success == 'updated'}Способ доставки изменен{/if}</span>
        </div>
    {/if}

    {if $message_error}
        <div class="message_box message_error">
            <span>{if $message_error == 'empty_name'}Не указано название доставки{/if}</span>
        </div>
    {/if}


	<div id="name">
        <label style="display: block;margin-bottom: 2px;">Название способа доставки</label>
        <input class="name_product" name=name type="text" value="{$delivery->name|escape}" placeholder="Название способа доставки"/>
		<input name=id type="hidden" value="{$delivery->id}"/>

        <label class="fancy-checkbox">
            <input type="checkbox" name="enabled" {if $delivery->enabled}checked{/if}>
            <span>Активен</span>
        </label>
	</div>

    <div class="board_subhead">
        <div id="board_column_left">
            <div class="block">
                <h2>Стоимость доставки</h2>
                <ul>
                    <li><label class=property>Стоимость {$currency->sign}</label><input name="price" class="simpla_small_inp" type="text" value="{$delivery->price}" /></li>
                    <li><label class=property>Бесплатна от {$currency->sign}</label><input name="free_from" class="simpla_small_inp" type="text" value="{$delivery->free_from}" /></li>
                    <li><label class=property>Сроки доставки дн.</label><input name="period" class="simpla_small_inp" type="text" value="{$delivery->period|escape}" /></li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="separate_payment" {if $delivery->separate_payment}checked{/if}>
                            <span>Оплачивается отдельно</span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Возможные способы оплаты</h2>
                <ul>
                    {foreach $payment_methods as $payment_method}
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="delivery_payments[]" value="{$payment_method->id}" {if in_array($payment_method->id, $delivery_payments)}checked{/if}>
                            <span>{$payment_method->name}</span>
                        </label>
                    </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    </div>

	
	<div class="text_block">
		<h2>Краткое описание</h2>
		<textarea name="description" class="editor_small">{$delivery->description|escape}</textarea>
	</div>

    <div class="board_footer">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form>