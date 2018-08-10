<?php
/* Smarty version 3.1.32, created on 2018-08-10 14:24:53
  from 'C:\SERVER\domains\cms\simpla\design\html\users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b6d1395c0d428_81117550',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0a6600196623cca86eaec8c8b0717b3e1d25641' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\users.tpl',
      1 => 1505797758,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:pagination.tpl' => 2,
  ),
),false)) {
function content_5b6d1395c0d428_81117550 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', 'Покупатели' ,false ,2);?>

<div class="content_header">
    <h1>
        <?php if ($_smarty_tpl->tpl_vars['keyword']->value && $_smarty_tpl->tpl_vars['users_count']->value > 0) {?>
            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'plural' ][ 0 ], array( $_smarty_tpl->tpl_vars['users_count']->value,'Нашелся','Нашлось','Нашлись' ));?>
 <?php echo $_smarty_tpl->tpl_vars['users_count']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'plural' ][ 0 ], array( $_smarty_tpl->tpl_vars['users_count']->value,'покупатель','покупателей','покупателя' ));?>

        <?php } elseif ($_smarty_tpl->tpl_vars['users_count']->value > 0) {?>
            <?php echo $_smarty_tpl->tpl_vars['users_count']->value;?>
 <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'plural' ][ 0 ], array( $_smarty_tpl->tpl_vars['users_count']->value,'покупатель','покупателей','покупателя' ));?>

        <?php } else { ?>
            Нет покупателей
        <?php }?>
    </h1>

    <?php if ($_smarty_tpl->tpl_vars['users']->value) {?>
    <div class="buttons">
        <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('module'=>'ExportUsersAdmin'),$_smarty_tpl ) );?>
">Экспортировать пользователей в exel</a>
    </div>
    <?php }?>

</div>

<?php if ($_smarty_tpl->tpl_vars['users']->value) {?>
    <!-- Основная часть -->
    <div id="main_list" class="board_content">
        <form id="list_form" method="post" class="left_board">
            <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

            <div class="board_subhead">
                <?php $_smarty_tpl->_subTemplateRender('file:pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </div>

            <div id="list">
                <div class="list_top">
                    <div class="checkbox"></div>
                    <div class="user_name">ФИО пользователя</div>
                    <div class="user_email">Email</div>
                    <div class="user_group">Группа</div>
                    <div class="date">Последний визит</div>
                </div>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                    <div class="<?php if (!$_smarty_tpl->tpl_vars['user']->value->enabled) {?>invisible<?php }?> row">
                        <div class="checkbox cell">
                            <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
"/>
                        </div>
                        <div class="user_name cell">
                            <a href="index.php?module=UserAdmin&id=<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
                        </div>
                        <div class="user_email cell">
                            <a href="mailto:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->name, ENT_QUOTES, 'UTF-8', true);?>
<<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user']->value->email, ENT_QUOTES, 'UTF-8', true);?>
</a>
                        </div>
                        <div class="user_group cell">
                            <?php echo $_smarty_tpl->tpl_vars['groups']->value[$_smarty_tpl->tpl_vars['user']->value->group_id]->name;?>

                        </div>
                        <div class="date cell">
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( $_smarty_tpl->tpl_vars['user']->value->last_visit ));?>

                        </div>
                        <div class="icons cell">
                            <a class="enable" title="Активен" href="#"></a>
                            <a class="delete" title="Удалить" href="#"></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'name') {?>class="selected"<?php }?>><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('sort'=>'name'),$_smarty_tpl ) );?>
">имени</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'date') {?>class="selected"<?php }?>><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('sort'=>'date'),$_smarty_tpl ) );?>
">дате</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'last_visit') {?>class="selected"<?php }?>><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('sort'=>'last_visit'),$_smarty_tpl ) );?>
">последнему визиту</a></li>
            </ul>

            <div id="right_head">Фильтр по группам</div>
            <ul class="filter">
                <li <?php if (!$_smarty_tpl->tpl_vars['group']->value->id) {?>class="selected"<?php }?>><a href='index.php?module=UsersAdmin'>Все группы</a></li>
            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['groups']->value, 'g');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['g']->value) {
?>
                    <li <?php if ($_smarty_tpl->tpl_vars['group']->value->id == $_smarty_tpl->tpl_vars['g']->value->id) {?>class="selected"<?php }?>><a href="index.php?module=UsersAdmin&group_id=<?php echo $_smarty_tpl->tpl_vars['g']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['g']->value->name;?>
</a></li>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php }?>
            </ul>
        </div>
    </div>

    <div class="board_footer">
        <?php $_smarty_tpl->_subTemplateRender('file:pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
    </div>
<?php } else { ?>
    Нет зарегистрированных пользователей<?php if ($_smarty_tpl->tpl_vars['group']->value->name) {?> с группой "<?php echo $_smarty_tpl->tpl_vars['group']->value->name;?>
"<?php }?>.
<?php }?>


<?php echo '<script'; ?>
>
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
                data: {'object': 'user', 'id': id, 'values': {'enabled': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
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

<?php echo '</script'; ?>
>
<?php }
}
