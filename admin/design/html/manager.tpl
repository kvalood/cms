{if $m->login}
    {$meta_title = $m->login scope=parent}
{else}
    {$meta_title = 'Новый менеджер' scope=parent}
{/if}

<script>
{literal}
$(function() {
	// Выделить все
	$("#check_all").click(function() {
		$('input[type="checkbox"][name*="permissions"]:not(:disabled)').attr('checked', $('input[type="checkbox"][name*="permissions"]:not(:disabled):not(:checked)').length>0);
	});

	{/literal}{if $m->login}$('#password_input').hide();{/if}{literal}
	$('#change_password').click(function() {
		$('#password_input').show();
	});
});
{/literal}
</script>

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">

    <div class="content_header">
        <a href="index.php?module=ManagersAdmin">← Назад</a>
        <a href="index.php?module=ManagerAdmin">+ Добавить менеджера</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success=='added'}Менеджер добавлен{elseif $message_success=='updated'}Менеджер обновлен{else}{$message_success|escape}{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>
        {if $message_error=='login_exists'}Менеджер с таким логином уже существует
        {elseif $message_error=='empty_login'}Введите логин
        {elseif $message_error=='not_writable'}Установите права на запись для файла /admin/.passwd
        {else}{$message_error|escape}{/if}
        </span>
    </div>
    {/if}

	<div id="name">
        <label style="display: block;margin-bottom: 2px;">Логин:</label>
		<input class="name_product" name="login" type="text" value="{$m->login|escape}" maxlength="32"/>
		<input name="old_login" type="hidden" value="{$m->login|escape}"/>

        <br/>
        <label style="display: block;margin-bottom: 2px;">Пароль:</label>
		{if $m->login}<a class="dash_link"id="change_password">изменить</a>{/if}
		<input id="password_input" class="name_product" name="password" type="password" value=""/>
	</div> 


    <div class="board">
        <div class="block">
            <h2>Права доступа: </h2>

            <label id="check_all" class="dash_link">Выбрать все</label>
            <ul style="margin-top:15px;">
                {$perms = [
                    'products'   =>'Товары',
                    'categories' =>'Категории товаров',
                    'brands'     =>'Бренды',
                    'features'   =>'Свойства товаров',
                    'orders'     =>'Заказы',

                    'labels'     =>'Метки заказов',

                    'users'      =>'Покупатели',
                    'groups'     =>'Группы покупателей',

                    'coupons'    =>'Скидочные купоны',

                    'comments'   =>'Комментарии',
                    'feedback'   =>'Обратная связь',

                    'import'     =>'Импорт товаров',
                    'export'     =>'Экспорт товаров',
                    'backup'     =>'Бекап товаров',

                    'stats'      =>'Статистика продаж',

                    'design'     =>'Управление дизайном сайта',
                    'settings'   =>'Настройки сайта',
                    'currency'   =>'Валюты сайта',

                    'delivery'   =>'Способы доставки',
                    'payment'    =>'Способы оплаты',
                    'managers'   =>'Менеджеры',

                    'article'	 =>'Материалы',
                    'articlecat' =>'Категории материалов',
                    'tags'	     =>'Теги/метки',
                    'slides'     =>'Слайдер',
                    'menu'	     =>'Меню'
                ]}

                {foreach $perms as $p=>$name}
                <li>
                    <label class=property for="{$p}">{$name}</label>
                    <input id="{$p}" name="permissions[]" type="checkbox" value="{$p}" {if $m->permissions && in_array($p, $m->permissions)}checked{/if} {if $m->login==$manager->login}disabled{/if}/>
                </li>
                {/foreach}
            </ul>
        </div>

        <div id="action">
            <input class="button_green button_save" type="submit" name="" value="Сохранить" />
        </div>
    </div>
</form>