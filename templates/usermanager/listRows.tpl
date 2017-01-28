{foreach $users as $user}
<tr>
    <td>
        <a class="btn btn-warning btn-xs" href="{Config::BASEURL}usermanager/edit/{$user.iduser}">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
        <a class="btn btn-danger btn-xs" href="{Config::BASEURL}usermanager/delete/{$user.iduser}" onclick="return confirm('Are you sure?');">
            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
        </a>
    </td>
    <td>{$user.iduser}</td>
    <td>{$user.dtlast_name} {$user.dtfirst_name}</td>
    <td>{$user.dttype}</td>
    <td>{if $user.dtemail}<a href="mailto:{$user.dtemail}">{$user.dtemail}</a>{/if}</td>
    <td>{if $user.dttel}<a href="tel:{$user.dttel}">{$user.dttel}</a>{/if}</td>
    <td>{$user.dtbirthdate}</td>
    <td class="text-center">
        {if $user.dtsubscription}
        <span class="label {if $user.dtsubscription eq 'ABO'}label-success{else}label-info{/if}">{$user.dtsubscription}</span>
        {/if}
    </td>
    <td class="text-center {if $user.dtenabled}success{else}danger{/if}">
        {if $user.dtenabled}
        <a class="btn btn-default btn-xs" href="{Config::BASEURL}usermanager/disable/{$user.iduser}">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Disable
        </a>
        {else}
        <a class="btn btn-default btn-xs" href="{Config::BASEURL}usermanager/enable/{$user.iduser}">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Enable
        </a>
        {/if}
    </td>
</tr>
{/foreach}
