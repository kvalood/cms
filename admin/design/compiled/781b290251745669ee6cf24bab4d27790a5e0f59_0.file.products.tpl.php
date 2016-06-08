<?php /* Smarty version 3.1.24, created on 2015-06-10 01:20:47
         compiled from "admin/design/html/products.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:116675577044fab6463_92926906%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '781b290251745669ee6cf24bab4d27790a5e0f59' => 
    array (
      0 => 'admin/design/html/products.tpl',
      1 => 1433863245,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116675577044fab6463_92926906',
  'variables' => 
  array (
    'category' => 0,
    'products_count' => 0,
    'brand' => 0,
    'keyword' => 0,
    'products' => 0,
    'product' => 0,
    'image' => 0,
    'variant' => 0,
    'currency' => 0,
    'settings' => 0,
    'variants_num' => 0,
    'pages_count' => 0,
    'categories' => 0,
    'brands' => 0,
    'level' => 0,
    'selected_id' => 0,
    'all_brands' => 0,
    'b' => 0,
    'filter' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.24',
  'unifunc' => 'content_5577044fcc5a50_47943124',
  'tpl_function' => 
  array (
    'category_select' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/781b290251745669ee6cf24bab4d27790a5e0f59_0.file.products.tpl.php',
      'uid' => '781b290251745669ee6cf24bab4d27790a5e0f59',
      'call_name' => 'smarty_template_function_category_select_116675577044fab6463_92926906',
    ),
    'categories_tree' => 
    array (
      'called_functions' => 
      array (
      ),
      'compiled_filepath' => 'admin/design/compiled/781b290251745669ee6cf24bab4d27790a5e0f59_0.file.products.tpl.php',
      'uid' => '781b290251745669ee6cf24bab4d27790a5e0f59',
      'call_name' => 'smarty_template_function_categories_tree_116675577044fab6463_92926906',
    ),
  ),
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5577044fcc5a50_47943124')) {
function content_5577044fcc5a50_47943124 ($_smarty_tpl) {
if (!is_callable('smarty_modifier_truncate')) require_once 'D:/OpenServer/domains/cms/Smarty/libs/plugins/modifier.truncate.php';

$_smarty_tpl->properties['nocache_hash'] = '116675577044fab6463_92926906';
?>

<?php if ($_smarty_tpl->tpl_vars['category']->value) {?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable($_smarty_tpl->tpl_vars['category']->value->name, null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php } else { ?>
	<?php $_smarty_tpl->tpl_vars['meta_title'] = new Smarty_Variable('Товары', null, 1);
if ($_smarty_tpl->parent != null) $_smarty_tpl->parent->tpl_vars['meta_title'] = clone $_smarty_tpl->tpl_vars['meta_title'];?>
<?php }?>

<div class="capture_head">
	
	<div id="header">
		<h1>
		<?php if ($_smarty_tpl->tpl_vars['products_count']->value) {?>
			<?php if ($_smarty_tpl->tpl_vars['category']->value->name || $_smarty_tpl->tpl_vars['brand']->value->name) {?>
				<?php echo $_smarty_tpl->tpl_vars['category']->value->name;?>
 <?php echo $_smarty_tpl->tpl_vars['brand']->value->name;?>
 (<?php echo $_smarty_tpl->tpl_vars['products_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['products_count']->value,'товар','товаров','товара');?>
)
			<?php } elseif ($_smarty_tpl->tpl_vars['keyword']->value) {?>
				<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['products_count']->value,'Найден','Найдено','Найдено');?>
 <?php echo $_smarty_tpl->tpl_vars['products_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['products_count']->value,'товар','товаров','товара');?>

			<?php } else { ?>
				<?php echo $_smarty_tpl->tpl_vars['products_count']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['products_count']->value,'товар','товаров','товара');?>

			<?php }?>		
		<?php } else { ?>
			Нет товаров
		<?php }?>
		</h1>
	</div>
	
	<a class="add" href="index.php?module=ProductAdmin">+ Добавить товар</a>
	
	<div class="search_tools">
		<form method="get">
			<input type="hidden" name="module" value="ProductsAdmin">
			<input class="search" type="text" name="keyword" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['keyword']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
			<input class="search_button" type="submit" value="Найти"/>
		</form>
	</div>
</div>
	

<div class="board">
	
	<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
	<div class="board_content">
		<form id="list_form" class="left_board" method="post">
            <input type="hidden" name="session_id" value="<?php echo $_SESSION['id'];?>
">
			
			<div class="board_subhead">
				<?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
	

				<?php if ($_smarty_tpl->tpl_vars['products']->value) {?>
				<div id="expand">
					<a href="#" class="dash_link" id="expand_all">Развернуть все варианты ↓</a>
					<a href="#" class="dash_link" id="roll_up_all" style="display:none;">Свернуть все варианты ↑</a>
				</div>
				<?php }?>
			</div>
		
			<div id="list" class="list_box">
			<?php
$_from = $_smarty_tpl->tpl_vars['products']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['product']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
$foreach_product_Sav = $_smarty_tpl->tpl_vars['product'];
?>
			<div class="<?php if (!$_smarty_tpl->tpl_vars['product']->value->visible) {?>invisible<?php }?> <?php if ($_smarty_tpl->tpl_vars['product']->value->featured) {?>featured<?php }?> row">
				<input type="hidden" name="positions[<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->position;?>
">
				<div class="move cell"><div class="move_zone"></div></div>
				<div class="checkbox cell">
					<input type="checkbox" name="check[]" value="<?php echo $_smarty_tpl->tpl_vars['product']->value->id;?>
"/>				
				</div>
				<div class="image cell">
					<?php $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable($_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['first'][0][0]->first_modifier($_smarty_tpl->tpl_vars['product']->value->images), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['image']->value) {?>
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ProductAdmin','id'=>$_smarty_tpl->tpl_vars['product']->value->id,'return'=>$_SERVER['REQUEST_URI']),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['resize'][0][0]->resize_modifier(htmlspecialchars($_smarty_tpl->tpl_vars['image']->value->filename, ENT_QUOTES, 'UTF-8', true),35,35);?>
" /></a>
					<?php }?>
				</div>
				<div class="name product_name cell">
					
					<div class="variants">
					<ul>
                        <?php
$_from = $_smarty_tpl->tpl_vars['product']->value->variants;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['variant'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['variant']->_loop = false;
$_smarty_tpl->tpl_vars['variant']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['variant']->value) {
$_smarty_tpl->tpl_vars['variant']->_loop = true;
$_smarty_tpl->tpl_vars['variant']->iteration++;
$_smarty_tpl->tpl_vars['variant']->first = $_smarty_tpl->tpl_vars['variant']->iteration == 1;
$foreach_variant_Sav = $_smarty_tpl->tpl_vars['variant'];
?>
                        <li <?php if (!$_smarty_tpl->tpl_vars['variant']->first) {?>class="variant" style="display:none;"<?php }?>>
                            <i title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->name, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smarty_modifier_truncate(htmlspecialchars($_smarty_tpl->tpl_vars['variant']->value->name, ENT_QUOTES, 'UTF-8', true),30,'…',true,true);?>
</i>
                            <input class="price <?php if ($_smarty_tpl->tpl_vars['variant']->value->compare_price > 0) {?>compare_price<?php }?>" type="text" name="price[<?php echo $_smarty_tpl->tpl_vars['variant']->value->id;?>
]" value="<?php echo $_smarty_tpl->tpl_vars['variant']->value->price;?>
" <?php if ($_smarty_tpl->tpl_vars['variant']->value->compare_price > 0) {?>title="Старая цена &mdash; <?php echo $_smarty_tpl->tpl_vars['variant']->value->compare_price;?>
 <?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>
"<?php }?> /><?php echo $_smarty_tpl->tpl_vars['currency']->value->sign;?>

                            <input class="stock" type="text" name="stock[<?php echo $_smarty_tpl->tpl_vars['variant']->value->id;?>
]" value="<?php if ($_smarty_tpl->tpl_vars['variant']->value->infinity) {?>∞<?php } else {
echo $_smarty_tpl->tpl_vars['variant']->value->stock;
}?>" /><?php echo $_smarty_tpl->tpl_vars['settings']->value->units;?>

                        </li>
                        <?php
$_smarty_tpl->tpl_vars['variant'] = $foreach_variant_Sav;
}
?>
					</ul>
		
					<?php $_smarty_tpl->tpl_vars['variants_num'] = new Smarty_Variable(count($_smarty_tpl->tpl_vars['product']->value->variants), null, 0);?>
					<?php if ($_smarty_tpl->tpl_vars['variants_num']->value > 1) {?>
					<div class="expand_variant">
					<a class="dash_link expand_variant" href="#"><?php echo $_smarty_tpl->tpl_vars['variants_num']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['variants_num']->value,'вариант','вариантов','варианта');?>
 ↓</a>
					<a class="dash_link roll_up_variant" style="display:none;" href="#"><?php echo $_smarty_tpl->tpl_vars['variants_num']->value;?>
 <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['plural'][0][0]->plural_modifier($_smarty_tpl->tpl_vars['variants_num']->value,'вариант','вариантов','варианта');?>
 ↑</a>
					</div>
					<?php }?>
					</div>
					
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('module'=>'ProductAdmin','id'=>$_smarty_tpl->tpl_vars['product']->value->id),$_smarty_tpl);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</a>
					
				</div>
				<div class="icons cell">
					<a class="preview"   title="Предпросмотр в новом окне" href="../products/<?php echo $_smarty_tpl->tpl_vars['product']->value->url;?>
" target="_blank"></a>
					<a class="ymarket <?php if ($_smarty_tpl->tpl_vars['product']->value->ymarket) {?>on<?php } else { ?>off<?php }?>" title="Включить/выключить выгрузку в Яндекс.маркет" href="#"></a>
					<a class="google <?php if ($_smarty_tpl->tpl_vars['product']->value->google) {?>on<?php } else { ?>off<?php }?>" title="Включить/выключить выгрузку в Google Merchant" href="#"></a>
					<a class="enable"    title="Активен"                 href="#"></a>
					<a class="featured"  title="Рекомендуемый"           href="#"></a>
					<a class="duplicate" title="Дублировать"             href="#"></a>
					<a class="delete"    title="Удалить"                 href="#"></a>
				</div>
			</div>
			<?php
$_smarty_tpl->tpl_vars['product'] = $foreach_product_Sav;
}
?>
			</div>

			<div id="action">
				<label id="check_all" class="dash_link">Выбрать все</label>
			
				<span id="select">
				<select name="action">
					<option value="enable">Сделать видимыми</option>
					<option value="disable">Сделать невидимыми</option>
					<option value="set_featured">Сделать рекомендуемым</option>
					<option value="unset_featured">Отменить рекомендуемый</option>
					<option value="duplicate">Создать дубликат</option>
					<option value="ymarket">Выгружать в Яндекс.Маркет</option>
					<option value="ymarket_no">Не выгружать в Яндекс.Маркет</option>
                    <option value="google">Выгружать в Google Merchant</option>
                    <option value="google_no">Не выгружать в Google Merchant</option>
					<?php if ($_smarty_tpl->tpl_vars['pages_count']->value > 1) {?>
					<option value="move_to_page">Переместить на страницу</option>
					<?php }?>
					<?php if (count($_smarty_tpl->tpl_vars['categories']->value) > 1) {?>
					<option value="move_to_category">Переместить в категорию</option>
					<?php }?>
					<?php if (count($_smarty_tpl->tpl_vars['brands']->value) > 0) {?>
					<option value="move_to_brand">Указать бренд</option>
					<?php }?>
					<option value="delete">Удалить</option>
				</select>
				</span>
			
				<span id="move_to_page">
				<select name="target_page">
					<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['name'] = 'target_page';
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['pages_count']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['target_page']['total']);
?>
					<option value="<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['target_page']['index']+1;?>
"><?php echo $_smarty_tpl->getVariable('smarty')->value['section']['target_page']['index']+1;?>
</option>
					<?php endfor; endif; ?>
				</select> 
				</span>
			
				<span id="move_to_category">
				<select name="target_category">
					
					<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

				</select> 
				</span>
				
				<span id="move_to_brand">
				<select name="target_brand">
					<option value="0">Не указан</option>
					<?php
$_from = $_smarty_tpl->tpl_vars['all_brands']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['b'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['b']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
$foreach_b_Sav = $_smarty_tpl->tpl_vars['b'];
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['b']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['b']->value->name;?>
</option>
					<?php
$_smarty_tpl->tpl_vars['b'] = $foreach_b_Sav;
}
?>
				</select> 
				</span>
			
				<input id="apply_action" class="button_green" type="submit" value="Применить">		
			</div>
			<?php }?>
		</form>
		
		<div class="right_board">
			
			<!-- Фильтры -->
			<div id="right_head">Фильтр по полям</div>
			
			<ul class="filter">
				<li <?php if (!$_smarty_tpl->tpl_vars['filter']->value) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('brand_id'=>null,'category_id'=>null,'keyword'=>null,'page'=>null,'filter'=>null),$_smarty_tpl);?>
">Все товары</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'featured') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'featured'),$_smarty_tpl);?>
">Рекомендуемые</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'discounted') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'discounted'),$_smarty_tpl);?>
">Со скидкой</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'visible') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'visible'),$_smarty_tpl);?>
">Активные</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'hidden') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'hidden'),$_smarty_tpl);?>
">Неактивные</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'outofstock') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'outofstock'),$_smarty_tpl);?>
">Отсутствующие</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'in_ymarket') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'in_ymarket'),$_smarty_tpl);?>
">Выгружаемые в Yandex</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'out_ymarket') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'out_ymarket'),$_smarty_tpl);?>
">Не выгружаемые в Yandex</a></li>
                <li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'in_google') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'in_google'),$_smarty_tpl);?>
">Выгружаемые в Google Merchant</a></li>
				<li <?php if ($_smarty_tpl->tpl_vars['filter']->value == 'out_google') {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'category_id'=>null,'page'=>null,'filter'=>'out_google'),$_smarty_tpl);?>
">Не выгружаемые в Google Merchant</a></li>
			</ul>
			<!-- Фильтры -->

			
			<!-- Категории товаров -->
			<div id="right_head">Фильтр по категориям</div>
			
			
			<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['categories']->value), true);?>

			<!-- Категории товаров (The End)-->
			
			<?php if ($_smarty_tpl->tpl_vars['brands']->value) {?>
			<!-- Бренды -->
			<div id="right_head">Фильтр по брендам</div>			
			<ul class="filter">
				<li <?php if (!$_smarty_tpl->tpl_vars['brand']->value->id) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('brand_id'=>null),$_smarty_tpl);?>
">Все бренды</a></li>
				<?php
$_from = $_smarty_tpl->tpl_vars['brands']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['b'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['b']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
$foreach_b_Sav = $_smarty_tpl->tpl_vars['b'];
?>
				<li brand_id="<?php echo $_smarty_tpl->tpl_vars['b']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['brand']->value->id == $_smarty_tpl->tpl_vars['b']->value->id) {?>class="selected"<?php } else { ?>class="droppable brand"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'page'=>null,'brand_id'=>$_smarty_tpl->tpl_vars['b']->value->id),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['b']->value->name;?>
</a></li>
				<?php
$_smarty_tpl->tpl_vars['b'] = $foreach_b_Sav;
}
?>
			</ul>
			<!-- Бренды (The End) -->
			<?php }?>
		</div>

	</div>
	
	<div class="board_footer">
		<?php echo $_smarty_tpl->getSubTemplate ('pagination.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>
	
	</div>
</div>





<?php echo '<script'; ?>
>

$(function() {

	// Сортировка списка
	$("#list").sortable({
		items:             ".row",
		tolerance:         "pointer",
		handle:            ".move_zone",
		scrollSensitivity: 40,
		opacity:           0.7, 
		
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
	
	//Включить/выключить загрузку в яндекс.маркет
	$("a.ymarket").click(function() {
		var icon        = $(this);
		var state       = icon.hasClass('on')?0:1;
		var id          = icon.closest('.row').find('input[type="checkbox"][name*="check"]').val();
		icon.addClass('loading_icon');

		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'product', 'id': id, 'values': {'ymarket': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');

				if(state)
				{
					icon.addClass('on');
					icon.removeClass('off');
					show_modal_message('Включено для загрузки в Яндекс.маркет','message',5000,'bottom-right');
				}
				else
				{
					icon.removeClass('on');
					icon.addClass('off');
					show_modal_message('Выключено.','black',5000,'bottom-right');
				}				
			},
			dataType: 'json'
		});	
		return false;	
	});


    //Включить/выключить загрузку в Google Merchant
    $("a.google").click(function() {
        var icon        = $(this);
        var state       = icon.hasClass('on')?0:1;
        var id          = icon.closest('.row').find('input[type="checkbox"][name*="check"]').val();
        icon.addClass('loading_icon');

        $.ajax({
            type: 'POST',
            url: 'ajax/update_object.php',
            data: {'object': 'product', 'id': id, 'values': {'google': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
            success: function(data){
                icon.removeClass('loading_icon');

                if(state)
                {
                    icon.addClass('on');
                    icon.removeClass('off');
                    show_modal_message('Включено для загрузки в Google Merchant','message',5000,'bottom-right');
                }
                else
                {
                    icon.removeClass('on');
                    icon.addClass('off');
                    show_modal_message('Выключено.','black',5000,'bottom-right');
                }
            },
            dataType: 'json'
        });
        return false;
    });
	

	// Перенос товара на другую страницу
	$("#action select[name=action]").change(function() {
		if($(this).val() == 'move_to_page')
			$("span#move_to_page").show();
		else
			$("span#move_to_page").hide();
	});
	$("#pagination a.droppable").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){
			$(ui.helper).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			$(ui.draggable).closest("form").find('select[name="action"] option[value=move_to_page]').attr("selected", "selected");		
			$(ui.draggable).closest("form").find('select[name=target_page] option[value='+$(this).html()+']').attr("selected", "selected");
			$(ui.draggable).closest("form").submit();
			return false;	
		}		
	});


	// Перенос товара в другую категорию
	$("#action select[name=action]").change(function() {
		if($(this).val() == 'move_to_category')
			$("span#move_to_category").show();
		else
			$("span#move_to_category").hide();
	});
	$("#right_menu .droppable.category").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){
			$(ui.helper).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			$(ui.draggable).closest("form").find('select[name="action"] option[value=move_to_category]').attr("selected", "selected");	
			$(ui.draggable).closest("form").find('select[name=target_category] option[value='+$(this).attr('category_id')+']').attr("selected", "selected");
			$(ui.draggable).closest("form").submit();
			return false;			
		}
	});


	// Перенос товара в другой бренд
	$("#action select[name=action]").change(function() {
		if($(this).val() == 'move_to_brand')
			$("span#move_to_brand").show();
		else
			$("span#move_to_brand").hide();
	});
	$("#right_menu .droppable.brand").droppable({
		activeClass: "drop_active",
		hoverClass: "drop_hover",
		tolerance: "pointer",
		drop: function(event, ui){
			$(ui.helper).find('input[type="checkbox"][name*="check"]').attr('checked', true);
			$(ui.draggable).closest("form").find('select[name="action"] option[value=move_to_brand]').attr("selected", "selected");			
			$(ui.draggable).closest("form").find('select[name=target_brand] option[value='+$(this).attr('brand_id')+']').attr("selected", "selected");
			$(ui.draggable).closest("form").submit();
			return false;			
		}
	});


	// Если есть варианты, отображать ссылку на их разворачивание
	if($("li.variant").size()>0)
		$("#expand").show();


	// Раскраска строк
	function colorize()
	{
		$("#list div.row:even").addClass('even');
		$("#list div.row:odd").removeClass('even');
	}
	// Раскрасить строки сразу
	colorize();


	// Показать все варианты
	$("#expand_all").click(function() {
		$("a#expand_all").hide();
		$("a#roll_up_all").show();
		$("a.expand_variant").hide();
		$("a.roll_up_variant").show();
		$(".variants ul li.variant").fadeIn('fast');
		return false;
	});


	// Свернуть все варианты
	$("#roll_up_all").click(function() {
		$("a#roll_up_all").hide();
		$("a#expand_all").show();
		$("a.roll_up_variant").hide();
		$("a.expand_variant").show();
		$(".variants ul li.variant").fadeOut('fast');
		return false;
	});

 
	// Показать вариант
	$("a.expand_variant").click(function() {
		$(this).closest("div.cell").find("li.variant").fadeIn('fast');
		$(this).closest("div.cell").find("a.expand_variant").hide();
		$(this).closest("div.cell").find("a.roll_up_variant").show();
		return false;
	});

	// Свернуть вариант
	$("a.roll_up_variant").click(function() {
		$(this).closest("div.cell").find("li.variant").fadeOut('fast');
		$(this).closest("div.cell").find("a.roll_up_variant").hide();
		$(this).closest("div.cell").find("a.expand_variant").show();
		return false;
	});

	// Выделить все
	$("#check_all").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', $('#list input[type="checkbox"][name*="check"]:not(:checked)').length>0);
	});	

	// Удалить товар
	$("a.delete").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=delete]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Дублировать товар
	$("a.duplicate").click(function() {
		$('#list input[type="checkbox"][name*="check"]').attr('checked', false);
		$(this).closest("div.row").find('input[type="checkbox"][name*="check"]').attr('checked', true);
		$(this).closest("form").find('select[name="action"] option[value=duplicate]').attr('selected', true);
		$(this).closest("form").submit();
	});
	
	// Показать товар
	$("a.enable").click(function() {
		var icon        = $(this);
		var line        = icon.closest("div.row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('invisible')?1:0;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'product', 'id': id, 'values': {'visible': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
                console.log(data);
				icon.removeClass('loading_icon');
				if(state)
				{
					line.removeClass('invisible');
					show_modal_message('Товар включен.','message',5000,'bottom-right');
				}
				else
				{
					line.addClass('invisible');
					show_modal_message('Товар выключен.','black',5000,'bottom-right');
				}	
			},
			dataType: 'json'
		});	
		return false;	
	});

	// Сделать хитом
	$("a.featured").click(function() {
		var icon        = $(this);
		var line        = icon.closest("div.row");
		var id          = line.find('input[type="checkbox"][name*="check"]').val();
		var state       = line.hasClass('featured')?0:1;
		icon.addClass('loading_icon');
		$.ajax({
			type: 'POST',
			url: 'ajax/update_object.php',
			data: {'object': 'product', 'id': id, 'values': {'featured': state}, 'session_id': '<?php echo $_SESSION['id'];?>
'},
			success: function(data){
				icon.removeClass('loading_icon');
				if(state)
				{
					line.addClass('featured');
					show_modal_message('Товар назначен "Избранным".','message',5000,'bottom-right');
				}
				else
				{
					line.removeClass('featured');
					show_modal_message('Товар удален из списка избранных.','black',5000,'bottom-right');
				}
					
			},
			dataType: 'json'
		});	
		return false;	
	});


	// Подтверждение удаления
	$("form").submit(function() {
		if($('select[name="action"]').val()=='delete' && !confirm('Подтвердите удаление'))
			return false;	
	});
	
	
	// Бесконечность на складе
	$("input[name*=stock]").focus(function() {
		if($(this).val() == '∞')
			$(this).val('');
		return false;
	});
	$("input[name*=stock]").blur(function() {
		if($(this).val() == '')
			$(this).val('∞');
	});
});

<?php echo '</script'; ?>
>
<?php }
}
?><?php
/* smarty_template_function_category_select_116675577044fab6463_92926906 */
if (!function_exists('smarty_template_function_category_select_116675577044fab6463_92926906')) {
function smarty_template_function_category_select_116675577044fab6463_92926906($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
$params = array_merge(array('level'=>0), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
					<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['category']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
$_smarty_tpl->tpl_vars['category']->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars['category'];
?>
							<option value='<?php echo $_smarty_tpl->tpl_vars['category']->value->id;?>
'><?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['name'] = 'sp';
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['level']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['sp']['total']);
?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endfor; endif;
echo htmlspecialchars($_smarty_tpl->tpl_vars['category']->value->name, ENT_QUOTES, 'UTF-8', true);?>
</option>
							<?php $_smarty_tpl->callTemplateFunction ('category_select', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['category']->value->subcategories,'selected_id'=>$_smarty_tpl->tpl_vars['selected_id']->value,'level'=>$_smarty_tpl->tpl_vars['level']->value+1), false);?>

					<?php
$_smarty_tpl->tpl_vars['category'] = $foreach_category_Sav;
}
?>
					<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_category_select_116675577044fab6463_92926906 */

