{$meta_title='Импорт товаров' scope=parent}

<div class="content_header">
    <h1>{if $count_prices}{$count_prices} {$count_prices|plural:'прайс':'прайсов':'прайса'}{else}Нет прайсов.{/if}</h1>

    <div class="buttons">
	    <a href="{url module=ImportAdmin method=item id=null}" class="button green">Добавить прайс</a>
    </div>
</div>

<div class="board">
{if $prices}
    <form method="post" data-object="article">

        <input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div class="list_items">
            <div class="row header_list">
                <div class="col s1 checkbox">
                    <input type="checkbox" id="check_all" />
                </div>
                <div class="col s6">Название</div>
                <div class="col s5">Дата последнего импорта</div>
            </div>

            {foreach $prices as $item}
                <div class="row list_item">
                    <div class="col s1 checkbox">
                        <input type="checkbox" name="check[]" value="{$item->id}" />
                    </div>
                    <div class="col s6">
                        <a href="{url module=ImportAdmin method=item id=$item->id}">{$item->name|escape}</a>
                    </div>
                    <div class="col s5">
                        {$item->last_import|date_format:'%Y/%m/%d %H:%M'}
                    </div>
                </div>
            {/foreach}
		</div>

		<div id="action">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>

            <input class="button green" type="submit" value="Применить">
		</div>

        <div class="block">
            {include file='pagination.tpl'}
        </div>
	</form>
{else}
    Прайсы отсутствуют
{/if}
</div>