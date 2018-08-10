<?php
/* Smarty version 3.1.32, created on 2018-07-11 00:05:56
  from 'C:\SERVER\domains\cms\simpla\design\html\currency.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b44bd4498dfc5_23825325',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7acebc36d2c72b27883a5d743e521229cabba93' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\currency.tpl',
      1 => 1464945792,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b44bd4498dfc5_23825325 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('meta_title', 'Валюты' ,false ,2);?>


<?php echo '<script'; ?>
>
$(function() {

	// Сортировка списка
	// Сортировка вариантов
	$("#currencies_block").sortable({ items: 'ul.sortable' , axis: 'y',  cancel: '#header', handle: '.move_zone' });

	// Добавление валюты
	var curr = $('#new_currency').clone(true);
	$('#new_currency').remove().removeAttr('id');
	$('a#add_currency').click(function() {
		$(curr).clone(true).appendTo('#currencies').fadeIn('slow').find("input[name*=currency][name*=name]").focus();
		return false;		
	});	
 
	// Скрыт/Видим
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest("ul");
		var id          = line.find('input[name*="currency[id]"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'currency', 'id': id, 'values': {'enabled': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
					line.removeClass('invisible');
				else
					line.addClass('invisible');				
			},
			dataType: 'json'
		});	
		return false;	
	});
	
	// Центы
	$("a.cents").click(function() {
		var icon        = $(this);
		var line        = icon.closest("ul");
		var id          = line.find('input[name*="currency[id]"]').val();
		var state       = line.hasClass('cents')?0:2;
		icon.addClass('loading_icon');

		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'currency', 'id': id, 'values': {'cents': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(!state)
					line.removeClass('cents');
				else
					line.addClass('cents');				
			},
			error: function (xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                    alert(thrownError);
            },
			dataType: 'json'
		});	
		return false;	
	});
	
	// Показать центы
	$("a.delete").click(function() {
		$('input[type="hidden"][name="action"]').val('delete');
		$('input[type="hidden"][name="action_id"]').val($(this).closest("ul").find('input[type="hidden"][name*="currency[id]"]').val());
		$(this).closest("form").submit();
	});
	
	// Запоминаем id первой валюты, чтобы определить изменение базовой валюты
	var base_currency_id = $('input[name*="currency[id]"]').val();
	
	$("form").submit(function() {
		if($('input[type="hidden"][name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
		if(base_currency_id != $('input[name*="currency[id]"]:first').val() && confirm('Пересчитать все цены в '+$('input[name*="name"]:first').val()+' по текущему курсу?', 'msgBox Title'))
			$('input[name="recalculate"]').val(1);
	});
});
<?php echo '</script'; ?>
>


    <form method="post">
        <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
        <input type=hidden name=recalculate value='0'>
        <input type=hidden name=action value=''>
        <input type=hidden name=action_id value=''>

        <div class="content_header">
            <div id="header">
                <h1>Валюты</h1>
            </div>
            <a id="add_currency" href="#">Добавить</a>

            <input id='apply_action' class="button_green button_save" type=submit value="Сохранить">
        </div>
 

        <div class="board">
            <div id="currencies_block">
                <ul id="header">
                    <li class="move"></li>
                    <li class="name">Название валюты</li>
                    <li class="icons"></li>
                    <li class="sign">Знак</li>
                    <li class="iso">Код ISO</li>
                </ul>
                <div id="currencies">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'c');
$_smarty_tpl->tpl_vars['c']->index = -1;
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->index++;
$_smarty_tpl->tpl_vars['c']->first = !$_smarty_tpl->tpl_vars['c']->index;
$__foreach_c_0_saved = $_smarty_tpl->tpl_vars['c'];
?>
                    <ul class="sortable <?php if (!$_smarty_tpl->tpl_vars['c']->value->enabled) {?>invisible<?php }?> <?php if ($_smarty_tpl->tpl_vars['c']->value->cents == 2) {?>cents<?php }?>">
                        <li class="move"><div class="move_zone"></div></li>
                        <li class="name">
                            <input name="currency[id][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="hidden" 	value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->id, ENT_QUOTES, 'UTF-8', true);?>
" /><input name="currency[name][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->name, ENT_QUOTES, 'UTF-8', true);?>
" />
                        </li>
                        <li class="icons">
                            <a class="cents" href="#" title="Выводить копейки"></a>
                            <a class="enable" href="#" title="Показывать на сайте"></a>
                        </li>
                        <li class="sign">		<input name="currency[sign][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="text" 	value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        <li class="iso">		<input name="currency[code][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="text" 	value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->code, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                        <li class="rate">
                            <?php if (!$_smarty_tpl->tpl_vars['c']->first) {?>
                            <div class=rate_from><input name="currency[rate_from][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->rate_from, ENT_QUOTES, 'UTF-8', true);?>
" /> <?php echo $_smarty_tpl->tpl_vars['c']->value->sign;?>
</div>
                            <div class=rate_to>= <input name="currency[rate_to][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->rate_to, ENT_QUOTES, 'UTF-8', true);?>
" /> <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
</div>
                            <?php } else { ?>
                            <input name="currency[rate_from][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->rate_from, ENT_QUOTES, 'UTF-8', true);?>
" />
                            <input name="currency[rate_to][<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
]" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['c']->value->rate_to, ENT_QUOTES, 'UTF-8', true);?>
" />
                            <?php }?>
                        </li>
                        <li class="icons">
                        <?php if (!$_smarty_tpl->tpl_vars['c']->first) {?>
                            <a class="delete" href="#" title="Удалить"></a>
                        <?php }?>
                        </li>
                    </ul>
                    <?php
$_smarty_tpl->tpl_vars['c'] = $__foreach_c_0_saved;
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <ul id="new_currency" style='display:none;'>
                        <li class="move"><div class="move_zone"></div></li>
                        <li class="name"><input name="currency[id][]" type="hidden" value="" /><input name="currency[name][]" type="text" value="" /></li>
                        <li class="icons">
                        </li>
                        <li class="sign"><input name="currency[sign][]" type="text" value="" /></li>
                        <li class="iso"><input  name="currency[code][]" type="text" value="" /></li>
                        <li class="rate">
                            <div class=rate_from><input name="currency[rate_from][]" type="text" value="1" /> </div>
                            <div class=rate_to>= <input name="currency[rate_to][]" type="text" value="1" /> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value->sign, ENT_QUOTES, 'UTF-8', true);?>
</div>
                        </li>
                        <li class="icons">

                        </li>
                    </ul>
                </div>
	        </div>
        </div>
	</form><?php }
}
