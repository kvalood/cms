{if $feature->id}
	{$meta_title = $feature->name|escape scope=parent}
{else}
	{$meta_title = 'Новое свойство' scope=parent}
{/if}

{* дополнительные опции *}
{capture name=option}
	<h3>Сброс значений свойств <span id="help"><i>?</i><div id="text">Внимание! Сброс значений свойств подразумевает очистку свойств от лишних символов. Удаляется все кроме цифер и точек у свойств с типом 'Слайдер - диапазон'. Запятые преобразуются в точки.</div></span></h3>
	<a href="index.php?module=FeaturesAdmin&method=reset" class="button_green captufe_all">Сбросить</a>	
{/capture}

{include file='tinymce_init.tpl'}


<form method=post id="product" class="board">
	<input type=hidden name='session_id' value='{$smarty.session.id}'>
	<input name=id type="hidden" value="{$feature->id|escape}"/> 
	
	<div class="content_header">
		<a href="index.php?module=FeaturesAdmin">← Назад</a>	
		<a href="index.php?module=FeatureAdmin">+ Добавить еще одно свойство</a>	
		
		<input class="button_green button_save" type="submit" name="" value="Сохранить" />
	</div>
	
	{if $message_success}
	<div class="message_box message_success">
		<span>{if $message_success=='added'}Свойство добавлено{elseif $message_success=='updated'}Свойство обновлено{/if}</span>
	</div>
	{/if}

	{if $message_error}
	<div class="message_box message_error">
		<span>{if $message_error=='empty_name'}У свойства должно быть название{/if}</span>
	</div>
	{/if}

	<div id="name">
		<label style="display: block;margin-bottom: 2px;">Название свойства</label>
		<input class="name_product" name=name type="text" value="{$feature->name|escape}" placeholder="Название свойства"/> 
	</div> 

	<div class="board_subhead">
		<div id="board_column_left">
			<div class="block">
				<h2>Использовать в категориях</h2>
				
				<ul class="list_checkbox">
				{function name=category_select selected_id=$product_category level=0}
				{foreach $categories as $category}
					<li>
						<label>
							<input type="checkbox" value="{$category->id}" name="feature_categories[]" {if in_array($category->id, $feature_categories)}checked{/if}/>
							<span>{$category->name}</span>
						</label>
						
						{if $category->subcategories}
						<ul>
							{category_select categories=$category->subcategories selected_id=$selected_id  level=$level+1}
						</ul>
						{/if}
					</li>
				{/foreach}
				{/function}
				{category_select categories=$categories}
				</ul>
				
			</div>
		</div>

		<div id="board_column_right">
			<div class="block">
				<h2>Настройки свойства</h2>
				<ul>
					<li>
						<label class="fancy-checkbox">
							<input type="checkbox" name="in_filter" {if $feature->in_filter or !$feature->id}checked{/if}>
							<span>Использовать в фильтре</span>
						</label>
					</li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible" {if $feature->visible or !$feature->id}checked{/if}>
                            <span>Показывать/не показывать на странице товара</span>
                        </label>
                    </li>
                    <li>
                        <label class="fancy-checkbox">
                            <input type="checkbox" name="visible_category" {if $feature->visible_category}checked{/if}>
                            <span>Показывать/не показывать в каталоге у товара</span>
                        </label>
                    </li>
				</ul>
			</div>
			
			
			<div class="block">
				<h2>Настройки отображения в фильтре</h2>
				<ul>
					<li>
						<label class="fancy-radio">
							<input name="type" type="radio" value="1" {if $feature->type == 1 or !$feature->id}checked{/if}>
							<span>Группа checkbox</span>
						</label>
						
						<label class="fancy-radio" title="При заполнении свойства, исспользуйте только числовые значения.">
							<input name="type" type="radio" value="2" {if $feature->type == 2}checked{/if}>
							<span>Слайдер - диапазон</span>
						</label>
					</li>
					<li>
						<label class="property">Единица измерения</label><input type="text" name="units" value="{$feature->units}"/>
					</li>
					<li>
						<label class="fancy-checkbox">
							<input type="checkbox" name="on_show" {if $feature->on_show}checked{/if}>
							<span>Развернутое/свернутое свойство</span>
						</label>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="text_block">		
		<h2>Описание свойства</h2>
		<textarea name="text" class="editor_large">{$feature->text|escape}</textarea>
	</div>

</form>