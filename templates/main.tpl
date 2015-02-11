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
		<div class="container-fluid">
			{$content}
		</div>
	</body>
</html>
