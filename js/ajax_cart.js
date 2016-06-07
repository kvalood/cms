// Аяксовая корзина
$(document).on('submit', 'form.variants', function(e) {
	e.preventDefault();
	button = $(this).find('input[type="submit"]');
	if($(this).find('input[name=variant]:checked').size()>0)
		variant = $(this).find('input[name=variant]:checked').val();
	if($(this).find('select[name=variant]').size()>0)
		variant = $(this).find('select').val();
		
	/*size_color*/
    if($(this).find('input[name=variant]').size()>0 && $(this).find('select[name=variant]').size() < 1 && $(this).find('input[name=variant]:checked').size() < 1) {
        variant = $(this).find('input[name=variant]').val();
    }
    /*/size_color*/
	
	$.ajax({
		url: "ajax/cart.php",
		data: {variant: variant},
		dataType: 'json',
		success: function(data){
			$('.cart_informer').html(data);
			if(button.attr('data-result-text'))
				button.val(button.attr('data-result-text'));
		}
	});

	//Уведомление, добавили
	show_modal_message('Товар добавлен в корзину! <br/><a href="/cart/">Перейти в корзину</a>','message','9000','bottom-right');
	
	return false;
});