// original - https://github.com/jquery/jquery-ui/blob/master/ui/widgets/slider.js
// demo - https://jsfiddle.net/C6u3J/99/
// Immediate function that creates a scope for our widget
// declaration.
(function( $ ) {

    // The slider events we want to hijack and extend.
    var events = [ "create", "start", "stop", "slide", "change" ];

    // Start our slider widget extension.
    $.widget( "app.slider", $.ui.slider, {

        // This method gives the "create" event data. We need the "value"
        // property here, which doesn't exist by default.
        _getCreateEventData: function() {
            return { value: this.value() };
        },

        // It's important to call _init() here instead of _create() since
        // we're setting an option value. The "max" option should be the
        // length of the "steps" array if it exists.
        _init: function() {
            var steps = this.options.steps;
            if ( $.isArray( steps ) ) {
                this.option( "max", steps.length - 1 );
            }
        },

        _trigger: function( name, e, ui ) {

            // The steps value array we want passed in the slider
            // event data.
            var steps = this.options.steps;

            // If there's no "steps" option, do the default action.
            if ( !$.isArray( steps ) ) {
                return this._superApply( arguments );
            }

            // Is this an event we're interested in? Check the "events" array.
            if ( $.inArray( name, events ) >= 0 ) {

                // Call the default _trigger() implementation, using custom
                // data. Specifically, the step value from the array.
                return this._superApply([
                    name,
                    e,
                    $.extend( ui, {
                        stepValue: steps[ ui.value ]
                    })
                ]);
            }

            return this._superApply( arguments );
        }
    });
})( jQuery );

/**
 * При нажатии вперед/назад в браузере, будем переходить на эту страницу.
 */
window.addEventListener('popstate', function(e) {
    window.location = document.location;
});

