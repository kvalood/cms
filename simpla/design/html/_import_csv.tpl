{$meta_title='Импорт товаров' scope=parent}

<div class="content_header">
    <h1>{if $filename}Импорт {$filename|escape}{else}Импорт товаров{/if}</h1>
</div>

<div class="board block">
{if !$filename}

    <div class="block" id="import">

        <form method="post" enctype="multipart/form-data">
            <input type=hidden name="session_id" value="{$smarty.session.id}">

            <ul class="row">
                <li class="col s12">
                    <label>Название слота импорта</label>
                    <input type="text" name="import_settings[][name]" value="{$import_csv_settings->name}"/>
                </li>
            </ul>

            <input name="file" class="import_file" type="file" value="" />
            <p>(максимальный размер файла &mdash; {if $config->max_upload_filesize>1024*1024}{$config->max_upload_filesize/1024/1024|round:'2'} МБ{else}{$config->max_upload_filesize/1024|round:'2'} КБ{/if})</p>

            <input class="button red" type="submit" name="upload_file" value="Загрузить файл" />
            <button type="submit" class="button blue" name="start_import">Начать импорт</button>

            <ul class="row">
            {foreach $columns as $key => $colum}
                <li class="col s4">
                    <label>{$colum}</label>
                    <select name="import_settings[field][{$key}]">
                        <option value=""{if isset($import_csv_settings->field->$key) AND empty($import_csv_settings->field->$key)} selected{/if}>Пропустить колонку</option>
                        <option value="name"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'name'} selected{/if}>Название товара</option>
                        <option value="category"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'category'} selected{/if}>Категория</option>
                        <option value="brand"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'brand'} selected{/if}>Бренд</option>
                        <option value="price"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'price'} selected{/if}>Цена</option>
                        <option value="compare_price"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'compare_price'} selected{/if}>Старая цена</option>
                        <option value="sku"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'sku'} selected{/if}>Артикул</option>
                        <option value="stock"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'stock'} selected{/if}>Остаток на складе</option>
                        <option value="visible"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'visible'} selected{/if}>Активный</option>
                        <option value="featured"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'featured'} selected{/if}>Рекомендуемый</option>
                        <option value="url"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'url'} selected{/if}>URL</option>
                        <option value="annotation"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'annotation'} selected{/if}>Краткое описание</option>
                        <option value="description"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'description'} selected{/if}>Полное описание</option>
                        <option value="images"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'images'} selected{/if}>Изображения товара</option>
                        <option value="meta_title"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'meta_title'} selected{/if}>Meta title</option>
                        <option value="meta_keywords"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'meta_keywords'} selected{/if}>Meta keywords</option>
                        <option value="meta_description"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'meta_description'} selected{/if}>Meta description</option>
                        <option value="variant"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'variant'} selected{/if}>Вариант</option>
                        <option value="instock"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'instock'} selected{/if}>В наличии</option>
                        <option value="external_id"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'external_id'} selected{/if}>Внешний id</option>
                        <option value="option"{if isset($import_csv_settings->field->$key) AND $import_csv_settings->field->$key == 'option'} selected{/if}>Свойство товара</option>
                    </select>
                </li>
            {/foreach}
            </ul>

            <ul class="row">
                <li class="col s12">
                    <label class="fancy-checkbox">
                        <input type="checkbox" name="import_settings[available_import]" {if $import_csv_settings->available_import}checked{/if}>
                        <span>Импортировать товары НЕ в наличии</span>
                    </label>
                </li>
            </ul>

            <button type="submit" class="button green" name="save" value="1">Сохранить настройки</button>

        </form>

    </div>
{else}
    <div id='progressbar'></div>
    <ul id='import_result'></ul>
{/if}




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


<script src="design/js/piecon/piecon.js"></script>
<script>
    {if $filename}
    {literal}
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
    {/literal}
    {/if}
</script>
