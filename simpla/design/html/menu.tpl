{$meta_title = 'Меню сайта' scope=parent}

<div class="content_header">
    <h1>Управление меню</h1>

    <div class="buttons">
	    <a href="{url module=MenuAdmin method=menu menu_id=null}" class="button green">Создать новое меню</a>
    </div>
</div>

<div class="board">
{if $menu}
    <form method="post">

        <input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div class="list_items">
            <div class="row header_list">
                <div class="col s1 checkbox">
                    <input type="checkbox" id="check_all" />
                </div>
                <div class="col s9">Название</div>
                <div class="col s1">ID</div>
                <div class="col s1 control"></div>
            </div>

            {foreach $menu as $m}
                <div class="row list_item">
                    <div class="col s1 checkbox">
                        <input type="checkbox" name="check[]" value="{$m->id}" />
                    </div>
                    <div class="col s9">
                        <a href="{url module=MenuAdmin method=items menu_id=$m->id}" title="Смотреть пункты меню" class="link">{$m->name|escape}</a>
                    </div>
                    <div class="col s1">{$m->id}</div>
                    <div class="col s1 control">
                        <a href="#" class="delete" title="Удалить" data="{$m->id}"></a>
                        <a href="{url module=MenuAdmin method=menu menu_id=$m->id}" class="icon-cog" title="Редактировать меню"></a>
                    </div>
                </div>
            {/foreach}
		</div>
	
		<div id="action">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>

            <input id="apply_action" class="button green" type="submit" value="Применить">
		</div>
	</form>
{else}
	Нет созданных меню
{/if}
</div>