{if $brand->id}
	{$meta_title = $brand->name scope=parent}
{else}
	{$meta_title = 'Новый бренд' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

{* On document load *}
{literal}
<script>
$(function() {

	// Удаление изображений
	$(".images a.delete").click( function() {
		$("input[name='delete_image']").val('1');
		$(this).closest("ul").fadeOut(200, function() { $(this).remove(); });
		return false;
	});

	// Автозаполнение мета-тегов
	meta_title_touched = true;
	meta_keywords_touched = true;
	meta_description_touched = true;
	url_touched = true;
	
	if($('input[name="meta_title"]').val() == generate_meta_title() || $('input[name="meta_title"]').val() == '')
		meta_title_touched = false;
	if($('textarea[name="meta_keywords"]').val() == generate_meta_keywords() || $('textarea[name="meta_keywords"]').val() == '')
		meta_keywords_touched = false;
	if($('textarea[name="meta_description"]').val() == generate_meta_description() || $('textarea[name="meta_description"]').val() == '')
		meta_description_touched = false;
	if($('input[name="url"]').val() == generate_url() || $('input[name="url"]').val() == '')
		url_touched = false;
		
	$('input[name="meta_title"]').change(function() { meta_title_touched = true; });
	$('textarea[name="meta_keywords"]').change(function() { meta_keywords_touched = true; });
	$('input[textarea="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	
	function set_meta()
	{
		if(!meta_title_touched)
			$('input[name="meta_title"]').val(generate_meta_title());
		if(!meta_keywords_touched)
			$('textarea[name="meta_keywords"]').val(generate_meta_keywords());
		if(!meta_description_touched)
			$('textarea[name="meta_description"]').val(generate_meta_description());
		if(!url_touched)
			$('input[name="url"]').val(generate_url());
	}
	
	function generate_meta_title()
	{
		name = $('input[name="name"]').val();
		return name;
	}

	function generate_meta_keywords()
	{
		name = $('input[name="name"]').val();
		return name;
	}

	function generate_meta_description()
	{
		name = $('input[name="name"]').val();
		return name;
	}
		
	function generate_url()
	{
		url = $('input[name="name"]').val();
		url = url.replace(/[\s]+/gi, '-');
		url = translit(url);
		url = url.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();	
		return url;
	}
	
	function translit(str)
	{
		var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")   
		var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")   
	 	var res = '';
		for(var i=0, l=str.length; i<l; i++)
		{ 
			var s = str.charAt(i), n = ru.indexOf(s); 
			if(n >= 0) { res += en[n]; } 
			else { res += s; } 
	    } 
	    return res;  
	}

});

</script>
 
{/literal}

<form method=post id=product enctype="multipart/form-data" class="board">
	<input type=hidden name="session_id" value="{$smarty.session.id}">
	<input name=id type="hidden" value="{$brand->id|escape}"/> 
	
	<div class="content_header">
		<a href="index.php?module=BrandsAdmin">← Назад</a>
		{if $brand->id}<a target="_blank" href="../brands/{$brand->url}">Открыть бренд на сайте</a>{/if}
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>	
	
	{if $message_success}
	<div class="message_box message_success">
		<span>{if $message_success=='added'}Бренд добавлен{elseif $message_success=='updated'}Бренд обновлен{else}{$message_success}{/if}</span>
				
		<div class="share">		
			<a href="#" onClick='window.open("http://vkontakte.ru/share.php?url={$config->root_url|urlencode}/brands/{$brand->url|urlencode}&title={$brand->name|urlencode}&description={$brand->description|urlencode}&image={$config->root_url|urlencode}/files/brands/{$brand->image|urlencode}&noparse=true","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="{$config->root_url}/admin/design/images/vk_icon.png" /></a>
			<a href="#" onClick='window.open("http://www.facebook.com/sharer.php?u={$config->root_url|urlencode}/brands/{$brand->url|urlencode}","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="{$config->root_url}/admin/design/images/facebook_icon.png" /></a>
			<a href="#" onClick='window.open("http://twitter.com/share?text={$brand->name|urlencode}&url={$config->root_url|urlencode}/brands/{$brand->url|urlencode}&hashtags={$brand->meta_keywords|replace:' ':''|urlencode}","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="{$config->root_url}/admin/design/images/twitter_icon.png" /></a>
		</div>
		
	</div>
	{/if}

	{if $message_error}
	<div class="message_box message_error">
		<span>{if $message_error=='url_exists'}Бренд с таким адресом уже существует{elseif $message_error=='name_empty'}У бренда должно быть название{elseif $message_error=='url_empty'}URl адрес не может быть пустым{/if}</span>
	</div>
	{/if}
	
	<div id="name">
		<label style="display: block;margin-bottom: 2px;">Название бренда</label>
		<input class="name_product" name=name type="text" value="{$brand->name|escape}" placeholder="Название бренда"/> 
	</div>
	
	<div class="board_subhead">	 
		<div id="board_column_left">
			<!-- Параметры страницы -->
			<div class="block">
				<h2>Параметры страницы</h2>
				<ul>
					<li><label class=property>Адрес /brands/</label><input name="url" type="text" value="{$brand->url|escape}" /></li>
					<li><label class=property>Заголовок</label><input name="meta_title" type="text" value="{$brand->meta_title|escape}" /></li>
					<li><label class=property>Ключевые слова</label><textarea name="meta_keywords">{$brand->meta_keywords|escape}</textarea></li>
					<li><label class=property>Описание</label><textarea name="meta_description" />{$brand->meta_description|escape}</textarea></li>
				</ul>
			</div>
		</div>
	
		<div id="board_column_right">
			<!-- Изображение категории -->	
			<div class="block images">
				<h2>Изображение бренда</h2>
				<input class='upload_image' name=image type=file>			
				<input type=hidden name="delete_image" value="">
				{if $brand->image}
				<ul>
					<li>
						<a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
						<img src="../{$config->brands_images_dir}{$brand->image}" alt="" />
					</li>
				</ul>
				{/if}
			</div>
			
		</div>
	</div>
	
	<div class="text_block">
		<h2>Описание бренда</h2>
		<textarea name="description" class="editor_small">{$brand->description|escape}</textarea>
	</div>
	
	<div class="board_footer">
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />	
	</div>
	
</form>