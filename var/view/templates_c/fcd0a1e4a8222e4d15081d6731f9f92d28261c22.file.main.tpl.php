<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-11 20:02:45
         compiled from "C:\XAMPP\htdocs\fitness\templates\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:427554dba755d9e394-51968421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fcd0a1e4a8222e4d15081d6731f9f92d28261c22' => 
    array (
      0 => 'C:\\XAMPP\\htdocs\\fitness\\templates\\main.tpl',
      1 => 1423509377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '427554dba755d9e394-51968421',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'lang' => 0,
    'title' => 0,
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54dba755dd8bc0_86289968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54dba755dd8bc0_86289968')) {function content_54dba755dd8bc0_86289968($_smarty_tpl) {?><!DOCTYPE html>
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
