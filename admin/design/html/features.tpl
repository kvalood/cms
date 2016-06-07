{* Title *}
{$meta_title='Свойства товаров' scope=parent}


{* дополнительные опции *}
{capture name=option}
	<h3>Сброс значений свойств <span id="help"><i>?</i><div id="text">Внимание! Сброс значений свойств подразумевает очистку свойств от лишних символов. Удаляется все кроме цифер и точек у свойств с типом 'Слайдер - диапазон'. Запятые преобразуются в точки.</div></span></h3>
	<a href="index.php?module=FeaturesAdmin&method=reset" class="button_green captufe_all">Сбросить</a>	
{/capture}


<div class="content_header">
	{* Заголовок *}
	<div id="header">
		<h1>Свойства товаров</h1>
	</div>
	
	<a href="index.php?module=FeatureAdmin">+ Добавить свойство</a>
</div>	

<div class="board">
	{if $reset}
		{$reset}
	{/if}
	
	
	{if $features}
	<div class="board_content">		
		<form id="list_form" method="post" class="left_board" data-object="feature">
			<input type="hidden" name="session_id" value="{$smarty.session.id}">

			<div id="list">
				{foreach $features as $feature}
				<div class="row" data-visible="{$feature->in_filter}">
					<input type="hidden" name="positions[{$feature->id}]" value="{$feature->position}">
					<div class="move cell"><div class="move_zone"></div></div>
					<div class="checkbox cell">
						<input type="checkbox" name="check[]" value="{$feature->id}" />				
					</div>
					<div class="cell">
						<a href="index.php?module=FeatureAdmin&id={$feature->id|escape}">{$feature->name|escape}</a>
					</div>
					<div class="icons cell">
						<a title="Использовать в фильтре" class="in_filter" href='#' ></a>
						<a title="Удалить" class="delete" href='#' ></a>
					</div>
					<div class="clear"></div>
				</div>
				{/foreach}
			</div>
			
			<div id="action">
				<label id="check_all" class="dash_link">Выбрать все</label>
		
				<span id="select">
					<select name="action">
						<option value="set_in_filter">Использовать в фильтре</option>
						<option value="unset_in_filter">Не использовать в фильтре</option>
						<option value="delete">Удалить</option>
					</select>
				</span>
		
				<input id="apply_action" class="button_green" type="submit" value="Применить">
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


{literal}
<script>
$(function() {

	// Сортировка списка
	$("#list").sortable({
		items:             ".row",
		tolerance:         "pointer",
		handle:            ".move_zone",
		axis: 'y',
		scrollSensitivity: 40,
		opacity:           0.7, 
		forcePlaceholderSize: true,
		
		helper: function(event, ui){		
			if($('input[type="checkbox"][name*="check"]:checked').size()<1) return ui;
			var helper = $('<div/>');
			$('input[type="checkbox"][name*="check"]:checked').each(function(){
				var item = $(this).closest('.row');
				helper.height(helper.height()+item.innerHeight());
				if(item[0]!=ui[0]) {
					helper.append(item.clone());
					$(this).closest('.row').remove();
				}
				else {
					helper.append(ui.clone());
					item.find('input[type="checkbox"][name*="check"]').attr('checked', false);
				}
			});
			return helper;			
		},	
 		start: function(event, ui) {
  			if(ui.helper.children('.row').size()>0)
				$('.ui-sortable-placeholder').height(ui.helper.height());
		},
		beforeStop:function(event, ui){
			if(ui.helper.children('.row').size()>0){
				ui.helper.children('.row').each(function(){
					$(this).insertBefore(ui.item);
				});
				ui.item.remove();
			}
		},
		update:function(event, ui)
		{
			$("#list_form input[name*='check']").attr('checked', false);
			$("#list_form").ajaxSubmit(function() {
				colorize();
			});
		}
	});
	
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