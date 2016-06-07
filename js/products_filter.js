$(function() {
    //создаем слайдеры-диапазоны
    $(document).ready(function()
    {
        var slides_filter = $('.slide_filter');

        if(slides_filter.length > 0) {
            for (var i = 1; i <= $('.slide_filter').length; i++) {
                var id = $('.slide_filter').eq(i-1).attr('id');
                create_slide(id);
            }
        }
    });

    // Создаем слайды.
    function create_slide(id) {
        var     obj         = $('#'+id),
            slider      = obj.find('#slider'),
            min_obj     = obj.find('#min'),
            max_obj     = obj.find('#max'),
            min         = min_obj.attr('data-min'),
            max         = max_obj.attr('data-max'),
            c_min       = parseFloat(min_obj.val()),
            c_max       = parseFloat(max_obj.val()),
            step        = 1;


        if(min.indexOf(".") != -1 || (max.indexOf(".") != -1)){
            step = 0.01;
        }

        $(slider).slider({
            range: true,
            min: parseFloat(min),
            max: parseFloat(max),
            step: step,
            values: [ c_min, c_max ],
            stop: function(event, ui) {
                get_data();
            },
            slide: function( event, ui ) {
                $(min_obj).val(ui.values[0]);
                $(max_obj).val(ui.values[1]);
            }
        });
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


    // Функция сбора данных с формы фильтра. + отдача данных на сайт.
    function get_data(element)
    {
        var products_list = $('#products_list');


        // Создаем спинер, (во время загрузки данных фильтра, показывать процесс)
        if(products_list.find('#spiner').length)
        {
            target.css('visibility','visible');
        }
        else
        {
            products_list.append('<div id="spiner"></div>');
            var opts = {lines: 9,length: 0,width: 8,radius: 16,corners: 1,rotate: 0,direction: 1,color: '#000',speed: 0.9,trail: 100,shadow: false,hwaccel: false,className: 'spinner',zIndex: 2e9,top: '50%',left: '50%'};
            var target = products_list.find('#spiner');
            var spinner = new Spinner(opts).spin(target);
            target.append(spinner.el);
            target.css('visibility','visible');
        }

        var arr = {};

        // Перебираем слайдеры
        for (var i = 1; i <= $('.slide_filter').length; i++) {
            var data = {};
            var id = $('.slide_filter').eq(i-1).attr('id'),
                cat_min = $('#'+id).find('#min').attr('data-min'),
                cat_max = $('#'+id).find('#max').attr('data-max'),
                c_min = $('#'+id).find('#min').val(),
                c_max = $('#'+id).find('#max').val();

            if((c_min != '' && c_min > cat_min) || (c_max != '' && c_max < cat_max))
            {
                data['min'] =  c_min;
                data['max'] =  c_max;
                arr[id] = data;
            }
        }

        // Перебираем чекбоксы
        var values = {};
        for (var i = 1; i <= $('.check_data:checked').length; i++) {

            var obj  = $('.check_data:checked').eq(i-1);
            var name = $(obj).attr('name');
            var option_id = name.split('[')[0];
            var value = name.split('[')[1].split(']')[0];

            if(arr[option_id]) {
                arr[option_id] += ',' + value;
            }
            else {
                arr[option_id] = value;
            }
        }
		
		console.log(arr);


        // Запрашиваем данные.
        $.ajax({
            url: "/ajax/products_filter.php",
            dataType: 'json',
            data: {'filter': arr, 'category':$('form[data-category]').attr('data-category')},
            success: function(data){

                console.log(data.dump);
                console.log(data);

                // Показываем количество найденых товаров.
                $('.filter_search_count').remove();
                var mes = '<div class="filter_search_count" style="top:'+((element.offset().top - element.closest('.features_id').offset().top) + element.outerHeight()/2)+'px">'+data.count+' '+declOfNum(data.count, ['товар', 'товара', 'товаров'])+'</div>';

                element.closest('.features_id').append(mes);

                var obj = $('.filter_search_count');

                if(obj.length > 0)
                    setTimeout(function(){obj.remove();}, 3000);


                // Отсекаем в фильтре ненужные атрибуты.
                // Перебираем группы свойств.
                for (var key in data.cl) {

                    var available_options = data.cl[key];

                    // Перебираем свойства
                    for (var k in available_options) {
                        // console.log($('input[name="'+key+'['+k+']'+'"]'));
                        //console.log(available_options[k]);
                    }

                    //console.log(key+' '+data.cl[key]);

                    // Тут будем перебирать все инпуты,


                }

                // а потом еще получим максимальное минимальную цену



                // Меняем УРЛ
                history.pushState(null, null, location.pathname+data.filter);
                //history.replaceState(null, null, location.pathname+data.filter);

                products_list.html(data.page);
                target.css('visibility','hidden');
            }
        });
    }


    // Сбросить фильтр
    $(document).on('click', '#reset_filter', function(){
        // Сбросим все чекбоксы
        $(".check_data:checked").removeAttr('checked');


        $('.features_id').find('#min').val();
        $('.features_id').find('#max').val();

        get_data($(this));
        return false;
    });

    // Скроем откроем закрытый фильтр
    $(document).on('click', '.f_name', function(){
        var obj = $(this).closest('.features_id'),
            method = obj.attr('class').split(' ')[2];

        switch(method)
        {
            case 'show':
                obj.removeClass('show').addClass('hide');
                break;

            case 'hide':
                obj.removeClass('hide').addClass('show');
                break;
        }
    });

    // Склонение численных
    function declOfNum(number, titles) {
        cases = [2, 0, 1, 1, 1, 2];
        return titles[ (number%100>4 && number%100<20)? 2 : cases[(number%10<5)?number%10:5] ];
    }
});