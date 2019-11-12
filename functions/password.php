<?PHP

	function reset_password($userMail)
	{
		include_once '../config/database.php';
		include_once 'mail.php';

		try
		{
			$conn = new PDO("mysql:host=$db_serverhost", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT id, username FROM $db_name.users WHERE mail=:mail AND verified='Y'");
			$userMail = strtolower($userMail);
			$sql->execute(array(':mail' => $userMail));

			$val = $sql->fetch();
			if ($val == null)
			{
				$sql->closeCursor();
				return (-1);
			}
			$sql->closeCursor();

			$pass = uniqid('');
			$passEncrypt = hash("whirlpool", $pass);

			$sql= $conn->prepare("UPDATE $db_name.users SET password=:password WHERE mail=:mail");
			$sql->execute(array(':password' => $passEncrypt, ':mail' => $userMail));
			$sql->closeCursor();

			send_forget_mail($userMail, $val['username'], $pass);
			return (0);
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}

?>
