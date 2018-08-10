<?php
/* Smarty version 3.1.32, created on 2018-08-10 14:24:56
  from 'C:\SERVER\domains\cms\simpla\design\html\export_users.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b6d1398d1c627_07362623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bbf9b377fe2cd0d733de27362adc44dd65c7793' => 
    array (
      0 => 'C:\\SERVER\\domains\\cms\\simpla\\design\\html\\export_users.tpl',
      1 => 1505797530,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b6d1398d1c627_07362623 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'tabs', null, null);
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);
$_smarty_tpl->_assignInScope('meta_title', 'Экспорт покупателей' ,false ,2);?>

<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['config']->value->root_url;?>
/simpla/design/js/piecon/piecon.js"><?php echo '</script'; ?>
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
