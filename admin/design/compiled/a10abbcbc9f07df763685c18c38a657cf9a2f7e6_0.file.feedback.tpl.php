<?php /* Smarty version 3.1.24, created on 2015-06-15 15:13:15
         compiled from "admin/design/html/feedback.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:11843557e5eeb4bda42_50262139%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a10abbcbc9f07df763685c18c38a657cf9a2f7e6' => 
    array (
      0 => 'admin/design/html/feedback.tpl',
      1 => 1423548447,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11843557e5eeb4bda42_50262139',
  'variables' => 
  array (
    'feedback_count' => 0,
    'feedback' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_557e5eeb5a0371_09525291',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_557e5eeb5a0371_09525291')) {
function content_557e5eeb5a0371_09525291 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11843557e5eeb4bda42_50262139';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Обратная связь', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div id="header">
	<?php if ($_smarty_tpl->tpl_vars['feedback_count']->value) {?>
	<h1><?php echo $_smarty_tpl->tpl_vars['feedback_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['feedback_count']->value,'сообщение','сообщений','сообщения');?>
</h1> 
	<?php } else { ?>
	<h1>Нет сообщений</h1> 
	<?php }?>
</div>	

<?php if ($_smarty_tpl->tpl_vars['feedback']->value) {?>
	<form id="list_form" method="post">
		<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
		<?php
$_from = $_smarty_tpl->tpl_vars['feedback']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['f'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['f']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
$_smarty_tpl->tpl_vars['f']->_loop = true;
$foreach_f_Sav = $_smarty_tpl->tpl_vars['f'];
?>
			<div class="feedback_id status_<?php echo $_smarty_tpl->tpl_vars['f']->value->status;?>
">
				<input type="hidden" class="id_id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
" />
				<div class="data_id">
					<div class="id_message"># <?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
</div>
					<h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</h2>
					<?php if ($_smarty_tpl->tpl_vars['f']->value->email) {?><div class="f_email"><b>Email:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->email, ENT_QUOTES, 'UTF-8', true);?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['f']->value->phone) {?><div class="f_phone"><b>Телефон:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->phone, ENT_QUOTES, 'UTF-8', true);?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['f']->value->phone) {?><div class="f_phone"><b>IP:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->ip, ENT_QUOTES, 'UTF-8', true);?>
</div><?php }?>
					<?php if ($_smarty_tpl->tpl_vars['f']->value->message) {?><div class="f_text"><b>Сообщение:</b> <?php echo nl2br($_smarty_tpl->tpl_vars['f']->value->message);?>
</div><?php }?>
					
					<div class="f_info">
						Сообщение отправлено <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['f']->value->date);?>
 в <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['f']->value->date);?>

					</div>
				</div>
				
								
				<div class="control_panel">
					
					<?php if ($_smarty_tpl->tpl_vars['f']->value->status == 0) {?><div class="flag_id">Отметить обработанным</div><?php }?>
					<div class="delete">Удалить</div>
				</div>
				
			</div>
		<?php
$_smarty_tpl->tpl_vars['f'] = $foreach_f_Sav;
}
?>
	</form>		
<?php } else { ?>
	Нет сообщений
<?php }?>
</div>



<?php echo '<script'; ?>
>
$(function() {
	//Выделить
	$('.select_id').click(function(){
		if($(this).closest('.feedback_id').hasClass('selected'))
		{
			$(this).closest('.feedback_id').removeClass('selected');
		}
		else
		{
			$(this).closest('.feedback_id').addClass('selected');
		}
		
	
	});
	
	//Удалить
	$('.delete').click(function() {
		//if(confirm('Подтвердите удаление')){
		var id = $(this).closest('.feedback_id').find('input[name*="id"]').val();
		console.log(id);
		$(this).closest('.feedback_id').remove();
			$.ajax({
				type: 'POST',
				url: 'ajax/delete_object.php',
				data: {'object': 'feedback', 'id': id, 'session_id': '<?php echo $_SESSION['id'];?>
'},
				success: function(data){
					
					show_modal_message('Удалено!','message',3000,'bottom-right');
										
				},
				dataType: 'json'
			});	
			return false;
		//}
	});
	

	
	//Пометить обработанными
	$('.flag_id').click(function(){
		var id = $(this).closest('.feedback_id').find('input[name*="id"]').val();
		var status = 1;
		$(this).closest('.feedback_id').removeClass().addClass('feedback_id').addClass('status_1');
		$(this).remove();
		
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'feedback', 'id': id, 'values': {'status': status}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				show_modal_message('Статус обратного звонка сменился на "Обработано"','message',3000,'bottom-right');
			},
			dataType: 'json'
		});	
		return false;	
	});

});

<?php echo '</script'; ?>
>

<?php }
}
?>