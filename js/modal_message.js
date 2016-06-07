//Добавление обязательного блока, для отображения всплывающих сообщений.
$(function(){
	$(document).ready(function(){
		$('body').append('<div class="modal_message"></div>');
	});
});

//Отображение всплывающего окна
function show_modal_message(message,type,time,position)
{
	var d = (new Date()).getTime();
	if($.inArray(type, ["error","notice","message","black"]) >=0 ){var types = type;}else{var types = 'message';}	
	
	if($.inArray(position, ["top-right","top-left","bottom-right","bottom-left"]) >=0 )
	{
		var positions = position;
	}
	else
	{var positions = 'top-right';}
	
	var result = '<div class="show_message '+types+'" id="'+d+'" style="opacity:0;"><div class="close_message_icons">×</div><div class="text_modal">'+message+'</div></div>';
	$('.modal_message').addClass(positions);
	$('.modal_message').append(result);
	$('.show_message.'+types).animate({opacity: 1}, 'normal');
	close_message_time(d,time);
	$('.close_message_icons').click(function(){
		$(this).parent('.show_message').animate({opacity: 0}, 'normal', function(){$('#'+d).remove();});
	});
	var length_message = $('.show_message').length;
	if(length_message > 5)
	{
		var close_max = $('.show_message').eq(length_message-6).attr('id');
		$('#'+close_max).animate({opacity: 0}, 'normal', function(){$(this).remove();});
	}
};

//Закрытие всплывающего окна
function close_message_time(id,time)
{
	if(typeof time == "undefined"){time = 1000;}
	setTimeout(function(){$('#'+id).animate({opacity: 0}, 'normal', function(){$('#'+id).remove();});},time);
}