{$meta_title='Слайды' scope=parent}

<div class="content_header">
    <h1>
        Слайды
        {if $slider->id} <span>{$slider->name|escape}</span>{/if}
    </h1>


    <div class="buttons">
        <a href="index.php?module=SliderAdmin&method=slide{if $slider->id}&slider_id={$slider->id}{/if}" class="button green">Создать слайд</a>
    </div>
</div>


{if $slides}
<div id="list" class="slides">
	
	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">

		<div id="list">
			{foreach $slides as $slide}
			<div class="row">
				<input type="hidden" name="positions[{$slide->id}]" value="{$slide->position}" />
				<div class="slide_wrapper">
					
					<div class="title">
						<input type="checkbox" name="check[]" value="{$slide->id}" />	
						{if $slide->name}
							<a href="{url module=SlideAdmin id=$slide->id return=$smarty.server.REQUEST_URI}">
								{$slide->name|escape}
							</a>
						{/if}
					</div>
					
					<div class="slide">
						<a href="{url module=SlideAdmin id=$slide->id return=$smarty.server.REQUEST_URI}">
						{if $slide->image}
						<img src="../{$slide->image}">
						{else}
						изображение не загружено
						{/if}
						</a>
					</div>
					
					{if $slide->image}
					<div class="tip">
						{$img_url=$config->root_url|cat:'/'|cat:$slide->image}
						{$img_url}
						{assign var="info" value=$img_url|getimagesize}<br />
						{$info.0}px X {$info.1}px
					</div>
					{/if}
					
					<a class="delete button_red" href='#' >Удалить слайд</a>
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

</div>
{else}
	Нет слайдов
{/if}
 
{literal}
<script>
$(function() {
	
	// Сортировка списка
	$("#list").sortable({
		items:             ".row",
		tolerance:         "pointer",
		handle:            ".slide_wrapper",
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
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
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