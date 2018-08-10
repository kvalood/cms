{if $menu->id}
    {$meta_title = 'Редактирование меню' scope=parent}
{else}
    {$meta_title = 'Создание меню' scope=parent}
{/if}


<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$menu->id|escape}"/>

    <div class="content_header">
        <h1>{if $menu->name}Редактирование меню{else}Создание меню{/if}</h1>

        <div class="buttons">
            <a href="{url method=MenuAdmin menu_id=null}" class="button back">Назад</a>
            <input class="button save" type="submit" value="Сохранить" />
        </div>
    </div>

    <div class="board block">

        <h2>Параметны</h2>

        <ul class="row">
            <li class="col s12 sm10">
                <label>Название</label>
                <input name="name" type="text" value="{$menu->name|escape}"/>
            </li>

            <li class="col s12 sm2">
                <label>ID</label>
                <input type="text" value="{$menu->id|escape}" disabled />
            </li>

        </ul>
    </div>

</form>