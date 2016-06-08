<?php /* Smarty version 3.1.24, created on 2016-06-05 20:54:13
         compiled from "admin/design/html/settings.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:23392575404d53f99f1_71335938%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '929ba875f0efe123f4e8d495b9c87b6d4f2ff58f' => 
    array (
      0 => 'admin/design/html/settings.tpl',
      1 => 1464973389,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23392575404d53f99f1_71335938',
  'variables' => 
  array (
    'settings' => 0,
    'config' => 0,
    'currency' => 0,
    'managers' => 0,
    'manager' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575404d5526a13_27987923',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575404d5526a13_27987923')) {
function content_575404d5526a13_27987923 ($_smarty_tpl) {
if (!is_callable('smarty_function_math')) require_once 'C:/SERVER/domains/cms/Smarty/libs/plugins/function.math.php';

$_smarty_tpl->properties['nocache_hash'] = '23392575404d53f99f1_71335938';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable("Настройки", null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	
	<div class="content_header">
        <h1>Настройки сайта</h1>

        <div class="buttons">
		    <input class="button green" type="submit" name="save" value="Сохранить" />
        </div>
	</div>

    <div class="board">
        <div class="row">
            <div class="col s12 sm4 m3 l3">

                <ul data-tabs="tabs" class="list-group">
                    <li class="active"><a href="#basic_settings" data-toggle="tab">Основные настройки</a></li>
                    <li><a href="#product_sorting" data-toggle="tab">Настройка товаров</a></li>
                    <li><a href="#comments_settings" data-toggle="tab">Комментарии</a></li>
                    <li><a href="#formant_settings" data-toggle="tab">Форматы данных</a></li>
                    <li><a href="#postiezvonki_settings" data-toggle="tab">Интеграция "Простые звонки"</a></li>
                </ul>

            </div>

            <div class="col s12 sm8 m9">

                <div class="tab-content">

                    <div class="block tab-pane active" id="basic_settings">

                        <div class="row">
                            <div class="col l6 s12">

                                <h2>Основные настройки сайта</h2>
                                <ul>
                                    <li><label>Имя сайта</label><input name="site_name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->site_name, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Имя компании</label><input name="company_name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->company_name, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Телефон компании</label><input name="phone_site" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->phone_site, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Формат даты</label><input name="date_format" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->date_format, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Email для восстановления пароля</label><input name="admin_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->admin_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                </ul>

                            </div>
                            <div class="col l6 s12">

                                <h2>email оповещения</h2>
                                <ul>
                                    <li><label>Оповещение о заказах</label><input placeholder="email" name="order_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Оповещение о комментариях</label><input placeholder="email" name="comment_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->comment_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Обратный адрес оповещений</label><input placeholder="email" name="notify_from_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->notify_from_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                </ul>

                                <h2>Регистрация и вход на сайт</h2>
                                <ul>
                                    <li>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="user_register" <?php if ($_smarty_tpl->tpl_vars['settings']->value->user_register) {?>checked<?php }?>>
                                            <span>Разрешить регистрацию</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="user_login" <?php if ($_smarty_tpl->tpl_vars['settings']->value->user_login) {?>checked<?php }?>>
                                            <span>Разрешить авторизацию</span>
                                        </label>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <h2>Страницы</h2>
                        <ul>
                            <li><label>Материалов на странице сайта(в категории)</label><input name="articles_num" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->articles_num, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Материалов на странице админки</label><input name="articles_num_admin" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->articles_num_admin, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        </ul>


                        <h2>Водяной знак на изображенях товара</h2>
                        <ul>
                            <li><label>Водяной знак</label>
                                <input name="watermark_file" type="file" />

                                <img style='display:block; border:1px solid #d0d0d0; margin:10px 0 10px 0;' src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/<?php echo $_smarty_tpl->tpl_vars['config']->value->watermark_file;?>
?<?php echo smarty_function_math(array('equation'=>'rand(10,10000)'),$_smarty_tpl);?>
">
                            </li>
                            <li><label>Горизонтальное положение водяного знака</label><input name="watermark_offset_x" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->watermark_offset_x, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Вертикальное положение водяного знака</label><input name="watermark_offset_y" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->watermark_offset_y, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Прозрачность знака (больше &mdash; прозрачней)</label><input name="watermark_transparency" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->watermark_transparency, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Резкость изображений (рекомендуется 20%)</label><input name="images_sharpen" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->images_sharpen, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        </ul>
                    </div>

                    <div class="block tab-pane" id="product_sorting">
                        <h2>Сортировка товаров на сайте</h2>
                        <ul>
                            <li>
                                <label>Сортировать по</label>
                                <select name="sorting_method">
                                    <option value="position" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'position') {?>selected="select"<?php }?>>позиции</option>
                                    <option value="name" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'name') {?>selected="select"<?php }?>>названию</option>
                                    <option value="created" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'created') {?>selected="select"<?php }?>>дате создания</option>
                                    <option value="brand" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'brand') {?>selected="select"<?php }?>>бренду</option>
                                    <option value="price" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'price') {?>selected="select"<?php }?>>цене</option>
                                    <option value="likes" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'likes') {?>selected="select"<?php }?>>лайкам</option>
                                </select>

                                <select name="sort_product_type">
                                    <option value="DESC" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sort_product_type, ENT_QUOTES, 'UTF-8', true) == 'DESC') {?>selected="select"<?php }?>>убыванию</option>
                                    <option value="ASC" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sort_product_type, ENT_QUOTES, 'UTF-8', true) == 'ASC') {?>selected="select"<?php }?>>возрастанию</option>
                                </select>
                            </li>
                        </ul>

                        <h2>Отображение товаров на сайте</h2>
                        <ul>
                            <li><label>Стиль по умолчанию</label>
                                <select name="model_type">
                                    <option value="list" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->model_type, ENT_QUOTES, 'UTF-8', true) == 'list') {?>selected="select"<?php }?>>Списком (построчно)</option>
                                    <option value="box" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->model_type, ENT_QUOTES, 'UTF-8', true) == 'box') {?>selected="select"<?php }?>>Блоками</option>
                                </select>
                            </li>
                            <li>
                                <hr/>
                                <label>Отсутствующие товары</label>
                                <select name="products_end_list">
                                    <option value="" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->products_end_list, ENT_QUOTES, 'UTF-8', true) == '') {?>selected="select"<?php }?>>показывать все товары</option>
                                    <option value="in_stock" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->products_end_list, ENT_QUOTES, 'UTF-8', true) == 'in_stock') {?>selected="select"<?php }?>>НЕ показывать</option>
                                    <option value="end_list" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->products_end_list, ENT_QUOTES, 'UTF-8', true) == 'end_list') {?>selected="select"<?php }?>>показывать в конце списка</option>
                                </select>
                            </li>
                        </ul>


                        <h2>Настройки каталога</h2>
                        <ul>
                            <li><label>Товаров на странице сайта</label><input name="products_num" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->products_num, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Товаров на странице админки</label><input name="products_num_admin" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->products_num_admin, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Максимум товаров в заказе</label><input name="max_order_amount" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->max_order_amount, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        </ul>

                    </div>

                    <div class="block tab-pane" id="comments_settings">
                        <h2>Настройки комментирования</h2>
                        <ul>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_product" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_product) {?>checked<?php }?>>
                                    <span>Комментировать товары</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_article" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_article) {?>checked<?php }?>>
                                    <span>Комментировать материалы</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_not_register" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_not_register) {?>checked<?php }?>>
                                    <span>Разрешить комментирование незарегистрированным пользователям?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_notice" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_notice) {?>checked<?php }?>>
                                    <span>Уведомлять администратора о новых комментариях?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_moderate" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_moderate) {?>checked<?php }?>>
                                    <span>Модерировать комментарии перед публикацией?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_moderate_valid" <?php if ($_smarty_tpl->tpl_vars['settings']->value->comment_moderate_valid) {?>checked<?php }?>>
                                    <span>Модерировать комментарии от пользователей, чьи комментарии были ранее одобрены?</span>
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div class="block tab-pane" id="formant_settings">
                        <h2>Форматы данных</h2>
                        <ul>
                            <li><label>Единицы измерения товаров</label><input name="units" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->units, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Разделитель копеек</label>
                                <select name="decimals_point">
                                    <option value='.' <?php if ($_smarty_tpl->tpl_vars['settings']->value->decimals_point == '.') {?>selected<?php }?>>точка: 12.45 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    <option value=',' <?php if ($_smarty_tpl->tpl_vars['settings']->value->decimals_point == ',') {?>selected<?php }?>>запятая: 12,45 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                </select>
                            </li>
                            <li><label>Разделитель тысяч</label>
                                <select name="thousands_separator">
                                    <option value='' <?php if ($_smarty_tpl->tpl_vars['settings']->value->thousands_separator == '') {?>selected<?php }?>>без разделителя: 1245678 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    <option value=' ' <?php if ($_smarty_tpl->tpl_vars['settings']->value->thousands_separator == ' ') {?>selected<?php }?>>пробел: 1 245 678 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    <option value=',' <?php if ($_smarty_tpl->tpl_vars['settings']->value->thousands_separator == ',') {?>selected<?php }?>>запятая: 1,245,678 <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                </select>
                            </li>
                        </ul>
                    </div>

                    <div class="block tab-pane" id="postiezvonki_settings">
                        <h2>Интеграция с <a href="http://prostiezvonki.ru">простыми звонками</a></h2>
                        <ul>
                            <li><label>Сервер</label><input name="pz_server" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->pz_server, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <li><label>Пароль</label><input name="pz_password" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->pz_password, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        </ul>

                        <h3>Телефоны менеджеров:</h3>
                        <ul>
                            <?php
$_from = $_smarty_tpl->tpl_vars['managers']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['manager'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['manager']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['manager']->value) {
$_smarty_tpl->tpl_vars['manager']->_loop = true;
$foreach_manager_Sav = $_smarty_tpl->tpl_vars['manager'];
?>
                                <li><label><?php echo $_smarty_tpl->tpl_vars['manager']->value->login;?>
</label><input name="pz_phones[<?php echo $_smarty_tpl->tpl_vars['manager']->value->login;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login], ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <?php
$_smarty_tpl->tpl_vars['manager'] = $foreach_manager_Sav;
}
?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

</form><?php }
}
?>