{* Title *}
{if $menu->id}
    {$meta_title = 'Редактирование меню' scope=parent}
{else}
    {$meta_title = 'Создание меню' scope=parent}
{/if}


<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$menu->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>{if $menu->name}Редактирование меню{else}Создание меню{/if}</h1>
        </div>

        <a href="index.php?module=MenuAdmin">← Назад</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success == 'cat_add'}Меню добавлено{elseif $message_success == 'updated'}Меню обновлено{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>{if $message_error == 'no_name'}Вы не указали название меню{elseif $message_error == 'exist_name_cat'}Меню с таким именем уже существует{/if}</span>
    </div>
    {/if}

    <div class="board_subhead">
        <div id="board_column_left">
            <div class="block">
                <h2>Параметры</h2>
                <ul>
                    <li><label class=property>Название</label><input class="name" name="cat_name" type="text" value="{$menu->name}"/></li>
                    <li><label class=property>id (no edit)</label><input name="id_no_edit" type="text" value="{$menu->id}" disabled /></li>
                </ul>
            </div>
        </div>
    </div>
</form>