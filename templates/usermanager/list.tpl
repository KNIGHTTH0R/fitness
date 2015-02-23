<div class="panel panel-default">
    <div class="panel-heading">Users</div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Birthdate</th>
                </tr>
            </thead>
            <tbody>
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
                    <td>{$user.dtemail}</td>
                    <td>{$user.dttel}</td>
                    <td>{$user.dtbirthdate}</td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
</div>
