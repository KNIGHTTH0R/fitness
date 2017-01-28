<form method="post" action="{Config::BASEURL}eventmanager/subscribe/{$idevent}">
    <div class="panel panel-default">
        <div class="panel-heading">Class - Subscriptions{if $complete} - <em>complete</em>{/if}</div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>E-Mail</th>
                        <th>Telephone</th>
                        <th class="text-center">Subscription</th>
                    </tr>
                </thead>
                <tbody>
                    {if $newusers and !$complete}
                    <tr>
                        <td>
                            <button class="btn btn-success btn-xs" type="submit">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            </button>
                        </td>
                        <td colspan="4">
                            <select name="fiuser" class="form-control input-sm">
                                <option></option>
                                {foreach $newusers as $user}
                                <option value="{$user.iduser}">{$user.dtlast_name} {$user.dtfirst_name}</option>
                                {/foreach}
                            <select>
                        </td>
                    </tr>
                    {/if}
                    {foreach $users as $user}
                    <tr>
                        <td>
                            <a class="btn btn-danger btn-xs" href="{Config::BASEURL}eventmanager/unsubscribe/{$idevent}/{$user.iduser}" onclick="return confirm('Are you sure?');">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td><a href="{Config::BASEURL}usermanager/edit/{$user.iduser}" />{$user.dtlast_name} {$user.dtfirst_name}</a></td>
                        <td>{if $user.dtemail}<a href="mailto:{$user.dtemail}">{$user.dtemail}</a>{/if}</td>
                        <td>{if $user.dttel}<a href="tel:{$user.dttel}">{$user.dttel}</a>{/if}</td>
                        <td class="text-center">
                            {if $user.dtsubscription eq 'CHECK_CARD'}
                            <a href="{Config::BASEURL}eventmanager/togglesignature/{$idevent}/{$user.iduser}" style="text-decoration: none">
                                <span class="label label-info">
                                    {$user.dtsubscription}
                                    {if $user.dtsubscription_signature}
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: #060"></span>
                                    {else}
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: #600"></span>
                                    {/if}
                                </span>
                            </a>
                            {elseif $user.dtsubscription}
                            <span class="label {if $user.dtsubscription eq 'ABO'}label-success{else}label-info{/if}">{$user.dtsubscription}</span>
                            {/if}
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</form>
