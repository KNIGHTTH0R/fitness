{if $subMenu}
<div class="navbar navbar-default">
    <div class="container-fluid">
        {if $subMenu.left}
        <ul class="nav navbar-nav">
            {foreach $subMenu.left as $m}
            <li>
                {if $m[0] eq 'link'}
                <a href="{$m[1]}">{$m[2]}</a>
                {elseif $m[0] eq 'text'}
                <p class="navbar-text">$m[1]</p>
                {/if}
            </li>
            {/foreach}
        </ul>
        {/if}
        {if $subMenu.right}
        <ul class="nav navbar-nav navbar-right">
            {foreach $subMenu.right as $m}
            <li>
                {if $m[0] eq 'link'}
                <a href="{$m[1]}">{$m[2]}</a>
                {elseif $m[0] eq 'text'}
                <p class="navbar-text">{$m[1]}</p>
                {/if}
            </li>
            {/foreach}
        </ul>
        {/if}
    </div>
</div>
{/if}
