{if $menu->name}
    {$meta_title = 'Редактирование пункта меню' scope=parent}
{else}
    {$meta_title = 'Новый пункт меню' scope=parent}
{/if}


{literal}
<script src="/js/autocomplete/jquery.autocomplete.min.js"></script>
<script>
$(function() {
	$('select[name="type"]').change(function(){
		var change = $(this).val();
		$('.block_id').eq(change-1).css('display','block').siblings().css('display','none');
	});
});
</script>
{/literal}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$menu->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>{if $menu->name}Редактирование пункта меню - {$menu->name|escape}{else}Новый пункт меню {/if} (<i>{$cat_cat->name|escape})</i></h1>
        </div>

        <a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat={$cat_cat->id}">← Назад</a>
        <a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat={$cat_cat->id}&mode=add" class="add">+ Добавить еще один пункт меню</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success == 'id_add'}Пункт меню добавлен{elseif $message_success == 'id_updated'}Пункт меню обновлен{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>{if $message_error == 'exist_url_menu'}Материл с таким адресом уже существует{elseif $message_error== 'no_name'}Не задан заголовок пункта меню{elseif $message_error== 'no_cat'}Не выбран материал или категория{elseif $message_error== 'no_url'}Не задан УРЛ{elseif $message_error=='no_type'}Вы не указали тип пункта меню{/if}</span>
    </div>
    {/if}


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Заголовок</label><input name=name type="text" value="{$menu->name|escape}"/></li>
                    <li><label class=property>URL на сайте</label><input name="url" type="text" value="{$menu->url|escape}"/></li>
                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" {if $menu->id}{if $menu->visible==1}checked{/if}{else}checked{/if}>
                            <span>Активный/не активный</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Заголовок <i>(meta title)</i></label><input name="meta_title" type="text" value="{$menu->meta_title|escape}"/></li>
                    <li><label class=property>Ключи <i>(meta keywords)</i></label><textarea name="meta_keywords">{$menu->meta_keywords|escape}</textarea></li>
                    <li><label class=property>Описание <i>(meta description)</i></label><textarea name="meta_description">{$menu->meta_description|escape}</textarea></li>
                    <li>Если данные незаполнены, они будут браться из настрое материала/категории</li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>CSS class пункта меню</label><input name="css" type="text" value="{$menu->css|escape}"/></li>

                    <li>
                        <label class=property>Родитель</label>
                        <select name="parent">
                            {if $menu_list_id}
                                <option value="0">Корневой элемент</option>
                                {foreach $menu_list_id as $a}
                                    <option value="{$a->id}" {if $menu->parent==$a->id}selected="selected"{/if}>-{$a->name|escape}</option>
                                {/foreach}
                            {else}
                                <option value="0">Корневой элемент</option>
                            {/if}
                        </select>
                    </li>

                    <li><label class=property>Шаблон <i>(прим. article_blog)</i></label><input name="template" type="text" value="{$menu->template|escape}"/></li>
                </ul>
            </div>

            <div class="block">
                <input type=hidden name="id_show" value='{$menu->id_show|escape}'>

                <h2>Настройки открываемого элемента</h2>
                <ul>
                    <li>
                        <label class=property>Тип пункта меню</label>
                        <select name="type">
                            <option value="1" {if $menu->type|escape == 1}selected="select"{/if}>Материал</option>
                            <option value="2" {if $menu->type|escape == 2}selected="select"{/if}>Категория материалов</option>
                            <option value="3" {if $menu->type|escape == 3}selected="select"{/if}>URL</option>
                        </select>
                    </li>

                    <li>

                        <div class="block_id{if $menu->type==1 or empty($menu->type)} visible{/if}">
                            <label class=property>Выберете материал</label><input type=text id='search_autocomplete' data-object="articles" class="input_autocomplete" placeholder="Пишите название материала" value="{if $menu->id_show}{$id_show->name} ({$menu->id_show}){/if}">
                        </div>

                        <div class="block_id{if $menu->type==2} visible{/if}">
                            <label class=property>Выберете категорию материалов</label><input value="{$id_show->name} ({$id_show->id})" type=text id='search_autocomplete' data-object="articles_category" class="input_autocomplete" placeholder="Пишите название категории">
                        </div>

                        <div class="block_id{if $menu->type==3} visible{/if}">

                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div id="action">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form>