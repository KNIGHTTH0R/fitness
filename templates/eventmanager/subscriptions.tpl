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
                        <td colspan="3">
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
                        <td>{$user.dtlast_name} {$user.dtfirst_name}</td>
                        <td>{if $user.dtemail}<a href="mailto:{$user.dtemail}">{$user.dtemail}</a>{/if}</td>
                        <td>{if $user.dttel}<a href="tel:{$user.dttel}">{$user.dttel}</a>{/if}</td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
</form>
