{$meta_title='Категории товаров' scope=parent}

<div class="content_header">
    <h1>Категории товаров</h1>

    <div class="buttons">
        <a href="{url module=CategoryAdmin}" class="button green">Добавить категорию</a>
    </div>
</div>

<div class="board">
	{if $categories}
		<form method="post" data-object="category">

			<input type="hidden" name="session_id" value="{$smarty.session.id}">

            <div class="listObjects">
                <div class="listBody">
                {function name=categories_tree level=0}
                {if $categories}
                    <ul class="sortable">
                    {foreach $categories as $category}
                        <li class="listItem{if $level} subItem{/if}">
                            <div{if $level} style="padding-left:{$level*2}7px"{/if}>
                                <input type="hidden" name="positions[{$category->id}]" value="{$category->position}">
                                <input type="checkbox" name="check[]" value="{$category->id}" />
                                <a href="{url module=CategoryAdmin id=$category->id}" title="Редактировать категорию">{$category->name|escape}</a>

                                <div class="control">
                                    <a class="preview" href="../catalog/{$category->url}" target="_blank" title="Посмотреть на сайте" ></a>
                                    <a class="visible{if $category->visible} on{/if}" title="Активна" href="#"></a>
                                    <a class="delete" title="Удалить" href="#"></a>
                                </div>
                            </div>

                            {categories_tree categories=$category->subcategories level=$level+1}

                        </li>
                    {/foreach}
                    </ul>
                {/if}
                {/function}
                {categories_tree categories=$categories}
                </div>
			
			
			<div id="action">
                <input type="checkbox" id="check_all" />

				<select name="action">
					<option value="enable">Сделать видимыми</option>
					<option value="disable">Сделать невидимыми</option>
					<option value="delete">Удалить</option>
				</select>
				
				<input class="button green" type="submit" value="Применить">
			</div>
		
		</form>
	{else}
		Категории отсутствуют
	{/if}
</div>

{literal}
<script>
$(function() {

	// Сортировка списка
	$(".sortable").sortable({
		items:".listItem",
		tolerance:"pointer",
		scrollSensitivity:40,
		opacity:0.7, 
		axis: "y",
        placeholder:"clear_state ui-state-highlight",
		update:function()
		{
			$(".board form input[name*='check']").attr('checked', false);
			$(".board form").ajaxSubmit();
		}
	});

});
</script>
{/literal}