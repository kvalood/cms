{if $banner->id}
    {$meta_title = 'Редактирование группы баннеров' scope=parent}
{else}
    {$meta_title = 'Создание группы баннеров' scope=parent}
{/if}

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$banner->id|escape}"/>

    <div class="content_header">
        <h1>{if $banner->id}Редактирование группы баннеров{else}Создание группы баннеров{/if}</h1>

        <div class="buttons">
            <a href="{url module=BannerAdmin method=banners id=null}" class="button back">Назад</a>
            <input class="button save" type="submit" name="save" value="{if $banner->id}Сохранить{else}Создать{/if}" />
        </div>
    </div>

    <div class="board">
        <div class="row">
            <div class="col s12 sm6">
                <label>Название группы</label>
                <input type="text" value="{$banner->name|escape}" name="name"/>
            </div>

            <div class="col s12 sm6">
                <label>ID группы</label>
                <input type="text" value="{$banner->id|escape}" name="id" disabled/>
            </div>
        </div>
    </div>

</form>