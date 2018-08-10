{$meta_title='Покупатели' scope=parent}

<div class="content_header">
    <h1>
        {if $keyword && $users_count>0}
            {$users_count|plural:'Нашелся':'Нашлось':'Нашлись'} {$users_count} {$users_count|plural:'покупатель':'покупателей':'покупателя'}
        {elseif $users_count>0}
            {$users_count} {$users_count|plural:'покупатель':'покупателей':'покупателя'}
        {else}
            Нет покупателей
        {/if}
    </h1>

    {if $users}
    <div class="buttons">
        <a href="{url module=ExportUsersAdmin}">Экспортировать пользователей в exel</a>
    </div>
    {/if}

</div>

{if $users}
    <!-- Основная часть -->
    <div id="main_list" class="board_content">
        <form id="list_form" method="post" class="left_board">
            <input type="hidden" name="session_id" value="{$smarty.session.id}">

            <div class="board_subhead">
                {include file='pagination.tpl'}
            </div>

            <div id="list">
                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="user_name">ФИО пользователя</div>
                    <div class="user_email">Email</div>
                    <div class="user_group">Группа</div>
                    <div class="date">Последний визит</div>
                </div>

                {foreach $users as $user}
                    <div class="{if !$user->enabled}invisible{/if} row">
                        <div class="checkbox cell">
                            <input type="checkbox" name="check[]" value="{$user->id}"/>
                        </div>
                        <div class="user_name cell">
                            <a href="index.php?module=UserAdmin&id={$user->id}">{$user->name|escape}</a>
                        </div>
                        <div class="user_email cell">
                            <a href="mailto:{$user->name|escape}<{$user->email|escape}>">{$user->email|escape}</a>
                        </div>
                        <div class="user_group cell">
                            {$groups[$user->group_id]->name}
                        </div>
                        <div class="date cell">
                            {$user->last_visit|date}
                        </div>
                        <div class="icons cell">
                            <a class="enable" title="Активен" href="#"></a>
                            <a class="delete" title="Удалить" href="#"></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                {/foreach}
            </div>

            <div id="action">
                <label id="check_all" class="dash_link">Выбрать все</label>

                <span id=select>
                <select name="action">
                    <option value="disable">Заблокировать</option>
                    <option value="enable">Разблокировать</option>
                    <option value="delete">Удалить</option>
                </select>
                </span>

                <input id="apply_action" class="button_green" type="submit" value="Применить">
            </div>
        </form>

        <div class="right_board">
            <div id="right_head">Упорядочить по</div>
            <ul class="filter">
                <li {if $sort=='name'}class="selected"{/if}><a href="{url sort=name}">имени</a></li>
                <li {if $sort=='date'}class="selected"{/if}><a href="{url sort=date}">дате</a></li>
                <li {if $sort=='last_visit'}class="selected"{/if}><a href="{url sort=last_visit}">последнему визиту</a></li>
            </ul>

            <div id="right_head">Фильтр по группам</div>
            <ul class="filter">
                <li {if !$group->id}class="selected"{/if}><a href='index.php?module=UsersAdmin'>Все группы</a></li>
            {if $groups}
                {foreach $groups as $g}
                    <li {if $group->id == $g->id}class="selected"{/if}><a href="index.php?module=UsersAdmin&group_id={$g->id}">{$g->name}</a></li>
                {/foreach}
            {/if}
            </ul>
        </div>
    </div>

    <div class="board_footer">
        {include file='pagination.tpl'}
    </div>
{else}
    Нет зарегистрированных пользователей{if $group->name} с группой "{$group->name}"{/if}.
{/if}

{literal}
<script>
    $(function() {

        // Выделить все
        $("#check_all").click(function() {
            $('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
        });

        // Удалить
        $("a.delete").click(function() {
            $('#list input[type="checkbox"][name*="check"]').attr('checked', false);
            $(this).closest(".row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
            $(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
            $(this).closest("form").submit();
        });

        // Скрыт/Видим
        $("a.enable").click(function() {
            var icon        = $(this);
            var line        = icon.closest(".row");
            var id          = line.find('input[type="checkbox"][name*="check"]').val();
            var state       = line.hasClass('invisible')?1:0;
            icon.addClass('loading_icon');
            $.ajax({
                type: 'POST',
                url: 'ajax/update_object.php',
                data: {'object': 'user', 'id': id, 'values': {'enabled': state}, 'session_id': '{/literal}{$smarty.session.id}{literal}'},
                success: function(data){
                    icon.removeClass('loading_icon');
                    if(state) {
                        line.removeClass('invisible');
                        show_modal_message('Пользователь включен.', 'message', 5000, 'bottom-right');
                    }
                    else {
                        line.addClass('invisible');
                        show_modal_message('Пользователь выключен.', 'black', 5000, 'bottom-right');
                    }
                },
                dataType: 'json'
            });
            return false;
        });

        // Подтверждение удаления
        $("form").submit(function() {
            if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
                if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
                    return false;
        });
    });

</script>
{/literal}