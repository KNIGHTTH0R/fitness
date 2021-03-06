<form method="POST" class="form-horizontal auth-register">
    <div class="form-group">
		<label for="register_lastName" class="col-sm-4 control-label">Last name *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[lastName]" value="{$smarty.post.register.lastName}" id="register_lastName" />
	    </div>
    </div>
	<div class="form-group">
		<label for="register_firstName" class="col-sm-4 control-label">First name *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[firstName]" value="{$smarty.post.register.firstName}" id="register_firstName" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_eMail" class="col-sm-4 control-label">E-Mail *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[eMail]" value="{$smarty.post.register.eMail}" id="register_eMail" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_tel" class="col-sm-4 control-label">Telephone *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[tel]" value="{$smarty.post.register.tel}" id="register_tel" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_birthdate" class="col-sm-4 control-label">Birthdate</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[birthdate]" placeholder="dd/mm/yyyy" value="{$smarty.post.register.birthdate}" id="register_birthdate" />
	    </div>
    </div>
    <hr />
    <div class="form-group">
		<label for="register_street" class="col-sm-4 control-label">Street *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[street]" value="{$smarty.post.register.street}" id="register_street" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_city" class="col-sm-4 control-label">City *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[city]" value="{$smarty.post.register.city}" id="register_city" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_zip" class="col-sm-4 control-label">Zip *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[zip]" value="{$smarty.post.register.zip}" id="register_zip" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_country" class="col-sm-4 control-label">Country *</label>
        <div class="col-sm-8">
            <input class="form-control" type="text" name="register[country]" value="{$smarty.post.register.country}" id="register_country" />
	    </div>
    </div>
    <hr />
	<div class="form-group">
		<label for="register_password" class="col-sm-4 control-label">Password *</label>
        <div class="col-sm-8">
            <input class="form-control" type="password" name="register[password]" id="register_password" />
	    </div>
    </div>
    <div class="form-group">
		<label for="register_password2" class="col-sm-4 control-label">Repeat password *</label>
        <div class="col-sm-8">
            <input class="form-control" type="password" name="register[password2]" id="register_password2" />
	    </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <input type="submit" class="btn btn-primary" value="Register" />
        </div>
    </div>
</form>
