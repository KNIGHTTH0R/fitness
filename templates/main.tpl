<!DOCTYPE html>
<html lang="{$lang}">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		<title>{$title|default:''}</title>
		<link rel="shortcut icon" href="{Config::BASEURL}files/image/favicon.png" type="image/png" />
		<link rel="icon" href="{Config::BASEURL}files/image/favicon.png" type="image/png" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/bootstrap/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/bootstrap/bootstrap-theme.min.css" />
		<link rel="stylesheet" type="text/css" href="{Config::BASEURL}css/main.css" />
		<script src="{Config::BASEURL}js/jquery/jquery-2.1.3.min.js"></script>
		<script src="{Config::BASEURL}js/bootstrap/bootstrap.min.js"></script>
		<script>
			var dojoConfig = {
			    isDebug: {if {Config::DEBUG}}true{else}false{/if},
			    async: true,
			    app: {
			        baseUri: '{Config::BASEURL}'
			    }
			};
		</script>
		<script src="{Config::BASEURL}js/dojo/dojo.js"></script>
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
