$(function(){

    /**
     * Всплывающая форма отправки сообщений
     */
	$(document).on('click', '.feed_back_link', function(){
		feedback_show_hide($(this).attr('data-fb-id'));
		
		//Если форма "Купить в 1 клик"
		if($(this).attr('data-fb-product-id'))
		{
			$("input[name='product_id']").attr('value',$(this).attr('data-fb-product-id'));
		}
	});
	
	// Закрываем форму
	$(document).on('click', '.feed_back_close, .modal_background', function(){
		feedback_show_hide();
	});
	
	// esc, тоже закрываем
	$(document).keyup(function(e) {
		if(e.keyCode == 27 && $('.modal_background').length > 0){ feedback_show_hide(); }
	});

	
	// Функция открытия и закрытия формы обратной сявзи + модального фона (черный)
	function feedback_show_hide(object)
	{
		object = object || 0;
		var form   = $('.feed_back_poup');
		
		if($('.modal_background').length > 0)
		{
			$('.modal_background').animate({"opacity": "toggle"}, 250);
			setTimeout(function(){$('.modal_background').remove()},250);			
		}
		else
		{
			$('body').append('<div class="modal_background"></div>');
			$('.modal_background').animate({"opacity": "toggle"}, 250);
		}
		
		if(object == 0)
		{
			$(form).fadeOut(250);
		}
		else
		{
			var obj = $('#'+object);
				height = $(obj).height(),
				width  = $(obj).width();
				
			$(obj).css({'margin-top': -height/2, 'margin-left': -width/2}).animate({"opacity": "toggle"}, 250);
		}
	}

	// Обрабатываем форму отправки сообщения.
	$(".feed_back_poup input[type='submit']").click(function(){
		feedback_process($(this).closest('.feed_back_poup').attr("id"));
		return false;
	});
	
	
	// Функция отправки формы
	function feedback_process(id_form)
	{
		var poup   = '#'+id_form,		
			form   = $(poup).find('form'),
			str    = $(form).serialize();
			
		//Вырубаем форму
		$(form).append('<div id="spiner_modal"><div id="spin"></div></div>');
		var opts = {lines: 9,length: 0,width: 8,radius: 16,corners: 1,rotate: 0,direction: 1,color: '#000',speed: 0.9,trail: 100,shadow: false,hwaccel: false,className: 'spinner',zIndex: 2e9,top: '50%',left: '50%'};
		var target = $('#spin');
		var spinner = new Spinner(opts).spin(target);
		target.append(spinner.el);
		
		$.ajax({
			type: "POST",
			url: "/ajax/feed_back_form.php",
			data: str,
			success: function(msg){
				eval(msg);
				
				//Врубаем форму
				$(poup).find('#spiner_modal').remove();
				
				if(data.result === 'send')
				{
					show_modal_message(data.message,'message',4000,'');
					$(form).find("input[type='text']").val('');
					$(form).find("textarea").val('');	
					feedback_show_hide();
				}
				else
				{
					show_modal_message(data.message,'error',4000,'');
				}
			}
		});
	}

    /***
     * Метод отображения товаров, кубиками или списком.
     */
	$('.show_type  > div').click(function(){
		var model_type = $(this).attr('id');
		$('.product_id').attr('id',model_type);
		$.ajax({
			type: "POST",
			url: "/ajax/session.php",
			data: {model_type : model_type}			
		});
	});


    /***
     *  Комментарии к товарам и статьям
     */
	$(document).on('click', 'a[href*=#].reply_button', function(e){
		//Листаем к форме
		var anchor = $(this);
		$('html, body').stop().animate({
			scrollTop: $(anchor.attr('href')).offset().top
		}, 850);
		e.preventDefault();
		
		//Добавляем данные
		var c_name = $(this).parent().find('.commentator_name').html();
		var c_parent_id = $(this).attr('data-comment-id');
		
		$('#reply_comment').val(c_parent_id);
		$('.retly_for_name').html('Ответить на комментарий: '+c_name);
		$('.delete_retly_for').css('display','inline-block');
	});

	//Удалить ответ на комментарий.
	$(document).on('click', '.delete_retly_for', function(){
		$('#reply_comment').attr('value', '');
		$('.retly_for_name').html('');
		$('.delete_retly_for').css('display','none');
	});


    /***
     * Лайк к товарам в категории товаров и карточке товара
     */
    $(document).on('click', '.like_button:not(.like_on), .like_button_min:not(.like_on)', function() {
        //$(this).addClass('like_on');
        var this_button = $(this);
        $.ajax({
            url: "ajax/like_product.php",
            data: {product_id: this_button.attr('data-id')},
            success: function(data){
                if(data == 'done')
                {
                    show_modal_message('Вы уже голосовали за этот товар!', 'notice', 5000, 'bottom-right');
                }
                else
                {
                    this_button.find('.like_counter').html(data);
                }
            }
        });
    });

});