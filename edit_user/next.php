<?PHP

	require_once('../config/pdo.php');
	session_start();

	function check_not_existing_user($pdo, $index, $value)
	{
		$request = $pdo->prepare("SELECT COUNT(*) FROM `users` WHERE $index=:value");
		$params = array(':value' => $value);
		$request->execute($params);
		$users = $request->fetch();
		if ($users[0] > 0)
			return false;
		return true;
	}

	if (isset($_SESSION['user']))
	{
		$value = "";
		$new_name = "";

		if (isset($_POST['new_name']) && $_POST['new_name'] != null)
		{
			if (strlen($_POST['new_name']) < 21 && check_not_existing_user($pdo, 'name', $_POST['new_name']))
			{
				$new_name = $_POST['new_name'];
				$value = $value."name=:name";
			}
			else
			{
?>
	<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=fail'"/> </head> </HTML>
			<?PHP
				return;
			}
		}

		if (isset($_POST['new_email']) && $_POST['new_email'] != null)
		{
			if (strlen($_POST['new_email']) < 51 && check_not_existing_user($pdo, 'email', $_POST['new_email']))
			{
				$new_email = $_POST['new_email'];
				if (!empty($value))
					$value = $value.", ";
				$value = $value."email=:email";
			}
			else
			{
			?>
			<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=fail'"/> </head> </HTML>
			<?PHP
				return;
			}
		}

		if (isset($_POST['new_password']) && $_POST['new_password'] != null)
		{
			if (strlen($_POST['new_password']) > 7 && preg_match('/\d/', $_POST['new_password']) === 1 && preg_match('/[A-Z]/', $_POST['new_password']) === 1)
			{
				$id = $_SESSION['id_user'];
				$request = "SELECT * FROM `users` WHERE id='$id'";
				$infos = $pdo->query($request);
				if ($infos->fetch()[2] != hash('whirlpool', $_POST['new_password']))
				{
					$new_password = hash('whirlpool', $_POST['new_password']);
					if (!empty($value))
						$value = $value.", ";
					$value = $value."password='$new_password'";
				}
				else
				{
			?>
?>
			<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=same'"/> </head> </HTML>
				<?PHP
					return;
				}
			}
			else
			{
			?>
			<head>
				<meta http-equiv="refresh" content="0; URL='./profile.php?id=password'"/>
			</head>
           <?PHP
				return ;
			}
		}

		if ($value != "")
		{
			$name = $_SESSION['user'];
			$id = $_SESSION['id_user'];
			$actual_password = hash('whirlpool', $_POST['last_password']);
			$request = "SELECT password FROM `users` WHERE id='$id'";
			$user_password = $pdo->query($request)->fetch()[0];
			if ($user_password != $actual_password)
			{
			?>
				<HTML> <head> <meta http-equiv='refresh' content="0; URL='./profile.php?id=password'"/> </head> </HTML>
			<?PHP
				return;
			}
			$request = $pdo->prepare("UPDATE `users` SET $value WHERE id='$id' AND password='$actual_password'");
			if (!empty($_POST['new_name']))
			{
				$_SESSION['user'] = $_POST['new_name'];
				$request->bindParam(':name', $new_name);
				$new_name = $_POST['new_name'];
			}
			if (!empty($_POST['new_email']))
			{
				$request->bindParam(':email', $mail);
				$mail = $_POST['new_email'];
			}
			$request->execute();
			?>
			<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=success'"/> </head> </HTML>
			<?PHP
			return;
		}

		if (isset($_POST['notif']))
		{
			$id = $_SESSION['id_user'];
			$request = "UPDATE `users` SET notif='1' WHERE id='$id'";
			$pdo->exec($request);
			?>
			<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=success'"/> </head> </HTML>
			<?PHP
			return;
		}
		else
		{
			$id = $_SESSION['id_user'];
			$request = "UPDATE `users` SET notif='0' WHERE id='$id'";
			$pdo->exec($request);
			?>
			<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php?id=success'"/> </head> </HTML>
			<?PHP
			return;
		}
	}
	else
	{
			?>
		<HTML> <head> <meta http-equiv="refresh" content="0; URL='./profile.php'"/> </head> </HTML>
		<?PHP
		return;
	}
		?>
