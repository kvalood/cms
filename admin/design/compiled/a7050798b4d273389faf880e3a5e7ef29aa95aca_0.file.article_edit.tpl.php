<?php /* Smarty version 3.1.24, created on 2015-07-14 06:17:50
         compiled from "admin/design/html/article_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1146255a41cee455393_12365831%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7050798b4d273389faf880e3a5e7ef29aa95aca' => 
    array (
      0 => 'admin/design/html/article_edit.tpl',
      1 => 1433685273,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1146255a41cee455393_12365831',
  'variables' => 
  array (
    'article' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'articlecat' => 0,
    'c' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a41cee4e5c30_19465142',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a41cee4e5c30_19465142')) {
function content_55a41cee4e5c30_19465142 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'D:/SERVER/domains/cms/Smarty/libs/plugins/modifier.date_format.php';

$_smarty_tpl->properties['nocache_hash'] = '1146255a41cee455393_12365831';
if ($_smarty_tpl->tpl_vars['article']->value->id) {?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['article']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый материал', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
 src="design/js/datetimepicker/jquery.datetimepicker.js"><?php echo '</script'; ?>
>
<link href="design/js/datetimepicker/jquery.datetimepicker.css" rel="stylesheet" type="text/css" media="screen"/>

<?php echo '<script'; ?>
>
$(function() {

    $('input[name="date"]').datetimepicker({
        value: '<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value->date,'%Y/%m/%d %H:%M');?>
'
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

<?php echo '</script'; ?>
>



<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1>
                <?php if ($_smarty_tpl->tpl_vars['article']->value->id) {?>
                    Редактирование материала
                <?php } else { ?>
                    Новый материал
                <?php }?>
            </h1>
        </div>
        <a href="index.php?module=ArticleAdmin">← Назад</a>
        <a href="index.php?module=ArticleEdit">+ Создать еще один материал</a>

        <?php if ($_smarty_tpl->tpl_vars['article']->value->id) {?>
        <a href="/<?php echo $_smarty_tpl->tpl_vars['article']->value->full_url;?>
" target="_blank">Просмотр на сайте</a>
        <?php }?>
	
	    <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>


    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'added') {?>Материал добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Материал обновлен<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span>
            <?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'url_exists') {?>Материл с таким адресом уже существует
            <?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'name_empty') {?>Название материала не может быть пустым<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'error_uploading_image') {?>Загрузка изображения не удалась!<?php }?>
        </span>
    </div>
    <?php }?>


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Название материала</label><input class="name" name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/></li>

                    <li>
                        <label class=property>Категория</label>
                        <div class="select_box">
                            <select name="article_category"  class="select_row">
                                <option value="0"<?php if ($_smarty_tpl->tpl_vars['article']->value->category == 0) {?> selected="selected"<?php }?>>Без категории</option>
                                <?php
$_from = $_smarty_tpl->tpl_vars['articlecat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['c']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
$foreach_c_Sav = $_smarty_tpl->tpl_vars['c'];
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['article']->value->category == $_smarty_tpl->tpl_vars['c']->value->id) {?>selected="selected"<?php }?> ><?php echo $_smarty_tpl->tpl_vars['c']->value->name;?>
</option>
                                <?php
$_smarty_tpl->tpl_vars['c'] = $foreach_c_Sav;
}
?>
                            </select>
                        </div>
                    </li>

                    <li><label class=property>Адрес(url)</label><input name="url" class="page_url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->url, ENT_QUOTES, 'UTF-8', true);?>
" /></li>

                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['article']->value->visible) {?>checked<?php }?>>
                            <span>Активный/не активный</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Meta title</label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Meta Keywords</label><input name="meta_keywords"  type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Meta Description</label><textarea name="meta_description" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
                </ul>
            </div>

            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>Дата создания</label><input type=text name=date value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value->date,'%Y/%m/%d %H:%M');?>
'></li>
                    <li><label class=property>Дата изменения</label><input type=text disabled="" name=date_update value='<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['article']->value->date_update,'%Y/%m/%d %H:%M');?>
'></li>
                    <li><label class=property>id материала</label><input type=text disabled="" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->id;?>
"></li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительнительные поля</h2>
                <div class="subhelp">Доп.поля можно исспользовать для вывода сторонних ссылок или любой другой информации. Например прикрепить ссылку на YouTube видео.</div>
                <ul class="property_min">
                    <li><label class=property>Ссылка 1</label><input name="field[one_link]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->one_link, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li><label class=property>Текст ссылки 1</label><input name="field[one_text]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->one_text, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li><label class=property>Ссылка 2</label><input name="field[twoo_link]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->twoo_link, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Текст ссылки 2</label><input name="field[twoo_text]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->twoo_text, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Ссылка 3</label><input name="field[tree_link]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->tree_link, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Текст ссылки 3</label><input name="field[tree_text]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->field->tree_text, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                </ul>
            </div>

            <div class="block">
                <h2>Изображение для краткого содержания</h2>
                <ul style="overflow:hidden">
                    <li>
                        <?php if ($_smarty_tpl->tpl_vars['article']->value->prev_images) {?>
                            <div class="prev_images">
                                <img src="/<?php echo $_smarty_tpl->tpl_vars['config']->value->article_images_dir;
echo $_smarty_tpl->tpl_vars['article']->value->prev_images;?>
" alt="" />
                                <a href="#" class="delete"><img src="design/images/cross-circle-frame.png"></a>
                                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['article']->value->prev_images;?>
" name="article_prev_images"/>
                            </div>
                        <?php }?>

                        <input class="upload_image" name="prev_images" type="file" value="test">
                    </li>
                </ul>
            </div>
        </div>
    </div>

	
	<div class="text_block">
		<h2>Краткое описание</h2>
		<textarea name="annotation" class='editor_small'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->annotation, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>
		
	<div class="text_block">
		<h2>Текст материала</h2>
		<textarea name="body"  class='editor_large'><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['article']->value->text, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
	</div>

    <div id="action">
	    <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form><?php }
}
?>