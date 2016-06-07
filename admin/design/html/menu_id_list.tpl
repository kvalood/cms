{$meta_title = 'Список пунктов меню' scope=parent}


<div class="content_header">
    <div id="header">
        <h1>Список пунктов меню <i>{$cat_cat->name|escape}</i></h1>
    </div>

	<a href="index.php?module=MenuAdmin">← Назад</a>
	<a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat={$cat_cat->id}&mode=add" class="add">+ Добавить новый пункт меню</a>
</div>

{if $menu}
	<form id="list_form" method="post" class="board_content" data-object="menu_item">
		<input type="hidden" name="session_id" value="{$smarty.session.id}">
		<div id="list">		
			{foreach $menu as $m}
			<div class="row" data-visible="{$m->visible}">
				<input type="hidden" name="positions[{$m->id}]" value="{$m->position}">
				<div class="move cell"><div class="move_zone"></div></div>
		 		<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="{$m->id}" />				
				</div>
				<div class="name cell">
					<a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat={$cat_cat->id}&mode=add&id={$m->id}">{$m->name|escape}</a><br/>
					<div class="sub_name">Тип меню - {if $m->type==1}Материал{elseif $m->type==2}Категория материалов{elseif $m->type==3}URL{/if}</div>
				</div>
				<div class="icons cell">
					<a class="home_page {if $m->home == 1}home{else}no_home{/if}" href="#" title="Главная страница"></a>
					<a class="preview" title="Предпросмотр в новом окне" href="../{$m->url}" target="_blank"></a>
					<a class="enable" title="Активна" href="#"></a>
					<a class="delete" title="Удалить" href="#"></a>
				</div>
				<div class="clear"></div>
			</div>
			{/foreach}
		</div>
	
		<div id="action">
            <label id="check_all" class="dash_link">Выбрать все</label>

            <span id="select">
            <select name="action">
                <option value="enable">Сделать видимыми</option>
                <option value="disable">Сделать невидимыми</option>
                <option value="delete">Удалить</option>
            </select>
            </span>

            <input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>
	</form>	
{else}
	Нет пунктов меню
{/if}

{* On document load *}
{literal}
<script>
$(function() {
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	


	// Назначить главной страницей
	$('.home_page').click(function(){
		var id = $(this).closest('.row').find('input[name*="check[]"]').val();
		if(confirm('Назначить страницу главной?')){
		$('.row').find('.home_page.home').removeClass('home').addClass('no_home');
		$(this).removeClass('no_home').addClass('home');
		
			$.ajax({
				type: 'POST',
				url: 'ajax/update_object.php',
				data: {'object': 'menu_home', 'id': id, 'values': {'home': 0}, 'values2': {'home': 1}, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
				success: function(data){
					show_modal_message('Сохранено','message',3000,'bottom-right');
				},
				dataType: 'json'
			});
		}
	
	});


	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
});
</script>
{/literal}