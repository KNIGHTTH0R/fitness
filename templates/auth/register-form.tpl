<form method="POST" class="auth-register">
    <div class="form-group">
		<label for="register_lastName">Last name</label>
		<input class="form-control" type="text" name="register[lastName]" id="register_lastName" />
	</div>
	<div class="form-group">
		<label for="register_firstName">First name</label>
		<input class="form-control" type="text" name="register[firstName]" id="register_firstName" />
	</div>
    <div class="form-group">
		<label for="register_eMail">E-Mail</label>
		<input class="form-control" type="text" name="register[eMail]" id="register_eMail" />
	</div>
	<div class="form-group">
		<label for="register_password">Password</label>
		<input class="form-control" type="password" name="register[password]" id="register_password" />
	</div>
    <div class="form-group">
		<label for="register_password2">Repeat password</label>
		<input class="form-control" type="password" name="register[password2]" id="register_password2" />
	</div>
	<input type="submit" class="btn btn-default" value="Register" />
</form>
