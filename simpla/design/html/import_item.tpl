{$meta_title='Импорт товаров' scope=parent}

<form method="post" enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input type="hidden" name="id" value="{$item->id|escape}"/>

    <div class="content_header">
        <h1>{if $item}Импорт {$item->name|escape}{else}Импорт товаров{/if}</h1>

        <div class="buttons">
            <a href="{url module=ImportAdmin method=null id=null}" class="button back">Назад</a>
            {if !$filename}
            <input class="button save" type="submit" name="save" value="Сохранить" />
            {/if}
        </div>
    </div>

    <div class="board block">

        <ul class="row">
            <li class="col s12">
                <label class="required">Название слота импорта</label>
                <input type="text" name="name" value="{$item->name}"/>
            </li>

            <li class="col s12 m6">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="available_import" {if $item->available_import}checked{/if}>
                    <span>Импортировать товары НЕ в наличии</span>
                </label>
            </li>

            <li class="col s12 m6">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="auto_import" {if $item->auto_import}checked{/if}>
                    <span>Автоматически импортировать</span>
                </label>
            </li>

            <li class="col s6 m3">
                <label>Пропустить первые N строк</label>
                <input type="text" name="settings[continue_row]" value="{if $item->settings.continue_row}{$item->settings.continue_row}{else}0{/if}"/>
            </li>

            <li class="col s6 m3">
                <label>Разделитель категорий товаров</label>
                <input type="text" name="settings[category_delimiter]" value="{if $item->settings.category_delimiter}{$item->settings.category_delimiter}{else},{/if}"/>
            </li>

            <li class="col s6 m3">
                <label>Разделитель колонок</label>
                <input type="text" name="settings[column_delimiter]" value="{if $item->settings.column_delimiter}{$item->settings.column_delimiter}{else};{/if}"/>
            </li>

            <li class="col s6 m3">
                <label>Разделитель подкатегорий товаров</label>
                <input type="text" name="settings[subcategory_delimiter]" value="{if $item->settings.subcategory_delimiter}{$item->settings.subcategory_delimiter}{else};{/if}"/>
            </li>

            <li class="col s6 m3">
                <label>Идентифицировать товар по:</label>
                <select name="settings[identifier]">
                    <option value="sku" {if $item->settings.identifier == 'sku'}selected{/if}>Артикулу товара</option>
                    <option value="product_name" {if $item->settings.identifier == 'product_name'}selected{/if}>Наименованию товара</option>
                    <option value="properties" {if $item->settings.identifier == 'properties'}selected{/if}>Артикулу и опциям товара "Цвет/размер"</option>
                 </select>
            </li>

        </ul>

        {if $item}
            <input name="file" class="import_file" type="file" value="" />
            <p>(максимальный размер файла &mdash; {if $config->max_upload_filesize>1024*1024}{$config->max_upload_filesize/1024/1024|round:'2'} МБ{else}{$config->max_upload_filesize/1024|round:'2'} КБ{/if})</p>

            <input class="button red" type="submit" name="upload_file" value="Загрузить файл" />

            {if $item->settings.file_import}
                <button type="submit" class="button blue" name="start_import">Начать импорт</button>

                <input type="hidden" name="settings[file_import]" value="{$item->settings.file_import}"/>

                <div class="table_box">
                    <table>

                    {$array_column = [
                        'name' => 'Название товара',
                        'category' => 'Категория товара',
                        'brand' => 'Бренд',
                        'price' => 'Цена',
                        'compare_price' => 'Старая цена',
                        'sku' => 'Артикул',
                        'stock' => 'Остаток на складе',
                        'visible' => 'Активный',
                        'featured' => 'Рекомендуемый',
                        'url' => 'URL',
                        'annotation' => 'Краткое описание',
                        'description' => 'Полное описание',
                        'images' => 'Изображения товара',
                        'meta_title' => 'Meta title',
                        'meta_keywords' => 'Meta keywords',
                        'meta_description' => 'Meta description',
                        'variant' => 'Называние варианта',
                        'color' => 'Цвет варианта',
                        'instock' => 'В наличии',
                        'external_id' => 'Внешний id']}

                    {foreach $columns as $key => $colum}
                        <thead>
                            <tr>
                                {foreach $colum as $ck => $val}
                                    <td>
                                        <select name="settings[field][{$ck}]" >
                                            <option value=""{if !isset($item->settings.field.$ck)} selected{/if}>Пропустить колонку</option>
                                            {foreach $array_column as $k => $v}
                                                <option value="{$k}"{if isset($item->settings.field.$ck) AND $item->settings.field.$ck == $k} selected{/if}>{$v}</option>
                                            {/foreach}
                                            <option value="" disabled>Свойства товаров</option>
                                            {foreach $features as $feature}
                                                <option value="option_{$feature->id}"{if isset($item->settings.field.$ck) AND $item->settings.field.$ck == "option_{$feature->id}"} selected{/if}>Свойство—{$feature->name}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                {/foreach}
                            </tr>
                        {break}
                    {/foreach}

                    {foreach $columns as $key => $colum}
                        <tr>
                            {foreach $colum as $val}
                                <td>{$val}</td>
                            {/foreach}
                        </tr>
                    {/foreach}
                    </table>
                </div>
            {/if}
        {/if}

    </div>
</form>


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
    {if $item->settings.file_import}
    {literal}
    var in_process=false;
    var count=1;

    $(document).on('click', '[name="start_import"]', function(){
        $(this).closest('form .board').html('<div id="progressbar"></div><ul id="import_result"></ul>');
        Piecon.setOptions({fallback: 'force'});
        Piecon.setProgress(0);
        $("#progressbar").progressbar({ value: 1 });
        in_process=true;
        do_import();

        return false;
    });

    function do_import(from)
    {
        from = typeof(from) != 'undefined' ? from : 0;
        $.ajax({
            type: 'POST',
            url: "ajax/import.php",
            data: {from:from, price_id: $('input[name="id"]').val()},
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
