<?PHP

	function signup($mail, $username, $password, $host)
	{
		include_once '../config/database.php';
		include_once 'mail.php';

		$mail = strtolower($mail);

		try
		{
			$conn = new PDO("mysql:host=$db_serverhost", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT id FROM $db_name.users WHERE username=:username OR mail=:mail");
			$sql->execute(array(':username' => $username, ':mail' => $mail));

			if ($val = $sql->fetch())
			{
				$_SESSION['error'] = "user already exist";
				$sql->closeCursor();
				return(-1);
			}
			$sql->closeCursor();

			// encrypt password
			$password = hash("whirlpool", $password);

			$sql= $conn->prepare("INSERT INTO $db_name.users (username, mail, password, token) VALUES (:username, :mail, :password, :token)");
			$token = uniqid(rand(), true);
			$sql->execute(array(':username' => $username, ':mail' => $mail, ':password' => $password, ':token' => $token));
			send_verification_email($mail, $username, $token, $host);
			$_SESSION['signup_success'] = true;
			return (0);
		}
		catch (PDOException $e)
		{
			$_SESSION['error'] = "ERROR: ".$e->getMessage();
		}
	}

?>
