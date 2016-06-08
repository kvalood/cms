<?php /* Smarty version 3.1.24, created on 2016-03-31 11:19:34
         compiled from "admin/design/html/tags.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1731256fc7b26274345_34615811%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d5f775f5f916bef245e89acdbfe4e6b57821cdd' => 
    array (
      0 => 'admin/design/html/tags.tpl',
      1 => 1436930204,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1731256fc7b26274345_34615811',
  'variables' => 
  array (
    'tags' => 0,
    'tag' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_56fc7b262d2994_53824284',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56fc7b262d2994_53824284')) {
function content_56fc7b262d2994_53824284 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1731256fc7b26274345_34615811';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Управление тегами', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>


<div class="capture_head">
	<a href="#" class="add_object">+ Добавить тег</a>
</div>

<div id="header">
	<h1>Управление тегами</h1>
</div>

<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
	<?php if ($_smarty_tpl->tpl_vars['tags']->value) {?>
		<div class="header_line">
			<div class="item_name">Назнвание</div>
			<div class="iten_url">Урл</div>
			<div class="item_description">Описание</div>
			<div class="item_id">id</div>					
		</div>		
	<?php
$_from = $_smarty_tpl->tpl_vars['tags']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['tag'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['tag']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['tag']->value) {
$_smarty_tpl->tpl_vars['tag']->_loop = true;
$foreach_tag_Sav = $_smarty_tpl->tpl_vars['tag'];
?>
		<div class="item_line" data-id-item="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->id, ENT_QUOTES, 'UTF-8', true);?>
">
			<input type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->id, ENT_QUOTES, 'UTF-8', true);?>
" name="check[]" class="item_check"/>
			<div class="item_name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</div>
			<div class="iten_url"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->url, ENT_QUOTES, 'UTF-8', true);?>
</div>
			<div class="item_description"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->description, ENT_QUOTES, 'UTF-8', true);?>
</div>
			<div class="item_id"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->id, ENT_QUOTES, 'UTF-8', true);?>
</div>
			<div class="item_control_panel">
				<div class="edit_item">Редактировать</div>
				<div class="delete_item">Удалить</div>
			</div>							
		</div>			
	<?php
$_smarty_tpl->tpl_vars['tag'] = $foreach_tag_Sav;
}
?>
	<?php } else { ?>
		Пока нет ни одного тега
	<?php }?>
</form>


<div id="edit_form">
	<input type="hidden" value="" name="id"/>
	<div class="edit_line">
		<label>Название меткии</label>
		<input type="text" value="" name="name" class="input"/>
	</div>
	
	<div class="edit_line">
		<label>Урл меткии</label>
		<input type="text" value="" name="url" class="input"/>
	</div>
	
	<div class="edit_line">
		<label>Описание меткии</label>
		<textarea name="description"></textarea>
	</div>
	
	<div class="control_link">
		<a href="#" id="save">Сохранить</a>
		<a href="#" id="cancel">Отменить</a>
	</div>
</div>

<div class="item_line" id="added_item" data-id-item="" style="display:none">
	<input type="checkbox" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tag']->value->id, ENT_QUOTES, 'UTF-8', true);?>
" name="check[]" class="item_check"/>
	<div class="item_name"></div>
	<div class="iten_url"></div>
	<div class="item_description"></div>
	<div class="item_id"></div>
	<div class="item_control_panel">
		<div class="edit_item">Редактировать</div>
		<div class="delete_item">Удалить</div>
	</div>							
</div>		





<?php echo '<script'; ?>
>
$(function() {

	//Редактировать элемент
	$(document).on('click', '.edit_item', function(){
		close_edit();
		var elemtn = $(this).closest('.item_line'),
			id = elemtn.attr('data-id-item'),
			edit_form = $('#edit_form').clone(true);
		
		elemtn.css('display','none').siblings('.item_line').css('display','block');
		//Добавляем классы к форме
		elemtn.after(edit_form.addClass('act').attr('data-edit-tag',id));

		$.ajax({
			type: 'POST',
			url: 'ajax/get_object.php',
			data: {'object': 'tags', 'id': id, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(msg){
				for(var i in msg)
				{
					$('[name = '+i+']').val(msg[i]);
				}				
			},
			dataType: 'json'
		});	
		return false;		
	});	
	
	function close_edit()
	{
		$('#list_form #edit_form').remove();
		$('#list_form').find('.item_line:hidden').css('display','block');
	}
	
	//Отменили редактирование
	$(document).on('click', '.control_link #cancel', function(){
		close_edit();
	});
	
	//Удалить тег
	$(document).on('click', '.item_control_panel .delete_item', function(){

		var element = $(this).closest('.item_line'),
			id      = element.attr('data-id-item');

		if(confirm('Подтвердите удаление'))
		{
			$.ajax({
				type: 'POST',
				url: 'ajax/delete_object.php',
				data: {'object': 'tags', 'id': id, 'session_id': '<?php echo $_SESSION['id'];?>
'},
				success: function(msg){
					element.remove();
					show_modal_message('Тег удален','error',3000,'bottom-right');
				},
				dataType: 'json'
			});	
		}
	});
	
	//Сохрнаить тег
	$(document).on('click', '.control_link #save', function(){

		//Добавленный или новый элемент
		var item = $(this).closest('#edit_form'),
			tag  = item.find(':input').serialize(),
			id   = item.find('[name=id]').attr('value'),
			name = item.find('[name=name]').attr('value');
			
		//Меняем текущий элемент		
		if(id == 'undefined' || id == '')
		{
			if(name == '')
			{
				show_modal_message('Незаполнено название тега','error',3000,'bottom-right');
			}
			else
			{
				$.ajax({
					type: 'POST',
					url: 'ajax/add_object.php',
					data: {'object': 'tags', 'values': tag, 'session_id': '<?php echo $_SESSION['id'];?>
'},
					success: function(msg){
						added_item = $('#added_item').clone(true);
						console.log(added_item);	
						
						$('#list_form').append(added_item);
						
						close_edit();
						show_modal_message('Новый тег добавлен','message',3000,'bottom-right');
					},
					dataType: 'json'
				});
			}
		}
		else //Добавляем  новый элемент 
		{
			$.ajax({
				type: 'POST',
				url: 'ajax/update_object.php',
				data: {'object': 'tags', 'values': tag, 'session_id': '<?php echo $_SESSION['id'];?>
'},
				success: function(msg){
					element_update = $('[data-id-item = '+msg.id+']');
					for(var i in msg)
					{
						element_update.find('.item_'+i).html(msg[i]);
					}				
					close_edit();
					show_modal_message('Сохранено','message',3000,'bottom-right');
				},
				dataType: 'json'
			});	
		
		}
		return false;	
	});
	
	
	//Добавить тег
	$(document).on('click', '.add_object', function(){
		close_edit();
		edit_form = $('#edit_form').clone(true);
		$('#list_form').append(edit_form.addClass('act')).find(':input').val('');
	});
});

<?php echo '</script'; ?>
>
<?php }
}
?>