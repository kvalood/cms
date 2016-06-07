{$meta_title = 'Список слайдеров' scope=parent}


<div class="content_header">
    <h1>Список слайдеров</h1>

    <div class="buttons">
        <a href="index.php?module=SliderAdmin&method=slider" class="button green">Создать слайдер</a>
    </div>
</div>

<div class="board">
{if $sliders}
    <div class="list_items">
        <div class="row header_list">
             <div class="col s2 control">Инструменты</div>
             <div class="col s1">ID</div>
             <div class="col s9">Наименование</div>
        </div>

        {foreach $sliders as $item}
        <div class="row list_item">
            <div class="col s2 control">
                <a href="index.php?module=SliderAdmin&method=slider&id={$item->id}" class="icon-cog" title="Редактировать слайдер"></a>
            </div>
            <div class="col s1">{$item->id}</div>
            <div class="col s9">
                <a href="index.php?module=SliderAdmin&method=slides&id={$item->id}" title="Список слайдов" class="link">{$item->name|escape}</a>
            </div>
        </div>
        {/foreach}
    </div>
{else}
	Слайдеры отсутствуют
{/if}
</div>