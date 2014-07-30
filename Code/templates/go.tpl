<div class="grid_12">

	<ul class="tabs">
		<li><a href="#tab1">Login</a></li>
	</ul>

	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<form action="index.php?page=go" method="post">
			<input type="hidden" name="go" value="true">
			<center>
				{if $message != ""}
					<span style="color: red">{$message}</span><br>
					<br/>
					<br/>
				{/if}
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