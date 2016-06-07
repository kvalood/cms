$(function() {

    /**
     * Меню сайта
     */
    $(document).on('click', '.menu-item__title', function(){
        $('.item__menu.open').removeClass('open');
        $(this).parent().addClass('open');
    });

    $(document).click(function (e) {
        var element = $('.item__menu > ul');
        if (!element.is(e.target) && element.has(e.target).length === 0 && !$('.menu-item__title').is(e.target)) {
            element.parent().removeClass('open');
        }
    });


    /**
     * Горячие клавиши
     * Сохраняем при ctrl + S
     */
    $(window).keypress(function(e) {
        if (e.which == 115 && e.ctrlKey) {
            console.log(12);
            $("input[name=save]").closest('form').submit();

            e.preventDefault();
        }

        return true;
    });





    /***
     * Вызов помощи, (при нажатии на воросик), (исспользуется в capture name=option)
     */
	$(document).on('click', 'span#help i', function(){
		var obj = $(this).closest('span#help');
		if(obj.hasClass('on'))
		{
			obj.removeClass('on');
		}
		else
		{
			obj.addClass('on');
		}
	});


    /***
     * Фиксируем боковое меню, при прокрутке на десктопах.
     */
    if($(window).width() > 640 && $(window).height() > 600){
        $(document).scroll(function() {
            var menu = $('.root_menu');
            if ($(window).scrollTop() >= 60) {
                menu.addClass('scroll');
            }
            else if (menu.hasClass('scroll')) {
                menu.removeClass('scroll');
            }
        });
    }


    /***
     * Открыть меню, для мобильных телефонов
     */
    $(document).on('click', '.menu_mobile', function(){
        scrolls('open');
    });

    if($(window).width() <= 640) {
        $(window).on("swipeleft",function(){
            scrolls();
        });
    }

    function scrolls(method) {
        var top_scroll = window.pageYOffset;

        if (method == 'open') {
            $('.root_menu').addClass('open');
            $('body').addClass('fix_b');
            $('body').css('margin-top', -top_scroll).addClass('fix_b');
        }
        else {
            $('.root_menu').removeClass('open');
            $('body').removeClass('fix_b');
            var scroll_t = $('body').css("margin-top").replace('-', '');
            $('body').css('margin-top', 0).removeClass('fix_b');
            $('html,body').animate({scrollTop: scroll_t}, 0);
        }
    }





    /***
     * Обработка icons a. (включить выключить, добавить в фильтр/убрать из него.)
     */

    // Пометить обработанными (используется в FeedbackAdmin + Список пунктов меню +)
    $('.icons a').click(function(){
        var icon            = $(this),
            row             = $(this).closest('.row'),
            id              = row.find('input[type="checkbox"][name*="check"]').val(),
            visible          = row.attr("data-visible"),
            object_name     = $('#list_form').attr('data-object'),
            session_id      = $('input[name="session_id"]').val();

        icon.addClass('loading_icon');
        visible==1?visible=0:visible=1;
        row.attr("data-visible",visible);

        var values = {};

        switch (icon.attr('class').split(' ')[0]) {
            case 'enable':
                values['visible'] = visible;
                break
            case 'in_filter':
                values['in_filter'] = visible;
                break
        }

        $.ajax({
            type: 'POST',
            url: '/admin/ajax/update_object.php',
            data: {'object': object_name, 'id': id, 'values': values, 'session_id': session_id},
            success: function(data){
                icon.removeClass('loading_icon');
                show_modal_message('Изменено','message',3000,'bottom-right');
            },
            dataType: 'json'
        });
        return false;
    });


    // Удалить (используется в FeedbackAdmin, MenuAdmin(Удаление пункта меню))
    $('.icons .delete').click(function() {
        if(confirm('Подтвердите удаление')){
            var row = $(this).closest('.row'),
                id = row.find('input[type="checkbox"][name*="check"]').val(),
                object_name = $('#list_form').attr('data-object'),
                session_id = $('input[name="session_id"]').val();

            row.remove();

            $.ajax({
                type: 'POST',
                url: '/admin/ajax/delete_object.php',
                data: {'object': object_name, 'id': id, 'session_id': session_id},
                success: function(data){
                    show_modal_message('Удалено','message',3000,'bottom-right');
                },
                dataType: 'json'
            });
            return false;
        }
    });


    /***
     * Поиск
     * Перебор AJAX поисковых строк.
     * обязательные параметры у поисковой строки id=search_autocomplete + data-object(передается в search.php)
     */
    elements_autocomplete = $("input#search_autocomplete");
    for(var i = 0; i <= elements_autocomplete.length-1; i++)
    {
        var obj = $(elements_autocomplete[i]).attr('data-object');
        $(elements_autocomplete[i]).autocomplete({
            serviceUrl:'/admin/ajax/search.php',
            params: {'object': obj},
            minChars:0,
            noCache: false,
            onSelect:
                function(suggestion){
                    $('input[name="id_show"]').val(suggestion.data.id);
                }
        });
    }


    /***
     * Работа с мета тегами (автозаполнение УРЛ, мета ключей/тайтла/описания


    //Генерация УРЛ
    $('input[name="name"]').keyup(function() {
        $('input[name="url"]').val(generate_url());
    });
     */

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


    /***
     * datepicker
     * datetimepicker

    $('input[name="date"]').datepicker({
        regional:'ru'
    });
    */
    var dates_timepicer = $('input[name="date"][data-datetime]');
    for(var i = 0; i <= dates_timepicer.length-1; i++)
    {
        var timepicer = $(dates_timepicer[i]).attr('data-datetime');
        $(dates_timepicer[i]).datetimepicker({
            value: timepicer
        });
    }



    /***
     * Сортировка списка (исспользуется в любых списках)
     */
        // Сортировка списка
    $("#list").sortable({
        items:             ".row",
        tolerance:         "pointer",
        handle:            ".move_zone",
        scrollSensitivity: 40,
        opacity:           0.7,
        forcePlaceholderSize: true,
        axis: 'y',

        helper: function(event, ui){
            if($('input[type="checkbox"][name*="check"]:checked').size()<1) return ui;
            var helper = $('<div/>');
            $('input[type="checkbox"][name*="check"]:checked').each(function(){
                var item = $(this).closest('.row');
                helper.height(helper.height()+item.innerHeight());
                if(item[0]!=ui[0]) {
                    helper.append(item.clone());
                    $(this).closest('.row').remove();
                }
                else {
                    helper.append(ui.clone());
                    item.find('input[type="checkbox"][name*="check"]').attr('checked', false);
                }
            });
            return helper;
        },
        start: function(event, ui) {
            if(ui.helper.children('.row').size()>0)
                $('.ui-sortable-placeholder').height(ui.helper.height());
        },
        beforeStop:function(event, ui){
            if(ui.helper.children('.row').size()>0){
                ui.helper.children('.row').each(function(){
                    $(this).insertBefore(ui.item);
                });
                ui.item.remove();
            }
        },
        update:function(event, ui)
        {
            $("#list_form input[name*='check']").attr('checked', false);
			$("#list_form").ajaxSubmit();
        }
    });



});