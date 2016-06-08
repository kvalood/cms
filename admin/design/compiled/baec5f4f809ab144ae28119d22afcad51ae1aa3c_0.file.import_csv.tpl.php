<?php /* Smarty version 3.1.24, created on 2016-06-08 03:45:54
         compiled from "admin/design/html/import_csv.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:16364575708522ec678_40331794%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baec5f4f809ab144ae28119d22afcad51ae1aa3c' => 
    array (
      0 => 'admin/design/html/import_csv.tpl',
      1 => 1465321551,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16364575708522ec678_40331794',
  'variables' => 
  array (
    'filename' => 0,
    'config' => 0,
    'fields' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5757085235aa70_54714751',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5757085235aa70_54714751')) {
function content_5757085235aa70_54714751 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '16364575708522ec678_40331794';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Импорт товаров', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="content_header">
    <h1><?php if ($_smarty_tpl->tpl_vars['filename']->value) {?>Импорт <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filename']->value, ENT_QUOTES, 'UTF-8', true);
} else { ?>Импорт товаров<?php }?></h1>

</div>

<div class="board block">
<?php if (!$_smarty_tpl->tpl_vars['filename']->value) {?>

    <div class="row">
        <div class="col s12 sm4 m3 l3">

            <ul data-tabs="tabs" class="list-group">
                <li class="active"><a href="#import" data-toggle="tab">Импорт</a></li>
                <li><a href="#import_setting" data-toggle="tab">Настройка импорта</a></li>
            </ul>

        </div>

        <div class="col s12 sm8 m9">

            <div class="tab-content">

                <div class="block tab-pane active" id="import">

                    <h2>Импорт товаров</h2>

                    <form method=post id=product enctype="multipart/form-data">
                        <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
                        <input name="file" class="import_file" type="file" value="" />
                        <input class="button green" type="submit" name="" value="Загрузить" />
                        <p>
                            (максимальный размер файла &mdash; <?php if ($_smarty_tpl->tpl_vars['config']->value->max_upload_filesize > 1024*1024) {
echo $_smarty_tpl->tpl_vars['config']->value->max_upload_filesize/1024/round(1024,'2');?>
 МБ<?php } else {
echo $_smarty_tpl->tpl_vars['config']->value->max_upload_filesize/round(1024,'2');?>
 КБ<?php }?>)
                        </p>
                    </form>

                </div>


                <div class="block tab-pane" id="import_setting">

                    <h2>Настройка импорта товаров</h2>

                    <p>
                        Введите названия колонок из прайс листа.<br/>
                        Названия колонок можно писать через запятую.<br/>
                        Любое другое название колонки трактуется как название свойства товара
                    </p>

                    <form method="post">
                        <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">

                            <ul class="row">
                                <li class="col s12 m6"><label>Название</label><input type="text" name="options[name]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->name;?>
" placeholder="название товара"></li>
                                <li class="col s12 m6"><label>Категория</label><input type="text" name="options[category]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->category;?>
" placeholder="категория товара"></li>
                                <li class="col s12 m6"><label>Бренд</label><input type="text" name="options[brand]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->brand;?>
" placeholder="бренд товара"></li>
                                <li class="col s12 m6"><label>Внешний id</label><input type="text" name="options[external_id]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->external_id;?>
" placeholder="внешний id"></li>
                                <li class="col s12 m6"><label>В наличии</label><input type="text" name="options[instock]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->instock;?>
" placeholder="в наличии"></li>
                                <li class="col s12 m6"><label>Вариант</label><input type="text" name="options[variant]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->variant;?>
" placeholder="название варианта"></li>
                                <li class="col s12 m6"><label>Цена</label><input type="text" name="options[price]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->price;?>
" placeholder="цена товара"></li>
                                <li class="col s12 m6"><label>Старая цена</label><input type="text" name="options[compare_price]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->compare_price;?>
" placeholder="старая цена товара"></li>
                                <li class="col s12 m6"><label>Склад</label><input type="text" name="options[stock]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->stock;?>
" placeholder="количество товара на складе"></li>
                                <li class="col s12 m6"><label>Артикул</label><input type="text" name="options[sku]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->sku;?>
" placeholder="артикул товара"></li>
                                <li class="col s12 m6"><label>Видим</label><input type="text" name="options[visible]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->visible;?>
" placeholder="отображение товара на сайте (0 или 1)"></li>
                                <li class="col s12 m6"><label>Рекомендуемый</label><input type="text" name="options[featured]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->featured;?>
" placeholder="является ли товар рекомендуемым (0 или 1)"></li>
                                <li class="col s12 m6"><label>Аннотация</label><input type="text" name="options[annotation]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->annotation;?>
" placeholder="краткое описание товара"></li>
                                <li class="col s12 m6"><label>Описание</label><input type="text" name="options[description]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->description;?>
" placeholder="полное описание товара"></li>
                                <li class="col s12 m6"><label>Изображения</label><input type="text" name="options[images]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->images;?>
" placeholder="имена локальных файлов или url изображений в интернете, через запятую"></li>
                                <li class="col s12 m6"><label>Заголовок страницы</label><input type="text" name="options[meta_title]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->meta_title;?>
" placeholder="заголовок страницы товара (Meta title)"></li>
                                <li class="col s12 m6"><label>Ключевые слова</label><input type="text" name="options[meta_keywords]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->meta_keywords;?>
" placeholder="ключевые слова (Meta keywords)"></li>
                                <li class="col s12 m6"><label>Описание страницы</label><input type="text" name="options[meta_keywords]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->meta_keywords;?>
" placeholder="описание страницы товара (Meta description)"></li>
                                <li class="col s12 m6"><label>URL Адрес</label><input type="text" name="options[url]" value="<?php echo $_smarty_tpl->tpl_vars['fields']->value->url;?>
" placeholder="url адрес страницы товара"></li>
                            </ul>

                            <button type="submit" class="button green" name="save">Сохранить</button>

                        </div>
                    </form>


                </div>




<?php } else { ?>
    <div id='progressbar'></div>
    <ul id='import_result'></ul>

<?php }?>




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


<?php echo '<script'; ?>
 src="design/js/piecon/piecon.js"><?php echo '</script'; ?>
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

                console.log(data);
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
<?php }
}
?>