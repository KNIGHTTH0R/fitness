<div class="panel panel-default">
    <div class="panel-heading">User - {if $user.iduser}Update{else}Create{/if}</div>
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
                <label for="inputTel" class="col-sm-2 control-label">Telephone *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputTel" name="dttel" value="{$user.dttel}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputBirthdate" class="col-sm-2 control-label">Birthdate</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputBirthdate" name="dtbirthdate" placeholder="dd/mm/yyyy" value="{$user.dtbirthdate}" />
                </div>
            </div>
            <hr />
            <div class="form-group">
                <label for="inputStreet" class="col-sm-2 control-label">Street *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputStreet" name="dtstreet" value="{$user.dtstreet}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputCity" class="col-sm-2 control-label">City *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCity" name="dtcity" value="{$user.dtcity}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputZip" class="col-sm-2 control-label">Zip *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputZip" name="dtzip" value="{$user.dtzip}" />
                </div>
            </div>
            <div class="form-group">
                <label for="inputCountry" class="col-sm-2 control-label">Country *</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputCountry" name="dtcountry" value="{$user.dtcountry}" />
                </div>
            </div>
            <hr />
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
            <div class="form-group">
                <label for="inputSubscription" class="col-sm-2 control-label">Subscription</label>
                <div class="col-sm-10">
                    <select class="form-control" id="inputSubscription" name="dtsubscription">
                        <option></option>
                        {foreach $subscriptions as $key => $value}
                        <option value="{$key}"{if $key eq $user.dtsubscription} selected="selected"{/if}>{$value}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {if $user.iduser}
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
                    <button type="submit" class="btn btn-default">{if $user.iduser}Update{else}Create{/if}</button>
                </div>
            </div>
        </form>
    </div>
</div>
