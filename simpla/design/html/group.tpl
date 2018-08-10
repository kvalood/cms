{if $group->id}
    {$meta_title = $group->name scope=parent}
{else}
    {$meta_title = 'Новая группа' scope=parent}
{/if}

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="{$smarty.session.id}">
    <input name=id type="hidden" value="{$group->id|escape}"/>

    <div class="content_header">
        <div id="header">
            <h1>{if $group->id}{$group->name|escape}{else}Новая группа{/if}</h1>
        </div>

        <a href="{url module=GroupsAdmin}"><- Назад</a>
        {if $group->id}
        <a href="{url module=GroupAdmin}">+ Добавить еще одну группу</a>
        {/if}

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>



    {if $message_success}
    <div class="message_box message_success">
        <span>{if $message_success=='added'}Группа добавлена{elseif $message_success=='updated'}Группа изменена{/if}</span>
    </div>
    {/if}

    {if $message_error}
    <div class="message_box message_error">
        <span>{if $message_error == 'empty_name'}Название группы не может быть пустым{/if}</span>
    </div>
    {/if}



    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class="property">Название группы</label><input class="name" name=name type="text" value="{$group->name|escape}"/></li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>Скидка %</label><input name="discount" type="text" value="{$group->discount|escape}" /></li>
                </ul>
            </div>
        </div>
    </div>
</form>