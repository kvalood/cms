{if $slider->id}
    {$meta_title = 'Редактирование слайдера' scope=parent}
{else}
    {$meta_title = 'Создание слайдера' scope=parent}
{/if}

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="session_id" value="{$smarty.session.id}">
    <input name="id" type="hidden" value="{$slider->id|escape}"/>

    <div class="content_header">
        <h1>{if $slider->id}Редактирование слайдера{else}Создание слайдера{/if}</h1>

        <div class="buttons">
            <a href="index.php?module=SliderAdmin" class="button back">Назад</a>
            <input class="button save" type="submit" name="save" value="{if $slider->id}Сохранить{else}Создать{/if}" />
        </div>
    </div>

    <div class="board">
        <div class="row">
            <div class="col s12 sm6">
                <label>Название слайда</label>
                <input type="text" value="{$slider->name}" name="name"/>
            </div>

            <div class="col s12 sm6">
                <label>id слайда</label>
                <input type="text" value="{$slider->id}" name="name" disabled/>
            </div>
        </div>
    </div>

</form>