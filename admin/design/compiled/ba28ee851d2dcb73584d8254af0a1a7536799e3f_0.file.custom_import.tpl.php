<?php /* Smarty version 3.1.24, created on 2016-06-08 01:05:18
         compiled from "admin/design/html/custom_import.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:113655756e2aed94ac6_55526717%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba28ee851d2dcb73584d8254af0a1a7536799e3f' => 
    array (
      0 => 'admin/design/html/custom_import.tpl',
      1 => 1465311901,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113655756e2aed94ac6_55526717',
  'variables' => 
  array (
    'manager' => 0,
    'config' => 0,
    'filename' => 0,
    'message_error' => 0,
    'import_files_dir' => 0,
    'locale' => 0,
    'custom_fields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5756e2aee336a1_76838663',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5756e2aee336a1_76838663')) {
function content_5756e2aee336a1_76838663 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '113655756e2aed94ac6_55526717';
$_smarty_tpl->_capture_stack[0][] = array('tabs', null, null); ob_start(); ?>
	<li class="active"><a href="index.php?module=CustomImportAdmin">Настраиваемый импорт</a></li>
    <?php if (in_array('import',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?><li><a href="index.php?module=ImportAdmin">Импорт</a></li><?php }?>
	<?php if (in_array('export',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?><li><a href="index.php?module=ExportAdmin">Экспорт</a></li><?php }?>
	<?php if (in_array('backup',$_smarty_tpl->tpl_vars['manager']->value->permissions)) {?><li><a href="index.php?module=BackupAdmin">Бекап</a></li><?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Импорт товаров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/simpla/design/js/piecon/piecon.js"><?php echo '</script'; ?>
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
 			 url: "ajax/custom_import.php",
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
    .list_custom_import{

    }
    .list_custom_import > li{
        padding: 12px 10px;
    }
    .list_custom_import > li:nth-of-type(2n){
        background: #e7ecef;
    }
    .list_custom_import > li label{
        width: 135px;
        display: inline-block;
    }
    .list_custom_import > li input{
        width: 750px;
        display: inline-block;
        border: 1px solid #abbdcb;
        padding: 6px 10px;
    }
    .help_box{
        line-height: 24px;
        font-size: 14px;
        margin: 30px 0 0px;
        font-weight: bold;
    }
	#progressbar{ clear: both; height:29px;}
	#result{ clear: both; width:100%;}

</style>

<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
<!-- Системное сообщение -->
<div class="message message_error">
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
<!-- Системное сообщение (The End)-->
<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
	
	<?php if ($_smarty_tpl->tpl_vars['filename']->value) {?>
	<div>
		<h1>Импорт <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filename']->value, ENT_QUOTES, 'UTF-8', true);?>
</h1>
	</div>
	<div id='progressbar'></div>
	<ul id='import_result'></ul>
	<?php } else { ?>
	
		<h1>Импорт товаров</h1>

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

        <form method="post">
            <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
            <div class="block">

                <p class="help_box">
                    Введите названия колонок из прайс листа.<br/>
                    Названия колонок можно писать через запятую.<br/>
                    Любое другое название колонки трактуется как название свойства товара
                </p>
                <ul class="list_custom_import">
                    <li><label>Название</label><input type="text" name="options[name]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->name;?>
" placeholder="название товара"></li>
                    <li><label>Категория</label><input type="text" name="options[category]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->category;?>
" placeholder="категория товара"></li>
                    <li><label>Бренд</label><input type="text" name="options[brand]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->brand;?>
" placeholder="бренд товара"></li>
                    <li><label>Внешний id</label><input type="text" name="options[external_id]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->external_id;?>
" placeholder="внешний id"></li>
                    <li><label>В наличии</label><input type="text" name="options[instock]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->instock;?>
" placeholder="в наличии"></li>
                    <li><label>Вариант</label><input type="text" name="options[variant]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->variant;?>
" placeholder="название варианта"></li>
                    <li><label>Цена</label><input type="text" name="options[price]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->price;?>
" placeholder="цена товара"></li>
                    <li><label>Старая цена</label><input type="text" name="options[compare_price]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->compare_price;?>
" placeholder="старая цена товара"></li>
                    <li><label>Склад</label><input type="text" name="options[stock]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->stock;?>
" placeholder="количество товара на складе"></li>
                    <li><label>Артикул</label><input type="text" name="options[sku]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->sku;?>
" placeholder="артикул товара"></li>
                    <li><label>Видим</label><input type="text" name="options[visible]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->visible;?>
" placeholder="отображение товара на сайте (0 или 1)"></li>
                    <li><label>Рекомендуемый</label><input type="text" name="options[featured]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->featured;?>
" placeholder="является ли товар рекомендуемым (0 или 1)"></li>
                    <li><label>Аннотация</label><input type="text" name="options[annotation]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->annotation;?>
" placeholder="краткое описание товара"></li>
                    <li><label>Описание</label><input type="text" name="options[description]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->description;?>
" placeholder="полное описание товара"></li>
                    <li><label>Изображения</label><input type="text" name="options[images]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->images;?>
" placeholder="имена локальных файлов или url изображений в интернете, через запятую"></li>
                    <li><label>Заголовок страницы</label><input type="text" name="options[meta_title]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->meta_title;?>
" placeholder="заголовок страницы товара (Meta title)"></li>
                    <li><label>Ключевые слова</label><input type="text" name="options[meta_keywords]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->meta_keywords;?>
" placeholder="ключевые слова (Meta keywords)"></li>
                    <li><label>Описание страницы</label><input type="text" name="options[meta_keywords]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->meta_keywords;?>
" placeholder="описание страницы товара (Meta description)"></li>

                    <li><label>URL Адрес</label><input type="text" name="options[url]" value="<?php echo $_smarty_tpl->tpl_vars['custom_fields']->value->url;?>
" placeholder="url адрес страницы товара"></li>
                </ul>

                <button type="submit" name="save">Сохранить</button>

            </div>
        </form>
	
	<?php }?>


<?php }
}
}
?>