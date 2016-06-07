//Текущий товар
$(document).on('click', '.more_product', function(){
	action_poup('open');
	get_product($(this).attr('data-product-more'));
});

//Следующий товар AND предыдущий товар
$(document).on('click', '.prev_product, .next_product', function() {
	get_product($(this).attr('data-product-more'));
});

//Получим товар + 
function get_product(id){

	var poup_window = $('.poup-data'),
		spiner = $('#spiner_modal');
	poup_window.css('visibility','hidden');

	spiner.css('visibility','visible');
	poup_window.html('').append('<div class="poup-close"></div>');
	
	$.ajax({
		url: "ajax/poup_product.php",
		data: {product_id: id},
		success: function(data){
			$('.poup-data').append(data);
			setTimeout(function() {
		
				var poup_background = $('.poup-background'),
					width = poup_window.width(),
					height = poup_window.outerHeight(),
					window_width = $(window).width(),
					window_height = $(window).height();
				
				if(height < window_height)
				{	
					poup_window.css({'top':'50%','margin-top':-height/2});
					poup_background.css('height',window_height);
				}
				else
				{
					poup_background.css('height',height+100);
				}

				poup_window.css('visibility','visible');
				spiner.css('visibility','hidden');
			}, 150);
		}
	});
}

//Проверяем изменения окна (что бы двигать поуп)
$(window).resize(function() {
	var poup_background = $('.poup-background'),
		poup_window = $('.poup-data');
		width = poup_window.width(),
		height = poup_window.outerHeight(),
		window_width = $(window).width(),
		window_height = $(window).height();
	
	if(height < window_height)
	{	
		poup_window.css({'top':'50%','margin-top':-height/2});
		poup_background.css('height',window_height);
	}
	else if(window_height < height+30)
	{
		poup_window.css({'top':'20px','margin-top':''});
	}
	else
	{
		poup_background.css('height',height+100);
	}
});

//Закрываем окно
$(document).on('click', '.poup-close, .poup-background', function() { action_poup();} );

//esc, тоже закрываем
$(document).keyup(function(event) { if (event.keyCode == 27) { action_poup(); } });

//Функция открывашка-закрывашка poup товара
function action_poup(method){
	method = method || 0;
	
	var top_scroll = window.pageYOffset;
	
	if(method == 'open')
	{
		$('body').css('margin-top',-top_scroll);
		
		$('body').addClass('fix_b').append('<div class="more-poup"><div class="poup-background"></div><div class="poup-data"></div><div id="spiner_modal"></div></div>');
		$('.more-poup').animate({opacity:"toggle"}, 250).css('overflow-y', 'scroll');
		
		var opts = {lines: 9,length: 0,width: 8,radius: 16,corners: 1,rotate: 0,direction: 1,color: '#000',speed: 0.9,trail: 100,shadow: false,hwaccel: false,className: 'spinner',zIndex: 2e9,top: '50%',left: '50%'};

		var target = $('#spiner_modal');
		var spinner = new Spinner(opts).spin(target);
		target.append(spinner.el);
	}
	else
	{
		var scroll_t = $('body').css("margin-top").replace('-', '');
		$('body').css('margin-top',0).removeClass('fix_b');
		$('.more-poup').remove();
		$('html,body').animate({scrollTop:scroll_t}, 0);
	}
}