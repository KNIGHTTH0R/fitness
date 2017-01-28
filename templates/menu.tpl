<div class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#MainMenu">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="MainMenu">
            {if $menu.left}
            <ul class="nav navbar-nav">
                {foreach $menu.left as $m}
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
            {if $menu.right}
            <ul class="nav navbar-nav navbar-right">
                {foreach $menu.right as $m}
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
</div>
