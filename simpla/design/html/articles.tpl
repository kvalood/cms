{$meta_title='Страницы' scope=parent}

<div class="content_header">
    <h1>{if $count_article}{$count_article} {$count_article|plural:'страница':'странц':'страниц'}{else}Нет материалов.{/if}</h1>

    <div class="buttons">
	    <a href="{url module=ArticleAdmin method=item id=null}" class="button green">Добавить материал</a>
    </div>
</div>

<div class="search_tools">
    <form method="get" name="search_to">
        <input type="hidden" name="module" value='ArticleAdmin'>
        <div class="select_box">
            <select name="category" class="select_row">
                <option value="">--Все категории--</option>
                <option value="not_cat"{if $category == 'not_cat'} selected="selected"{/if}>Без категории</option>
                {foreach $article_categories as $cat}
                    <option value="{$cat->id}" {if $cat->id==$category}selected{/if}>{$cat->name}</option>
                {/foreach}
            </select>
        </div>
        <input type="text" name="keyword" value="{if $keyword}{$keyword}{/if}" placeholder="Название материала"/>
        <input class="search_button" type="submit" value="Поиск"/>
        <a href="index.php?module=ArticleAdmin" class="refresh_botton">Сбросить</a>
    </form>
</div>

<div class="board">
{if $articles}
    <form method="post" data-object="article">

        <input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div class="list_items">
            <div class="row header_list">
                <div class="col s1 checkbox">
                    <input type="checkbox" id="check_all" />
                </div>
                <div class="col s5">Название</div>
                <div class="col s3">URL</div>
                <div class="col s1">ID</div>
                <div class="col s1 control"></div>
            </div>

            {$article_categories|print_r}

            {foreach $articles as $item}
                <div class="row list_item" data-visible="{$item->visible}">
                    <input type="hidden" name="positions[{$item->id}]" value="{$item->position}">

                    <div class="col s1 checkbox">
                        <input type="checkbox" name="check[]" value="{$item->id}" />
                    </div>
                    <div class="col s5">
                        <a href="{url module=ArticleAdmin method=item id=$item->id}">{$item->name|escape}</a>
                    </div>
                    <div class="col s3">
                        {$item->url}
                    </div>
                    <div class="col s2">
                        {foreach $article_categories as $acat}
                            {if $acat->id==$article->category}{$acat->name}{/if}
                        {/foreach}
                        {if $article->category == 0}Без категории{/if}
                    </div>
                    <div class="col s1">
                        {$item->url}
                    </div>
                    <div class="col s1 control">
                        <a class="enable" title="Активна" href="#"></a>
                    </div>
                </div>
            {/foreach}
		</div>

		<div id="action">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>

            <input class="button green" type="submit" value="Применить">
		</div>

        <div class="block">
            {include file='pagination.tpl'}
        </div>
	</form>
{/if}
</div>