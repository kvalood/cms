<?php
/* Smarty version 3.1.32, created on 2018-07-18 11:25:04
  from 'C:\SERVER\domains\cms\simpla\design\html\settings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b4e96f09db830_09888999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfdddabb8688e0e928f97fe2cfea1f0866a593b1' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\settings.tpl',
      1 => 1531833553,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b4e96f09db830_09888999 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'C:\\SERVER\\domains\\cms\\Smarty\\libs\\plugins\\function.math.php','function'=>'smarty_function_math',),));
$_smarty_tpl->_assignInScope('meta_title', "Настройки" ,false ,2);?>

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
                    <li><a href="#information_settings" data-toggle="tab">Информация о сайте</a></li>
                    <li><a href="#home_settings" data-toggle="tab">Главная страница</a></li>
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
                                    <li><label>Название компании</label><input name="company_name" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->company_name, ENT_QUOTES, 'UTF-8', true);?>
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
                            <div class="col l6 s12">
                                <h2>email оповещения</h2>
                                <ul>
                                    <li><label>Оповещение о заказах</label><input placeholder="email" name="order_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Оповещение о комментариях</label><input placeholder="email" name="comment_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->comment_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Обратный адрес оповещений</label><input placeholder="email" name="notify_from_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->notify_from_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                                    <li><label>Email для восстановления пароля</label><input name="admin_email" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->admin_email, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
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

                    <div class="block tab-pane" id="information_settings">
                        <div class="row">
                            <div class="col s12">
                                <h2>Информация о сайте</h2>
                                <ul>
                                    <li class="siteinfo_field hidden">
                                        <input type="text" value="" name="siteinfo[name][]"/>
                                        <textarea name="siteinfo[value][]"></textarea>
                                    </li>

                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['settings']->value->siteinfo, 'siteinfo_value', false, 'siteinfo_name');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['siteinfo_name']->value => $_smarty_tpl->tpl_vars['siteinfo_value']->value) {
?>
                                        <li class="siteinfo_field">
                                            <input type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteinfo_name']->value, ENT_QUOTES, 'UTF-8', true);?>
" name="siteinfo[name][]"/>
                                            <textarea name="siteinfo[value][]"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['siteinfo_value']->value, ENT_QUOTES, 'UTF-8', true);?>
</textarea>
                                            <button name="remove" class="icon-close"></button>
                                        </li>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>

                                <p id="create_siteinfo" class="button blue">Добавить контакт</p>
                            </div>
                        </div>
                    </div>

                    <div class="block tab-pane" id="home_settings">
                        <h2>Главная страница</h2>
                        <ul>
                            <li>
                                <label>страница</label>
                                <?php if ($_smarty_tpl->tpl_vars['home_article']->value) {?>
                                    <select name="home_page" class="selectpicker" data-live-search="true" data-width="100%">
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['home_article']->value->id;?>
" selected><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['home_article']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
                                    </select>
                                <?php } else { ?>
                                    У вас не создано еще ни одной страницы
                                <?php }?>
                            </li>
                        </ul>
                    </div>

                    <div class="block tab-pane" id="product_sorting">
                        <h2>Сортировка товаров на сайте</h2>
                        <ul>
                            <li>
                                <label>Сортировать по</label>
                                <select name="order_by">
                                    <option value="position" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_by, ENT_QUOTES, 'UTF-8', true) == 'position') {?>selected="select"<?php }?>>позиции</option>
                                    <option value="name" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_by, ENT_QUOTES, 'UTF-8', true) == 'name') {?>selected="select"<?php }?>>названию</option>
                                    <option value="created" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_by, ENT_QUOTES, 'UTF-8', true) == 'created') {?>selected="select"<?php }?>>дате создания</option>
                                    <option value="brand" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_by, ENT_QUOTES, 'UTF-8', true) == 'brand') {?>selected="select"<?php }?>>бренду</option>
                                    <option value="price" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->order_by, ENT_QUOTES, 'UTF-8', true) == 'price') {?>selected="select"<?php }?>>цене</option>
                                </select>

                                <select name="sort_order">
                                    <option value="desc" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sort_order, ENT_QUOTES, 'UTF-8', true) == 'desc') {?>selected="select"<?php }?>>убыванию</option>
                                    <option value="asc" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->sort_order, ENT_QUOTES, 'UTF-8', true) == 'asc') {?>selected="select"<?php }?>>возрастанию</option>
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
                            <li><label>Формат даты</label><input name="date_format" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->date_format, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
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
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['managers']->value, 'manager');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['manager']->value) {
?>
                                <li><label><?php echo $_smarty_tpl->tpl_vars['manager']->value->login;?>
</label><input name="pz_phones[<?php echo $_smarty_tpl->tpl_vars['manager']->value->login;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['settings']->value->pz_phones[$_smarty_tpl->tpl_vars['manager']->value->login], ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

</form><?php }
}
