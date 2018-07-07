$(function() {

    var products_list   = $("#products_list"), // Список товаров
        product_filter  = $("#product_filter"), // Блок с фильтром
        slides_filter   = $('.slide_filter'), // Фильтр - слайдер диапазон
        feature_id      = '.features_id', // Конкретное свойство по которому будет фильтрация
        loader_filter   = '<div class="loader"></div>', // Спинер
        page_pagination = product_filter.find("input[name='page']"); // Страница пагинации

    //создаем слайдеры-диапазоны
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
     */
    function get_slider_range_data(object) {
        var sd = {};
            sd.obj     = $(object);
            sd.slider  = sd.obj.find('.slider-range');
            sd.min_obj = sd.obj.find('input[name$="[min]"]');
            sd.max_obj = sd.obj.find('input[name$="[max]"]');
            sd.el_name = sd.max_obj.attr('name').split('[max')[0];
            sd.min     = sd.min_obj.attr('data-min');
            sd.max     = sd.max_obj.attr('data-max');
            sd.c_min   = parseFloat(sd.min_obj.val());
            sd.c_max   = parseFloat(sd.max_obj.val());

        return sd;
    }

    /**
     * Создаем слайдер-диапазон
     * @param el - query element
     */
    function create_slide(el) {

        var slider_data = get_slider_range_data(el);

        $(slider_data.slider).slider({
            range: true,
            min: parseFloat(slider_data.min),
            max: parseFloat(slider_data.max),
            step: (slider_data.min.indexOf(".") != -1 || (slider_data.max.indexOf(".") != -1)) ? 0.01 : 1,
            values: [ slider_data.c_min, slider_data.c_max ],
            stop: function(event, ui) {
                get_data(slider_data.obj);
            },
            slide: function( event, ui ) {
                $(slider_data.min_obj).val(ui.values[0]);
                $(slider_data.max_obj).val(ui.values[1]);
            }
        });
    }

    /**
     * Сбросить номер страницы
     */
    function reset_page() {

    }

    // Запускаем фильтр при ползунках и смене чекбоксов.
    $(document).on('click', '.check_data', function(){
        get_data($(this));
    });

    $(document).on('click', 'input[name="filter"]', function(){
        get_data($(this));
        return false;
    });

    // Запускаем фильтр если изменился инпут
    $(document).on('change', '.slide_filter input[type="text"]', function(){
        var obj = $(this),
            parent = obj.closest('.slide_filter'),
            min = parent.find('#min').val(),
            max = parent.find('#max').val();

        $(this).closest('.slide_filter').find('#slider').slider('option', 'values', [min, max]);
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

        console.log(page_pagination.val());

        if(page_pagination.val()) {
            arr.page = page_pagination.val();
            page_pagination.val('');
        }

        console.log(arr);

        // Запрашиваем данные.
        $.ajax({
            url: product_filter.find('form').attr('action'),
            data: arr,
            success: function(filter_data){

                var data = JSON.parse(filter_data);


                console.warn(data);
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
                //history.replaceState(null, null, location.pathname+data.url);

                products_list.html(data.product_list);
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
        $('html, body').animate({scrollTop: products_list.offset().top - 100},250);
        page_pagination.val($(this).attr('data-page'));
        get_data();
    });

    // Склонение численных
    function declOfNum(number, titles) {
        cases = [2, 0, 1, 1, 1, 2];
        return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
    }
});