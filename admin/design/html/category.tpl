{if $category->id}
	{$meta_title = $category->name scope=parent}
{else}
	{$meta_title = 'Новая категория' scope=parent}
{/if}

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$category->id|escape}"/>
	
	<div class="content_header">
        <h1>{if $category->id}Редактирование категории{else}Создание категории{/if}</h1>

        <div class="buttons">
            <a href="{url module=CategoriesAdmin method=null id=null}" class="button back">Назад</a>
            <input type="submit" name="remove" class="button red" value="Удалить" />
            {if $category->id}
                <a href="/catalog/{$category->url|escape}" target="_blank" class="button green">Просмотр на сайте</a>
            {/if}
            <input class="button save" type="submit" name="" value="Сохранить" />
        </div>
    </div>

    <div class="board block">
        <h2>Основные настройки</h2>
        <ul class="row">

            <li class="col s12 sm7">
                <label class="required">Название категории</label>
                <input name="name" type="text" value="{$category->name|escape}"/>
            </li>

            <li class="col s12 sm3">
                <label>Родительская категория</label>

                <select name="parent_id" data-live-search="true">
                    <option value='0'>Корневая категория</option>
                    {function name=category_select level=0}
                        {foreach $cats as $cat}
                            {if $category->id != $cat->id}
                                <option value='{$cat->id}' {if $category->parent_id == $cat->id}selected{/if}>{section name=sp loop=$level}-{/section} {$cat->name}</option>
                                {category_select cats=$cat->subcategories level=$level+1}
                            {/if}
                        {/foreach}
                    {/function}
                    {category_select cats=$categories}
                </select>
            </li>

            <li class="col s12 sm2">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $category->visible}checked{/if}>
                    <span>Активна</span>
                </label>
            </li>

            <li class="col s12">
                <label>Описание категории</label>
                <textarea name="description" class="full_text">{$category->description|escape}</textarea>
            </li>

        </ul>
    </div>

    <div class="block">
        <div class="row">
            <div class="col l8 s12">
                <h2>Свойства</h2>
                <ul>
                    <li>
                        <label>URL /catalog/</label>
                        <input name="url" type="text" value="{$category->url|escape}" />
                        <button name="generate_url" class="button update">Автозаполнение</button>
                    </li>
                    <li>
                        <label>Meta title</label>
                        <input name="meta_title" type="text" value="{$category->meta_title|escape}" />
                    </li>
                    <li>
                        <label>Meta Keywords</label>
                        <textarea name="meta_keywords">{$category->meta_keywords|escape}</textarea>
                        <button name="generate_keywords" class="button update">Автозаполнение</button>
                    </li>
                    <li>
                        <label>Meta Description</label>
                        <textarea name="meta_description">{$category->meta_description|escape}</textarea>
                        <button name="generate_description" class="button update">Автозаполнение</button>
                    </li>
                </ul>
            </div>

            <div class="col l4 s12">
                <h2>Изображение категории</h2>
                <input class='upload_image' name=image type=file>
                <input type=hidden name="delete_image" value="">
                {if $category->image}
                    <ul>
                        <li>
                            <a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
                            <img src="../{$config->categories_images_dir}{$category->image}" alt="" />
                        </li>
                    </ul>
                {/if}
            </div>
        </div>
    </div>


</form>

{include file="admin_tinymce.tpl"}

{* On document load *}
{literal}

    <script>
        $(function() {


            // Удаление изображений
            $(".images a.delete").click( function() {
                $("input[name='delete_image']").val('1');
                $(this).closest("ul").fadeOut(200, function() { $(this).remove(); });
                return false;
            });

        });

    </script>

{/literal}