?>
<?php
/* smarty_template_function_categories_tree_116675577044fab6463_92926906 */
if (!function_exists('smarty_template_function_categories_tree_116675577044fab6463_92926906')) {
function smarty_template_function_categories_tree_116675577044fab6463_92926906($_smarty_tpl,$params) {
$saved_tpl_vars = $_smarty_tpl->tpl_vars;
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value);
}?>
			<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
			<ul class="filter">
				<?php if ($_smarty_tpl->tpl_vars['categories']->value[0]->parent_id == 0) {?>
				<li <?php if (!$_smarty_tpl->tpl_vars['category']->value->id) {?>class="selected"<?php }?>><a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('category_id'=>null,'brand_id'=>null),$_smarty_tpl);?>
">Все категории</a></li>	
				<?php }?>
				<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['c'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['c']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
$foreach_c_Sav = $_smarty_tpl->tpl_vars['c'];
?>
				<li category_id="<?php echo $_smarty_tpl->tpl_vars['c']->value->id;?>
" <?php if ($_smarty_tpl->tpl_vars['category']->value->id == $_smarty_tpl->tpl_vars['c']->value->id) {?>class="selected"<?php } else { ?>class="droppable category"<?php }?>><a href='<?php ob_start();
echo $_smarty_tpl->tpl_vars['c']->value->id;
$_tmp1=ob_get_clean();
echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url_modifier(array('keyword'=>null,'brand_id'=>null,'page'=>null,'category_id'=>$_tmp1),$_smarty_tpl);?>
'><?php echo $_smarty_tpl->tpl_vars['c']->value->name;?>
</a></li>
				<?php $_smarty_tpl->callTemplateFunction ('categories_tree', $_smarty_tpl, array('categories'=>$_smarty_tpl->tpl_vars['c']->value->subcategories), false);?>

				<?php
$_smarty_tpl->tpl_vars['c'] = $foreach_c_Sav;
}
?>
			</ul>
			<?php }?>
			<?php foreach (Smarty::$global_tpl_vars as $key => $value){
if ($_smarty_tpl->tpl_vars[$key] === $value) $saved_tpl_vars[$key] = $value;
}
$_smarty_tpl->tpl_vars = $saved_tpl_vars;
}
}
/*/ smarty_template_function_categories_tree_116675577044fab6463_92926906 */

?>
