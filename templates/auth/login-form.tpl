<form method="POST" class="auth-login">
	<div class="form-group">
		<input class="form-control" type="text" name="login[username]" value="{$smarty.post.login.username}" placeholder="ID or E-Mail" autofocus="autofocus" />
	</div>
	<div class="form-group">
		<input class="form-control" type="password" name="login[password]" value="{$smarty.post.login.password}" placeholder="Password" />
	</div>
	<input type="submit" class="btn btn-primary btn-block" value="Login" />
</form>
