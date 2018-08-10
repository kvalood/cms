{if $item->name}
    {$meta_title = 'Редактирование пункта меню' scope=parent}
{else}
    {$meta_title = 'Новый пункт меню' scope=parent}
{/if}

<form method="post" enctype="multipart/form-data">

    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$item->id|escape}"/>
    <input type="hidden" name="type" value="{if $item->type}{$item->type}{else}1{/if}" />

    <div class="content_header">
        <h1>{if $item->name}Редактирование пункта меню - "{$item->name|escape}"{else}Новый пункт меню {/if}</h1>

        <div class="buttons">
            <a href="{url module=MenuAdmin method=items menu_id=$menu->id id=null}" class="button back">Назад</a>
            <input class="button save" type="submit" name="" value="Сохранить" />
        </div>
    </div>

    <div class="board block">
        <h2>Основные настройки</h2>
        
        <ul class="row">
            <li class="col s12 sm9">
                <label class="required">Заголовок</label>
                <input name=name type="text" value="{$item->name|escape}"/>
            </li>

            <li class="col s12 sm3">
                <label class="fancy-checkbox">
                    <input type="checkbox" name="visible" {if $item->id}{if $item->visible==1}checked{/if}{else}checked{/if}>
                    <span>Активный/не активный</span>
                </label>
            </li>

            <li class="col s12 sm6">
                <label>Родитель</label>
                <select name="parent_id">
                    <option value="0">Нет</option>
                    {foreach $menu_items as $a}
                        {if $a->id != $item->id}
                            <option value="{$a->id}" {if $item->parent_id==$a->id}selected="selected"{/if}>-{$a->name|escape}</option>
                        {/if}
                    {/foreach}
                </select>
            </li>

            <li class="col s12 sm6">
                <label>CSS class пункта меню</label>
                <input name="css" type="text" value="{$item->css|escape}"/>
            </li>

        </ul>

    </div>

    <div class="board">
        <h2>Настройки открываемого элемента</h2>

        <div class="row">
            <div class="col s12 sm4 m3 l3">
                <ul data-tabs="tabs" class="list-group">
                    <li{if $item->type==1 || !$item} class="active"{/if}><a href="#article" data-toggle="tab" data-type="1">Страница</a></li>
                    <li{if $item->type==2} class="active"{/if}><a href="#category" data-toggle="tab" data-type="2">Категория страниц</a></li>
                    <li{if $item->type==3} class="active"{/if}><a href="#url" data-toggle="tab" data-type="3">URL</a></li>
                </ul>
            </div>

            <div class="col s12 sm8 m9">

                <div class="tab-content">

                    <div class="block tab-pane{if $item->type==1 || !$item} active{/if}" id="article">
                        <label class="required">Выберите страницу</label>
                        {if $articles}
                            <select name="id_show" class="selectpicker" data-live-search="true" data-width="100%">
                                {foreach $articles as $article}
                                    <option value="{$article->id}" {if $item->type==1 && $item->id_show==$article->id}selected{/if}>{$article->name|escape}</option>
                                {/foreach}
                            </select>
                        {else}
                            У вас не создано еще ни одной страницы
                        {/if}
                    </div>

                    <div class="block tab-pane{if $item->type==2} active{/if}" id="category">
                        <label class="required">Выберите категорию</label>
                        {if $article_categories}
                            <select name="id_show" class="selectpicker" data-live-search="true" data-width="100%">
                                {foreach $article_categories as $category}
                                    <option value="{$category->id}" {if $item->type==2 && $item->id_show==$category->id}selected{/if}>{$category->name|escape}</option>
                                {/foreach}
                            </select>
                        {else}
                            У вас не создано еще ни одной категории.
                        {/if}
                    </div>

                    <div class="block tab-pane {if $item->type==3}active{/if}" id="url">
                        <label class="required">Введите URl</label>
                        <input type="text" name="url" value="{if $item->type==3}{$item->url}{/if}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

{literal}
<script>
    // Переключаем типы
    $(document).on('click', 'a[data-toggle="tab"]', function () {
       $(this).closest('form').find('input[name="type"]').val($(this).attr('data-type'));
    });
</script>
{/literal}