{if $messages.success}
    {foreach $messages.success as $message}
    <div class="info success clear">
        <i class="icon-check"></i>
        <span>{$lang->$message.key}</span>
        {if $message.data}
            <div class="info__data">{$message.data}</div>
        {/if}
    </div>
    {/foreach}
{/if}

{if $messages.error}
    {foreach $messages.error as $message}
    <div class="info warning clear">
        <i class="icon-close"></i>
        <span>{$lang->$message.key}</span>
        {if $message.data}
            <div class="info__data">{$message.data}</div>
        {/if}
    </div>
    {/foreach}
{/if}

{if $messages.notice}
    {foreach $messages.notice as $message}
    <div class="info notice clear">
        <i class="icon-warning"></i>
        <span>{$lang->$message.key}</span>
        {if $message.data}
            <div class="info__data">{$message.data}</div>
        {/if}
    </div>
    {/foreach}
{/if}