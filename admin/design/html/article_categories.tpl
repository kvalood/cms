{* Title *}
{$meta_title='Категории материалов' scope=parent}

<div class="content_header">
    <div id="header">
        <h1>Категории материалов</h1>
    </div>

	<a class="add" href="index.php?module=ArticleCategoryAdmin&method=add_cat">+ Добавить категорию</a>
</div>

{if $articlecat}
	<form id="list_form" method="post" data-object="article_category">
	    <input type="hidden" name="session_id" value="{$smarty.session.id}">
	
		<div id="list">
			<div class="list_top">
				<div class="checkbox"></div>
				<div class="name">Название</div>
				<div class="id">id</div>
			</div>
			
			{foreach $articlecat as $c}
			<div class="row">
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$c->id}" />				
				</div>
				<div class="name cell"><a href="index.php?module=ArticleCategoryAdmin&method=add_cat&id={$c->id}">{$c->name|escape}</a></div>
				<div class="id cell">{$c->id}</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#"></a>
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
	$("a.del").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});

</script>
{/literal}