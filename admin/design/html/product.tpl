{if $product->id}
	{$meta_title = $product->name scope=parent}
{else}
	{$meta_title = 'Новый товар' scope=parent}
{/if}

{* Подключаем Tiny MCE *}
{include file='tinymce_init.tpl'}

{* On document load *}
{literal}
<script src="/js/autocomplete/jquery.autocomplete.min.js"></script>

<script>
$(function() {

    // Добавление категории
    $(document).on('click', '#product_categories .add', function(){
        var pc_parent = $('#product_categories > ul > li:last-of-type').clone(true),
            bth_remove = pc_parent.find('> span').removeClass('hidden'),
            pc_select = pc_parent.find('select[name*="categories"]').clone(false);
        $('#product_categories ul li:last-of-type').after('<li></li>').parent().find('li:last').append(pc_select).append(bth_remove);
        $('select').selectpicker('refresh');
        return false;
    });

    // Удаление категории
    $(document).on('click', '#product_categories .delete', function() {
		$(this).closest("li").remove();
        return false;
	});

	// Сортировка вариантов
	$("#variants_block").sortable({ items: '#variants ul' , axis: 'y',  cancel: '#header', handle: '.move_zone' });
	// Сортировка вариантов
	$("table.related_products").sortable({ items: 'tr' , axis: 'y',  cancel: '#header', handle: '.move_zone' });

	
	// Сортировка связанных товаров
	$(".sortable").sortable({
		items: "div.row",
		tolerance:"pointer",
		scrollSensitivity:40,
		opacity:0.7,
		handle: '.move_zone'
	});
		

	// Сортировка изображений
	$(".images ul").sortable({ tolerance: 'pointer'});

	// Удаление изображений
    $(document).on('click', '.images a.delete', function() {
		 $(this).closest("li").fadeOut(200, function() { $(this).remove(); });
		 return false;
	});
	// Загрузить изображение с компьютера
	$('#upload_image').click(function() {
		$("<input class='upload_image' name=images[] type=file multiple  accept='image/jpeg,image/png,image/gif'>").appendTo('div#add_image').focus().click();
	});
	// Или с URL
	$('#add_image_url').click(function() {
		$("<input class='remote_image' name=images_urls[] type=text value='http://'>").appendTo('div#add_image').focus().select();
	});
	// Или перетаскиванием
	if(window.File && window.FileReader && window.FileList)
	{
		$("#dropZone").show();
		$("#dropZone").on('dragover', function (e){
			$(this).css('border', '1px solid #8cbf32');
		});
		$(document).on('dragenter', function (e){
			$("#dropZone").css('border', '1px dotted #8cbf32').css('background-color', '#c5ff8d');
		});
	
		dropInput = $('.dropInput').last().clone();
		
		function handleFileSelect(evt){
			var files = evt.target.files; // FileList object
			// Loop through the FileList and render image files as thumbnails.
		    for (var i = 0, f; f = files[i]; i++) {
				// Only process image files.
				if (!f.type.match('image.*')) {
					continue;
				}
			var reader = new FileReader();
			// Closure to capture the file information.
			reader.onload = (function(theFile) {
				return function(e) {
					// Render thumbnail.
					$("<li class=wizard><a href='' class='delete'><img src='design/images/cross-circle-frame.png'></a><img onerror='$(this).closest(\"li\").remove();' src='"+e.target.result+"' /><input name=images_urls[] type=hidden value='"+theFile.name+"'></li>").appendTo('div .images ul');
					temp_input =  dropInput.clone();
					$('.dropInput').hide();
					$('#dropZone').append(temp_input);
					$("#dropZone").css('border', '1px solid #d0d0d0').css('background-color', '#ffffff');
					clone_input.show();
		        };
		      })(f);
		
		      // Read in the image file as a data URL.
		      reader.readAsDataURL(f);
		    }
		}
		$(document).on('change', '.dropInput', handleFileSelect);
	};

	// Удаление варианта
	$('a.del_variant').click(function() {
		if($("#variants ul").size()>1)
		{
			$(this).closest("ul").fadeOut(200, function() { $(this).remove(); });
		}
		else
		{
			$('#variants_block .variant_name input[name*=variant][name*=name]').val('');
            /*size_color*/
            $('#variants_block .variant_color input[name*=variant][name*=color]').val('');
            /*/size_color*/
			$('#variants_block .variant_name').hide('slow');
			$('#variants_block').addClass('single_variant');
		}
		return false;
	});

	// Загрузить файл к варианту
	$('#variants_block a.add_attachment').click(function() {
		$(this).hide();
		$(this).closest('li').find('div.browse_attachment').show('fast');
		$(this).closest('li').find('input[name*=attachment]').attr('disabled', false);
		return false;		
	});
	
	// Удалить файл к варианту
	$('#variants_block a.remove_attachment').click(function() {
		closest_li = $(this).closest('li');
		closest_li.find('.attachment_name').hide('fast');
		$(this).hide('fast');
		closest_li.find('input[name*=delete_attachment]').val('1');
		closest_li.find('a.add_attachment').show('fast');
		return false;		
	});


	// Добавление варианта
	var variant = $('#new_variant').clone(true);
	$('#new_variant').remove().removeAttr('id');
	$('#variants_block span.add').click(function() {
		if(!$('#variants_block').is('.single_variant'))
		{
			$(variant).clone(true).appendTo('#variants').fadeIn('slow').find("input[name*=variant][name*=name]").focus();
			
			
			//Добавляем к изображению варианта товара, свой ID
			var ss = $('#variants > ul').eq(-2).find('.variant_images').find('input').data('id');
			var index_img = ss + 1;
			$('#variants > ul').last().find('.variant_images').find('input').attr('name', 'variant_images['+index_img+'][]').data('id',index_img);
		}
		else
		{
			$('#variants_block .variant_name').show('slow');
			$('#variants_block').removeClass('single_variant');		
		}
		return false;		
	});
	
	
	function show_category_features(category_id)
	{
		$('ul.prop_ul').empty();
		$.ajax({
			url: "ajax/get_features.php",
			data: {category_id: category_id, product_id: $("input[name=id]").val()},
			dataType: 'json',
			success: function(data){
				for(i=0; i<data.length; i++)
				{
					feature = data[i];
					
					line = $("<li><label class=property></label><input class='simpla_inp' type='text'/></li>");
					var new_line = line.clone(true);
					new_line.find("label.property").text(feature.name);
					new_line.find("input").attr('name', "options["+feature.id+"]").val(feature.value);
					new_line.appendTo('ul.prop_ul').find("input")
					.autocomplete({
						serviceUrl:'ajax/options_autocomplete.php',
						minChars:0,
						params: {feature_id:feature.id},
						noCache: false
					});
				}
			}
		});
		return false;
	}
	
	// Изменение набора свойств при изменении категории
	$('select[name="categories[]"]:first').change(function() {
		show_category_features($("option:selected",this).val());
	});

	// Автодополнение свойств
	$('ul.prop_ul input[name*=options]').each(function(index) {
		feature_id = $(this).closest('li').attr('feature_id');
		$(this).autocomplete({
			serviceUrl:'ajax/options_autocomplete.php',
			minChars:0,
			params: {feature_id:feature_id},
			noCache: false
		});
	}); 	
	
	// Добавление нового свойства товара
	var new_feature = $('#new_feature').clone(true);
	$('#new_feature').remove().removeAttr('id');
	$('#add_new_feature').click(function() {
		$(new_feature).clone(true).appendTo('ul.new_features').fadeIn('slow').find("input[name*=new_feature_name]").focus();
		return false;		
	});

	
	// Удаление связанного товара
	$(document).on('click', '.related_products a.delete', function() {
		 $(this).closest("div.row").fadeOut(200, function() { $(this).remove(); });
		 return false;
	});
 

	// Добавление связанного товара 
	var new_related_product = $('#new_related_product').clone(true);
	$('#new_related_product').remove().removeAttr('id');
 
	$("input#related_products").autocomplete({
		serviceUrl:'ajax/search_products.php',
		minChars:0,
		noCache: false, 
		onSelect:
			function(suggestion){
				$("input#related_products").val('').focus().blur(); 
				new_item = new_related_product.clone().appendTo('.related_products');
				new_item.removeAttr('id');
				new_item.find('a.related_product_name').html(suggestion.data.name);
				new_item.find('a.related_product_name').attr('href', 'index.php?module=ProductAdmin&id='+suggestion.data.id);
				new_item.find('input[name*="related_products"]').val(suggestion.data.id);
				if(suggestion.data.image)
					new_item.find('img.product_icon').attr("src", suggestion.data.image);
				else
					new_item.find('img.product_icon').remove();
				new_item.show();
			},
		formatResult:
			function(suggestions, currentValue){
				var reEscape = new RegExp('(\\' + ['/', '.', '*', '+', '?', '|', '(', ')', '[', ']', '{', '}', '\\'].join('|\\') + ')', 'g');
				var pattern = '(' + currentValue.replace(reEscape, '\\$1') + ')';
  				return (suggestions.data.image?"<img align=absmiddle src='"+suggestions.data.image+"'> ":'') + suggestions.value.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>');
			}

	});
  

	// infinity
	$("input[name*=variant][name*=stock]").focus(function() {
		if($(this).val() == '∞')
			$(this).val('');
		return false;
	});

	$("input[name*=variant][name*=stock]").blur(function() {
		if($(this).val() == '')
			$(this).val('∞');
	});
	
	// Волшебные изображения
	name_changed = false;
	$("input[name=name]").change(function() {
		name_changed = true;
		images_loaded = 0;
	});	
	images_num = 8;
	images_loaded = 0;
	old_wizar_dicon_src = $('#images_wizard img').attr('src');
	$('#images_wizard').click(function() {
		
		$('#images_wizard img').attr('src', 'design/images/loader.gif');
		if(name_changed)
			$('div.images ul li.wizard').remove();
		name_changed = false;
		key = $('input[name=name]').val();
		$.ajax({
 			 url: "ajax/get_images.php",
 			 	data: {keyword: key, start: images_loaded},
 			 	dataType: 'json',
  				success: function(data){
    				for(i=0; i<Math.min(data.length, images_num); i++)
    				{
	    				image_url = data[i];
						$("<li class=wizard><a href='' class='delete'><img src='design/images/cross-circle-frame.png'></a><a href='"+image_url+"' target=_blank><img onerror='$(this).closest(\"li\").remove();' src='"+image_url+"' /><input name=images_urls[] type=hidden value='"+image_url+"'></a></li>").appendTo('div .images ul');
    				}
					$('#images_wizard img').attr('src', old_wizar_dicon_src);
					images_loaded += images_num;
  				}
		});
		return false;
	});
	
	// Волшебное описание
	name_changed = false;
	$("input[name=name]").change(function() {
		name_changed = true;
	});	
	old_prop_wizard_icon_src = $('#properties_wizard img').attr('src');
	$('#properties_wizard').click(function() {
		
		$('#properties_wizard img').attr('src', 'design/images/loader.gif');
		if(name_changed)
			$('div.images ul li.wizard').remove();
		name_changed = false;
		key = $('input[name=name]').val();
		$.ajax({
 			 url: "ajax/get_info.php",
 			 	data: {keyword: key},
 			 	dataType: 'json',
  				success: function(data){
					$('#properties_wizard img').attr('src', old_prop_wizard_icon_src);
  					if(data)
  					{
  						$('li#new_feature').remove();
	    				for(i=0; i<data.options.length; i++)
	    				{
	    					option_name = data.options[i].name;
	    					option_value = data.options[i].value;
							// Добавление нового свойства товара
							exists = false;
							if(!$('label.property:visible:contains('+option_name+')').closest('li').find('input[name*=options]').val(option_value).length)
							{
								f = $(feature).clone(true);
								f.find('input[name*=new_features_names]').val(option_name);
								f.find('input[name*=new_features_values]').val(option_value);
								f.appendTo('ul.new_features').fadeIn('slow');
							}
	   					}
	   					
   					}					
				},
				error: function(xhr, textStatus, errorThrown){
                	alert("Error: " +textStatus);
           		}
		});
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
	$('textarea[name="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	$('select[name="brand_id"]').change(function() { set_meta(); });
	$('select[name="categories[]"]').change(function() { set_meta(); });
	
});

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
	result = name;
	brand = $('select[name="brand_id"] option:selected').attr('brand_name');
	if(typeof(brand) == 'string' && brand!='')
			result += ', '+brand;
	$('select[name="categories[]"]').each(function(index) {
		c = $(this).find('option:selected').attr('category_name');
		if(typeof(c) == 'string' && c != '')
    		result += ', '+c;
	}); 
	return result;
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

<style>
    .autocomplete-suggestions{max-height:250px!important;overflow-y: scroll !important;}
</style>

{/literal}


<form method="post" enctype="multipart/form-data">
	<input name="id" type="hidden" value="{$product->id|escape}"/>
    <input type="hidden" name="session_id" value="{$smarty.session.id}">

	<div class="content_header">
        <h1>{if $product}Редактирование товара{else}Создание товара{/if}</h1>

        <div class="buttons">
            <a href="{url module=ProductsAdmin id=null}" class="button back">Назад</a>
            {if $product->id}<a href="../products/{$product->url}" target="_blank" class="button blue">Открыть товар на сайте</a>{/if}
            <input class="button save" type="submit" name="save" value="Сохранить" />
        </div>
	</div>

    <div class="board block">
        <h2>Основные настройки</h2>
        <ul class="row">

            <li class="col s12">
                <label class="required">Название товара</label>
                <input name="name" type="text" value="{$product->name|escape}"/>
            </li>

            <li class="col s12 sm3{if !$categories} hidden{/if}" id="product_categories">
                <label>Категория</label>

                <ul>
                {foreach $product_categories as $product_category name=categories}
                    <li>
                        <select name="categories[]">
                            {function name=category_select level=0}
                                {foreach $categories item=category}
                                    <option value='{$category->id}' {if $category->id == $selected_id}selected{/if} category_name='{$category->name|escape}'>{section name=sp loop=$level}&nbsp;&nbsp;&nbsp;&nbsp;{/section}{$category->name|escape}</option>
                                    {category_select categories=$category->subcategories selected_id=$selected_id  level=$level+1}
                                {/foreach}
                            {/function}
                            {category_select categories=$categories selected_id=$product_category->id}
                        </select>
                        <span class="delete icon-close{if $smarty.foreach.categories.first} hidden{/if}" title="Удалить"></span>
                    </li>
                {/foreach}
                </ul>
                <span class="add{if not $smarty.foreach.categories.first} hidden{/if}"><i class="dash_link">Дополнительная категория</i></span>

            </li>

            <li class="col s12 sm3{if !$brands} hidden{/if}" id="product_brand">
                <label>Бренд</label>
                <select name="brand_id">
                    <option value='0' {if !$product->brand_id}selected{/if} brand_name=''>Не указан</option>
                    {foreach $brands as $brand}
                        <option value='{$brand->id}' {if $product->brand_id == $brand->id}selected{/if} brand_name='{$brand->name|escape}'>{$brand->name|escape}</option>
                    {/foreach}
                </select>
            </li>

            <li class="col s12 sm2">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $product->visible}checked{/if}>
                    <span>Активен</span>
                </label>

                <label class="fancy-checkbox">
                    <input type="checkbox" name="featured" {if $product->featured}checked{/if}>
                    <span>Рекомендуемый</span>
                </label>
            </li>




            <li class="col s12">
                <label>Текст материала</label>
                <textarea name="body" class="full_text">{$article->text|escape}</textarea>
            </li>

            <li class="col s12">
                <label>Краткое описание</label>
                <textarea name="annotation" class="full_text">{$article->annotation|escape}</textarea>
            </li>

        </ul>
    </div>


		
		<!-- Варианты товара -->
		<div id="variants_block" {assign var=first_variant value=$product_variants|@first}{if $product_variants|@count <= 1 && !$first_variant->name}class=single_variant{/if}>
			<ul id="header">
				<li class="variant_move"></li>
                {*size_color*}
                {*<li class="variant_name">Название варианта</li>*}
                <li class="variant_name">{if $settings->v_attr1}{$settings->v_attr1}{else}Размер{/if}</li>
                <li class="variant_color">{if $settings->v_attr2}{$settings->v_attr2}{else}Цвет{/if}</li>
                {*/size_color*}
				<li class="variant_sku">Артикул</li>	
				<li class="variant_price">Цена, {$currency->sign}</li>	
				<li class="variant_discount">Старая, {$currency->sign}</li>	
				<li class="variant_amount">Кол-во</li>
				<li class="variant_download">Эл. товар</li>
			</ul>
			<div id="variants">
			{foreach $product_variants as $variant key=i}
			<ul id="v_dd">
				<li class="variant_move"><div class="move_zone"></div></li>
				<li class="variant_name">
					<input name="variants[id][]" type="hidden" value="{$variant->id|escape}" />
					<input name="variants[name][]" type="text" value="{$variant->name|escape}" />
					<a class="del_variant" href=""><img src="design/images/cross-circle-frame.png" alt="" /></a>
				</li>
                {*size_color*}
                <li class="variant_color"><input name="variants[color][]" type="" value="{$variant->color|escape}" /></li>
                {*/size_color*}
				<li class="variant_sku">       <input name="variants[sku][]"           type="text"   value="{$variant->sku|escape}" /></li>
				<li class="variant_price">     <input name="variants[price][]"         type="text"   value="{$variant->price|escape}" /></li>
				<li class="variant_discount">  <input name="variants[compare_price][]" type="text"   value="{$variant->compare_price|escape}" /></li>
				<li class="variant_amount">    <input name="variants[stock][]"         type="text"   value="{if $variant->infinity || $variant->stock == ''}∞{else}{$variant->stock|escape}{/if}" /><div class="units">{$settings->units}</div></li>
                <li class="variant_download">
				
					{if $variant->attachment}
						<span class=attachment_name>{$variant->attachment|truncate:25:'...':false:true}</span>
						<a href='#' class=remove_attachment><img src='design/images/bullet_delete.png'  title="Удалить цифровой товар"></a>
						<a href='#' class=add_attachment style='display:none;'><img src="design/images/cd_add.png" title="Добавить цифровой товар" /></a>
					{else}
						<a href='#' class=add_attachment><img src="design/images/cd_add.png"  title="Добавить цифровой товар" /></a>
					{/if}
					<div class=browse_attachment style='display:none;'>
						<input type=file name=attachment[]>
						<input type=hidden name=delete_attachment[]>
					</div>
				
				</li>

                <li class="max-width">
                    <div class="variant_images">
                        <h2>Изображения варианта</h2>
                        <input name="variant_images[{$i}][]" data-id="{$i}" type="file" multiple  accept="image/jpeg,image/png,image/gif">
                        <div class="image_case">
                            {foreach from=$product_images item=image}
                                {if $image->variant_id == $variant->id}
                                    <div><img src="{$image->filename|resize:70:70}" alt="" /></div>
                                {/if}
                            {/foreach}
                        </div>
                    </div>

                    <div class="variant_google">
                        <h2>Google Merchant</h2>
                        {* 1 - в наличии, 2 - предзаказ, 0 - нет в наличии *}
                        <select name="variants[google_stock][]">
                            <option value="1" {if $variant->google_stock == '1'}selected{/if}>в наличии</option>
                            <option value="0" {if $variant->google_stock == '0'}selected{/if}>нет в наличии</option>
                            <option value="2" {if $variant->google_stock == '2'}selected{/if}>предзаказ</option>
                        </select>
                    </div>
                </li>
			</ul>
			{/foreach}		
			</div>
			<ul id=new_variant style='display:none;'>
				<li class="variant_move"><div class="move_zone"></div></li>
				<li class="variant_name"><input name="variants[id][]" type="hidden" value="" /><input name="variants[name][]" type="text" value="" placeholder="Название"/><a class="del_variant" href=""><img src="design/images/cross-circle-frame.png" alt="" /></a></li>
                {*size_color*}
                <li class="variant_color"><input name="variants[color][]" type="" value="" /></li>
                {*/size_color*}
                <li class="variant_sku"><input name="variants[sku][]" type="text" value="" placeholder="Артикул"/></li>
				<li class="variant_price"><input  name="variants[price][]" type="text" value="" placeholder="Цена"/></li>
				<li class="variant_discount"><input name="variants[compare_price][]" type="text" value="" placeholder="Старая цена"/></li>
				<li class="variant_amount"><input name="variants[stock][]" type="text" value="∞" />{$settings->units}</li>
				<li class="variant_download">
					<a href='#' class=add_attachment><img src="design/images/cd_add.png" alt="" /></a>
					<div class=browse_attachment style='display:none;'>
						<input type=file name=attachment[]>
						<input type=hidden name=delete_attachment[]>
					</div>
				</li>

                <li class="max-width">
                    <div class="variant_images">
                        <h2>Изображения варианта</h2>
                        <input name="" type="file" multiple  accept="image/jpeg,image/png,image/gif">
                    </div>
                    <div class="variant_google">
                        <h2>Google Merchant</h2>
                        <select name="variants[google_stock][]">
                            <option value="in stock">в наличии</option>
                            <option value="out of stock">нет в наличии</option>
                            <option value="preorder">предзаказ</option>
                        </select>
                    </div>
                </li>
			</ul>

            <div id="popup_images"></div>

			<span class="add" id="add_variant"><i class="dash_link">Добавить вариант</i></span>
		</div>
		<!-- Варианты товара (The End)--> 
		
		
		<div class="board_subhead">
			<!-- Левая колонка свойств товара -->
			<div id="board_column_left">
				<div class="block">
					<h2>Параметры страницы</h2>
					<ul>
						<li><label class=property>URL адрес</label><input name="url" class="page_url" type="text" value="{$product->url|escape}" /></li>
						<li><label class=property>Заголовок</label><input name="meta_title" type="text" value="{$product->meta_title|escape}" /></li>
						<li><label class=property>Ключевые слова</label><textarea name="meta_keywords" />{$product->meta_keywords|escape}</textarea></li>
						<li><label class=property>Описание</label><textarea name="meta_description" />{$product->meta_description|escape}</textarea></li>
					</ul>
				</div>
						
				<div class="block" {if !$categories}style='display:none;'{/if}>
					<h2>Свойства товара
					<a href="#" id=properties_wizard><img src="design/images/wand.png" alt="Подобрать автоматически" title="Подобрать автоматически"/></a>
					</h2>
					
					<ul class="prop_ul">
						{foreach $features as $feature}
							{assign var=feature_id value=$feature->id}
							<li feature_id={$feature_id}><label class=property>{$feature->name}</label><input type="text" name=options[{$feature_id}] value="{$options.$feature_id->value|escape}" /></li>
						{/foreach}
					</ul>
					<!-- Новые свойства -->
					<ul class=new_features>
						<li id=new_feature><label class=property><input type=text name=new_features_names[]></label><input type="text" name=new_features_values[] /></li>
					</ul>
					<span class="add"><i class="dash_link" id="add_new_feature">Добавить новое свойство</i></span>
				</div>
				
				<!-- Свойства товара (The End)-->
			</div>

			<!-- Правая колонка свойств товара -->	
			<div id="board_column_right">
				<div class="block images">
					<h2>Все изображения товара
					<a href="#" id=images_wizard><img src="design/images/wand.png" alt="Подобрать автоматически" title="Подобрать автоматически"/></a>
					</h2>
					<ul>{foreach $product_images as $image}<li>
							<a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
							<img src="{$image->filename|resize:100:100}" alt="" />
							<input type=hidden name='images[]' value='{$image->id}'>
						</li>{/foreach}</ul>
					<div id=dropZone>
						<div id=dropMessage>Перетащите файлы сюда</div>
						<input type="file" name="dropped_images[]" multiple class="dropInput">
					</div>
					<div id="add_image"></div>
					<span class=upload_image><i class="dash_link" id="upload_image">Добавить изображение</i></span> или <span class=add_image_url><i class="dash_link" id="add_image_url">загрузить из интернета</i></span>
				</div>

                <div class="block">
                    <h2>Настройки выгрузки товаров в каталоги</h2>
                    <ul>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="ymarket" {if $product->ymarket==1}checked{/if}>
                                <span>Выгрузка в Яндекс.маркет</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="google" {if $product->google==1}checked{/if}>
                                <span>Выгрузка в Google Merchant</span>
                            </label>
                            <hr/>
                        </li>
                        <li>
                            Прежде нужно подключить ваш магазин к этим системам<br/>
                            <a href="http://google.com/merchants/" target="_blank">Google Merchant</a> и <a href="https://partner.market.yandex.ru" target="_blank">Яндекс.Маркет</a>
                        </li>
                    </ul>
                </div>

				<div class="block">
					<h2>Связанные товары</h2>
					<div class="sortable related_products">
						{foreach $related_products as $related_product}
						<div class="row">
							<div class="move cell">
								<div class="move_zone"></div>
							</div>
							<div class="image cell">
								<input type=hidden name=related_products[] value='{$related_product->id}'>
								<a href="{url id=$related_product->id}">
									<img class=product_icon src='{$related_product->images[0]->filename|resize:35:35}'>
								</a>
							</div>
							<div class="name cell">
								<a href="{url id=$related_product->id}">{$related_product->name}</a>
							</div>
							<div class="icons cell">
								<a href='#' class="delete"></a>
							</div>
						</div>
						{/foreach}
						<div id="new_related_product" class="row" style='display:none;'>
							<div class="move cell">
								<div class="move_zone"></div>
							</div>
							<div class="image cell">
							<input type=hidden name=related_products[] value=''>
							<img class=product_icon src=''>
							</div>
							<div class="name cell">
							<a class="related_product_name" href=""></a>
							</div>
							<div class="icons cell">
							<a href='#' class="delete"></a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
					<input type=text name=related id='related_products' class="input_autocomplete" placeholder='Выберите товар чтобы добавить его'>
				</div>

                <div class="block">
                    <h2>Рейтинг товара</h2>
                    <ul>
                        <li>
                            <label class="property">Лайки</label><input type=text name="likes" value="{$product->likes}">
                        </li>
                    </ul>
                </div>
			</div>
		</div>

		<!-- Описагние товара -->
		<div class="text_block">
			<h2>Краткое описание</h2>
			<textarea name="annotation" class="editor_small">{$product->annotation|escape}</textarea>
		</div>
			
		<div class="text_block">		
			<h2>Полное  описание</h2>
			<textarea name="body" class="editor_large">{$product->body|escape}</textarea>
		</div>
		<!-- Описание товара (The End)-->
		
		<div class="board_footer">
			<input class="button_green button_save" type="submit" name="" value="Сохранить" />	
		</div>
</form>