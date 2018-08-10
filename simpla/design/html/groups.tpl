{* Title *}
{$meta_title='Группы пользователей' scope=parent}

{* Заголовок *}
<div class="content_header">
    <div id="header">
        <h1>Группы пользователей</h1>
    </div>

    <a href="{url module=GroupAdmin}">+ Добавить группу</a>
</div>


<!-- Основная часть -->
{if $groups}
	<form id="list_form" method="post">
        <input type="hidden" name="session_id" value="{$smarty.session.id}">
        <div id="list">

            <div class="list_top">
                <div class="checkbox"></div>
                <div class="name">Название группы</div>
                <div class="date">Скидка</div>
            </div>

            {foreach $groups as $group}
            <div class="row">
                <div class="checkbox cell">
                    <input type="checkbox" name="check[]" value="{$group->id}"/>
                </div>
                <div class="name cell">
                    <a href="index.php?module=GroupAdmin&id={$group->id}">{$group->name}</a>
                </div>
                <div class="date cell">
                    {$group->discount} %
                </div>
                <div class="icons cell">
                    <a class="delete" title="Удалить" href="#"></a>
                </div>
            </div>
            {/foreach}
        </div>

        <div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id=select>
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
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
	});	

	// Удалить 
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
		
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
	
});

</script>
{/literal}