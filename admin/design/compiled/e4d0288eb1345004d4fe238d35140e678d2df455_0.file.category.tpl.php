<?php /* Smarty version 3.1.24, created on 2016-06-08 03:26:16
         compiled from "admin/design/html/category.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:19186575703b898fbf7_62414779%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e4d0288eb1345004d4fe238d35140e678d2df455' => 
    array (
      0 => 'admin/design/html/category.tpl',
      1 => 1464945791,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19186575703b898fbf7_62414779',
  'variables' => 
  array (
    'category' => 0,
    'message_success' => 0,
    'config' => 0,
    'message_error' => 0,
    'cats' => 0,
    'cat' => 0,
    'level' => 0,
    'categories' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575703b8a360f2_56208603',
  'tpl_function' => 
  array (
    'category_select' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/e4d0288eb1345004d4fe238d35140e678d2df455_0.file.category.tpl.php',
      'uid' => 'e4d0288eb1345004d4fe238d35140e678d2df455',
      'call_name' => 'smarty_template_function_category_select_19186575703b898fbf7_62414779',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575703b8a360f2_56208603')) {
function content_575703b8a360f2_56208603 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_replace')) require_once 'C:/SERVER/domains/cms/Smarty/libs/plugins/modifier.replace.php';

$_smarty_tpl->properties['nocache_hash'] = '19186575703b898fbf7_62414779';
if ($_smarty_tpl->tpl_vars['category']->value->id) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['category']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новая категория', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
 src="design/js/jquery/jquery.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="design/js/jquery/jquery-ui.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/autocomplete/jquery.autocomplete.min.js"><?php echo '</script'; ?>
>

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
	$('textarea[name="meta_description"]').change(function() { meta_description_touched = true; });
	$('input[name="url"]').change(function() { url_touched = true; });
	
	$('input[name="name"]').keyup(function() { set_meta(); });
	  
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
	return name;
}

function generate_meta_description()
{
	if(typeof(tinyMCE.get("description")) =='object')
	{
		description = tinyMCE.get("description").getContent().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
		return description;
	}
	else
		return $('textarea[name=description]').val().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
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
 




<!-- Основная форма -->
<form method=post id=product enctype="multipart/form-data" class="board">
	<input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
	<input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/> 
	
	<div class="content_header">
		<a href="index.php?module=CategoriesAdmin">← Назад</a>	
		<?php if ($_smarty_tpl->tpl_vars['category']->value->id) {?><a target="_blank" href="../catalog/<?php echo $_smarty_tpl->tpl_vars['category']->value->url;?>
">Открыть категорию на сайте</a><?php }?>
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>
	
	
	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Категория добавлена<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Категория обновлена<?php } else {
echo $_smarty_tpl->tpl_vars['message_success']->value;
}?></span>
			
		<div class="share">		
			<a href="#" onClick='window.open("http://vkontakte.ru/share.php?url=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/catalog/<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->url);?>
&title=<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->name);?>
&description=<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->description);?>
&image=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/files/categories/<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->image);?>
&noparse=true","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/vk_icon.png" /></a>
			<a href="#" onClick='window.open("http://www.facebook.com/sharer.php?u=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/catalog/<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->url);?>
","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/facebook_icon.png" /></a>
			<a href="#" onClick='window.open("http://twitter.com/share?text=<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->name);?>
&url=<?php echo urlencode($_smarty_tpl->tpl_vars['config']->value->root_url);?>
/catalog/<?php echo urlencode($_smarty_tpl->tpl_vars['category']->value->url);?>
&hashtags=<?php echo urlencode(smarty_modifier_replace($_smarty_tpl->tpl_vars['category']->value->meta_keywords,' ',''));?>
","displayWindow","width=700,height=400,left=250,top=170,status=no,toolbar=no,menubar=no");return false;'>
			<img src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/images/twitter_icon.png" /></a>
		</div>
	</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
	<div class="message_box message_error">
		<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'url_exists') {?>Категория с таким адресом уже существует<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'name_empty') {?>У категории должно быть название<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'url_empty') {?>URl адрес не может быть пустым<?php }?></span>
	</div>
	<?php }?>

	<div id="name">
		<label style="display: block;margin-bottom: 2px;">Название категории</label>
		<input class="name_product" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" placeholder="Название категории"/> 

		<label class="fancy-checkbox">
			<input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['category']->value->visible) {?>checked<?php }?>>
			<span>Активена</span>
		</label>
	</div> 
	
	<div class="board_subhead">
		<div id="product_categories">
			<select name="parent_id">
				<option value='0'>Корневая категория</option>
				
				<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('cats'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

			</select>
		</div>
	</div>

	<div class="board_subhead">
		<div id="board_column_left">
			<div class="block">
				<h2>Параметры категории</h2>
				<ul>
					<li><label class=property>Адрес /catalog/</label><input name="url" class="page_url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
					<li><label class=property>Заголовок</label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
					<li><label class=property>Ключевые слова</label><textarea name="meta_keywords"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
					<li><label class=property>Описание</label><textarea name="meta_description"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
				</ul>
			</div>
		</div>

		<div id="board_column_right">
			<!-- Изображение категории -->	
			<div class="block layer images">
				<h2>Изображение категории</h2>
				<input class='upload_image' name=image type=file>			
				<input type=hidden name="delete_image" value="">
				<?php if ($_smarty_tpl->tpl_vars['category']->value->image) {?>
				<ul>
					<li>
						<a href='#' class="delete"><img src='design/images/cross-circle-frame.png'></a>
						<img src="../<?php echo $_smarty_tpl->tpl_vars['config']->value->categories_images_dir;
echo $_smarty_tpl->tpl_vars['category']->value->image;?>
" alt="" />
					</li>
				</ul>
				<?php }?>
			</div>
		</div>
	</div>

	<div class="text_block">
		<h2>Описание категории</h2>
		<textarea name="description" class="editor_small"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>

	<div class="board_footer">
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />	
	</div>
</form><?php }
}
?><?php
/* smarty_template_function_category_select_19186575703b898fbf7_62414779 */
if (!function_exists('smarty_template_function_category_select_19186575703b898fbf7_62414779')) {
function smarty_template_function_category_select_19186575703b898fbf7_62414779($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
$params = array_merge(array('level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
				<?php
$_from = $_smarty_tpl->tpl_vars['cats']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['cat']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
$foreach_cat_Sav = $_smarty_tpl->tpl_vars['cat'];
?>
					<?php if ($_smarty_tpl->tpl_vars['category']->value->id != $_smarty_tpl->tpl_vars['cat']->value->id) {?>
						<option value='<?php echo $_smarty_tpl->tpl_vars['cat']->value->id;?>
' <?php if ($_smarty_tpl->tpl_vars['category']->value->parent_id == $_smarty_tpl->tpl_vars['cat']->value->id) {?>selected<?php }?>><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']);
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
echo $_smarty_tpl->tpl_vars['cat']->value->name;?>
</option>
						<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('cats'=>$_smarty_tpl->tpl_vars['cat']->value->subcategories,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), false);?>

					<?php }?>
				<?php
$_smarty_tpl->tpl_vars['cat'] = $foreach_cat_Sav;
}
?>
				<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_category_select_19186575703b898fbf7_62414779 */

?>
