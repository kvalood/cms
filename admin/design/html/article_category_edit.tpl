{* Title *}
{if $articlecat->name}
	{$meta_title={$articlecat->name} scope=parent}
{else}
	{$meta_title='Новая категория материалов' scope=parent}
{/if}

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$articlecat->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>{if $articlecat->name}Категория - {$articlecat->name}{else}Новая категория материалов{/if}</h1>
        </div>

        <a href="index.php?module=ArticleCategoryAdmin"><- Назад</a>
        <a class="add" href="index.php?module=ArticleCategoryAdmin&method=add_cat">+ Добавить категорию</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

	{if $message_success}
	<div class="message_box message_success">
		<span>{if $message_success == 'cat_add'}Категория добавлена{elseif $message_success == 'updated'}Категория обновлена{/if}</span>
	</div>
	{/if}

	{if $message_error}
	<div class="message_box message_error">
		<span>{if $message_error == 'no_name'}Вы не указали название категории{elseif $message_error == 'exist_name_cat'}Категория с таким именем уже существует{/if}</span>
	</div>
	{/if}


	<div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки категории</h2>
                <ul>
                    <li><label class=property>Название</label><input class="name" name="cat_name" type="text" value="{$articlecat->name}"/></li>
                    <li><label class=property>Шаблон (прим. arcion_article.tpl)</label><input name="template" type="text" value="{$articlecat->template}" /></li>
                    <li><label class=property>Количество отображаемых материалов в категории</label><input name="articles_num" type="text" value="{if $articlecat->articles_num != 0}{$articlecat->articles_num}{/if}" /></li>
                    <li>
                        <label class=property>Сортировать по</label>
                        <select name="sorting_method">
                            <option value="date" {if $articlecat->sorting_method|escape == 'date'}selected="select"{/if}>дате создания</option>
                            <option value="date_update" {if $articlecat->sorting_method|escape == 'date_update'}selected="select"{/if}>дате обновления</option>
                            <option value="name" {if $articlecat->sorting_method|escape == 'name'}selected="select"{/if}>названию</option>
                            <option value="id" {if $articlecat->sorting_method|escape == 'id'}selected="select"{/if}>id материала</option>
                        </select>
                    </li>

                    <li>
                        <label class=property>Сортировать по</label>
                        <select name="sorting_type">
                            <option value="desc" {if $articlecat->sorting_type|escape == 'desc'}selected="select"{/if}>убыванию</option>
                            <option value="asc" {if $articlecat->sorting_type|escape == 'asc'}selected="select"{/if}>возрастанию</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Meta title</label><input name="meta_title" type="text" value="{$articlecat->meta_title|escape}" /></li>
                    <li><label class=property>Meta Keywords</label><input name="meta_keywords"  type="text" value="{$articlecat->meta_keywords|escape}" /></li>
                    <li><label class=property>Meta Description</label><textarea name="meta_description" />{$articlecat->meta_description|escape}</textarea></li>
                </ul>
            </div>
        </div>
    </div>
</form>