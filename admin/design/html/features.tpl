{$meta_title='Свойства товаров' scope=parent}

<div class="content_header">
	<h1>Свойства товаров</h1>

    <div class="buttons">
	    <a href="{url module=FeatureAdmin}" class="button green">Добавить свойство</a>
    </div>
</div>	

<div class="board">

	{if $features}
	<div class="board_content">		
		<form method="post" data-object="feature">
			<input type="hidden" name="session_id" value="{$smarty.session.id}">

			<div class="list_items">
                <div class="row header_list">
                    <div class="col s1 checkbox">
                        <input type="checkbox" id="check_all" />
                    </div>
                    <div class="col s9">Название</div>
                    <div class="col s2 control"></div>
                </div>

                <div id="sortable">
				{foreach $features as $feature}
                    <div class="row list_item">
                        <input type="hidden" name="positions[{$feature->id}]" value="{$feature->position}">

                        <div class="col s1 checkbox">
                            <input type="checkbox" name="check[]" value="{$feature->id}" />
                        </div>
                        <div class="col s9">
                            <a href="{url module=FeatureAdmin id=$feature->id|escape}">{$feature->name|escape}</a>
                        </div>
                        <div class="col s2 control">
                            <a title="Выгружать в Яндекс.Маркет" class="in_yandex{if $feature->in_yandex} on{/if}" href='#' ></a>
                            <a title="Использовать в фильтре" class="in_filter{if $feature->in_filter} on{/if}" href='#' ></a>
                            <a title="Удалить" class="delete" href='#' ></a>
                        </div>
                    </div>
				{/foreach}
                </div>
			</div>
			
			<div id="action">
                <select name="action">
                    <option value="set_in_filter">Использовать в фильтре</option>
                    <option value="unset_in_filter">Не использовать в фильтре</option>
                    <option value="set_in_yandex">Выгружать в Яндекс.Маркет</option>
                    <option value="unset_in_yandex">Не выгружать в Яндекс.Маркет</option>
                    <option value="delete">Удалить</option>
                </select>
		
				<input class="button green" type="submit" value="Применить">
			</div>
		</form>
		
		<div class="right_board">
			<div id="right_head">Фильтр по категориям</div>

			{function name=categories_tree}
			{if $categories}
			<ul class="filter">
				{if $categories[0]->parent_id == 0}
				<li {if !$category->id}class="selected"{/if}><a href="{url category_id=null}">Все категории</a></li>	
				{/if}
				{foreach $categories as $c}
				<li {if $category->id == $c->id}class="selected"{/if}><a href="index.php?module=FeaturesAdmin&category_id={$c->id}">{$c->name}</a></li>
				{categories_tree categories=$c->subcategories}
				{/foreach}
			</ul>
			{/if}
			{/function}
			{categories_tree categories=$categories}
		</div>

	</div>
	{else}
		Нет свойств
	{/if}
</div>