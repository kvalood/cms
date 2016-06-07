{if $label->id}
    {$meta_title = $label->name scope=parent}
{else}
    {$meta_title = 'Новая метка' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

{* On document load *}
{literal}
<link rel="stylesheet" media="screen" type="text/css" href="design/js/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="design/js/colorpicker/js/colorpicker.js"></script>

<script>
$(function() {
	$('#color_icon, #color_link').ColorPicker({
		color: $('#color_input').val(),
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#color_icon').css('backgroundColor', '#' + hex);
			$('#color_input').val(hex);
			$('#color_input').ColorPickerHide();
		}
	});
});
</script>
{/literal}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$label->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>
                {if $label->id}
                    Редактирование метки
                {else}
                    Создание метки
                {/if}
            </h1>
        </div>
        <a href="{url module=OrdersLabelsAdmin}">← Назад</a>

        {if $label->id}
            <a href="index.php?module=OrdersLabelAdmin">+ Создать еще одну метку</a>
        {/if}

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success == 'added'}Метка добавлена{elseif $message_success == 'updated'}Метка обновлена{/if}</span>
    </div>
    {/if}

    {if $message_error}
        <div class="message_box message_error">
            <span>{if $message_error == 'empty_name'}Название метки не может быть пустым{/if}</span>
        </div>
    {/if}

    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название метки</label><input class="name" name="name" type="text" value="{$label->name|escape}"/></li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li>
                        <label class=property>Цвет метки</label>
                        <span id="color_icon" style="background-color:#{$label->color};" class="order_label"></span>
                        <input id="color_input" name="color" type="hidden" value="{$label->color|escape}" />
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div id="action">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form>