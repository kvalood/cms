<?php /* Smarty version 3.1.24, created on 2015-07-17 03:51:56
         compiled from "admin/design/html/feedback.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:762055a7ef3cca6825_59320179%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dd5f5c426b3752d7b2843ab5836939ceda0a8116' => 
    array (
      0 => 'admin/design/html/feedback.tpl',
      1 => 1437068930,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '762055a7ef3cca6825_59320179',
  'variables' => 
  array (
    'feedback_count' => 0,
    'feedback' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a7ef3cd082b8_86718431',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a7ef3cd082b8_86718431')) {
function content_55a7ef3cd082b8_86718431 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '762055a7ef3cca6825_59320179';
?>

<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Обратная связь', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>

<div class="capture_head">
    <div id="header">
        <h1>
        <?php if ($_smarty_tpl->tpl_vars['feedback_count']->value) {?>
            <?php echo $_smarty_tpl->tpl_vars['feedback_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['feedback_count']->value,'сообщение','сообщений','сообщения');?>

        <?php } else { ?>
            Нет сообщений
        <?php }?>
        </h1>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['feedback']->value) {?>
	<form id="list_form" method="post" data-object="feedback">

        <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">

        <div id="list">
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
			<div class="row feedback_id" data-visible="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->visible, ENT_QUOTES, 'UTF-8', true);?>
">
                <div class="checkbox cell">
                    <input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
" />
                </div>

                <div class="id cell"># <?php echo $_smarty_tpl->tpl_vars['f']->value->id;?>
</div>

                <div class="box_left cell">
                    <b>Имя:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->name, ENT_QUOTES, 'UTF-8', true);?>
<br/>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value->email) {?><b>Email:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->email, ENT_QUOTES, 'UTF-8', true);
}?><br/>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value->phone) {?><b>Телефон:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->phone, ENT_QUOTES, 'UTF-8', true);
}?><br/>
                    <?php if ($_smarty_tpl->tpl_vars['f']->value->ip) {?><b>IP:</b> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['f']->value->ip, ENT_QUOTES, 'UTF-8', true);
}?>
                </div>

                <div class="box_right cell">
                    <?php if ($_smarty_tpl->tpl_vars['f']->value->message) {?><div class="f_text"><b>Сообщение:</b> <?php echo nl2br($_smarty_tpl->tpl_vars['f']->value->message);?>
</div><?php }?>
                    <div class="sub_name">Сообщение отправлено <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['date'][0][0]->date_modifier($_smarty_tpl->tpl_vars['f']->value->date);?>
 в <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['time'][0][0]->time_modifier($_smarty_tpl->tpl_vars['f']->value->date);?>
</div>
                </div>

                <div class="icons cell">
                    <a class="delete" title="Удалить" href="#"></a>
                    <a class="enable" title="Отметить прочитанным/новым" href="#"></a>
                </div>
			</div>
		<?php
$_smarty_tpl->tpl_vars['f'] = $foreach_f_Sav;
}
?>
        </div>
	</form>		
<?php } else { ?>
	Нет сообщений
<?php }?>
</div><?php }
}
?>