<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-09 20:19:33
         compiled from "/var/www/fitness/templates/main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132398804354d7ab4c749663-28278687%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ff3fb365b88969138c534a4c1d8dc72110f0088' => 
    array (
      0 => '/var/www/fitness/templates/main.tpl',
      1 => 1423509377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132398804354d7ab4c749663-28278687',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d7ab4c77ca78_39714630',
  'variables' => 
  array (
    'lang' => 0,
    'title' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d7ab4c77ca78_39714630')) {function content_54d7ab4c77ca78_39714630($_smarty_tpl) {?><!DOCTYPE html>
<html lang="<?php echo $_smarty_tpl->tpl_vars['lang']->value;?>
">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['title']->value)===null||$tmp==='' ? '' : $tmp);?>
</title>
		<link rel="stylesheet" type="text/css" href="<?php echo Config::BASEURL;?>
js/dijit/themes/tundra/tundra.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Config::BASEURL;?>
css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Config::BASEURL;?>
css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo Config::BASEURL;?>
css/main.css" />
		<?php echo '<script'; ?>
 src="<?php echo Config::BASEURL;?>
js/dojo/dojo.js" data-dojo-config="async: true"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo Config::BASEURL;?>
js/main.js"><?php echo '</script'; ?>
>
	</head>
	<body class="tundra">
		<div class="container-fluid">
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		</div>
	</body>
</html>
<?php }} ?>
