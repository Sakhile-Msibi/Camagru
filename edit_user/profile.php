<?PHP

	require_once('../config/pdo.php');
	session_start();
	
	if (isset($_SESSION['user']))
	{ ?>

		<HTML>
			<head>
				<link rel="stylesheet" type="text/css" href="../stylesheets/index.css">
				<link rel="stylesheet" type="text/css" href="../stylesheets/profile.css">
				<meta charset = "UTF-8">
			</head>
			<body>
				<div class="topbar">
					<h1 class="title">Profile</h1>
					<div class="container">
						<a class="text" href="../index.php"><button class="button_top">Gallery</button></a>
						<a class="text" href="../montage/montage.php"><button class="button_top">Picture</button></a>
						<a class="text" href="../admin/disconnect.php"><button class="button_top">Logout</button></a>
					</div>
				</div>
				<div class="container_cadre">
					<div class="cadre">
						<form class="rfi" action="./next.php" method="post">
							<span class="text">New username</span><br/>
							<input class="input" type="text" name="new_name" maxlength="20"><br/>
							<span class="text">New email address</span><br/>
							<input class="input" type="email" name="new_email" maxlength="50"><br/>
							<span class="text">New password (Min 8 char with at least ONE number and ONE capital letter)</span><br/>
							<input class="input" type="password" name="new_password" minlength="8"><br/>
							<span class="text">Current password*</span><br/>
							<input class="input" type="password" name="last_password" required>
							<?PHP
								$id = $_SESSION['id_user'];
								$request = "SELECT notif FROM `users` WHERE id='$id'";
								$notif = $pdo->query($request)->fetch()[0];
								if ($notif == '0')
								{
									echo "<input type='checkbox' name='notif' class='desactivate' unchecked>Deactivate comment notification<br/>";
								}
								else if ($notif == '1')
								{
									echo "<input type='checkbox' name='notif' class='desactivate' checked>Deactivate comment notification<br/>";
								}
							?>
							<input class="submit" type="submit" value="Edit"><br/>
							<?PHP
								if (isset($_GET['id']) && $_GET['id'] == 'success')
									echo "<br/><center class='good'>Informations changed succesfully ! :3</center>";
								if (isset($_GET['id']) && $_GET['id'] == 'password')
									echo "<br/><center class='wrong'>Wrong password.</center>";
								if (isset($_GET['id']) && $_GET['id'] == 'fail')
									echo "<br/><center class='wrong'>These credentials are already taken or invalid.</center>";
								if (isset($_GET['id']) && $_GET['id'] == 'same')
									echo "<br/><center class='wrong'>You must change to a different password.</center>";
							?>

						</form>
					</div>
				</div>
				<div class="footer">
					<div class="text_footer">&copy 2019 - smsibi</div>
				</div>
			</body>
		</HTML>
	<?PHP }
	else
	{
		echo "You need to sign in to access this page. (;";
	}

?>
