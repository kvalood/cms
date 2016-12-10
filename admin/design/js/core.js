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


    /**
     * Форматы времени и даты
     */
    $('input[name="date"]').datetimepicker({
        format:'d.m.Y H:i',
        lang:'ru',
        step: 10
    });


    /**
     * Стилизуем селекты
     */
    $('.selectpicker, .content select').selectpicker();
    $('select[name="home_page"]')
        .selectpicker({
            liveSearch: true
        })
        .ajaxSelectPicker({
            ajax: {
                type: 'GET',
                url: '/admin/ajax/search.php',
                data: function () {
                    var params = {
                        query: '{{{q}}}',
                        object: 'articles'
                    };
                    return params;
                }
            },
            preprocessData: function(data){
                console.log(data);
                var articles = [];
                if(data.suggestions) {
                    for (var i in data.suggestions) {
                        var item = data.suggestions[i];
                        articles.push(
                            {
                                'value': item.data.id,
                                'text': item.value,
                                'disabled': item.data.visible ? false : true
                            }
                        );
                    }
                }
                return articles;
            }
        });


    /**
     * Подтверждение удаления
     */
    $(document).on('click', 'input[name="remove"]', function(){
        if(!confirm('Подтвердите удаление'))
            return false;
    });

    // Подтверждение удаления в списке
    $("form").submit(function() {
        if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
            return false;
    });

    // Удалить
    $("a.delete").click(function() {
        $('#list input[type="checkbox"][name*="check"]').attr('checked', false);
        $(this).closest(".article_id").find('input[type="checkbox"][name*="check"]').attr('checked', true);
        $(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
        $(this).closest("form").submit();
    });

    /**
     * Выделить все
     */
    $(document).on('click', '#check_all', function() {
        $(this).closest('form').find('input[type="checkbox"][name*="check"]').prop('checked', $(this).closest('form').find('input[type="checkbox"][name*="check"]:not(:checked)').length>0);
    });


    /**
     * Создание дополнительных полей siteinfo в разделе Настройки -> информация о сайте
     */
    $(document).on('click', '#create_siteinfo', function() {
        $('.siteinfo_field.hidden').clone(true).removeClass('hidden').appendTo($(this).parent().find('ul'));
    });



    /***
     * Обработка .control a. (включить выключить, добавить в фильтр/убрать из него.)
     */
    $('.control a:not(.preview)').click(function(){

        var icon            = $(this),
            row             = $(this).closest('.listItem'),
            id              = row.find('input[type="checkbox"][name*="check"]').val(),
            object_name     = $(this).closest('form').attr('data-object'),
            session_id      = $('input[name="session_id"]').val(),
            enable          = icon.hasClass('on')?0:1,
            data            = icon.attr('class').split(' ')[0],
            values = {};

        icon.addClass('loading_icon');
        values[data]    = enable;
        icon.hasClass('on') ? icon.removeClass('on') : icon.addClass('on');

        $.ajax({
            type: 'POST',
            url: '/admin/ajax/update_object.php',
            data: {'object': object_name, 'id': id, 'values': values, 'session_id': session_id},
            success: function(data){
                icon.removeClass('loading_icon');
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
    $(document).on('click', 'button[name="generate_url"]', function(){
        var url = generate_url($(this).closest('form').find('input[name="name"]').val());
        $(this).closest('form').find('input[name="url"]').val(url);

        return false;
    });

    function generate_url(data)
    {
        data = data.replace(/[\s]+/gi, '-');
        data = translit(data);
        data = data.replace(/[^0-9a-z_\-]+/gi, '').toLowerCase();
        return data;
    }

    // Генерация ключевых слов.
    $(document).on('click', 'button[name="generate_keywords"]', function(){

    });




    // Генерация meta description слов.
    $(document).on('click', 'button[name="generate_description"]', function(){
        descr = $('textarea[name="meta_description"]');
        descr.val(generate_meta_description());
        descr.scrollTop(descr.outerHeight());
    });

    function generate_meta_description()
    {
        if(typeof(tinyMCE.get("annotation")) =='object')
        {
            description = tinyMCE.get("annotation").getContent().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
            return description;
        }
        else
            return $('textarea[name=annotation]').val().replace(/(<([^>]+)>)/ig," ").replace(/(\&nbsp;)/ig," ").replace(/^\s+|\s+$/g, '').substr(0, 512);
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
     * выбор изображений в вариантах
     */
    var color_variant;

    $(document).on('click', '#variants_block a.add_color', function() {
        offset = $(this).offset();

        color_variant = $(this);

        $('#popup_images').html('');
        $('#column_right .images ul').clone().appendTo('#popup_images');
        $('#popup_images ul').append('<li class="empty"><input type="hidden" value="0"></li>');

        $('#popup_images li').each(function() {
            $(this).find('a').remove();
            if($(this).find('input[type=hidden]').val() == $(color_variant).closest('li').find('input[type=hidden]').val())
                $(this).addClass('active');
        });

        $('#popup_images').css('top', (offset.top+28)+'px').css('left', (offset.left+0) + 'px').toggle();
        return false;
    });

    $(document).on('click', '#popup_images li', function() {
        id = $(this).find('input').val();
        $(color_variant).closest('li').find('input[type=hidden]').val(id);
        if(id > 0) $(color_variant).closest('li').find('img').attr('src', 'design/images/picture.png');
        else $(color_variant).closest('li').find('img').attr('src', 'design/images/picture_empty.png');
        $('#popup_images').toggle();
    });
    function changeVarName(obj) {
        parent = $(obj).closest('ul');
        color = parent.find('.variant_color input').val();
        size = parent.find('.variant_size input').val();
        parent.find('.variant_name input').val(color + ' ' + size);
    }


    /***
     * Сортировка списка (исспользуется в любых списках)

        // Сортировка списка
    $("#sortable").sortable({
        items:             ".row",
        tolerance:         "pointer",

        scrollSensitivity: 40,
        opacity:           0.7,
        forcePlaceholderSize: true,
        axis: 'y',
        placeholder: "ui-state-highlight",

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

    $( "#sortable" ).disableSelection();
     */


});