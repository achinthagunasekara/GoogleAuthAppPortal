<?php /* Smarty version Smarty-3.0.8, created on 2014-07-30 14:55:36
         compiled from "C:\Program Files (x86)\Apache Software Foundation\Apache2.2\htdocs\GoogleAuthAppPortal/templates\go.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1756653d87ac8da6e45-52344543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c4cc9e22c10e592aacb175bc1d0a21b67a182e2' => 
    array (
      0 => 'C:\\Program Files (x86)\\Apache Software Foundation\\Apache2.2\\htdocs\\GoogleAuthAppPortal/templates\\go.tpl',
      1 => 1406695263,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1756653d87ac8da6e45-52344543',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="grid_12">

	<ul class="tabs">
		<li><a href="#tab1">Login</a></li>
	</ul>

	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<form action="index.php?page=go" method="post">
			<input type="hidden" name="go" value="true">
			<center>
				<?php if ($_smarty_tpl->getVariable('message')->value!=''){?>
					<span style="color: red"><?php echo $_smarty_tpl->getVariable('message')->value;?>
</span><br>
					<br/>
					<br/>
				<?php }?>
				<table>
					<tr>
						<td>User Name</td><td><input type="text" name="user_name"/></td>
					</tr>
					<tr>
						<td>Password</td><td><input name="password"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" value="Multiply"/></td>
					</tr>
				</table>
			</center>
			</form>
		</div>
	</div>
	
</div>