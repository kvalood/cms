{if $payment_method->id}
    {$meta_title = $payment_method->name scope=parent}
{else}
    {$meta_title = 'Новый способ оплаты' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

{* On document load *}
{literal}
<script>
$(function() {
	$('div#module_settings').filter(':hidden').find("input, select, textarea").attr("disabled", true);

	$('select[name=module]').change(function(){
		$('div#module_settings').hide().find("input, select, textarea").attr("disabled", true);
		$('div#module_settings[module='+$(this).val()+']').show().find("input, select, textarea").attr("disabled", false);
	});
});
</script>
{/literal}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">

    <div class="content_header">
        <div id="header">
            <h1>{if $payment_method->id}Редактировать способ оплаты{else}Новый способ оплаты{/if}</h1>
        </div>
        {if $payment_method->id}<a id="add_currency" href="#">Добавить еще один способ оплаты</a>{/if}

        <input id='apply_action' class="button_green button_save" type=submit value="Сохранить">
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success == 'added'}Способ оплаты добавлен{elseif $message_success == 'updated'}Способ оплаты изменен{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>{if $message_error == 'empty_name'}Укажите название способа оплаты{/if}</span>
    </div>
    {/if}


    <div class="board_subhead">
        <div id="name">
            <input class="name_product" name=name type="text" value="{$payment_method->name|escape}"/>
            <input name=id type="hidden" value="{$payment_method->id}"/>
            <label class="fancy-checkbox">
                <input type="checkbox" name="enabled" {if $payment_method->enabled}checked{/if}>
                <span>Активен</span>
            </label>
        </div>
    </div>


    <div class="board_subhead">
	    <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li>
                        <label class=property>Обработчик</label>
                        <select name="module">
                            <option value='null'>Ручная обработка</option>
                            {foreach $payment_modules as $payment_module}
                                <option value='{$payment_module@key|escape}' {if $payment_method->module == $payment_module@key}selected{/if} >{$payment_module->name|escape}</option>
                            {/foreach}
                        </select>
                    </li>
                    <li>
                        <label class=property>Валюта</label>
                        <select name="currency_id">
                            {foreach $currencies as $currency}
                                <option value='{$currency->id}' {if $currency->id==$payment_method->currency_id}selected{/if}>{$currency->name|escape}</option>
                            {/foreach}
                        </select>
                    </li>
                </ul>
            </div>

            {foreach $payment_modules as $payment_module}
                <div class="block" {if $payment_module@key!=$payment_method->module}style='display:none;'{/if} id=module_settings module='{$payment_module@key}'>
                <h2>{$payment_module->name}</h2>
                {* Параметры модуля оплаты *}
                <ul>
                {foreach $payment_module->settings as $setting}
                    {$variable_name = $setting->variable}
                    {if $setting->options|@count>1}
                    <li><label class=property>{$setting->name}</label>
                    <select name="payment_settings[{$setting->variable}]">
                        {foreach $setting->options as $option}
                        <option value='{$option->value}' {if $option->value==$payment_settings[$setting->variable]}selected{/if}>{$option->name|escape}</option>
                        {/foreach}
                    </select>
                    </li>
                    {elseif $setting->options|@count==1}
                    {$option = $setting->options|@first}
                    <li><label class="property" for="{$setting->variable}">{$setting->name|escape}</label><input name="payment_settings[{$setting->variable}]" type="checkbox" value="{$option->value|escape}" {if $option->value==$payment_settings[$setting->variable]}checked{/if} id="{$setting->variable}" /> <label for="{$setting->variable}">{$option->name}</label></li>
                    {else}
                    <li><label class="property" for="{$setting->variable}">{$setting->name|escape}</label><input name="payment_settings[{$setting->variable}]" type="text" value="{$payment_settings[$setting->variable]|escape}" id="{$setting->variable}"/></li>
                    {/if}
                {/foreach}
                </ul>
                {* END Параметры модуля оплаты *}

                </div>
            {/foreach}

            <div {if $payment_method->module != ''}style='display:none;'{/if} id=module_settings module='null'></div>
        </div>

        <div id="board_column_right">
            <div class="block">
            <h2>Возможные способы доставки</h2>
            <ul>
            {foreach $deliveries as $delivery}
                <li>
                <input type=checkbox name="payment_deliveries[]" id="delivery_{$delivery->id}" value='{$delivery->id}' {if in_array($delivery->id, $payment_deliveries)}checked{/if}> <label for="delivery_{$delivery->id}">{$delivery->name}</label><br>
                </li>
            {/foreach}
            </ul>
            </div>
        </div>
    </div>
	
	<div class="text_block">
		<h2>Описание</h2>
		<textarea name="description" class="editor_small">{$payment_method->description|escape}</textarea>
	</div>

    <div class="board_footer">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form>