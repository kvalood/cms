{$meta_title='Категории страниц' scope=parent}

<div class="content_header">
    <h1>Категории материалов</h1>

    <div class="buttons">
        <a href="{url module=ArticleAdmin method=category}" class="button green">Добавить категорию</a>
    </div>
</div>

<div class="board">
{if $article_categories}
    <form method="post" data-object="article_category">

        <input type="hidden" name="session_id" value="{$smarty.session.id}">

	    <div class="list_items">
            <div class="row header_list">
                <div class="col s1 checkbox">
                    <input type="checkbox" id="check_all" />
                </div>
                <div class="col s7">Название</div>
                <div class="col s4">URL</div>
            </div>

			{foreach $article_categories as $category}
			<div class="row list_item">
				<div class="col s1 checkbox">
					<input type="checkbox" name="check[]" value="{$category->id}" />
				</div>
				<div class="col s7">
				    <a href="{url module=ArticleAdmin method=category id=$category->id}">{$category->name|escape}</a>
                </div>
				<div class="col s4">{$category->url|escape}</div>
			</div>
			{/foreach}
		</div>
	
		<div id="action">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>

            <input class="button green" type="submit" value="Применить">
		</div>
	</form>
{else}
    Нет категорий
{/if}
</div>