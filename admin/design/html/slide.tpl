{if $slide->id}
	{$meta_title = 'Редактирование слайда' scope=parent}
{else}
	{$meta_title = 'Создание слайда' scope=parent}
{/if}


<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$slide->id|escape}"/>


    <div class="content_header">
        <h1>{if $slide->id}Редактирование слайда{else}Добавление слайда{/if}</h1>

        <div class="buttons">
            <a href="index.php?module=SliderAdmin&method=slides{if $smarty.get.slider_id}&id={$smarty.get.slider_id}{/if}" class="button back">Назад</a>
            <input class="button save" type="submit" name="" value="{if $slide->id}Сохранить{else}Создать{/if}" />
        </div>
	</div>

	<div class="board block">

        <h2>Настройки слайда</h2>
        <ul class="row">
            <li class="col s12 sm4">
                <label class="required">Название слайда</label>
                <input name="name" type="text" value="{$slide->name|escape}" required/>
            </li>

            <li class="col s12 sm4">
                <label>URL слайда</label>
                <input name="url" type="text" value="{$slide->url|escape}" />
            </li>

            <li class="col s12 sm4">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $slide->visible}checked{/if}>
                    <span>Активный</span>
                </label>
            </li>

            <li class="col s12">
                <label>Текст на слайде</label>
                <textarea name="description" class="full_text">{$slide->description|escape}</textarea>
            </li>
        </ul>

        <h2>Изображение слайда</h2>

        <ul class="row">
        {if $slide->image}

            <li class="col s12">
                <input type="submit" name="delete_image" class="button red" value="Удалить изображение и обновить слайд">
            </li>

            <li class="col s12">
                <img src="{$slide->image}" alt="" />
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