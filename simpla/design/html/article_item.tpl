{if $article->id}
    {$meta_title = $article->name scope=parent}
{else}
    {$meta_title = 'Новый материал' scope=parent}
{/if}

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$article->id|escape}"/>

    <div class="content_header">
        <h1>{if $article->id}Редактирование материала{else}Новый материал{/if}</h1>

        <div class="buttons">
            <a href="{url module=ArticleAdmin method=null id=null}" class="button back">Назад</a>
            {if $article->id}
                <a href="/{$article->full_url}" target="_blank" class="button green">Просмотр на сайте</a>
            {/if}
            <input class="button save" type="submit" name="" value="Сохранить" />
        </div>
    </div>

    <div class="board block">
        <h2>Основные настройки</h2>
        <ul class="row">

            <li class="col s12 sm7">
                <label class="required">Название материала</label>
                <input name="name" type="text" value="{$article->name|escape}"/>
            </li>

            <li class="col s12 sm3">
                <label>Категория</label>

                <select name="article_category">
                    <option value="0"{if $article->category == 0} selected="selected"{/if}>Без категории</option>
                    {foreach $article_categories as $c}
                        <option value="{$c->id}" {if $article->category == $c->id}selected="selected"{/if} >{$c->name}</option>
                    {/foreach}
                </select>
            </li>

            <li class="col s12 sm2">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $article->visible}checked{/if}>
                    <span>Активный</span>
                </label>
            </li>

            <li class="col s12">
                <label>Текст материала</label>
                <textarea name="body" class="full_text">{$article->text|escape}</textarea>
            </li>

            <li class="col s12">
                <label>Краткое описание</label>
                <textarea name="annotation" class="full_text">{$article->annotation|escape}</textarea>
            </li>

        </ul>
    </div>

    <div class="block">
        <div class="row">
            <div class="col l8 s12">
                <h2>Свойства</h2>
                <ul>
                    <li>
                        <label>Адрес (url)</label>
                        <input name="url" type="text" value="{$article->url|escape}" />
                        <button name="generate_url" class="button update">Автозаполнение</button>
                    </li>
                    <li>
                        <label>Meta title</label>
                        <input name="meta_title" type="text" value="{$article->meta_title|escape}" />
                    </li>
                    <li>
                        <label>Meta Keywords</label>
                        <textarea name="meta_keywords">{$article->meta_keywords|escape}</textarea>
                        <button name="generate_keywords" class="button update">Автозаполнение</button>
                    </li>
                    <li>
                        <label>Meta Description</label>
                        <textarea name="meta_description">{$article->meta_description|escape}</textarea>
                        <button name="generate_description" class="button update">Автозаполнение</button>
                    </li>
                </ul>
            </div>

            <div class="col l4 s12">
                <h2>Дополнительно</h2>
                <ul>
                    <li><label>Дата создания</label><input type="text" name="date" value="{$article->date|date_format:'%Y/%m/%d %H:%M'}"></li>
                    <li><label>Дата изменения</label><input type="text" disabled="" name="date_update" value="{$article->date_update|date_format:'%Y/%m/%d %H:%M'}"></li>
                    <li><label>ID материала</label><input type="text" disabled="" value="{$article->id}"></li>
                </ul>
            </div>
        </div>
    </div>

</form>

{include file="admin_tinymce.tpl"}