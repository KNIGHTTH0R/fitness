<form method="POST" class="auth-login">
	<div class="form-group">
		<label for="username">ID or E-Mail</label>
		<input class="form-control" type="text" name="username" id="username" />
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input class="form-control" type="password" name="password" id="password" />
	</div>
	<input type="submit" class="btn btn-default" value="Login" />
	<a class="btn btn-default" href="{Config::BASEURL}auth/register">Create new account</a>
</form>
