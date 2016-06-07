{* Title *}
{$meta_title='Бренды' scope=parent}

<div class="content_header">
	{* Заголовок *}
	<div id="header">
		<h1>Бренды</h1> 
	</div>
	
	<a href="index.php?module=BrandAdmin"> +Добавить бренд</a>
</div>


<div class="board list_box">
	{if $brands}
	<div class="brands">

		<form id="list_form" method="post">
		<input type="hidden" name="session_id" value="{$smarty.session.id}">
			
			<div id="list" class="brands">	
				{foreach $brands as $brand}
				<div class="row">
					<div class="checkbox cell">
						<input type="checkbox" name="check[]" value="{$brand->id}" />				
					</div>
					<div class="cell">
						<a href="{url module=BrandAdmin id=$brand->id return=$smarty.server.REQUEST_URI}">{$brand->name|escape}</a> 	 			
					</div>
					<div class="icons cell">
						<a class="preview" title="Предпросмотр в новом окне" href="../brands/{$brand->url}" target="_blank"></a>				
						<a class="delete"  title="Удалить" href="#"></a>
					</div>
					<div class="clear"></div>
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
	</div>
	{else}
		Нет брендов
	{/if}
</div>

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
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
 	
});
</script>
{/literal}
