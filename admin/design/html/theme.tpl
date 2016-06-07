{if $theme->name}
{$meta_title = "Тема {$theme->name}" scope=parent}
{/if}

<script>
{literal}
	
$(function() {

	// Выбрать тему
	$('.set_main_theme').click(function() {
     	$("form input[name=action]").val('set_main_theme');
    	$("form input[name=theme]").val($(this).closest('li').attr('theme'));
    	$("form").submit();
	});	
	
	// Клонировать текущую тему
	$('a.add').click(function() {
     	$("form input[name=action]").val('clone_theme');
    	$("form").submit();
	});	
	
	// Редактировать название
	$("a.edit").click(function() {
		name = $(this).closest('li').attr('theme');
		inp1 = $('<input type=hidden name="old_name[]">').val(name);
		inp2 = $('<input type=text name="new_name[]">').val(name);
		$(this).closest('li').find("p.name").html('').append(inp1).append(inp2);
		inp2.focus().select();
		return false;
	});
	
	// Удалить тему
	$('.delete').click(function() {
     	$("form input[name=action]").val('delete_theme');
     	$("form input[name=theme]").val($(this).closest('li').attr('theme'));
   		$("form").submit();
	});	

	$("form").submit(function() {
		if($("form input[name=action]").val()=='delete_theme' && !confirm('Подтвердите удаление'))
			return false;	
	});
	
});
{/literal}
</script>

<div class="content_header">
	<div id="header">
		<h1 class="{if $theme->locked}locked{/if}">Текущая тема &mdash; {$theme->name}</h1>
	</div>

	<a href="index.php?module=TemplatesAdmin">Редактировать шаблон</a>	
	<a href="index.php?module=StylesAdmin">CSS шаблона</a>		
	<a href="index.php?module=ImagesAdmin">Изображения шаблона</a>
	<a class="add" href="#">Создать копию темы {$settings->theme}</a>
</div>





{if $message_error}

<div class="message_box message_error">
	<span>{if $message_error == 'permissions'}Установите права на запись для папки {$themes_dir}
	{elseif $message_error == 'name_exists'}Тема с таким именем уже существует{/if}</span>
</div>

{/if}

{if $message_success}
	<div class="message_box message_success">
		<span>{if $message_success=='delete_theme'}Тема удалена{elseif $message_success=='clone_theme'}Тема клонирована{elseif $message_success=="set_main_theme"}Тема установлена как главная{/if}</span>
	</div>
{/if}

	<form method="post" enctype="multipart/form-data" class="board_subhead">
		<input type="hidden" name="session_id" value="{$smarty.session.id}">
		<input type=hidden name="action">
		<input type=hidden name="theme">

		<ul class="themes">
		{foreach $themes as $t}
			<li theme='{$t->name|escape}'>
				{if $theme->name == $t->name}<img class="tick" src='design/images/tick.png'> {/if}
				{if $t->locked}<img class="tick" src='design/images/lock_small.png'> {/if}
				{if $theme->name != $t->name && !$t->locked}
				<a href='#' title="Удалить" class='delete'><img src='design/images/delete.png'></a>
				<a href='#' title="Переименовать" class='edit'><img src='design/images/pencil.png'></a>
				{elseif $theme->name != $t->name}
				{*<a href='#' title="Выбрать" class='select set_main_theme'><img src='design/images/tick.png'></a>*}
				{elseif !$t->locked}
				<a href='#' title="Удалить" class='delete'><img src='design/images/delete.png'></a>
				<a href='#' title="Изменить название" class='edit'><img src='design/images/pencil.png'></a>
				{/if}
				{if $theme->name == $t->name}
				<p class=name>{$t->name|escape|truncate:16:'...'}</p>
				{else}
				<p class=name><a href='#' class='set_main_theme'>{$t->name|escape|truncate:16:'...'}</a></p>
				{/if}
				<a href="index.php?module=TemplatesAdmin"><img class="preview" src='{$root_dir}../design/{$t->name}/preview.png'></a>
			</li>
		{/foreach}
		</ul>

		<div class="board_footer">
			<input class="button_green button_save" type="submit" name="save" value="Сохранить" />
		</div>
	
	</form>

