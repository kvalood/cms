{* Title *}
{$meta_title='Обратная связь' scope=parent}

<div class="content_header">
    <div id="header">
        <h1>
        {if $feedback_count}
            {$feedback_count} {$feedback_count|plural:'сообщение':'сообщений':'сообщения'}
        {else}
            Нет сообщений
        {/if}
        </h1>
    </div>
</div>

{if $feedback}
	<form id="list_form" method="post" data-object="feedback">

        <input type="hidden" name="session_id" value="{$smarty.session.id}">

        <div id="list">
		{foreach $feedback as $f}
			<div class="row feedback_id" data-visible="{$f->visible|escape}">
                <div class="checkbox cell">
                    <input type="checkbox" name="check[]" value="{$f->id}" />
                </div>

                <div class="id cell"># {$f->id}</div>

                <div class="box_left cell">
                    <b>Имя:</b> {$f->name|escape}<br/>
                    {if $f->email}<b>Email:</b> {$f->email|escape}{/if}<br/>
                    {if $f->phone}<b>Телефон:</b> {$f->phone|escape}{/if}<br/>
                    {if $f->ip}<b>IP:</b> {$f->ip|escape}{/if}
                </div>

                <div class="box_right cell">
                    {if $f->message}<div class="f_text"><b>Сообщение:</b> {$f->message|nl2br}</div>{/if}
                    <div class="sub_name">Сообщение отправлено {$f->date|date} в {$f->date|time}</div>
                </div>

                <div class="icons cell">
                    <a class="delete" title="Удалить" href="#"></a>
                    <a class="enable" title="Отметить прочитанным/новым" href="#"></a>
                </div>
			</div>
		{/foreach}
        </div>
	</form>		
{else}
	Нет сообщений
{/if}
</div>