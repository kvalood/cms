{if $banner_image->id}
	{$meta_title = 'Редактирование баннера' scope=parent}
{else}
	{$meta_title = 'Создание баннера' scope=parent}
{/if}


<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$banner_image->id|escape}"/>


    <div class="content_header">
        <h1>{if $banner_image->id}Редактирование баннера{else}Добавление баннера{/if}</h1>

        <div class="buttons">
            <a href="{url module=BannerAdmin method=null id=null}" class="button back">Назад</a>
            <input class="button save" type="submit" name="" value="{if $banner_image->id}Сохранить{else}Создать{/if}" />
        </div>
	</div>

	<div class="board block">

        <h2>Настройки баннера</h2>
        <ul class="row">
            <li class="col s12 sm7">
                <label class="required">Название баннера</label>
                <input name="name" type="text" value="{$banner_image->name|escape}" required/>
            </li>

            {if $banners}
            <li class="col s12 sm3">
                <label>Группа баннеров</label>

                <select name="banner_id">
                {foreach $banners as $banner_id}
                    <option value="{$banner_id->id}">{$banner_id->name}</option>
                {/foreach}
                </select>
            </li>
            {/if}

            <li class="col s12 sm2">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $banner_image->visible}checked{/if}>
                    <span>Активный</span>
                </label>
            </li>

            <li class="col s12">
                <label>URL баннера</label>
                <input name="url" type="text" value="{$banner_image->url|escape}" />
            </li>

            <li class="col s12">
                <label>Текст на баннере</label>
                <textarea name="description" class="full_text">{$banner_image->description|escape}</textarea>
            </li>
        </ul>

        <h2>Изображение баннера</h2>

        <ul class="row">
        {if $banner_image->image}

            <li class="col s12">
                <input type="submit" name="delete_image" class="button red" value="Удалить изображение и обновить баннер">
            </li>

            <li class="col s12">
                <img src="{$banner_image->image}" alt="" />
            </li>

        {else}
            <li class="col s12">
                <input class='upload_image' name=image type=file value="test">
            </li>
        {/if}
        </ul>

    </div>

</form>


{include file="admin_tinymce.tpl"}