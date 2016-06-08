<?php /* Smarty version 3.1.24, created on 2015-07-14 04:55:41
         compiled from "admin/design/html/tinymce_init.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1654155a409ade5ffc2_01604132%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b96eee37e02f4bd38a851f2b2f7df5be50a0160f' => 
    array (
      0 => 'admin/design/html/tinymce_init.tpl',
      1 => 1430680879,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1654155a409ade5ffc2_01604132',
  'variables' => 
  array (
    'settings' => 0,
    'config' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a409ade6bb46_11157988',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a409ade6bb46_11157988')) {
function content_55a409ade6bb46_11157988 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1654155a409ade5ffc2_01604132';
?>
<?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="design/js/tiny_mce/plugins/smimage/smplugins.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="design/js/tiny_mce/tiny_mce.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript">

  tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : /editor/,
	theme : "advanced",
	language : "ru",
	theme_advanced_path : false,
	apply_source_formatting : false,
	plugins : "jaretypograph,smimage,smeditimage,smexplorer,safari,spellchecker,style,table,save,advimage,advlink,autolink,inlinepopups,media,contextmenu,paste,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
	relative_urls : false,
	remove_script_host : true,
	convert_urls : true,
	verify_html: false,
    remove_linebreaks : false,
    //content_css :"../design/<?php echo $_smarty_tpl->tpl_vars['settings']->value->theme;?>
/css/style.css",
    spellchecker_languages : "+Russian=ru,+English=en",
            
	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,paste,pastetext,pasteword,|,undo,redo,|,bold,italic,underline,strikethrough,|,bullist,numlist,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "tablecontrols,|,link,unlink,anchor,smimage,smeditimage,smexplorer,charmap,nonbreaking,|,styleprops,attribs,|,jaretypograph,removeformat,cleanup,spellchecker,|,visualaid,fullscreen,code",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	file_browser_callback : "SMPlugins",
	plugin_smexplorer_directory : "<?php echo $_smarty_tpl->tpl_vars['config']->value->subfolder;?>
files/uploads",
	plugin_smimage_directory : "<?php echo $_smarty_tpl->tpl_vars['config']->value->subfolder;?>
files/uploads",
	
	setup : function(ed) {
		if(typeof set_meta == 'function')
		{
			ed.onKeyUp.add(set_meta);
			ed.onChange.add(set_meta);
		}
	}

	});

<?php echo '</script'; ?>
><?php }
}
?>