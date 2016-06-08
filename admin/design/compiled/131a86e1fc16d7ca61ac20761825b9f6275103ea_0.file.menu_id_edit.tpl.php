<?php /* Smarty version 3.1.24, created on 2015-06-25 16:57:59
         compiled from "admin/design/html/menu_id_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:14028558ba677bd24f8_62760860%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '131a86e1fc16d7ca61ac20761825b9f6275103ea' => 
    array (
      0 => 'admin/design/html/menu_id_edit.tpl',
      1 => 1432917938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14028558ba677bd24f8_62760860',
  'variables' => 
  array (
    'menu' => 0,
    'cat_cat' => 0,
    'message_success' => 0,
    'message_error' => 0,
    'article' => 0,
    'a' => 0,
    'menu_list_id' => 0,
    'article_cat' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_558ba677d456c8_50499194',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_558ba677d456c8_50499194')) {
function content_558ba677d456c8_50499194 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '14028558ba677bd24f8_62760860';
if ($_smarty_tpl->tpl_vars['menu']->value->name) {?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Редактирование пункта меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новый пункт меню', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>


<?php echo $_smarty_tpl->getSubTemplate ('tinymce_init.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>




<?php echo '<script'; ?>
 src="design/js/jquery/datepicker/jquery.ui.datepicker-ru.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
$(function() {
	$('.id_show').change(function(){
		var change = $('.id_show').val();
		$('.block_id').eq(change).css('display','block').siblings().css('display','none');
	});

	$('input[name="date"]').datepicker({
		regional:'ru'
	});
	
	//Генерация УРЛ
	$('input[name="name"]').keyup(function() {
		$('input[name="m_url"]').val(generate_url());
	});
	
	
});

function generate_url()
{
	url = $('input[name="name"]').val();
	url = url.replace(/[\s]+/gi, '-');
	url = translit(url);
	url = url.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();	
	return url;
}

function translit(str)
{
	var ru=("А-а-Б-б-В-в-Ґ-ґ-Г-г-Д-д-Е-е-Ё-ё-Є-є-Ж-ж-З-з-И-и-І-і-Ї-ї-Й-й-К-к-Л-л-М-м-Н-н-О-о-П-п-Р-р-С-с-Т-т-У-у-Ф-ф-Х-х-Ц-ц-Ч-ч-Ш-ш-Щ-щ-Ъ-ъ-Ы-ы-Ь-ь-Э-э-Ю-ю-Я-я").split("-")   
	var en=("A-a-B-b-V-v-G-g-G-g-D-d-E-e-E-e-E-e-ZH-zh-Z-z-I-i-I-i-I-i-J-j-K-k-L-l-M-m-N-n-O-o-P-p-R-r-S-s-T-t-U-u-F-f-H-h-TS-ts-CH-ch-SH-sh-SCH-sch-'-'-Y-y-'-'-E-e-YU-yu-YA-ya").split("-")   
 	var res = '';
	for(var i=0, l=str.length; i<l; i++)
	{ 
		var s = str.charAt(i), n = ru.indexOf(s); 
		if(n >= 0) { res += en[n]; } 
		else { res += s; } 
    } 
    return res;  
}

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


    <div class="board_subhead">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки</h2>
                <ul>
                    <li><label class=property>Заголовок</label><input name=name type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"/></li>
                    <li><label class=property>URL на сайте</label><input name="m_url" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->url, ENT_QUOTES, 'UTF-8', true);?>
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
        </div>

        <div id="board_column_right">
            <div class="block">
                <h2>Дополнительные настройки</h2>
                <ul>
                    <li><label class=property>CSS class пункта меню</label><input name="m_css" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->css, ENT_QUOTES, 'UTF-8', true);?>
"/></li>

                    <li><label class=property>Тип пункта меню</label>
                        <select name="id_show" class="id_show">
                            <option value="1" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 1) {?>selected="select"<?php }?>>Материал</option>
                            <option value="2" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 2) {?>selected="select"<?php }?>>Категория материалов</option>
                            <option value="3" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->type, ENT_QUOTES, 'UTF-8', true) == 3) {?>selected="select"<?php }?>>URL</option>
                        </select>
                    </li>

                    <li>
                        <label class=property>Типы</label>
                        <div class="list_block">
                            <div class="block_id"></div>

                            <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 1) {?> visible_b<?php }?>">
                                <div id="line">
                                    <label class="attrib">Выберете материал</label>
                                    <select name="article_id">
                                        <?php
$_from = $_smarty_tpl->tpl_vars['article']->value;
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
" <?php if ($_smarty_tpl->tpl_vars['a']->value->id == $_smarty_tpl->tpl_vars['menu']->value->id_show) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['a']->value->name, ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo $_smarty_tpl->tpl_vars['a']->value->id;?>
)</option>
                                        <?php
$_smarty_tpl->tpl_vars['a'] = $foreach_a_Sav;
}
?>
                                    </select>
                                </div>
                                <div id="line">
                                    <label class="attrib">Родительский элемент</label>
                                    <select name="m_parent_1">
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
                                </div>
                                <div id="line">
                                    <label class="attrib">Шаблон (прим. article_blog)</label>
                                    <input name="m_template_1" type="text" class="input_m"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->template, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Заголовок (title)</label>
                                    <input name="m_title_1" type="text" class="input_m"  value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Meta Keywords</label>
                                    <input name="m_keywords_1" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Meta description</label>
                                    <input name="m_description_1" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                            </div>

                            <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 2) {?> visible_b<?php }?>">
                                <div id="line">
                                    <label class="attrib">Выберете категорию материалов</label>
                                    <select name="category_id">
                                        <?php
$_from = $_smarty_tpl->tpl_vars['article_cat']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['c']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
$foreach_c_Sav = $_smarty_tpl->tpl_vars['c'];
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['c']->value->id == $_smarty_tpl->tpl_vars['menu']->value->id_show) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
 (<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
)</option>
                                        <?php
$_smarty_tpl->tpl_vars['c'] = $foreach_c_Sav;
}
?>
                                    </select>
                                </div>
                                <div id="line">
                                    <label class="attrib">Родительский элемент</label>
                                    <select name="m_parent_2">
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
                                </div>
                                <div id="line">
                                    <label class="attrib">Шаблон (прим. article_blog)</label>
                                    <input name="m_template_2" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->template, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Заголовок (title)</label>
                                    <input name="m_title_2" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Meta Keywords</label>
                                    <input name="m_keywords_2" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                                <div id="line">
                                    <label class="attrib">Meta description</label>
                                    <input name="m_description_2" type="text" class="input_m" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['menu']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
"/>
                                </div>
                            </div>

                            <div class="block_id<?php if ($_smarty_tpl->tpl_vars['menu']->value->type == 3) {?> visible_b<?php }?>">
                                <div id="line">
                                    <label class="attrib">Родительский элемент</label>
                                    <select name="m_parent_3">
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
                                </div>
                            </div>
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