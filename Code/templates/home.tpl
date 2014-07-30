<div class="grid_12">

	<form action="index.php?page=home" method="post">
		<input type="hidden" name="logout" value="true">
		<div class="grid_2" style="float:right;">Logged In: {$user_name} <input type="submit" value="Log Out"/></div>
	</form>

	<ul class="tabs">
		<li><a href="#tab1">Your Apps</a></li>
	</ul>
	
	<div class="tab_container">
		<div id="tab1" class="tab_content">
			<div class="grid_8">
				<a href="index.php?page=rdweb" target="_blank">
					<img src="images/web_rd.png" alt="Your App"><br>
					<p style="margin-left:40px;">Your App</p>
				</a>
			</div>
		</div>
	</div>
	
</div>