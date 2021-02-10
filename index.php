
<?PHP
	session_start();
	require_once("config/pdo.php");
?>
<HTML>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheets/index.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<meta charset = "UTF-8">
	</head>
	<body>
		<div id='transparant' onClick='hide_div()'></div>
		<div class="topbar">
			<h1 class="title">CAMAGRU</h1>
			<div class="container">
			<?PHP
			if (isset($_SESSION['id_user']))
			{?>
				<a class="text" href="montage/montage.php"><button class="button_top">Gallery</button></a>
				<a class="text" href="edit_user/profile.php"><button class="button_top"><?php echo htmlspecialchars($_SESSION['user']) ?></button></a>
				<a class="text" href="admin/disconnect.php"><button class="button_top">Logout</button></a>
			<?PHP }
			else
			{ ?>
				<button class="button_top">Home</button>
				<div class="container-child">
					<a class="text" href="admin/connection.php">Sign in !</a>
					<a class="text" href="admin/registration.php">Create account</a>
				</div>
			<?PHP } ?>
			</div>
		</div>
		<div class="container_pictures">
			<?PHP require('pictures.php') ?>
		</div>
		<div class="container_pagination">
			<?PHP require('pagination.php') ?>
		</div>
			<?PHP require('dialogbox.php') ?>
		<div class="footer">
			<div class="text_footer">&copy 2019 - smsibi</div>
		</div>
	</body>
</HTML>
