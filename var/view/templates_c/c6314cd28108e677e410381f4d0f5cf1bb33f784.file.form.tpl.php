<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-09 20:19:32
         compiled from "/var/www/fitness/templates/login/form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:210126221054d7aca7b790a6-15404844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6314cd28108e677e410381f4d0f5cf1bb33f784' => 
    array (
      0 => '/var/www/fitness/templates/login/form.tpl',
      1 => 1423509563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '210126221054d7aca7b790a6-15404844',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d7aca7bc9d62_97008420',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d7aca7bc9d62_97008420')) {function content_54d7aca7bc9d62_97008420($_smarty_tpl) {?><form method="POST" class="login">
	<div class="form-group">
		<label for="username">ID or E-Mail</label>
		<input class="form-control" type="text" name="username" id="username" />
	</div>
	<div class="form-group">
		<label for="password">Password</label>
		<input class="form-control" type="password" name="password" id="password" />
	</div>
	<input type="submit" class="btn btn-default" value="Login" />
</form>
<?php }} ?>
