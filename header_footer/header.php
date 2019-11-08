<div id="header">
	<?PHP
		if (isset($_SESSION['id']))
		{ ?>
			<div class="button" onclick="location.href='forms/logout.php'">
				<span>
					Logout
				</span>
			</div>
		<?PHP }
		else
		{ ?>
			<div class="button" onclick="location.href='index.php'">
				<span>
					Login
				</span>
			</div>
	<?PHP } ?>
	<?PHP
		if (isset($_SESSION['id']))
		{ ?>
			<div class="button" onclick="location.href='gallery.php'">
				<span>
					Gallery
				</span>
			</div>
			<div class="button" onclick="location.href='views.php'">
				<span>
					Views
				</span>
			</div>
	<?PHP } ?>
</div>
