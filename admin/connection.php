<HTML>
	<head>
		<link rel="stylesheet" type="text/css" href="../stylesheets/connection.css">
		<meta charset = "UTF-8">
	</head>
	<body>
		<div class="topbar">
			<h1 class="title">Sign in!</h1>
		</div>
		<div class="container">
			<div class="cadre">
				<form class="rfi" action="./connection.php" method="post">
					<span class="text">Username *</span><br/>
					<input class="input" type="text" name="name" maxlength="20" required><br/>
					<span class="text">Password *</span><br/>
					<input class="input" type="password" name="password" required><br/>
					<input class="submit" type="submit" value="Connect"><br/>
					<?PHP
						if (isset($_GET['id']) && $_GET['id'] == 'incorrect')
							echo "<center class='wrong''>Connection failed, verify your name/password. Be sure you validated your account first.</center>";
					?>
				</form><br/>
				<form class="password_forgot" action="./connection.php" method="post">
					<input class="submit" type="submit" name="forgot" value="Forgot password ?">
					<?PHP
						if (isset($_GET['id']) && $_GET['id'] == 'forgot')
						{
							echo "<br/><form action='./connection.php' method='post'>
								  <span class='text'>Enter your email address *</span><br/>
								  <input class='input' type='email' name='email' required>
								  <input class='submit' type='submit' value='Get my reset email'>
								  </form>";
							if (isset($_GET['check']) && $_GET['check'] == 'error')
								echo "<center class='wrong' style='width: 45%'>Unfortunately, this account does not exist. Are you sure you have validated it?
									  Or perhaps you wrote your address incorrectly</center>";
						}
						else if (isset($_GET['check']) && $_GET['check'] == 'mail')
							echo "<center class='good'>Please check your emails to reset your password, do not forget to check your unwanted emails (:<center>";
						else if (isset($_GET['check']) && $_GET['check'] == 'fail')
							echo "<center class='wrong''>Unfortunately, the email can not be sent.. ):<center>";
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
						
	session_start();
	require_once('../config/pdo.php');

	function check_existing_user($pdo, $name, $password)
	{
		$request = "SELECT * FROM `users`";
		$users = $pdo->query($request);
		if ($users)
		{
			foreach ($users as $user)
			{
				if ($user[1] == $name && $user[2] == hash('whirlpool', $password) && $user[6] == 1)
					return true;
			}
		}
		return false;
	}

	
	function check_existing_adress($pdo, $adress)
	{
		$request = "SELECT * FROM `users`";
		$users = $pdo->query($request);
		if ($users)
		{
			foreach ($users as $user)
			{
				if ($user[3] == $adress && $user[6] == 1)
					return true;
			}
		}
		return false;
	}

	function send_mail($pdo, $adress)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers .= 'From: <thembinkosimsibi198@gmail.com>' . "\r\n";
		$cpyadress = $adress.time();
		$hash = hash('whirlpool', $cpyadress);
		$request = "UPDATE `users` SET hash_mail='$hash' WHERE email='$adress'";
		$pdo->exec($request);
		$lien = "http://127.0.0.1/camagru/admin/reset_password.php?id=".$hash;
		$message = "Welcome back !\r\n\nIt seems like you forgot your password. If you need to change it, please click on the link below :\r\n".$lien." ! \r\n\nSee you soon :D";
		$subject = "Forgotten password for Camagru";
		$to = $adress;
		if (mail($to, $subject, utf8_decode($message), $headers))
		{
?>

			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./connection.php?check=mail'"/>
				</head>
			</HTML>
			<?PHP
		}
		else
		{
			?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./connection.php?check=fail'"/>
				</head>
			</HTML>
			<?PHP
		}
	}

	if (isset($_POST['email']))
	{
		if (check_existing_adress($pdo, $_POST['email']))
		{
			send_mail($pdo, $_POST['email']);
		}
		else
		{
			?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./connection.php?id=forgot&check=error'"/>
				</head>
			</HTML>
			<?PHP
		}
	}

	if (isset($_POST['name']) && isset($_POST['password']))
	{
		if (check_existing_user($pdo, $_POST['name'], $_POST['password']))
		{
			$name = $_POST['name'];
			$request = $pdo->prepare("SELECT id FROM `users` WHERE name=:name");
			$params = array(':name' => $name);
			$request->execute($params);
			$_SESSION['id_user'] = $request->fetch()[0];
			$_SESSION['user'] = $name;
			?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='../index.php'"/>
				</head>
			</HTML>
			<?PHP
		}
		else
		{
			?>
			<HTML>
				<head>
					<meta http-equiv="refresh" content="0; URL='./connection.php?id=incorrect'"/>
				</head>
			</HTML>
			<?PHP
		}
	}

	if (isset($_POST['forgot']))
	{
			?>
		<HTML>
			<head>
				<meta http-equiv="refresh" content="0; URL='./connection.php?id=forgot"/>
			</head>
		</HTML>
			<?PHP
	}
			?>
