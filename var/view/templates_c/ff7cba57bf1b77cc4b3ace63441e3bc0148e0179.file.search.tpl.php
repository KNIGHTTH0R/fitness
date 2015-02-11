<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-02-08 19:30:36
         compiled from "/var/www/fitness/templates/thesis/search.tpl" */ ?>
<?php /*%%SmartyHeaderCode:132119952854d7ab4c4aa668-63633429%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff7cba57bf1b77cc4b3ace63441e3bc0148e0179' => 
    array (
      0 => '/var/www/fitness/templates/thesis/search.tpl',
      1 => 1362581841,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '132119952854d7ab4c4aa668-63633429',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'search' => 0,
    'options' => 0,
    'item' => 0,
    'results' => 0,
    'result' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_54d7ab4c721a41_51071280',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_54d7ab4c721a41_51071280')) {function content_54d7ab4c721a41_51071280($_smarty_tpl) {?><div class="form page search">
	<form method="POST">
		<div class="formline">
			<input name="dtsearch" type="text" placeholder="Recherche" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['search']->value['dtsearch'])===null||$tmp==='' ? '' : $tmp);?>
" />
			<select name="fikeyword" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['search']->value['fikeyword'])===null||$tmp==='' ? 0 : $tmp);?>
" data-dojo-type="dijit/form/FilteringSelect">
				<option value="0">Mot clé</option>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['options']->value['fikeyword']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</option>
				<?php } ?>
			</select>
			<select name="fiuniversity" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['search']->value['fiuniversity'])===null||$tmp==='' ? 0 : $tmp);?>
" data-dojo-type="dijit/form/FilteringSelect">
				<option value="0">Université</option>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['options']->value['fiuniversity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['value'];?>
</option>
				<?php } ?>
			</select>
			<input name="search" type="submit" value="Recherche" />
		</div>
	</form>
</div>

<?php if ((($tmp = @$_smarty_tpl->tpl_vars['results']->value)===null||$tmp==='' ? false : $tmp)) {?>
<table class="thesis">
	<tr>
		<th>Auteur</th>
		<th>Année</th>
		<th>Titre</th>
		<th>Université</th>
		<th>Ville</th>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['result'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['result']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['results']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['result']->key => $_smarty_tpl->tpl_vars['result']->value) {
$_smarty_tpl->tpl_vars['result']->_loop = true;
?>
	<tr class="result" onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['result']->value['link'];?>
'">
		<td><?php echo $_smarty_tpl->tpl_vars['result']->value['dtname'];?>
 <?php echo $_smarty_tpl->tpl_vars['result']->value['dtfirstname'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['result']->value['dtyear'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['result']->value['dttitle'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['result']->value['dtuniversity'];?>
</td>
		<td><?php echo $_smarty_tpl->tpl_vars['result']->value['dtcity'];?>
</td>
	</tr>
	<?php } ?>
</table>
<?php }?><?php }} ?>
