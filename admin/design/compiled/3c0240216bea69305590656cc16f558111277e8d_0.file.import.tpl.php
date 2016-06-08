<?php /* Smarty version 3.1.24, created on 2015-07-15 14:46:53
         compiled from "admin/design/html/import.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2301655a5e5bd0eaf81_74977203%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c0240216bea69305590656cc16f558111277e8d' => 
    array (
      0 => 'admin/design/html/import.tpl',
      1 => 1436935611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2301655a5e5bd0eaf81_74977203',
  'variables' => 
  array (
    'config' => 0,
    'filename' => 0,
    'message_error' => 0,
    'import_files_dir' => 0,
    'locale' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5e5bd13d014_46107081',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5e5bd13d014_46107081')) {
function content_55a5e5bd13d014_46107081 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2301655a5e5bd0eaf81_74977203';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Импорт товаров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/js/piecon/piecon.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['filename']->value) {?>

	
	var in_process=false;
	var count=1;

	// On document load
	$(function(){
 		Piecon.setOptions({fallback: 'force'});
 		Piecon.setProgress(0);
    	$("#progressbar").progressbar({ value: 1 });
		in_process=true;
		do_import();	    
	});
  
	function do_import(from)
	{
		from = typeof(from) != 'undefined' ? from : 0;
		$.ajax({
 			 url: "ajax/import.php",
 			 	data: {from:from},
 			 	dataType: 'json',
  				success: function(data){
  					for(var key in data.items)
  					{
    					$('ul#import_result').prepend('<li><span class=count>'+count+'</span> <span title='+data.items[key].status+' class="status '+data.items[key].status+'"></span> <a target=_blank href="index.php?module=ProductAdmin&id='+data.items[key].product.id+'">'+data.items[key].product.name+'</a> '+data.items[key].variant.name+'</li>');
    					count++;
    				}

    				Piecon.setProgress(Math.round(100*data.from/data.totalsize));
   					$("#progressbar").progressbar({ value: 100*data.from/data.totalsize });
  				
    				if(data != false && !data.end)
    				{
    					do_import(data.from);
    				}
    				else
    				{
    					Piecon.setProgress(100);
    					$("#progressbar").hide('fast');
    					in_process = false;
    				}
  				},
				error: function(xhr, status, errorThrown) {
					alert(errorThrown+'\n'+xhr.responseText);
        		}  				
		});
	} 

<?php }?>
<?php echo '</script'; ?>
>

<style>
	.ui-progressbar-value { background-color:#b4defc; background-image: url(design/images/progress.gif); background-position:left; border-color: #009ae2;}
	#progressbar{ clear: both; height:29px;}
	#result{ clear: both; width:100%;}
</style>



<div class="capture_head">
    <div id="header">
        <h1>Импорт <?php if ($_smarty_tpl->tpl_vars['filename']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['filename']->value, ENT_QUOTES, 'UTF-8', true);
}?></h1>
    </div>
</div>


<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<div class="message_box message_error">
	<span class="text">
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'no_permission') {?>Установите права на запись в папку <?php echo $_smarty_tpl->tpl_vars['import_files_dir']->value;?>

	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'convert_error') {?>Не получилось сконвертировать файл в кодировку UTF8
	<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'locale_error') {?>На сервере не установлена локаль <?php echo $_smarty_tpl->tpl_vars['locale']->value;?>
, импорт может работать некорректно
	<?php } else {
echo $_smarty_tpl->tpl_vars['message_error']->value;
}?>
	</span>
</div>
<?php }?>

<div class="board_content">
<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
	<?php if ($_smarty_tpl->tpl_vars['filename']->value) {?>
	<div id='progressbar'></div>
	<ul id='import_result'></ul>
	<?php } else { ?>
        <div class="block">
            <form method=post id=product enctype="multipart/form-data">
                <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
                <input name="file" class="import_file" type="file" value="" />
                <input class="button_green" type="submit" name="" value="Загрузить" />
                <p>
                    (максимальный размер файла &mdash; <?php if ($_smarty_tpl->tpl_vars['config']->value->max_upload_filesize > 1024*1024) {
echo $_smarty_tpl->tpl_vars['config']->value->max_upload_filesize/1024/round(1024,'2');?>
 МБ<?php } else {
echo $_smarty_tpl->tpl_vars['config']->value->max_upload_filesize/round(1024,'2');?>
 КБ<?php }?>)
                </p>
            </form>
        </div>
	
		<div class="block block_help">
		<p>
			Создайте бекап на случай неудачного импорта. 
		</p>
		<p>
			Сохраните таблицу в формате CSV
		</p>
		<p>
			В первой строке таблицы должны быть указаны названия колонок в таком формате:

			<ul>
				<li><label>Товар</label> название товара</li>
				<li><label>Категория</label> категория товара</li>
				<li><label>Бренд</label> бренд товара</li>
				<li><label>Вариант</label> название варианта</li>
				<li><label>Цена</label> цена товара</li>
				<li><label>Старая цена</label> старая цена товара</li>
				<li><label>Склад</label> количество товара на складе</li>
				<li><label>Артикул</label> артикул товара</li>
				<li><label>Видим</label> отображение товара на сайте (0 или 1)</li>
				<li><label>Рекомендуемый</label> является ли товар рекомендуемым (0 или 1)</li>
				<li><label>Аннотация</label> краткое описание товара</li>
				<li><label>Адрес</label> адрес страницы товара</li>
				<li><label>Описание</label> полное описание товара</li>
				<li><label>Изображения</label> имена локальных файлов или url изображений в интернете, через запятую</li>
				<li><label>Заголовок страницы</label> заголовок страницы товара (Meta title)</li>
				<li><label>Ключевые слова</label> ключевые слова (Meta keywords)</li>
				<li><label>Описание страницы</label> описание страницы товара (Meta description)</li>
			</ul>
		</p>
		<p>
			Любое другое название колонки трактуется как название свойства товара
		</p>
		<p>
			<a href='files/import/example.csv'>Скачать пример файла</a>
		</p>
		</div>
	<?php }?>

<?php }?>
</div><?php }
}
?>