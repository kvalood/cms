<?php /* Smarty version 3.1.24, created on 2016-06-05 20:42:41
         compiled from "admin/design/html/slides.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:29684575402211e08f1_29324911%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c1bd2c7af2cefce52647fe42512157f77dc13cbb' => 
    array (
      0 => 'admin/design/html/slides.tpl',
      1 => 1465123354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29684575402211e08f1_29324911',
  'variables' => 
  array (
    'slider' => 0,
    'slides' => 0,
    'slide' => 0,
    'config' => 0,
    'img_url' => 0,
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5754022124eb32_09572379',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5754022124eb32_09572379')) {
function content_5754022124eb32_09572379 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '29684575402211e08f1_29324911';
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Слайды', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="content_header">
    <h1>
        Слайды
        <?php if ($_smarty_tpl->tpl_vars['slider']->value->id) {?> <span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slider']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</span><?php }?>
    </h1>


    <div class="buttons">
        <a href="index.php?module=SliderAdmin&method=slide<?php if ($_smarty_tpl->tpl_vars['slider']->value->id) {?>&slider_id=<?php echo $_smarty_tpl->tpl_vars['slider']->value->id;
}?>" class="button green">Создать слайд</a>
    </div>
</div>


<?php if ($_smarty_tpl->tpl_vars['slides']->value) {?>
<div id="list" class="slides">
	
	<form id="list_form" method="post">
	<input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

		<div id="list">
			<?php
$_from = $_smarty_tpl->tpl_vars['slides']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['slide']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
$foreach_slide_Sav = $_smarty_tpl->tpl_vars['slide'];
?>
			<div class="row">
				<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['slide']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value->position;?>
" />
				<div class="slide_wrapper">
					
					<div class="title">
						<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['slide']->value->id;?>
" />	
						<?php if ($_smarty_tpl->tpl_vars['slide']->value->name) {?>
							<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'SlideAdmin','id'=>$_smarty_tpl->tpl_vars['slide']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">
								<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value->name, ENT_QUOTES, 'UTF-8', true);?>

							</a>
						<?php }?>
					</div>
					
					<div class="slide">
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'SlideAdmin','id'=>$_smarty_tpl->tpl_vars['slide']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
">
						<?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?>
						<img src="../<?php echo $_smarty_tpl->tpl_vars['slide']->value->image;?>
">
						<?php } else { ?>
						изображение не загружено
						<?php }?>
						</a>
					</div>
					
					<?php if ($_smarty_tpl->tpl_vars['slide']->value->image) {?>
					<div class="tip">
						<?php $_smarty_tpl->tpl_vars['img_url'] = new Smarty_Variable((($_smarty_tpl->tpl_vars['config']->value->root_url).('/')).($_smarty_tpl->tpl_vars['slide']->value->image), null, 0);?>
						<?php echo $_smarty_tpl->tpl_vars['img_url']->value;?>

						<?php $_smarty_tpl->tpl_vars["info"] = new Smarty_Variable(getimagesize($_smarty_tpl->tpl_vars['img_url']->value), null, 0);?><br />
						<?php echo $_smarty_tpl->tpl_vars['info']->value[0];?>
px X <?php echo $_smarty_tpl->tpl_vars['info']->value[1];?>
px
					</div>
					<?php }?>
					
					<a class="delete button_red" href='#' >Удалить слайд</a>
				</div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['slide'] = $foreach_slide_Sav;
}
?>
		</div>
		
		<div id="action">
			<label id="check_all" class="dash_link">Выбрать все</label>
		
			<span id="select">
			<select name="action">
				<option value="delete">Удалить</option>
			</select>
			</span>
		
			<input id="apply_action" class="button_green" type="submit" value="Применить">
		</div>

	</form>

</div>
<?php } else { ?>
	Нет слайдов
<?php }?>
 

<?php echo '<script'; ?>
>
$(function() {
	
	// Сортировка списка
	$("#list").sortable({
		items:             ".row",
		tolerance:         "pointer",
		handle:            ".slide_wrapper",
		axis: 'y',
		scrollSensitivity: 40,
		opacity:           0.7, 
		forcePlaceholderSize: true,
		
		helper: function(event, ui){		
			if($('input[type="checkbox"][name*="check"]:checked').size()<1) return ui;
			var helper = $('<div/>');
			$('input[type="checkbox"][name*="check"]:checked').each(function(){
				var item = $(this).closest('.row');
				helper.height(helper.height()+item.innerHeight());
				if(item[0]!=ui[0]) {
					helper.append(item.clone());
					$(this).closest('.row').remove();
				}
				else {
					helper.append(ui.clone());
					item.find('input[type="checkbox"][name*="check"]').attr('checked', false);
				}
			});
			return helper;			
		},	
 		start: function(event, ui) {
  			if(ui.helper.children('.row').size()>0)
				$('.ui-sortable-placeholder').height(ui.helper.height());
		},
		beforeStop:function(event, ui){
			if(ui.helper.children('.row').size()>0){
				ui.helper.children('.row').each(function(){
					$(this).insertBefore(ui.item);
				});
				ui.item.remove();
			}
		},
		update:function(event, ui)
		{
			$("#list_form input[name*='check']").attr('checked', false);
			$("#list_form").ajaxSubmit(function() {
				colorize();
			});
		}
	});
	
	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', 1-$('#list input[type="checkbox"][name*="check"]').attr('checked'));
	});	

	// Удалить
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Подтверждение удаления
	$("form").submit(function() {
		if($('#list input[type="checkbox"][name*="check"]:checked').length>0)
			if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
				return false;	
	});
	
});
<?php echo '</script'; ?>
>
<?php }
}
?>