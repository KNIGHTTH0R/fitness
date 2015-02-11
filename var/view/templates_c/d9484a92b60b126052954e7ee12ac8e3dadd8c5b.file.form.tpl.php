<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-11 20:02:45
         compiled from "C:\XAMPP\htdocs\fitness\templates\login\form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:361854dba755d03b42-55821753%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9484a92b60b126052954e7ee12ac8e3dadd8c5b' => 
    array (
      0 => 'C:\\XAMPP\\htdocs\\fitness\\templates\\login\\form.tpl',
      1 => 1423509563,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '361854dba755d03b42-55821753',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54dba755d867d5_91475323',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54dba755d867d5_91475323')) {function content_54dba755d867d5_91475323($_smarty_tpl) {?><form method="POST" class="login">
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
