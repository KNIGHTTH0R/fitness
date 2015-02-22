<!DOCTYPE html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<title>{$title|default:''}</title>
		<link rel="shortcut icon" href="{Config::BASEURL}files/image/favicon.png" type="image/png" />
		<link rel="icon" href="{Config::BASEURL}files/image/favicon.png" type="image/png" />
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
		{$menu}

		<div class="container">
			{include file='sub-menu.tpl'}
			{$message}
			{$content}
		</div>
	</body>
</html>
