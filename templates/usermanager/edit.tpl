<div class="panel panel-default">
    <div class="panel-heading">User - {if $user}Update{else}Create{/if}</div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="{Config::BASEURL}usermanager/save/{$user.iduser}">
            <div class="form-group">
                <label for="inputLastName" class="col-sm-2 control-label">Last name *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputLastName" name="dtlast_name" value="{$user.dtlast_name}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputFirstName" class="col-sm-2 control-label">First name *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputFirstName" name="dtfirst_name" value="{$user.dtfirst_name}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">E-Mail *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail" name="dtemail" value="{$user.dtemail}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputBirthdate" class="col-sm-2 control-label">Birthdate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputBirthdate" name="dtbirthdate" placeholder="dd/mm/yyyy" value="{$user.dtbirthdate}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputUserType" class="col-sm-2 control-label">User type</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputUserType" name="dttype">
                        <option></option>
                        {foreach $types as $key => $value}
                        <option value="{$key}"{if $key eq $user.dttype} selected="selected"{/if}>{$value}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {if $user}
            <hr />
            <p>
                Only fill in password if you want to change it.
            </p>
            {/if}
            <div class="form-group">
                <label for="inputPassword" class="col-sm-2 control-label">Password *</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword" name="dtpassword" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword2" class="col-sm-2 control-label">Repeat password *</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword2" name="dtpassword2" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">{if $user}Update{else}Create{/if}</button>
                </div>
            </div>
        </form>
    </div>
</div>