$(function() {

    var products_list       = $("#products_list"), // Список товаров
        product_filter      = $("#product_filter"), // Блок с фильтром
        pagination          = $("#pagination"), // Блок с пагинацией
        page_pagination     = '', // Страница пагинации
        pagination_more     = '', // если нажали на кнопку "показать еще" в пагинации
        slides_filter       = $('.slide_filter'), // Фильтр - слайдер диапазон
        feature_id          = '.features_id', // Конкретное свойство по которому будет фильтрация
        loader_filter       = $('<div class="loader"></div>'), // Спинер
        filter_sort         = ''; // Сортировка


    /**
     * создаем слайдеры-диапазоны
     */
    $(document).ready(function() {
        if(slides_filter.length > 0) {
            for (var i = 1; i <= slides_filter.length; i++) {
                create_slide(slides_filter[i-1]);
            }
        }
    });

    /**
     * Функция для получения данных о слайдере
     * @param object
     * @return object {
     *      min - string
     *      max - string
     * }
     */
    function get_slider_range_data(object) {
        var sd = {};
        sd.obj          = $(object);
        sd.slider       = sd.obj.find('.slider-range');
        sd.min_obj      = sd.obj.find('input[name$="[min]"]');
        sd.max_obj      = sd.obj.find('input[name$="[max]"]');
        sd.el_name      = sd.max_obj.attr('name').split('[max')[0];
        sd.min          = sd.min_obj.attr('data-min');
        sd.max          = sd.max_obj.attr('data-max');
        sd.c_min        = parseFloat(sd.min_obj.val());
        sd.c_max        = parseFloat(sd.max_obj.val());
        sd.step_values  = sd.obj.attr('data-step-values');

        return sd;
    }

    /**
     * Создаем слайдер-диапазон
     * @param el - query element
     */
    function create_slide(el) {

        var slider_data = get_slider_range_data(el),
            step_values = slider_data.step_values;

        step_values = $.map(step_values.split(','), function(value){
            return parseFloat(value);
        });

        $(slider_data.slider).slider({
            range: true,
            /*
            min: parseFloat(slider_data.min),
            max: parseFloat(slider_data.max),
            step: (slider_data.min.indexOf(".") != -1 || (slider_data.max.indexOf(".") != -1)) ? 0.01 : 1,
            values: [ slider_data.c_min, slider_data.c_max ],
            */
            steps: step_values,
            values: [ step_values.indexOf(slider_data.c_min), step_values.indexOf(slider_data.c_max) ],
            stop: function(event, ui) {
                get_data(slider_data.obj);
            },
            slide: function( event, ui ) {
                /*
                $(slider_data.min_obj).val(ui.values[0]);
                $(slider_data.max_obj).val(sui.values[1]);
                */
                $(slider_data.min_obj).val(step_values[ui.values[0]]);
                $(slider_data.max_obj).val(step_values[ui.values[1]]);
            }
        });
    }

    /**
     * Запуск фильтрации
      */
    // Запускаем фильтр при ползунках и смене чекбоксов.
    $(document).on('click', '.check_data', function(){
        get_data($(this));
    });

    $(document).on('click', 'input[name="filter"]', function(){
        get_data($(this));
        return false;
    });

    // Запускаем фильтр если изменился инпут
    $(document).on('change', 'input[name$="[min]"], input[name$="[max]"]', function(){
        var slider_data = get_slider_range_data($(this).closest(slides_filter));
        slider_data.slider.slider('option', 'values', [slider_data.c_min, slider_data.c_max]);
        get_data($(this));
    });


    /**
     * Функция сбора данных с формы фильтра. + отдача данных на сайт.
     * @param element
     */
    function get_data(element) {

        // Создаем спинер, (во время загрузки данных фильтра, показывать процесс)
        products_list.append(loader_filter);

        var arr = {};

        // Перебираем слайдеры
        for (var i = 1; i <= slides_filter.length; i++) {
            var slider_data = get_slider_range_data(slides_filter[i-1]);
            if((slider_data.c_min && slider_data.c_min > slider_data.min) || (slider_data.c_max && slider_data.c_max < slider_data.max)) {
                arr[slider_data.el_name] = slider_data.c_min + '-' + slider_data.c_max;
            }
        }

        // Перебираем чекбоксы
        if($('.check_data:checked').length) {
            for (var i = 1; i <= $('.check_data:checked').length; i++) {
                var obj = $('.check_data:checked').eq(i-1),
                    option_id  = $(obj).attr('name').split('[')[0],
                    value = obj.val();

                if(arr[option_id])
                    arr[option_id] += ',' + value;
                else
                    arr[option_id] = value;
            }
        }

        // Пагинация
        if(page_pagination) {
            arr.page = page_pagination;
            page_pagination = '';
        }

        // Сортировка
        if(filter_sort) {
            arr.sort = filter_sort;
            filter_sort = ''
        }

        // Запрашиваем данные.
        $.ajax({
            url: product_filter.find('form').attr('action'),
            data: arr,
            success: function(filter_data){

                var data = JSON.parse(filter_data);

                // Показываем количество найденых товаров.
                var filter_search_count = $('.filter_search_count');
                filter_search_count.remove();
                var mes = '<div class="filter_search_count">' + declOfNum(parseFloat(data.count), ['Найден', 'Найдено', 'Найдено']) + ' ' + data.count+' '+declOfNum(data.count, ['товар', 'товара', 'товаров'])+'</div>';

                if(data.url && element)
                    element.closest(feature_id).append(mes);

                if(filter_search_count.length > 0)
                    setTimeout(function(){filter_search_count.remove();}, 3000);


                /**
                 * Перебираем свойства, включаем доступыне, выключаем недоступные для фильтрации
                 */
                for (var key in data.available_options) {

                    var options = data.available_options[key];

                    for (var option_id in options) {
                        if(options[option_id] === false) {
                            $('#' + key + '_' + option_id).attr('disabled', 'disabled')
                        } else {
                            $('#' + key + '_' + option_id).removeAttr('disabled')
                        }
                    }
                }

                // Меняем УРЛ
                history.pushState(null, null, location.pathname + '?' + data.url);

                // Прокручиваем ввверх списка с товарами
                if(arr.page && !pagination_more)
                    $('html, body').animate({scrollTop: products_list.offset().top - 100},250);

                // Если кнопка "показать еще", добавляем
                if(pagination_more) {
                    products_list.append(data.product_list);
                    pagination_more = 0;
                } else {
                    products_list.html(data.product_list);
                }

                pagination.html(data.pagination);

                // remove loader spiner
                $(loader_filter).remove();
            }
        });
    }

    /**
     * Сбросить фильтр
     */
    $(document).on('click', '#reset_filter', function(){
        // Сбросим все чекбоксы
        $(".check_data:checked").removeAttr('checked');

        // Сбросим все слайдеры-диапазоны
        $(feature_id).find('input[name$="[min]"]').val();
        $(feature_id).find('input[name$="[max]"]').val();

        get_data($(this));
        return false;
    });

    // Скроем откроем закрытый фильтр
    $(document).on('click', '.f_name', function(){
        $(this).parent().toggleClass('сollapsed');
    });

    // Axaj пагинация
    $(document).on('click', '.pagination a', function(e){
        e.preventDefault();
        page_pagination = $(this).attr('data-page');
        if($(this).is('#pagination_more')) {
            pagination_more = 1;
        }
        get_data();
    });

    /**
     * Axaj sorting
      */
    // for link
    $(document).on('click change', '[data-filter-sort]', function(e){

        var data_toggle = $(this).attr('data-filter-toggle'),
            data_sort   = $(this).val() ? $(this).val() : $(this).attr('data-filter-sort');

        filter_sort = data_sort;

        $('[data-filter-sort-this]').removeAttr('data-filter-sort-this');
        $(this).attr('data-filter-sort-this', '');

        if(data_toggle) {
            $(this).attr({
                'data-filter-toggle': filter_sort,
                'data-filter-sort': data_toggle
            });
        }

        get_data();
    });


    // Склонение численных
    function declOfNum(number, titles) {
        cases = [2, 0, 1, 1, 1, 2];
        return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
    }
});