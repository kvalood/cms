<?php /* Smarty version 3.1.24, created on 2015-07-15 13:13:54
         compiled from "admin/design/html/export_users.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:80855a5cff2aba706_12661970%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '624b2e1620c9d612a93139d69f6cefe007e6d100' => 
    array (
      0 => 'admin/design/html/export_users.tpl',
      1 => 1436814040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80855a5cff2aba706_12661970',
  'variables' => 
  array (
    'config' => 0,
    'group_id' => 0,
    'keyword' => 0,
    'sort' => 0,
    'message_error' => 0,
    'export_files_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a5cff2b37723_45131079',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a5cff2b37723_45131079')) {
function content_55a5cff2b37723_45131079 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '80855a5cff2aba706_12661970';
$_smarty_tpl->_capture_stack[0][] = array('tabs', null, null); ob_start(); ?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Экспорт покупателей', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/admin/design/js/piecon/piecon.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
var group_id='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['group_id']->value, ENT_QUOTES, 'UTF-8', true);?>
';
var keyword='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);?>
';
var sort='<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['sort']->value, ENT_QUOTES, 'UTF-8', true);?>
';

	
var in_process=false;

$(function() {
	// On document load
	$('input#start').click(function() {
 
 		Piecon.setOptions({fallback: 'force'});
 		Piecon.setProgress(0);
    	$("#progressbar").progressbar({ value: 0 });
 		
    	$("#start").hide('fast');
		do_export();
	});
  
	function do_export(page)
	{
		page = typeof(page) != 'undefined' ? page : 1;

		$.ajax({
				url: "ajax/export_users.php",
				data: {page:page, group_id:group_id, keyword:keyword, sort:sort},
				dataType: 'json',
				success: function(data){
				
				if(data && !data.end)
				{
    				Piecon.setProgress(Math.round(100*data.page/data.totalpages));
					$("#progressbar").progressbar({ value: 100*data.page/data.totalpages });
					do_export(data.page*1+1);
				}
				else
				{	
    				Piecon.setProgress(100);
					$("#progressbar").hide('fast');
					window.location.href = 'files/export_users/users.csv';

				}
				},
				error:function(xhr, status, errorThrown) {	
				alert(errorThrown+'\n'+xhr.responseText);
			}  				
		});
	}
});

<?php echo '</script'; ?>
>

<style>
	.ui-progressbar-value { background-image: url(design/images/progress.gif); background-position:left; border-color: #009ae2;}
	#progressbar{ clear: both; height:29px; }
	#result{ clear: both; width:100%;}
	#download{ display:none;  clear: both; }
</style>


<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>

<div class="message_box message_error">
	<span class="text">
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'no_permission') {?>Установите права на запись в папку <?php echo $_smarty_tpl->tpl_vars['export_files_dir']->value;
}?>
	</span>
</div>

<?php }?>


<div>
	<h1>Экспорт покупателей</h1>
	<?php if ($_smarty_tpl->tpl_vars['message_error']->value != 'no_permission') {?>
	<div id='progressbar'></div>
	<input class="button_green" id="start" type="button" name="" value="Экспортировать" />
	<?php }?>
</div><?php }
}
?>