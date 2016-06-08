<?php /* Smarty version 3.1.24, created on 2016-06-03 19:19:36
         compiled from "admin/design/html/users.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1282457514ba821d676_12085008%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5af6cd52bd90e59571eaaed574bc29d5a7231be' => 
    array (
      0 => 'admin/design/html/users.tpl',
      1 => 1464945567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1282457514ba821d676_12085008',
  'variables' => 
  array (
    'keyword' => 0,
    'users_count' => 0,
    'users' => 0,
    'user' => 0,
    'groups' => 0,
    'sort' => 0,
    'group' => 0,
    'g' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_57514ba82cae73_68206690',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57514ba82cae73_68206690')) {
function content_57514ba82cae73_68206690 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1282457514ba821d676_12085008';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Покупатели', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="content_header">
    <h1>
        <?php if ($_smarty_tpl->tpl_vars['keyword']->value && $_smarty_tpl->tpl_vars['users_count']->value > 0) {?>
            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['users_count']->value,'Нашелся','Нашлось','Нашлись');?>
 <?php echo $_smarty_tpl->tpl_vars['users_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['users_count']->value,'покупатель','покупателей','покупателя');?>

        <?php } elseif ($_smarty_tpl->tpl_vars['users_count']->value > 0) {?>
            <?php echo $_smarty_tpl->tpl_vars['users_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['users_count']->value,'покупатель','покупателей','покупателя');?>

        <?php } else { ?>
            Нет покупателей
        <?php }?>
    </h1>

    <?php if ($_smarty_tpl->tpl_vars['users']->value) {?>
    <div class="buttons">
        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ExportUsersAdmin'),$_smarty_tpl);?>
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
                <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
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
$_from = $_smarty_tpl->tpl_vars['users']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['user']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
$foreach_user_Sav = $_smarty_tpl->tpl_vars['user'];
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
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['user']->value->last_visit);?>

                        </div>
                        <div class="icons cell">
                            <a class="enable" title="Активен" href="#"></a>
                            <a class="delete" title="Удалить" href="#"></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
$_smarty_tpl->tpl_vars['user'] = $foreach_user_Sav;
}
?>
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
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'name') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'name'),$_smarty_tpl);?>
">имени</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'date') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'date'),$_smarty_tpl);?>
">дате</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['sort']->value == 'last_visit') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('sort'=>'last_visit'),$_smarty_tpl);?>
">последнему визиту</a></li>
            </ul>

            <div id="right_head">Фильтр по группам</div>
            <ul class="filter">
                <li <?php if (!$_smarty_tpl->tpl_vars['group']->value->id) {?>class="selected"<?php }?>><a href='index.php?module=UsersAdmin'>Все группы</a></li>
            <?php if ($_smarty_tpl->tpl_vars['groups']->value) {?>
                <?php
$_from = $_smarty_tpl->tpl_vars['groups']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['g'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['g']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['g']->value) {
$_smarty_tpl->tpl_vars['g']->_loop = true;
$foreach_g_Sav = $_smarty_tpl->tpl_vars['g'];
?>
                    <li <?php if ($_smarty_tpl->tpl_vars['group']->value->id == $_smarty_tpl->tpl_vars['g']->value->id) {?>class="selected"<?php }?>><a href="index.php?module=UsersAdmin&group_id=<?php echo $_smarty_tpl->tpl_vars['g']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['g']->value->name;?>
</a></li>
                <?php
$_smarty_tpl->tpl_vars['g'] = $foreach_g_Sav;
}
?>
            <?php }?>
            </ul>
        </div>
    </div>

    <div class="board_footer">
        <?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
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
            $('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
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
?>