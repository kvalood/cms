{if $article->id}
{$meta_title = $article->name scope=parent}
{else}
{$meta_title = 'Новый материал' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

{* On document load *}
{literal}
<script src="design/js/datetimepicker/jquery.datetimepicker.js"></script>
<link href="design/js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>

<script>
$(function() {

    $('input[name="date"]').datetimepicker({
        value: '{/literal}{$article->date|date_format:'%Y/%m/%d %H:%M'}{literal}'
    });


	// Автозаполнение мета-тегов
	meta_title_touched = true;
	meta_keywords_touched = true;
	meta_description_touched = true;
	url_touched = true;
	
	if($('input[name="meta_title"]').val() == generate_meta_title() || $('input[name="meta_title"]').val() == '')
		meta_title_touched = false;
	if($('input[name="meta_keywords"]').val() == generate_meta_keywords() || $('input[name="meta_keywords"]').val() == '')
		meta_keywords_touched = false;
	if($('textarea[name="meta_description"]').val() == generate_meta_description() || $('textarea[name="meta_description"]').val() == '')
		meta_description_touched = false;
	if($('input[name="url"]').val() == generate_url() || $('input[name="url"]').val() == '')
		url_touched = false;
		
	$('input[name="meta_title"]').change(function() { meta_title_touched = true; });
	$('input[name="meta_keywords"]').change(function() { meta_keywords_touched = true; });
	$('textarea[name="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	$('select[name="brand_id"]').change(function() { set_meta(); });
	$('select[name="categories[]"]').change(function() { set_meta(); });
	
	//Удаление Prev_images
	$(document).on('click', '.prev_images a.delete', function(){
		$(this).closest('.prev_images').remove();	
	});
	
});

function set_meta()
{
	if(!meta_title_touched)
		$('input[name="meta_title"]').val(generate_meta_title());
	if(!meta_keywords_touched)
		$('input[name="meta_keywords"]').val(generate_meta_keywords());
	if(!meta_description_touched)
	{
		descr = $('textarea[name="meta_description"]');
		descr.val(generate_meta_description());
		descr.scrollTop(descr.outerHeight());
	}
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
	if(typeof(tinyMCE.get("annotation")) =='object')
	{
		description = tinyMCE.get("annotation").getContent().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
		return description;
	}
	else
		return $('textarea[name=annotation]').val().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
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

</script>
{/literal}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$article->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>
                {if $article->id}
                    Редактирование материала
                {else}
                    Новый материал
                {/if}
            </h1>
        </div>
        <a href="index.php?module=ArticleAdmin">← Назад</a>
        <a href="index.php?module=ArticleEdit">+ Создать еще один материал</a>

        {if $article->id}
        <a href="/{$article->full_url}" target="_blank">Просмотр на сайте</a>
        {/if}
	
	    <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>


    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success == 'added'}Материал добавлен{elseif $message_success == 'updated'}Материал обновлен{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>
            {if $message_error == 'url_exists'}Материл с таким адресом уже существует
            {elseif $message_error == 'name_empty'}Название материала не может быть пустым{elseif $message_error == 'error_uploading_image'}Загрузка изображения не удалась!{/if}
        </span>
    </div>
    {/if}


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название материала</label><input class="name" name=name type="text" value="{$article->name|escape}"/></li>

                    <li>
                        <label class=property>Категория</label>
                        <div class="select_box">
                            <select name="article_category"  class="select_row">
                                <option value="0"{if $article->category == 0} selected="selected"{/if}>Без категории</option>
                                {foreach $articlecat as $c}
                                <option value="{$c->id}" {if $article->category == $c->id}selected="selected"{/if} >{$c->name}</option>
                                {/foreach}
                            </select>
                        </div>
                    </li>

                    <li><label class=property>Адрес(url)</label><input name="url" class="page_url" type="text" value="{$article->url|escape}" /></li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" {if $article->visible}checked{/if}>
                            <span>Активный/не активный</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Meta title</label><input name="meta_title" type="text" value="{$article->meta_title|escape}" /></li>
                    <li><label class=property>Meta Keywords</label><input name="meta_keywords"  type="text" value="{$article->meta_keywords|escape}" /></li>
                    <li><label class=property>Meta Description</label><textarea name="meta_description" />{$article->meta_description|escape}</textarea></li>
                </ul>
            </div>

            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>Дата создания</label><input type=text name=date value='{$article->date|date_format:'%Y/%m/%d %H:%M'}'></li>
                    <li><label class=property>Дата изменения</label><input type=text disabled="" name=date_update value='{$article->date_update|date_format:'%Y/%m/%d %H:%M'}'></li>
                    <li><label class=property>id материала</label><input type=text disabled="" value="{$article->id}"></li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительнительные поля</h2>
                <div class="subhelp">Доп.поля можно исспользовать для вывода сторонних ссылок или любой другой информации. Например прикрепить ссылку на YouTube видео.</div>
                <ul class="property_min">
                    <li><label class=property>Ссылка 1</label><input name="field[one_link]" type="text" value="{$article->field->one_link|escape}"/></li>
                    <li><label class=property>Текст ссылки 1</label><input name="field[one_text]" type="text" value="{$article->field->one_text|escape}"/></li>
                    <li><label class=property>Ссылка 2</label><input name="field[twoo_link]" type="text" value="{$article->field->twoo_link|escape}" /></li>
                    <li><label class=property>Текст ссылки 2</label><input name="field[twoo_text]" type="text" value="{$article->field->twoo_text|escape}" /></li>
                    <li><label class=property>Ссылка 3</label><input name="field[tree_link]" type="text" value="{$article->field->tree_link|escape}" /></li>
                    <li><label class=property>Текст ссылки 3</label><input name="field[tree_text]" type="text" value="{$article->field->tree_text|escape}" /></li>
                </ul>
            </div>

            <div class="block">
                <h2>Изображение для краткого содержания</h2>
                <ul style="overflow:hidden">
                    <li>
                        {if $article->prev_images}
                            <div class="prev_images">
                                <img src="/{$config->article_images_dir}{$article->prev_images}" alt="" />
                                <a href="#" class="delete"><img src="design/images/cross-circle-frame.png"></a>
                                <input type="hidden" value="{$article->prev_images}" name="article_prev_images"/>
                            </div>
                        {/if}

                        <input class="upload_image" name="prev_images" type="file" value="test">
                    </li>
                </ul>
            </div>
        </div>
    </div>

	
	<div class="text_block">
		<h2>Краткое описание</h2>
		<textarea name="annotation" class='editor_small'>{$article->annotation|escape}</textarea>
	</div>
		
	<div class="text_block">
		<h2>Текст материала</h2>
		<textarea name="body"  class='editor_large'>{$article->text|escape}</textarea>
	</div>

    <div id="action">
	    <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form>