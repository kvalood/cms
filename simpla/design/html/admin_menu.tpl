<ul class="list_menu">
    <li class="item__menu{if $module=='products' OR $module=='categories' OR $module=='brands'  OR $module=='features'} active{/if}">
        <div class="menu-item__title">Каталог товаров</div>
        <ul>           
            <li><a href="index.php?module=ProductsAdmin">Товары</a></li>
            <li><a href="index.php?module=FeaturesAdmin">Свойства товаров</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CategoriesAdmin">Категории товаров</a></li>        
            <li><a href="index.php?module=BrandsAdmin">Бренды</a></li>        

        </ul>
    </li>

    <li class="item__menu{if $module=='orders' OR $module=='labels'} active{/if}">
        <div class="menu-item__title">Заказы</div>
        <ul>
            <li><a href="index.php?module=OrdersAdmin">Новые заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=1">Принятые заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=2">Выполненные заказы</a></li>
            <li><a href="index.php?module=OrdersAdmin&status=3">Удаленные заказы</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=OrdersLabelsAdmin">Метки заказов</a></li>
        </ul>
    </li>

    <li class="item__menu{if $module=='article' OR $module == 'articlecat' OR $module == 'slides' OR $module == 'tags'} active{/if}">
        <div class="menu-item__title">Страницы</div>
        <ul>
            <li><a href="index.php?module=ArticleAdmin">Создать страницу</a></li>
            <li><a href="index.php?module=ArticleAdmin">Список страниц</a></li>
            <li class="separator"></li>
            <li><a href="{url module=ArticleAdmin method=category}">Создать категорию</a></li>
            <li><a href="{url module=ArticleAdmin method=categories}">Список категорий</a></li>

        </ul>
    </li>

    <li class="item__menu{if $module=='menu'} active{/if}">
        <div class="menu-item__title">Модули</div>
        <ul>
            <li><a href="index.php?module=MenuAdmin">Меню сайта</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=BannerAdmin">Баннеры/Слайдеры</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CommentsAdmin">Комментарии {if $new_comments_counter}<i>{$new_comments_counter}</i>{/if}</a></li>
            <li><a href="index.php?module=FeedbackAdmin">Обратная связь {if $new_feedback_counter}<i>{$new_feedback_counter}</i>{/if}</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=ImportAdmin">Импорт товаров *.csv</a></li>
            <li><a href="{url module=ExportAdmin}">Экспорт товаров</a></li>
            <li><a href="{url module=BackupAdmin}">Бекап товаров</a></li>
            <li class="separator"></li>
            <li><a href="index.php?module=CouponsAdmin">Промо-коды</a></li>
        </ul>
    </li>

    <li class="item__menu{if $module=='stats'} active{/if}">
        <div class="menu-item__title">Статистика</div>
        <ul>
            <li><a href="index.php?module=ReportStatsAdmin">Отчет по заказам</a></li>
            <li><a href="index.php?module=StatsAdmin">Статистика</a></li>
        </ul>
    </li>

    <li class="item__menu{if $module=='groups' OR $module=='users'} active{/if}">
        <div class="menu-item__title">Пользователи</div>
        <ul>
            <li><a href="{url module=UsersAdmin}">Пользователи</a></li>
            <li><a href="{url module=GroupsAdmin}">Группы покупателей</a></li>
            <li><a href="{url module=ExportUsersAdmin}">Экспорт пользователей</a></li>
        </ul>
    </li>

    <li class="item__menu{if $module=='settings' OR $module == 'design' OR $module == 'currency' OR $module == 'delivery' OR $module == 'payment' OR $module == 'managers'} active{/if}">
        <div class="menu-item__title">Настройки сайта</div>

        <ul>
            <li><a href="{url module=SettingsAdmin}">Общие настройки</a></li>
            <li><a href="{url module=ThemeAdmin}">Дизайн</a></li>
            <li class="separator"></li>
            <li><a href="{url module=CurrencyAdmin}">Валюты сайта</a></li>
            <li><a href="{url module=DeliveriesAdmin}">Способы доставки</a></li>
            <li><a href="{url module=PaymentMethodsAdmin}">Способы оплаты</a></li>
            <li class="separator"></li>
            <li><a href="{url module=ManagersAdmin}">Менеджеры</a></li>
        </ul>
    </li>
</ul>