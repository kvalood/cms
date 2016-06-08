<?php /* Smarty version 3.1.24, created on 2015-07-26 16:29:19
         compiled from "admin/design/html/brand.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:196055b47e3f699025_78353211%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a10c1e14bc3f653a4e25b948abac40bdaddc78cf' => 
    array (
      0 => 'admin/design/html/brand.tpl',
      1 => 1430735535,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '196055b47e3f699025_78353211',
  'variables' => 
  array (
    'brand' => 0,
    'message_success' => 0,
    'config' => 0,
    'message_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55b47e3f725a47_72839626',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55b47e3f725a47_72839626')) {
function content_55b47e3f725a47_72839626 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/modifier.replace.php';

$_smarty_tpl->properties['nocache_hash'] = '196055b47e3f699025_78353211';
if ($_smarty_tpl->tpl_vars['brand']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['brand']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый бренд', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
>
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

<?php echo '</script'; ?>
>
 


<form method=post id=product enctype="multipart/form-data" class="board">
	<input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
	<input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/> 
	
	<div class="capture_head">
		<a href="index.php?module=BrandsAdmin">← Назад</a>
		<?php if ($_smarty_tpl->tpl_vars['brand']->value->id) {?><a target="_blank" href="../brands/<?php echo $_smarty_tpl->tpl_vars['brand']->value->url;?>
">Открыть бренд на сайте</a><?php }?>
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>	
	
	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Бренд добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Бренд обновлен<?php } else {
echo $_smarty_tpl->tpl_vars['message_success']->value;
}?></span>
				
		<div class="share">		
			<a href="#" onClick='window.open("http://vkontakte.ru/share.php?url=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/brands/<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->url);?>
&title=<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->name);?>
&description=<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->description);?>
&image=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/files/brands/<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->image);?>
&noparse=true","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/vk_icon.png" /></a>
			<a href="#" onClick='window.open("http://www.facebook.com/sharer.php?u=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/brands/<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->url);?>
","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/facebook_icon.png" /></a>
			<a href="#" onClick='window.open("http://twitter.com/share?text=<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->name);?>
&url=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/brands/<?php echo urlencode($_smarty_tpl->tpl_vars['brand']->value->url);?>
&hashtags=<?php echo urlencode(smarty_modifier_replace($_smarty_tpl->tpl_vars['brand']->value->meta_keywords,' ',''));?>
","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/twitter_icon.png" /></a>
		</div>
		
	</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
	<div class="message_box message_error">
		<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'url_exists') {?>Бренд с таким адресом уже существует<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'name_empty') {?>У бренда должно быть название<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'url_empty') {?>URl адрес не может быть пустым<?php }?></span>
	</div>
	<?php }?>
	
	<div id="name">
		<label style="display: block;margin-bottom: 2px;">Название бренда</label>
		<input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Название бренда"/> 
	</div>
	
	<div class="board_subhead">	 
		<div id="board_column_left">
			<!-- Параметры страницы -->
			<div class="block">
				<h2>Параметры страницы</h2>
				<ul>
					<li><label class=property>Адрес /brands/</label><input name="url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
					<li><label class=property>Заголовок</label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
					<li><label class=property>Ключевые слова</label><textarea name="meta_keywords"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
					<li><label class=property>Описание</label><textarea name="meta_description" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
				</ul>
			</div>
		</div>
	
		<div id="board_column_right">
			<!-- Изображение категории -->	
			<div class="block images">
				<h2>Изображение бренда</h2>
				<input class='upload_image' name=image type=file>			
				<input type=hidden name="delete_image" value="">
				<?php if ($_smarty_tpl->tpl_vars['brand']->value->image) {?>
				<ul>
					<li>
						<a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
						<img src="../<?php echo $_smarty_tpl->tpl_vars['config']->value->brands_images_dir;
echo $_smarty_tpl->tpl_vars['brand']->value->image;?>
" alt="" />
					</li>
				</ul>
				<?php }?>
			</div>
			
		</div>
	</div>
	
	<div class="text_block">
		<h2>Описание бренда</h2>
		<textarea name="description" class="editor_small"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['brand']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>
	
	<div class="board_footer">
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />	
	</div>
	
</form><?php }
}
?>