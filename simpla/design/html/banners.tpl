{$meta_title = 'Список групп баннеров' scope=parent}

<div class="container_top_header">
    <a href="{url module=BannerAdmin method=null id=null}">Баннеры</a>
    <a href="{url module=BannerAdmin method=banners id=null}">Группы баннеров</a>
</div>

<div class="content_header">
    <h1>Список групп баннеров</h1>

    <div class="buttons">
        <a href="{url module=BannerAdmin method=null id=null}" class="button green">Создать группу баннеров</a>
    </div>
</div>

<div class="board">
{if $banners}
    <div class="list_items">
        <div class="row header_list">
             <div class="col s1 control"></div>
             <div class="col s1">ID</div>
             <div class="col s10">Изображения группы</div>
        </div>

        {foreach $banners as $banner_id}
        <div class="row list_item">
            <div class="col s1 control">
                <a href="{url module=BannerAdmin method=banner id=$banner_id->id}" class="icon-cog" title="Редактировать группу баннеров"></a>
            </div>
            <div class="col s1">{$banner_id->id}</div>
            <div class="col s10">
                <a href="{url module=BannerAdmin method=banner_images banner_id=$banner_id->id id=null}" title="Изображения группы баннеров" class="link">{$banner_id->name|escape}</a>
            </div>
        </div>
        {/foreach}
    </div>
{else}
	Группы баннеров отсутствуют
{/if}
</div>