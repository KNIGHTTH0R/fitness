<!DOCTYPE html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>{$title|default:''}</title>
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}js/dijit/themes/tundra/tundra.css" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/bootstrap/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/bootstrap/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/main.css" />
		<script src="{Config::BASEURL}js/dojo/dojo.js" data-dojo-config="async: true"></script>
		<script src="{Config::BASEURL}js/main.js"></script>
	</head>
	<body class="tundra">
		<div class="container">
			<img id="Logo" src="{Config::BASEURL}files/image/logo.jpg" />
		</div>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<a class="navbar-brand" href="{Config::BASEURL}">Fitness-Lounge</a>
				</div>
				<ul class="nav navbar-nav navbar-right">
				{if $smarty.session.auth|default:false}
					<li><a href="{Config::BASEURL}auth/logout">Logout</a></li>
				{else}
					<li><a href="{Config::BASEURL}auth/login">Login</a></li>
				{/if}
				</ul>
			</div>
		</nav>
		<div class="container">
			{$content}
		</div>
	</body>
</html>
