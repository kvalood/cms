{* Title *}
{$meta_title='Управление тегами' scope=parent}


<div class="content_header">
	<a href="#" class="add_object">+ Добавить тег</a>
</div>

<div id="header">
	<h1>Управление тегами</h1>
</div>

<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">
	{if $tags}
		<div class="header_line">
			<div class="item_name">Назнвание</div>
			<div class="iten_url">Урл</div>
			<div class="item_description">Описание</div>
			<div class="item_id">id</div>					
		</div>		
	{foreach $tags as $tag}
		<div class="item_line" data-id-item="{$tag->id|escape}">
			<input type="checkbox" value="{$tag->id|escape}" name="check[]" class="item_check"/>
			<div class="item_name">{$tag->name|escape}</div>
			<div class="iten_url">{$tag->url|escape}</div>
			<div class="item_description">{$tag->description|escape}</div>
			<div class="item_id">{$tag->id|escape}</div>
			<div class="item_control_panel">
				<div class="edit_item">Редактировать</div>
				<div class="delete_item">Удалить</div>
			</div>							
		</div>			
	{/foreach}
	{else}
		Пока нет ни одного тега
	{/if}
</form>


<div id="edit_form">
	<input type="hidden" value="" name="id"/>
	<div class="edit_line">
		<label>Название меткии</label>
		<input type="text" value="" name="name" class="input"/>
	</div>
	
	<div class="edit_line">
		<label>Урл меткии</label>
		<input type="text" value="" name="url" class="input"/>
	</div>
	
	<div class="edit_line">
		<label>Описание меткии</label>
		<textarea name="description"></textarea>
	</div>
	
	<div class="control_link">
		<a href="#" id="save">Сохранить</a>
		<a href="#" id="cancel">Отменить</a>
	</div>
</div>

<div class="item_line" id="added_item" data-id-item="" style="display:none">
	<input type="checkbox" value="{$tag->id|escape}" name="check[]" class="item_check"/>
	<div class="item_name"></div>
	<div class="iten_url"></div>
	<div class="item_description"></div>
	<div class="item_id"></div>
	<div class="item_control_panel">
		<div class="edit_item">Редактировать</div>
		<div class="delete_item">Удалить</div>
	</div>							
</div>		


{* On document load *}
{literal}

<script>
$(function() {

	//Редактировать элемент
	$(document).on('click', '.edit_item', function(){
		close_edit();
		var elemtn = $(this).closest('.item_line'),
			id = elemtn.attr('data-id-item'),
			edit_form = $('#edit_form').clone(true);
		
		elemtn.css('display','none').siblings('.item_line').css('display','block');
		//Добавляем классы к форме
		elemtn.after(edit_form.addClass('act').attr('data-edit-tag',id));

		$.ajax({
			type: 'POST',
			url: 'ajax/get_object.php',
			data: {'object': 'tags', 'id': id, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
			success: function(msg){
				for(var i in msg)
				{
					$('[name = '+i+']').val(msg[i]);
				}				
			},
			dataType: 'json'
		});	
		return false;		
	});	
	
	function close_edit()
	{
		$('#list_form #edit_form').remove();
		$('#list_form').find('.item_line:hidden').css('display','block');
	}
	
	//Отменили редактирование
	$(document).on('click', '.control_link #cancel', function(){
		close_edit();
	});
	
	//Удалить тег
	$(document).on('click', '.item_control_panel .delete_item', function(){

		var element = $(this).closest('.item_line'),
			id      = element.attr('data-id-item');

		if(confirm('Подтвердите удаление'))
		{
			$.ajax({
				type: 'POST',
				url: 'ajax/delete_object.php',
				data: {'object': 'tags', 'id': id, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
				success: function(msg){
					element.remove();
					show_modal_message('Тег удален','error',3000,'bottom-right');
				},
				dataType: 'json'
			});	
		}
	});
	
	//Сохрнаить тег
	$(document).on('click', '.control_link #save', function(){

		//Добавленный или новый элемент
		var item = $(this).closest('#edit_form'),
			tag  = item.find(':input').serialize(),
			id   = item.find('[name=id]').attr('value'),
			name = item.find('[name=name]').attr('value');
			
		//Меняем текущий элемент		
		if(id == 'undefined' || id == '')
		{
			if(name == '')
			{
				show_modal_message('Незаполнено название тега','error',3000,'bottom-right');
			}
			else
			{
				$.ajax({
					type: 'POST',
					url: 'ajax/add_object.php',
					data: {'object': 'tags', 'values': tag, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
					success: function(msg){
						added_item = $('#added_item').clone(true);
						console.log(added_item);	
						
						$('#list_form').append(added_item);
						
						close_edit();
						show_modal_message('Новый тег добавлен','message',3000,'bottom-right');
					},
					dataType: 'json'
				});
			}
		}
		else //Добавляем  новый элемент 
		{
			$.ajax({
				type: 'POST',
				url: 'ajax/update_object.php',
				data: {'object': 'tags', 'values': tag, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
				success: function(msg){
					element_update = $('[data-id-item = '+msg.id+']');
					for(var i in msg)
					{
						element_update.find('.item_'+i).html(msg[i]);
					}				
					close_edit();
					show_modal_message('Сохранено','message',3000,'bottom-right');
				},
				dataType: 'json'
			});	
		
		}
		return false;	
	});
	
	
	//Добавить тег
	$(document).on('click', '.add_object', function(){
		close_edit();
		edit_form = $('#edit_form').clone(true);
		$('#list_form').append(edit_form.addClass('act')).find(':input').val('');
	});
});

</script>
{/literal}