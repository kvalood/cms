<?php /* Smarty version 3.1.24, created on 2016-05-02 16:44:49
         compiled from "admin/design/html/menu_id_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:182515726f7612a52d3_45550566%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '470d25f7155e6ee4db5464c168c9f8e909ec5ecc' => 
    array (
      0 => 'admin/design/html/menu_id_edit.tpl',
      1 => 1462171488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '182515726f7612a52d3_45550566',
  'variables' => 
  array (
    'menu' => 0,
    'cat_cat' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'menu_list_id' => 0,
    'a' => 0,
    'id_show' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5726f761344039_46816131',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5726f761344039_46816131')) {
function content_5726f761344039_46816131 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '182515726f7612a52d3_45550566';
if ($_smarty_tpl->tpl_vars['menu']->value->name) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование пункта меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый пункт меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>



<?php echo '<script'; ?>
 src="/js/autocomplete/jquery.autocomplete.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
$(function() {
	$('select[name="type"]').change(function(){
		var change = $(this).val();
		$('.block_id').eq(change-1).css('display','block').siblings().css('display','none');
	});
});
<?php echo '</script'; ?>
>



<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name=id type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1><?php if ($_smarty_tpl->tpl_vars['menu']->value->name) {?>Редактирование пункта меню - <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->name, ENT_QUOTES, 'UTF-8', true);
} else { ?>Новый пункт меню <?php }?> (<i><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cat_cat']->value->name, ENT_QUOTES, 'UTF-8', true);?>
)</i></h1>
        </div>

        <a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['cat_cat']->value->id;?>
">← Назад</a>
        <a href="index.php?module=MenuAdmin&method=list_id_menu&id_cat=<?php echo $_smarty_tpl->tpl_vars['cat_cat']->value->id;?>
&mode=add" class="add">+ Добавить еще один пункт меню</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

    <?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
    <div class="message_box message_success">
        <span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'id_add') {?>Пункт меню добавлен<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'id_updated') {?>Пункт меню обновлен<?php }?></span>
    </div>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
    <div class="message_box message_error">
        <span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'exist_url_menu') {?>Материл с таким адресом уже существует<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'no_name') {?>Не задан заголовок пункта меню<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'no_cat') {?>Не выбран материал или категория<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'no_url') {?>Не задан УРЛ<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'no_type') {?>Вы не указали тип пункта меню<?php }?></span>
    </div>
    <?php }?>


    <div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Заголовок</label><input name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li><label class=property>URL на сайте</label><input name="url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->url, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li>
                        <hr/>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" <?php if ($_smarty_tpl->tpl_vars['menu']->value->id) {
if ($_smarty_tpl->tpl_vars['menu']->value->visible == 1) {?>checked<?php }
} else { ?>checked<?php }?>>
                            <span>Активный/не активный</span>
                        </label>
                    </li>
                </ul>
            </div>

            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Заголовок <i>(meta title)</i></label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li><label class=property>Ключи <i>(meta keywords)</i></label><textarea name="meta_keywords"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
                    <li><label class=property>Описание <i>(meta description)</i></label><textarea name="meta_description"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
                    <li>Если данные незаполнены, они будут браться из настрое материала/категории</li>
                </ul>
            </div>
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>CSS class пункта меню</label><input name="css" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->css, ENT_QUOTES, 'UTF-8', true);?>
"/></li>

                    <li>
                        <label class=property>Родитель</label>
                        <select name="parent">
                            <?php if ($_smarty_tpl->tpl_vars['menu_list_id']->value) {?>
                                <option value="0">Корневой элемент</option>
                                <?php
$_from = $_smarty_tpl->tpl_vars['menu_list_id']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['a']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->_loop = true;
$foreach_a_Sav = $_smarty_tpl->tpl_vars['a'];
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['a']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['menu']->value->parent == $_smarty_tpl->tpl_vars['a']->value->id) {?>selected="selected"<?php }?>>-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                <?php
$_smarty_tpl->tpl_vars['a'] = $foreach_a_Sav;
}
?>
                            <?php } else { ?>
                                <option value="0">Корневой элемент</option>
                            <?php }?>
                        </select>
                    </li>

                    <li><label class=property>Шаблон <i>(прим. article_blog)</i></label><input name="template" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->template, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                </ul>
            </div>

            <div class="block">
                <input type=hidden name="id_show" value='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->id_show, ENT_QUOTES, 'UTF-8', true);?>
'>

                <h2>Настройки открываемого элемента</h2>
                <ul>
                    <li>
                        <label class=property>Тип пункта меню</label>
                        <select name="type">
                            <option value="1" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 1) {?>selected="select"<?php }?>>Материал</option>
                            <option value="2" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 2) {?>selected="select"<?php }?>>Категория материалов</option>
                            <option value="3" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 3) {?>selected="select"<?php }?>>URL</option>
                        </select>
                    </li>

                    <li>

                        <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 1 || empty($_smarty_tpl->tpl_vars['menu']->value->type)) {?> visible<?php }?>">
                            <label class=property>Выберете материал</label><input type=text id='search_autocomplete' data-object="articles" class="input_autocomplete" placeholder="Пишите название материала" value="<?php if ($_smarty_tpl->tpl_vars['menu']->value->id_show) {
echo $_smarty_tpl->tpl_vars['id_show']->value->name;?>
 (<?php echo $_smarty_tpl->tpl_vars['menu']->value->id_show;?>
)<?php }?>">
                        </div>

                        <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 2) {?> visible<?php }?>">
                            <label class=property>Выберете категорию материалов</label><input value="<?php echo $_smarty_tpl->tpl_vars['id_show']->value->name;?>
 (<?php echo $_smarty_tpl->tpl_vars['id_show']->value->id;?>
)" type=text id='search_autocomplete' data-object="articles_category" class="input_autocomplete" placeholder="Пишите название категории">
                        </div>

                        <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 3) {?> visible<?php }?>">

                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div id="action">
        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>
</form><?php }
}
?>