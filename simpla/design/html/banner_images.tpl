{$meta_title='Баннеры' scope=parent}

<div class="container_top_header">
    <a href="{url module=BannerAdmin method=null id=null}">Баннеры</a>
    <a href="{url module=BannerAdmin method=banners id=null}">Группы баннеров</a>
</div>

<div class="content_header">
    <h1>Баннеры</h1>

    <div class="buttons">
        <a href="{url module=BannerAdmin method=banner}" class="button blue">Создать группу баннеров</a>
        <a href="{url module=BannerAdmin method=banner_image}" class="button green">Создать баннер</a>
    </div>
</div>


{if $banner_images}
<div id="list" class="slides">
	
	<form id="list_form" method="post">
	    <input type="hidden" name="session_id" value="{$smarty.session.id}">

		<div id="list">
			{foreach $banner_images as $item}
			<div class="row">
				<input type="hidden" name="positions[{$item->id}]" value="{$item->position}" />
				<div class="slide_wrapper">
					
					<div class="title">
						<input type="checkbox" name="check[]" value="{$item->id}" />
						{if $item->name}
							<a href="{url module=BannerAdmin method=banner_image id=$item->id return=$smarty.server.REQUEST_URI}">
								{$item->name|escape}
							</a>
						{/if}
					</div>
					
					<div class="slide">
						<a href="{url module=BannerAdmin id=$item->id return=$smarty.server.REQUEST_URI}">
						{if $item->image}
						<img src="{$config->root_url}/{$config->banner_images_dir}{$item->image}">
						{else}
						изображение не загружено
						{/if}
						</a>
					</div>
					
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
	Баннеры отсутствуют
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