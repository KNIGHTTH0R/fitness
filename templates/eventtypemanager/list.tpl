<div class="panel panel-default">
    <div class="panel-heading">Classtypes</div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Limit</th>
                </tr>
            </thead>
            <tbody>
                {foreach $types as $type}
                <tr>
                    <td>
                        <a class="btn btn-warning btn-xs" href="{Config::BASEURL}eventtypemanager/edit/{$type.idevent_type}">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </a>
                        <a class="btn btn-danger btn-xs" href="{Config::BASEURL}eventtypemanager/delete/{$type.idevent_type}" onclick="return confirm('Are you sure?');">
                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                        </a>
                    </td>
                    <td>{$type.dtname}</td>
                    <td>{if $type.dtlimit}{$type.dtlimit}{else}no limit{/if}</td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
