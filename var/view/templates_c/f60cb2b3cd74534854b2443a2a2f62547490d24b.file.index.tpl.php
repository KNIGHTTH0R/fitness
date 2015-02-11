<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 19:30:36
         compiled from "/var/www/fitness/templates/home/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:183894118654d7ab4c7320c3-05120903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f60cb2b3cd74534854b2443a2a2f62547490d24b' => 
    array (
      0 => '/var/www/fitness/templates/home/index.tpl',
      1 => 1390317408,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '183894118654d7ab4c7320c3-05120903',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'search' => 0,
    'addlink' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d7ab4c742ca3_44539968',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d7ab4c742ca3_44539968')) {function content_54d7ab4c742ca3_44539968($_smarty_tpl) {?><div id="Search">
	<?php echo $_smarty_tpl->tpl_vars['search']->value;?>

</div>
<a href="<?php echo $_smarty_tpl->tpl_vars['addlink']->value;?>
" class="button">Ajouter un nouveau mémoire</a><?php }} ?>
