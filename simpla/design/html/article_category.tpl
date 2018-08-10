{if $category->name}
	{$meta_title=$category->name|escape scope=parent}
{else}
	{$meta_title='Новая категория' scope=parent}
{/if}


<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$category->id|escape}"/>

    <div class="content_header">
        <h1>{if $category->name}Категория - {$category->name}{else}Новая категория материалов{/if}</h1>

        <div class="buttons">
            <a href="{url module=ArticleAdmin method=categories id=null}" class="button back">Назад</a>
            <input class="button save" type="submit" name="" value="Сохранить" />
        </div>
    </div>

    <div class="board block">
        <h2>Основные настройки</h2>

        <ul class="row">
            <li class="col s12 m6">
                <label class="required">Название</label>
                <input name="name" type="text" value="{$category->name}"/>
            </li>
            <li class="col s12 m6">
                <label class="required">URL категории</label>
                <input name="url" type="text" value="{$category->url}" />
                <button name="generate_url" class="button update">Автозаполнение</button>
            </li>
        </ul>
    </div>

    <div class="row block">
        <div class="col s12 m6">
            <h2>Настройки SEO</h2>
            <ul>
                <li>
                    <label>Meta title</label>
                    <input name="meta_title" type="text" value="{$category->meta_title|escape}" />
                </li>
                <li>
                    <label>Meta Keywords</label>
                    <textarea name="meta_keywords">{$category->meta_keywords|escape}</textarea>
                </li>
                <li>
                    <label>Meta Description</label>
                    <textarea name="meta_description">{$category->meta_description|escape}</textarea>
                </li>
            </ul>
        </div>

        <div class="col s12 m6">
            <h2>Дополнительные настройки</h2>
            <ul>
                <li>
                    <label>Количество отображаемых материалов в категории</label>
                    <input name="articles_num" type="text" value="{if $category->articles_num != 0}{$category->articles_num}{/if}" />
                </li>
                <li>
                    <label>Сортировать по</label>
                    <select name="sorting_method">
                        <option value="date" {if $category->sorting_method|escape == 'date'}selected="select"{/if}>дате создания</option>
                        <option value="date_update" {if $category->sorting_method|escape == 'date_update'}selected="select"{/if}>дате обновления</option>
                        <option value="name" {if $category->sorting_method|escape == 'name'}selected="select"{/if}>названию</option>
                        <option value="id" {if $category->sorting_method|escape == 'id'}selected="select"{/if}>id материала</option>
                    </select>
                </li>

                <li>
                    <label>Сортировать по</label>
                    <select name="sorting_type">
                        <option value="desc" {if $category->sorting_type|escape == 'desc'}selected="select"{/if}>убыванию</option>
                        <option value="asc" {if $category->sorting_type|escape == 'asc'}selected="select"{/if}>возрастанию</option>
                    </select>
                </li>
                <li>
                    <label>Шаблон (прим. actions.tpl)</label>
                    <input name="template" type="text" value="{$category->template|escape}" />
                </li>
            </ul>
        </div>

    </div>
</form>