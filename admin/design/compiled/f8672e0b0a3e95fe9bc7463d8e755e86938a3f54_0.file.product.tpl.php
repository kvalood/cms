<?php /* Smarty version 3.1.24, created on 2015-06-10 03:46:29
         compiled from "admin/design/html/product.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3210355772675795801_29739041%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8672e0b0a3e95fe9bc7463d8e755e86938a3f54' => 
    array (
      0 => 'admin/design/html/product.tpl',
      1 => 1433871648,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3210355772675795801_29739041',
  'variables' => 
  array (
    'product' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'categories' => 0,
    'product_categories' => 0,
    'category' => 0,
    'selected_id' => 0,
    'level' => 0,
    'product_category' => 0,
    'brands' => 0,
    'brand' => 0,
    'product_variants' => 0,
    'first_variant' => 0,
    'currency' => 0,
    'variant' => 0,
    'attributes' => 0,
    'at' => 0,
    'settings' => 0,
    'i' => 0,
    'product_images' => 0,
    'image' => 0,
    'features' => 0,
    'feature' => 0,
    'feature_id' => 0,
    'options' => 0,
    'related_products' => 0,
    'related_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55772675dac2f6_09305552',
  'tpl_function' => 
  array (
    'category_select' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/f8672e0b0a3e95fe9bc7463d8e755e86938a3f54_0.file.product.tpl.php',
      'uid' => 'f8672e0b0a3e95fe9bc7463d8e755e86938a3f54',
      'call_name' => 'smarty_template_function_category_select_3210355772675795801_29739041',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55772675dac2f6_09305552')) {
function content_55772675dac2f6_09305552 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'D:/OpenServer/domains/cms/Smarty/libs/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '3210355772675795801_29739041';
if ($_smarty_tpl->tpl_vars['product']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['product']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый товар', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
 src="/js/autocomplete/jquery.autocomplete-min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(function() {
	//Скрываем и показываем атрибуты цветов
	$('.attributes_click li').click(function(){
		var attrib = $(this).data('attid'),
		color = $(this).find('.color_at').attr('style');
		
		$(this).parent('.attributes_click').parent('.variant_color').find('#color_show').attr('style', color);
		$(this).parent('.attributes_click').parent('.variant_color').find('input').val(attrib);
	});
	
	
	//*
	// Добавление категории
	$('#product_categories .add').click(function() {
		$("#product_categories ul li:last").clone(false).appendTo('#product_categories ul').fadeIn('slow').find("select[name*=categories]:last").focus();
		$("#product_categories ul li:last span.add").hide();
		$("#product_categories ul li:last span.delete").show();
		return false;		
	});

	// Удаление категории
	$("#product_categories .delete").live('click', function() {
		$(this).closest("li").fadeOut(200, function() { $(this).remove(); });
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
	$(".images a.delete").live('click', function() {
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
		$('.dropInput').live("change", handleFileSelect);
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
	$(".related_products a.delete").live('click', function() {
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

<?php echo '</script'; ?>
>



<form method=post id="product" enctype="multipart/form-data" class="board">
	<input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">

	<div class="capture_head">
		<a href="index.php?module=ProductsAdmin">← Назад</a>
		<?php if ($_smarty_tpl->tpl_vars['product']->value->id) {?><a href="../products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
" target="_blank">Открыть товар на сайте</a><?php }?>
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>


	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Товар добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Товар изменен<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message_success']->value, ENT_QUOTES, 'UTF-8', true);
}?></span>
	</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
	<div class="message_box message_error">
		<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'url_exists') {?>Товар с таким адресом уже существует<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'empty_name') {?>Введите название<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['message_error']->value, ENT_QUOTES, 'UTF-8', true);
}?></span>
	</div>
	<?php }?>


		<div id="name">
			<label style="display: block;margin-bottom: 2px;">Название товара</label>
			<input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Название товара"/> 
			 
			<label class="fancy-checkbox">
				<input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['product']->value->visible) {?>checked<?php }?>>
				<span>Активен</span>
			</label>
			
			<label class="fancy-checkbox">
				<input type="checkbox" name="featured" <?php if ($_smarty_tpl->tpl_vars['product']->value->featured) {?>checked<?php }?>>
				<span>Рекомендуемый</span>
			</label>
		</div>
		
		<div class="board_subhead">
			<div id="product_categories" <?php if (!$_smarty_tpl->tpl_vars['categories']->value) {?>style='display:none;'<?php }?>>
				<label>Категория</label>
				<div>
					<ul>
						<?php
$_from = $_smarty_tpl->tpl_vars['product_categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['product_category'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['product_category']->_loop = false;
$_smarty_tpl->tpl_vars['__foreach_categories'] = new Smarty_Variable(array('iteration' => 0));
foreach ($_from as $_smarty_tpl->tpl_vars['product_category']->value) {
$_smarty_tpl->tpl_vars['product_category']->_loop = true;
$_smarty_tpl->tpl_vars['__foreach_categories']->value['iteration']++;
$_smarty_tpl->tpl_vars['__foreach_categories']->value['first'] = $_smarty_tpl->tpl_vars['__foreach_categories']->value['iteration'] == 1;
$foreach_product_category_Sav = $_smarty_tpl->tpl_vars['product_category'];
?>
						<li>
							<select name="categories[]">
								
								<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value,'selected_id'=>$_smarty_tpl->tpl_vars['product_category']->value->id), true);?>

							</select>
							<span <?php if (!(isset($_smarty_tpl->tpl_vars['__foreach_categories']->value['first']) ? $_smarty_tpl->tpl_vars['__foreach_categories']->value['first'] : null)) {?>style='display:none;'<?php }?> class="add"><i class="dash_link">Дополнительная категория</i></span>
							<span <?php if ((isset($_smarty_tpl->tpl_vars['__foreach_categories']->value['first']) ? $_smarty_tpl->tpl_vars['__foreach_categories']->value['first'] : null)) {?>style='display:none;'<?php }?> class="delete"><i class="dash_link">Удалить</i></span>
						</li>
						<?php
$_smarty_tpl->tpl_vars['product_category'] = $foreach_product_category_Sav;
}
?>		
					</ul>
				</div>
			</div>
			
			<div id="product_brand" <?php if (!$_smarty_tpl->tpl_vars['brands']->value) {?>style='display:none;'<?php }?>>
				<label>Бренд</label>
				<select name="brand_id">
					<option value='0' <?php if (!$_smarty_tpl->tpl_vars['product']->value->brand_id) {?>selected<?php }?> brand_name=''>Не указан</option>
					<?php
$_from = $_smarty_tpl->tpl_vars['brands']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['brand'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['brand']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
$_smarty_tpl->tpl_vars['brand']->_loop = true;
$foreach_brand_Sav = $_smarty_tpl->tpl_vars['brand'];
?>
						<option value='<?php echo $_smarty_tpl->tpl_vars['brand']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['product']->value->brand_id == $_smarty_tpl->tpl_vars['brand']->value->id) {?>selected<?php }?> brand_name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
					<?php
$_smarty_tpl->tpl_vars['brand'] = $foreach_brand_Sav;
}
?>
				</select>
			</div>
		</div>


		
		
		<!-- Варианты товара -->
		<div id="variants_block" <?php $_smarty_tpl->tpl_vars['first_variant'] = new Smarty_Variable($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['first'][0][0]->first_modifier($_smarty_tpl->tpl_vars['product_variants']->value), null, 0);
if (count($_smarty_tpl->tpl_vars['product_variants']->value) <= 1 && !$_smarty_tpl->tpl_vars['first_variant']->value->name) {?>class=single_variant<?php }?>>
			<ul id="header">
				<li class="variant_move"></li>
				<li class="variant_name">Размер</li>
				<li class="variant_color">Цвет</li>            
				<li class="variant_sku">Артикул</li>	
				<li class="variant_price">Цена, <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>	
				<li class="variant_discount">Старая, <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</li>	
				<li class="variant_amount">Кол-во</li>
				<li class="variant_download">Эл. товар</li>
			</ul>
			<div id="variants">
			<?php
$_from = $_smarty_tpl->tpl_vars['product_variants']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['variant'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['variant']->_loop = false;
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['i']->value => $_smarty_tpl->tpl_vars['variant']->value) {
$_smarty_tpl->tpl_vars['variant']->_loop = true;
$foreach_variant_Sav = $_smarty_tpl->tpl_vars['variant'];
?>
			<ul id="v_dd">
				<li class="variant_move"><div class="move_zone"></div></li>
				<li class="variant_name">
					<input name="variants[id][]" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->id, ENT_QUOTES, 'UTF-8', true);?>
" />
					<input name="variants[name][]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
					<a class="del_variant" href=""><img src="design/images/cross-circle-frame.png" alt="" /></a>
				</li>
				<li class="variant_color">
					<input name="variants[color][]" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->color, ENT_QUOTES, 'UTF-8', true);?>
" />
					<div style="<?php
$_from = $_smarty_tpl->tpl_vars['attributes']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['at'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['at']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['at']->value) {
$_smarty_tpl->tpl_vars['at']->_loop = true;
$foreach_at_Sav = $_smarty_tpl->tpl_vars['at'];
if ($_smarty_tpl->tpl_vars['variant']->value->color == $_smarty_tpl->tpl_vars['at']->value->id) {?>background:<?php echo $_smarty_tpl->tpl_vars['at']->value->value;
}
$_smarty_tpl->tpl_vars['at'] = $foreach_at_Sav;
}
?>" id="color_show"></div>
					<ul class="attributes_click">
					<?php
$_from = $_smarty_tpl->tpl_vars['attributes']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['at'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['at']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['at']->value) {
$_smarty_tpl->tpl_vars['at']->_loop = true;
$foreach_at_Sav = $_smarty_tpl->tpl_vars['at'];
?>
						<li data-attid="<?php echo $_smarty_tpl->tpl_vars['at']->value->id;?>
">
							<div class="color_at" style="background:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['at']->value->value, ENT_QUOTES, 'UTF-8', true);?>
"></div>
							<div class="name_at"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['at']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div>
						</li>
					<?php
$_smarty_tpl->tpl_vars['at'] = $foreach_at_Sav;
}
?>
					</ul>
				</li>			
			
				<li class="variant_sku">       <input name="variants[sku][]"           type="text"   value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->sku, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
				<li class="variant_price">     <input name="variants[price][]"         type="text"   value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->price, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
				<li class="variant_discount">  <input name="variants[compare_price][]" type="text"   value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->compare_price, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
				<li class="variant_amount">    <input name="variants[stock][]"         type="text"   value="<?php if ($_smarty_tpl->tpl_vars['variant']->value->infinity || $_smarty_tpl->tpl_vars['variant']->value->stock == '') {?>∞<?php } else {
echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->stock, ENT_QUOTES, 'UTF-8', true);
}?>" /><div class="units"><?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</div></li>
                <li class="variant_download">
				
					<?php if ($_smarty_tpl->tpl_vars['variant']->value->attachment) {?>
						<span class=attachment_name><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['variant']->value->attachment,25,'...',false,true);?>
</span>
						<a href='#' class=remove_attachment><img src='design/images/bullet_delete.png'  title="Удалить цифровой товар"></a>
						<a href='#' class=add_attachment style='display:none;'><img src="design/images/cd_add.png" title="Добавить цифровой товар" /></a>
					<?php } else { ?>
						<a href='#' class=add_attachment><img src="design/images/cd_add.png"  title="Добавить цифровой товар" /></a>
					<?php }?>
					<div class=browse_attachment style='display:none;'>
						<input type=file name=attachment[]>
						<input type=hidden name=delete_attachment[]>
					</div>
				
				</li>

                <li class="max-width">
                    <div class="variant_images">
                        <h2>Изображения варианта</h2>
                        <input name="variant_images[<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
][]" data-id="<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
" type="file" multiple  accept="image/jpeg,image/png,image/gif">
                        <div class="image_case">
                            <?php
$_from = $_smarty_tpl->tpl_vars['product_images']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['image']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
$foreach_image_Sav = $_smarty_tpl->tpl_vars['image'];
?>
                                <?php if ($_smarty_tpl->tpl_vars['image']->value->variant_id == $_smarty_tpl->tpl_vars['variant']->value->id) {?>
                                    <div><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->tpl_vars['image']->value->filename,70,70);?>
" alt="" /></div>
                                <?php }?>
                            <?php
$_smarty_tpl->tpl_vars['image'] = $foreach_image_Sav;
}
?>
                        </div>
                    </div>

                    <div class="variant_google">
                        <h2>Google Merchant</h2>
                        
                        <select name="variants[google_stock][]">
                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['variant']->value->google_stock == '1') {?>selected<?php }?>>в наличии</option>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['variant']->value->google_stock == '0') {?>selected<?php }?>>нет в наличии</option>
                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['variant']->value->google_stock == '2') {?>selected<?php }?>>предзаказ</option>
                        </select>
                    </div>
                </li>
			</ul>
			<?php
$_smarty_tpl->tpl_vars['variant'] = $foreach_variant_Sav;
}
?>		
			</div>
			<ul id=new_variant style='display:none;'>
				<li class="variant_move"><div class="move_zone"></div></li>
				<li class="variant_name"><input name="variants[id][]" type="hidden" value="" /><input name="variants[name][]" type="text" value="" placeholder="Название"/><a class="del_variant" href=""><img src="design/images/cross-circle-frame.png" alt="" /></a></li>
				<li class="variant_color">
					<input name="variants[color][]" type="hidden" value="" />
					<div style="" id="color_show"></div>
					<ul class="attributes_click">
					<?php
$_from = $_smarty_tpl->tpl_vars['attributes']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['at'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['at']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['at']->value) {
$_smarty_tpl->tpl_vars['at']->_loop = true;
$foreach_at_Sav = $_smarty_tpl->tpl_vars['at'];
?>
						<li data-attid="<?php echo $_smarty_tpl->tpl_vars['at']->value->id;?>
">
							<div class="color_at" style="background:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['at']->value->value, ENT_QUOTES, 'UTF-8', true);?>
"></div>
							<div class="name_at"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['at']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div>
						</li>
					<?php
$_smarty_tpl->tpl_vars['at'] = $foreach_at_Sav;
}
?>
					</ul>
				</li>		
				<li class="variant_sku"><input name="variants[sku][]" type="text" value="" placeholder="Артикул"/></li>
				<li class="variant_price"><input  name="variants[price][]" type="text" value="" placeholder="Цена"/></li>
				<li class="variant_discount"><input name="variants[compare_price][]" type="text" value="" placeholder="Старая цена"/></li>
				<li class="variant_amount"><input name="variants[stock][]" type="text" value="∞" /><?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>
</li>
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

			<span class="add" id="add_variant"><i class="dash_link">Добавить вариант</i></span>
		</div>
		<!-- Варианты товара (The End)--> 
		
		
		<div class="board_subhead">
			<!-- Левая колонка свойств товара -->
			<div id="board_column_left">
				<div class="block">
					<h2>Параметры страницы</h2>
					<ul>
						<li><label class=property>URL адрес</label><input name="url" class="page_url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
						<li><label class=property>Заголовок</label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
						<li><label class=property>Ключевые слова</label><textarea name="meta_keywords" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
						<li><label class=property>Описание</label><textarea name="meta_description" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
					</ul>
				</div>
						
				<div class="block" <?php if (!$_smarty_tpl->tpl_vars['categories']->value) {?>style='display:none;'<?php }?>>
					<h2>Свойства товара
					<a href="#" id=properties_wizard><img src="design/images/wand.png" alt="Подобрать автоматически" title="Подобрать автоматически"/></a>
					</h2>
					
					<ul class="prop_ul">
						<?php
$_from = $_smarty_tpl->tpl_vars['features']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['feature']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value) {
$_smarty_tpl->tpl_vars['feature']->_loop = true;
$foreach_feature_Sav = $_smarty_tpl->tpl_vars['feature'];
?>
							<?php $_smarty_tpl->tpl_vars['feature_id'] = new Smarty_Variable($_smarty_tpl->tpl_vars['feature']->value->id, null, 0);?>
							<li feature_id=<?php echo $_smarty_tpl->tpl_vars['feature_id']->value;?>
><label class=property><?php echo $_smarty_tpl->tpl_vars['feature']->value->name;?>
</label><input type="text" name=options[<?php echo $_smarty_tpl->tpl_vars['feature_id']->value;?>
] value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['options']->value[$_smarty_tpl->tpl_vars['feature_id']->value]->value, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
						<?php
$_smarty_tpl->tpl_vars['feature'] = $foreach_feature_Sav;
}
?>
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
					<ul><?php
$_from = $_smarty_tpl->tpl_vars['product_images']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['image']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['image']->value) {
$_smarty_tpl->tpl_vars['image']->_loop = true;
$foreach_image_Sav = $_smarty_tpl->tpl_vars['image'];
?><li>
							<a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
							<img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->tpl_vars['image']->value->filename,100,100);?>
" alt="" />
							<input type=hidden name='images[]' value='<?php echo $_smarty_tpl->tpl_vars['image']->value->id;?>
'>
						</li><?php
$_smarty_tpl->tpl_vars['image'] = $foreach_image_Sav;
}
?></ul>
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
                                <input type="checkbox" name="ymarket" <?php if ($_smarty_tpl->tpl_vars['product']->value->ymarket == 1) {?>checked<?php }?>>
                                <span>Выгрузка в Яндекс.маркет</span>
                            </label>
                        </li>
                        <li>
                            <label class="fancy-checkbox">
                                <input type="checkbox" name="google" <?php if ($_smarty_tpl->tpl_vars['product']->value->google == 1) {?>checked<?php }?>>
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
						<?php
$_from = $_smarty_tpl->tpl_vars['related_products']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['related_product'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['related_product']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['related_product']->value) {
$_smarty_tpl->tpl_vars['related_product']->_loop = true;
$foreach_related_product_Sav = $_smarty_tpl->tpl_vars['related_product'];
?>
						<div class="row">
							<div class="move cell">
								<div class="move_zone"></div>
							</div>
							<div class="image cell">
								<input type=hidden name=related_products[] value='<?php echo $_smarty_tpl->tpl_vars['related_product']->value->id;?>
'>
								<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('id'=>$_smarty_tpl->tpl_vars['related_product']->value->id),$_smarty_tpl);?>
">
									<img class=product_icon src='<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier($_smarty_tpl->tpl_vars['related_product']->value->images[0]->filename,35,35);?>
'>
								</a>
							</div>
							<div class="name cell">
								<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('id'=>$_smarty_tpl->tpl_vars['related_product']->value->id),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['related_product']->value->name;?>
</a>
							</div>
							<div class="icons cell">
								<a href='#' class="delete"></a>
							</div>
						</div>
						<?php
$_smarty_tpl->tpl_vars['related_product'] = $foreach_related_product_Sav;
}
?>
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
                            <label class="property">Лайки</label><input type=text name="likes" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->likes;?>
">
                        </li>
                    </ul>
                </div>
			</div>
		</div>

		<!-- Описагние товара -->
		<div class="text_block">
			<h2>Краткое описание</h2>
			<textarea name="annotation" class="editor_small"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->annotation, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
		</div>
			
		<div class="text_block">		
			<h2>Полное  описание</h2>
			<textarea name="body" class="editor_large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->body, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
		</div>
		<!-- Описание товара (The End)-->
		
		<div class="board_footer">
			<input class="button_green button_save" type="submit" name="" value="Сохранить" />	
		</div>
</form><?php }
}
?><?php
/* smarty_template_function_category_select_3210355772675795801_29739041 */
if (!function_exists('smarty_template_function_category_select_3210355772675795801_29739041')) {
function smarty_template_function_category_select_3210355772675795801_29739041($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
$params = array_merge(array('level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
								<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['category']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars['category'];
?>
										<option value='<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['category']->value->id == $_smarty_tpl->tpl_vars['selected_id']->value) {?>selected<?php }?> category_name='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
'><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['name'] = 'sp';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['level']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total']);
?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endfor; endif;
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
										<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['category']->value->subcategories,'selected_id'=>$_smarty_tpl->tpl_vars['selected_id']->value,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), false);?>

								<?php
$_smarty_tpl->tpl_vars['category'] = $foreach_category_Sav;
}
?>
								<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_category_select_3210355772675795801_29739041 */

?>
