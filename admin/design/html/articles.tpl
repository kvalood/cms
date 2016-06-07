{* Title *}
{$meta_title='Материалы' scope=parent}

<div class="content_header">
    <div id="header">
        {if $count_article}
            <h1>{$count_article} {$count_article|plural:'материал':'материалов':'материала'}</h1>
        {else}
            <h1>Нет материалов.</h1>
        {/if}
    </div>

	<a href="index.php?module=ArticleEdit">+ Добавить материал</a>
	
	<div class="search_tools">
	<form method="get" name="search_to">
		<input type="hidden" name="module" value='ArticleAdmin'>
		<div class="select_box">
			<select name="category" class="select_row">
				<option value="">--Все категории--</option>
				<option value="not_cat"{if $category == 'not_cat'} selected="selected"{/if}>Без категории</option>
				{foreach $articlecat as $cat}
					<option value="{$cat->id}" {if $cat->id==$category}selected{/if}>{$cat->name}</option>
				{/foreach}
			</select>
		</div>
		<input type="text" name="keyword" value="{if $keyword}{$keyword}{/if}" placeholder="Название материала"/>
		<input class="search_button" type="submit" value="Поиск"/>
		<a href="index.php?module=ArticleAdmin" class="refresh_botton">Сбросить</a>
	</form>
	</div>
</div>


{if $article}
	<form id="list_form" method="post" data-object="article">
	    <input type="hidden" name="session_id" value="{$smarty.session.id}">
	
		<div id="list">
			<div class="list_top">
				<div class="checkbox"></div>
				<div class="name">Название</div>
				<div class="cat">Категория</div>
				<div class="date">Дата создания</div>
				<div class="id">id</div>
			</div>
			
			{foreach $article as $a}
			<div class="row" data-visible="{$a->visible|escape}">
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$a->id}" />				
				</div>
				<div class="name cell"><a href="index.php?module=ArticleEdit&id={$a->id}">{$a->name|escape}</a></div>
				<div class="cat cell">
					{foreach $articlecat as $cat}
						{if $cat->id==$a->category}{$cat->name}{/if}
					{/foreach}
					{if $a->category == 0}Без категории{/if}
				</div>
				<div class="date cell">{$a->date|date}</div>
				<div class="id cell">{$a->id}</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#"></a>
					<a class="enable" title="Активность" href="#"></a>
				</div>
			</div>
			{/foreach}
		</div>
		
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id="select">
            <select name="action">
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>

        <div class="board_footer">
            {include file='pagination.tpl'}
        </div>
	</form>
{/if}


{literal}

<script>
$(function() {
    
   	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	
	
	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form#list_form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});

</script>
{/literal}