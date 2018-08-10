{$meta_title = 'Список пунктов меню' scope=parent}

<div class="content_header">
    <h1>Список пунктов меню <i>{$cat_cat->name|escape}</i></h1>

    <div class="buttons">
        <a href="{url module=MenuAdmin method=null menu_id=null id=null}" class="button back">Назад</a>
	    <a href="{url module=MenuAdmin method=item menu_id=$menu->id}" class="button green">Добавить пункт меню</a>
    </div>
</div>

<div class="board">
{if $items}
	<form method="post" data-object="menu_item">

		<input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div class="list_items">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <td>Название</td>
                        <td>Тип</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                {foreach $items as $item}
                    <tr class="row" data-visible="{$item->visible}">
                        <td>
                            <input type="hidden" name="positions[{$item->id}]" value="{$item->position}">
                            <input type="checkbox" name="check[]" value="{$item->id}" />
                        </td>
                        <td>
                            <a href="{url module=MenuAdmin method=item menu_id=$menu->id id=$item->id}">{$item->name|escape}</a>
                        </td>
                        <td>
                            {if $item->type==1}Материал{elseif $item->type==2}Категория материалов{elseif $item->type==3}URL{/if}
                        </td>
                        <td class="control">
                            <a class="enable" title="Активна" href="#"></a>
                        </td>
                    </tr>
                {/foreach}
                </tbody>
            </table>


            <div class="row header_list">
                <div class="col s1 checkbox">
                    <input type="checkbox" id="check_all" />
                </div>
                <div class="col s7">Название</div>
                <div class="col s2">Тип пункта</div>
                <div class="col s2 control"></div>
            </div>

            <div id="sortable">
                {foreach $items as $item}
                <div class="row list_item" data-visible="{$item->visible}">
                    <input type="hidden" name="positions[{$item->id}]" value="{$item->position}">

                    <div class="col s1 checkbox">
                        <input type="checkbox" name="check[]" value="{$item->id}" />
                    </div>
                    <div class="col s7">
                        <a href="{url module=MenuAdmin method=item menu_id=$menu->id id=$item->id}">{$item->name|escape}</a>
                    </div>
                    <div class="col s2">
                        {if $item->type==1}Материал{elseif $item->type==2}Категория материалов{elseif $item->type==3}URL{/if}
                    </div>
                    <div class="col s2 control">
                        <a class="enable" title="Активна" href="#"></a>
                    </div>
                </div>
                {/foreach}
            </div>
        </div>
	
		<div id="action">
            <select name="action">
                <option value="enable">Сделать видимыми</option>
                <option value="disable">Сделать невидимыми</option>
                <option value="delete">Удалить</option>
            </select>

            <input class="button green" type="submit" value="Применить">
		</div>
	</form>	
{else}
	Нет пунктов меню
{/if}
</div>