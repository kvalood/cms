<?php /* Smarty version 3.1.24, created on 2015-07-14 06:16:46
         compiled from "admin/design/html/article_category_edit.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:476955a41caee9b9b2_72184608%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50d1b3487ae26546d7bc769993a467cf127016f0' => 
    array (
      0 => 'admin/design/html/article_category_edit.tpl',
      1 => 1432902876,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '476955a41caee9b9b2_72184608',
  'variables' => 
  array (
    'articlecat' => 0,
    'message_success' => 0,
    'message_error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_55a41caef05147_40033358',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_55a41caef05147_40033358')) {
function content_55a41caef05147_40033358 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '476955a41caee9b9b2_72184608';
?>

<?php if ($_smarty_tpl->tpl_vars['articlecat']->value->name) {?>
	<?php ob_start();
echo $_smarty_tpl->tpl_vars['articlecat']->value->name;
$_tmp1=ob_get_clean();
$_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_tmp1, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Новая категория материалов', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<form method=post id=product enctype="multipart/form-data">
    <input type=hidden name="session_id" value="<?php echo $_SESSION['id'];?>
">
    <input name="id" type="hidden" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->id, ENT_QUOTES, 'UTF-8', true);?>
"/>

    <div class="capture_head">
        <div id="header">
            <h1><?php if ($_smarty_tpl->tpl_vars['articlecat']->value->name) {?>Категория - <?php echo $_smarty_tpl->tpl_vars['articlecat']->value->name;
} else { ?>Новая категория материалов<?php }?></h1>
        </div>

        <a href="index.php?module=ArticleCategoryAdmin"><- Назад</a>
        <a class="add" href="index.php?module=ArticleCategoryAdmin&method=add_cat">+ Добавить категорию</a>

        <input class="button_green button_save" type="submit" name="" value="Сохранить" />
    </div>

	<?php if ($_smarty_tpl->tpl_vars['message_success']->value) {?>
	<div class="message_box message_success">
		<span><?php if ($_smarty_tpl->tpl_vars['message_success']->value == 'cat_add') {?>Категория добавлена<?php } elseif ($_smarty_tpl->tpl_vars['message_success']->value == 'updated') {?>Категория обновлена<?php }?></span>
	</div>
	<?php }?>

	<?php if ($_smarty_tpl->tpl_vars['message_error']->value) {?>
	<div class="message_box message_error">
		<span><?php if ($_smarty_tpl->tpl_vars['message_error']->value == 'no_name') {?>Вы не указали название категории<?php } elseif ($_smarty_tpl->tpl_vars['message_error']->value == 'exist_name_cat') {?>Категория с таким именем уже существует<?php }?></span>
	</div>
	<?php }?>


	<div class="board_content">
        <div id="board_column_left">
            <div class="block">
                <h2>Основные настройки категории</h2>
                <ul>
                    <li><label class=property>Название</label><input class="name" name="cat_name" type="text" value="<?php echo $_smarty_tpl->tpl_vars['articlecat']->value->name;?>
"/></li>
                    <li><label class=property>Шаблон (прим. arcion_article.tpl)</label><input name="template" type="text" value="<?php echo $_smarty_tpl->tpl_vars['articlecat']->value->template;?>
" /></li>
                    <li><label class=property>Количество отображаемых материалов в категории</label><input name="articles_num" type="text" value="<?php if ($_smarty_tpl->tpl_vars['articlecat']->value->articles_num != 0) {
echo $_smarty_tpl->tpl_vars['articlecat']->value->articles_num;
}?>" /></li>
                    <li>
                        <label class=property>Сортировать по</label>
                        <select name="sorting_method">
                            <option value="date" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'date') {?>selected="select"<?php }?>>дате создания</option>
                            <option value="date_update" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'date_update') {?>selected="select"<?php }?>>дате обновления</option>
                            <option value="name" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'name') {?>selected="select"<?php }?>>названию</option>
                            <option value="id" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_method, ENT_QUOTES, 'UTF-8', true) == 'id') {?>selected="select"<?php }?>>id материала</option>
                        </select>
                    </li>

                    <li>
                        <label class=property>Сортировать по</label>
                        <select name="sorting_type">
                            <option value="desc" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_type, ENT_QUOTES, 'UTF-8', true) == 'desc') {?>selected="select"<?php }?>>убыванию</option>
                            <option value="asc" <?php if (htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->sorting_type, ENT_QUOTES, 'UTF-8', true) == 'asc') {?>selected="select"<?php }?>>возрастанию</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
        <div id="board_column_right">
            <div class="block">
                <h2>Настройки SEO</h2>
                <ul>
                    <li><label class=property>Meta title</label><input name="meta_title" type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->meta_title, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Meta Keywords</label><input name="meta_keywords"  type="text" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->meta_keywords, ENT_QUOTES, 'UTF-8', true);?>
" /></li>
                    <li><label class=property>Meta Description</label><textarea name="meta_description" /><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['articlecat']->value->meta_description, ENT_QUOTES, 'UTF-8', true);?>
</textarea></li>
                </ul>
            </div>
        </div>
    </div>
</form><?php }
}
?>