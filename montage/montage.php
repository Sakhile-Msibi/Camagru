<?PHP
	error_reporting(-1);
	ini_set('display_errors', 'true');


	session_start();
	require_once("../config/pdo.php");

	if (isset($_SESSION['user']))
	{ ?>
	<!DOCTYPE html>
		<HTML>
			<head>
				<link rel="stylesheet" type="text/css" href="../stylesheets/index.css">
				<link rel="stylesheet" type="text/css" href="../stylesheets/montage.css">
				<meta charset = "UTF-8">
			</head>
			<body>
				<div class="topbar">
					<h1 class="title">Photo booth</h1>
					<div class="container">
						<a class="text" href="../index.php"><button class="button_top">Gallery</button></a>
						<a class="text" href="../edit_user/profile.php"><button class="button_top"><?PHP echo htmlspecialchars($_SESSION['user']) ?></button></a>
						<a class="text" href="../admin/disconnect.php"><button class="button_top">Logout</button></a>
					</div>
				</div>
				<div class="container_body">
					<div class="video">
						<?PHP require('filters.php') ?>
						<?PHP require('webcam.php') ?>
					</div>
					<div class="image">
						<?PHP require('gallery.php'); ?>
					</div>
				</div>
			</body>
			<div class="footer">
				<div class="text_footer">&copy 2019 - smsibi</div>
			</div>
		</HTML>
	<?PHP }
	else
	{
		echo "First sign in to access this page.";
	}

?>
