{$meta_title = "Настройки" scope=parent}

<form method="post" enctype="multipart/form-data">
	<input type="hidden" name="session_id" value="{$smarty.session.id}">
	
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
                                    <li><label>Имя сайта</label><input name="site_name" type="text" value="{$settings->site_name|escape}" /></li>
                                    <li><label>Название компании</label><input name="company_name" type="text" value="{$settings->company_name|escape}" /></li>
                                </ul>

                                <h2>Регистрация и вход на сайт</h2>
                                <ul>
                                    <li>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="user_register" {if $settings->user_register}checked{/if}>
                                            <span>Разрешить регистрацию</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="fancy-checkbox">
                                            <input type="checkbox" name="user_login" {if $settings->user_login}checked{/if}>
                                            <span>Разрешить авторизацию</span>
                                        </label>
                                    </li>
                                </ul>

                            </div>
                            <div class="col l6 s12">
                                <h2>email оповещения</h2>
                                <ul>
                                    <li><label>Оповещение о заказах</label><input placeholder="email" name="order_email" type="text" value="{$settings->order_email|escape}" /></li>
                                    <li><label>Оповещение о комментариях</label><input placeholder="email" name="comment_email" type="text" value="{$settings->comment_email|escape}" /></li>
                                    <li><label>Обратный адрес оповещений</label><input placeholder="email" name="notify_from_email" type="text" value="{$settings->notify_from_email|escape}" /></li>
                                    <li><label>Email для восстановления пароля</label><input name="admin_email" type="text" value="{$settings->admin_email|escape}" /></li>
                                </ul>
                            </div>
                        </div>

                        <h2>Страницы</h2>
                        <ul>
                            <li><label>Материалов на странице сайта(в категории)</label><input name="articles_num" type="text" value="{$settings->articles_num|escape}" /></li>
                            <li><label>Материалов на странице админки</label><input name="articles_num_admin" type="text" value="{$settings->articles_num_admin|escape}" /></li>
                        </ul>


                        <h2>Водяной знак на изображенях товара</h2>
                        <ul>
                            <li><label>Водяной знак</label>
                                <input name="watermark_file" type="file" />

                                <img style='display:block; border:1px solid #d0d0d0; margin:10px 0 10px 0;' src="{$config->root_url}/{$config->watermark_file}?{math equation='rand(10,10000)'}">
                            </li>
                            <li><label>Горизонтальное положение водяного знака</label><input name="watermark_offset_x" type="text" value="{$settings->watermark_offset_x|escape}" /></li>
                            <li><label>Вертикальное положение водяного знака</label><input name="watermark_offset_y" type="text" value="{$settings->watermark_offset_y|escape}" /></li>
                            <li><label>Прозрачность знака (больше &mdash; прозрачней)</label><input name="watermark_transparency" type="text" value="{$settings->watermark_transparency|escape}" /></li>
                            <li><label>Резкость изображений (рекомендуется 20%)</label><input name="images_sharpen" type="text" value="{$settings->images_sharpen|escape}" /></li>
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

                                    {foreach $settings->siteinfo as $siteinfo_name => $siteinfo_value}
                                        <li class="siteinfo_field">
                                            <input type="text" value="{$siteinfo_name|escape}" name="siteinfo[name][]"/>
                                            <textarea name="siteinfo[value][]">{$siteinfo_value|escape}</textarea>
                                            <button name="remove" class="icon-close"></button>
                                        </li>
                                    {/foreach}
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
                                {if $home_article}
                                    <select name="home_page" class="selectpicker" data-live-search="true" data-width="100%">
                                        <option value="{$home_article->id}" selected>{$home_article->name|escape}</option>
                                    </select>
                                {else}
                                    У вас не создано еще ни одной страницы
                                {/if}
                            </li>
                        </ul>
                    </div>

                    <div class="block tab-pane" id="product_sorting">
                        <h2>Сортировка товаров на сайте</h2>
                        <ul>
                            <li>
                                <label>Сортировать по</label>
                                <select name="order_by">
                                    <option value="position" {if $settings->order_by|escape == 'position'}selected="select"{/if}>позиции</option>
                                    <option value="name" {if $settings->order_by|escape == 'name'}selected="select"{/if}>названию</option>
                                    <option value="created" {if $settings->order_by|escape == 'created'}selected="select"{/if}>дате создания</option>
                                    <option value="brand" {if $settings->order_by|escape == 'brand'}selected="select"{/if}>бренду</option>
                                    <option value="price" {if $settings->order_by|escape == 'price'}selected="select"{/if}>цене</option>
                                </select>

                                <select name="sort_order">
                                    <option value="desc" {if $settings->sort_order|escape == 'desc'}selected="select"{/if}>убыванию</option>
                                    <option value="asc" {if $settings->sort_order|escape == 'asc'}selected="select"{/if}>возрастанию</option>
                                </select>
                            </li>
                        </ul>

                        <h2>Отображение товаров на сайте</h2>
                        <ul>
                            <li><label>Стиль по умолчанию</label>
                                <select name="model_type">
                                    <option value="list" {if $settings->model_type|escape == 'list'}selected="select"{/if}>Списком (построчно)</option>
                                    <option value="box" {if $settings->model_type|escape == 'box'}selected="select"{/if}>Блоками</option>
                                </select>
                            </li>
                            <li>
                                <hr/>
                                <label>Отсутствующие товары</label>
                                <select name="products_end_list">
                                    <option value="" {if $settings->products_end_list|escape == ''}selected="select"{/if}>показывать все товары</option>
                                    <option value="in_stock" {if $settings->products_end_list|escape == 'in_stock'}selected="select"{/if}>НЕ показывать</option>
                                    <option value="end_list" {if $settings->products_end_list|escape == 'end_list'}selected="select"{/if}>показывать в конце списка</option>
                                </select>
                            </li>
                        </ul>

                        <h2>Настройки каталога</h2>
                        <ul>
                            <li><label>Товаров на странице сайта</label><input name="products_num" type="text" value="{$settings->products_num|escape}" /></li>
                            <li><label>Товаров на странице админки</label><input name="products_num_admin" type="text" value="{$settings->products_num_admin|escape}" /></li>
                            <li><label>Максимум товаров в заказе</label><input name="max_order_amount" type="text" value="{$settings->max_order_amount|escape}" /></li>
                        </ul>

                    </div>

                    <div class="block tab-pane" id="comments_settings">
                        <h2>Настройки комментирования</h2>
                        <ul>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_product" {if $settings->comment_product}checked{/if}>
                                    <span>Комментировать товары</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_article" {if $settings->comment_article}checked{/if}>
                                    <span>Комментировать материалы</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_not_register" {if $settings->comment_not_register}checked{/if}>
                                    <span>Разрешить комментирование незарегистрированным пользователям?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_notice" {if $settings->comment_notice}checked{/if}>
                                    <span>Уведомлять администратора о новых комментариях?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_moderate" {if $settings->comment_moderate}checked{/if}>
                                    <span>Модерировать комментарии перед публикацией?</span>
                                </label>
                            </li>
                            <li>
                                <label class="fancy-checkbox">
                                    <input type="checkbox" name="comment_moderate_valid" {if $settings->comment_moderate_valid}checked{/if}>
                                    <span>Модерировать комментарии от пользователей, чьи комментарии были ранее одобрены?</span>
                                </label>
                            </li>
                        </ul>
                    </div>


                    <div class="block tab-pane" id="formant_settings">
                        <h2>Форматы данных</h2>
                        <ul>
                            <li><label>Формат даты</label><input name="date_format" type="text" value="{$settings->date_format|escape}" /></li>
                            <li><label>Единицы измерения товаров</label><input name="units" type="text" value="{$settings->units|escape}" /></li>
                            <li><label>Разделитель копеек</label>
                                <select name="decimals_point">
                                    <option value='.' {if $settings->decimals_point == '.'}selected{/if}>точка: 12.45 {$currency->sign|escape}</option>
                                    <option value=',' {if $settings->decimals_point == ','}selected{/if}>запятая: 12,45 {$currency->sign|escape}</option>
                                </select>
                            </li>
                            <li><label>Разделитель тысяч</label>
                                <select name="thousands_separator">
                                    <option value='' {if $settings->thousands_separator == ''}selected{/if}>без разделителя: 1245678 {$currency->sign|escape}</option>
                                    <option value=' ' {if $settings->thousands_separator == ' '}selected{/if}>пробел: 1 245 678 {$currency->sign|escape}</option>
                                    <option value=',' {if $settings->thousands_separator == ','}selected{/if}>запятая: 1,245,678 {$currency->sign|escape}</option>
                                </select>
                            </li>
                        </ul>
                    </div>

                    <div class="block tab-pane" id="postiezvonki_settings">
                        <h2>Интеграция с <a href="http://prostiezvonki.ru">простыми звонками</a></h2>
                        <ul>
                            <li><label>Сервер</label><input name="pz_server" type="text" value="{$settings->pz_server|escape}" /></li>
                            <li><label>Пароль</label><input name="pz_password" type="text" value="{$settings->pz_password|escape}" /></li>
                        </ul>

                        <h3>Телефоны менеджеров:</h3>
                        <ul>
                            {foreach $managers as $manager}
                                <li><label>{$manager->login}</label><input name="pz_phones[{$manager->login}]" type="text" value="{$settings->pz_phones[$manager->login]|escape}" /></li>
                            {/foreach}
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>

</form>