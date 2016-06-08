<?php /* Smarty version 3.1.24, created on 2016-06-06 19:43:17
         compiled from "admin/design/html/admin_tinymce.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3366575545b5a48354_27227980%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd01cd6a90eea8ce507aff15df21d83eab74b9621' => 
    array (
      0 => 'admin/design/html/admin_tinymce.tpl',
      1 => 1465201043,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3366575545b5a48354_27227980',
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_575545b5a70ae4_96921093',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_575545b5a70ae4_96921093')) {
function content_575545b5a70ae4_96921093 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3366575545b5a48354_27227980';
?>
<?php echo '<script'; ?>
 language="javascript" type="text/javascript" src="design/libs/tinymce/tinymce.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript">


    tinymce.init({
        selector: 'textarea.full_text',
        language : "ru",
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table contextmenu paste codemirror autoresize'
        ],
        toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',

        /* AutoResize textarea */
        autoresize_bottom_margin: 10,

        /* Редактор html кода */
        codemirror: {
            indentOnInit: true, // Whether or not to indent code on init.
            path: '/admin/design/libs/codemirror/', // Path to CodeMirror distribution
            config: {// Default config
                theme:"seti",
                mode: "text/html",
                gutters: ["CodeMirror-lint-markers"],
                lint: true,
                lineNumbers: true,
                lineWrapping: true,
                indentUnit: 1,
                tabSize: 1,
                matchBrackets: true,
                styleActiveLine: false,
                extraKeys: {"Ctrl-Space": "autocomplete"},

            },
            jsFiles: [
                'lib/codemirror.js',
                'addon/hint/show-hint.js',
                'addon/hint/html-hint.js',
                'addon/hint/anyword-hint.js',
                'addon/hint/css-hint.js',
                'addon/hint/javascript-hint.js',
                'addon/hint/sql-hint.js',
                'addon/hint/xml-hint.js',
                'mode/htmlmixed/htmlmixed.js',
                'mode/xml/xml.js',
                'mode/javascript/javascript.js',
                'mode/css/css.js',
                'lib/jshint.js',
                'lib/jsonlint.js',
                'lib/csslint.js',
                'addon/edit/matchbrackets.js',
                'addon/edit/closebrackets.js',
                'addon/edit/closetag.js',
                'addon/edit/continuelist.js',
                'addon/edit/matchtags.js',
                'addon/edit/trailingspace.js',
                'addon/dialog/dialog.js',
                'addon/search/searchcursor.js',
                'addon/search/search.js',
                'addon/lint/lint.js',
                'addon/lint/html-lint.js',
                'addon/lint/javascript-lint.js',
                'addon/lint/css-lint.js',
                'addon/lint/json-lint.js',
            ],
            cssFiles: [// Default CSS files
                'lib/codemirror.css',
                'theme/seti.css',
                'addon/dialog/dialog.css',
                'addon/hint/show-hint.css',
                'addon/lint/lint.css',
            ],
        }

    });

    
<?php echo '</script'; ?>
><?php }
}
?>