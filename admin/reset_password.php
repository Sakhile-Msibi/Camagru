<?PHP

	require_once('../config/pdo.php');
	session_start();

	function check_existing_adress($pdo, $hash)
	{
		$request = "SELECT * FROM `users`";
		$users = $pdo->query($request);
		if ($users)
		{
			foreach ($users as $user)
			{
				if ($user[5] == $hash)
					return true;
			}
		}
		return false;
	}

	if ((isset($_GET['id']) && check_existing_adress($pdo, $_GET['id'])) || isset($_SESSION['id']))
	{
?>
<HTML>
	<head>
		<link rel="stylesheet" type="text/css" href="../stylesheets/connection.css">
		<meta charset = "UTF-8">
		<?PHP
			if (isset($_GET['value']) && $_GET['value'] == 'success')
				echo "<meta http-equiv='refresh' content=\"5; URL='../index.php\"/>";
		?>
	</head>
	<body>
		<div class="topbar">
			<h1 class="title">Reset your password</h1>
		</div>
		<div class="container">
			<div class="cadre">
				<form class="rfi" action="./reset_password.php" method="post">
					<span class="text">Enter a new password (Min 8 char with at least ONE number and ONE capital letter) *</span><br/>
					<input class="input" type="password" name="password" minlength="8" required><br/>
					<input class="submit" type="submit" value="Change it"><br/>
					<?PHP
						if (isset($_GET['value']) && $_GET['value'] == 'success')
							echo "<br/><center class='good'>Password changed succesfully, you will be redirected to the main page in a few seconds ! :3</center>";
						else if (isset($_GET['value']) && $_GET['value'] == 'fail')
							echo "<br/><center class='wrong'>Error : You need 8 char min with at least one number and one capital letter for your password. :3</center>";
					?>
				</form>
			</div>
		</div>
		<div class="footer">
			<div class="text_footer">&copy 2019 - smsibi</div>
		</div>
	</body>
</HTML>
<?PHP
	if (isset($_POST['password']))
	{
		if (strlen($_POST['password']) > 7 && preg_match('/\d/', $_POST['password']) === 1 && preg_match('/[A-Z]/', $_POST['password']) === 1)
		{
			$id = $_SESSION['id'];
			$password = hash('whirlpool', $_POST['password']);
			$request = "UPDATE `users` SET password='$password', hash_mail='null' WHERE hash_mail='$id'";
			unset($_SESSION['id_user']);
			unset($_SESSION['user']);
			$pdo->exec($request);
?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./reset_password.php?value=success'"/>
				</head>
			</HTML>
			<?PHP
			return ;
		}
		else
		{
			$_SESSION['id'] = $_GET['id'];
			?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./reset_password.php?id=<?php $_SESSION['id']?>&value=fail'"/>
				</head>
			</HTML>
			<?PHP
			return ;
		}
	}
	else
		$_SESSION['id'] = $_GET['id'];
	}
	else
		echo "This page does not exist anymore, sorry. (;";
?>
