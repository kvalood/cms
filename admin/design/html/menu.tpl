{* Title *}
{$meta_title = 'Меню сайта' scope=parent}


<div class="content_header">
    <div id="header">
        <h1>Управление меню</h1>
    </div>

	<a href="index.php?module=MenuAdmin&method=create_menu">Создать новое меню</a>
</div>



{if $menu}
	<form id="list_form" method="post" class="board_content">
		<input type="hidden" name="session_id" value="{$smarty.session.id}">
		<div id="list">
			<div class="list_top">
				<div class="checkbox"></div>
				<div class="name">Название</div>
				<div class="id">id</div>
			</div>
			
			{foreach $menu as $m}
			<div class="row">
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$m->id}" />				
				</div>
				<div class="name cell"><a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat={$m->id}" title="Смотреть пункты меню">{$m->name|escape}</a></div>
				<div class="id cell">{$m->id}</div>
				<div class="icons cell">
					<a class="delete" title="Удалить" href="#" data="{$m->id}"></a>
					<a class="edit" title="Редактировать меню" href="index.php?module=MenuAdmin&method=create_menu&id={$m->id}"></a>
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
{else}
	Нет созданных меню
{/if}

{* On document load *}
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
		$(this).closest(".article_id").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('При удалении меню, все пункты этого меню будут удалены. Удаляем?'))
			return false;	
	});
});

</script>
{/literal}
