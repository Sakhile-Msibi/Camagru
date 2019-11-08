<?PHP

	function log_user($userMail, $password)
	{
  		include_once '../config/database.php';

  		try
		{
			$conn = new PDO("mysql:host=$db_serverhost", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT id, username FROM $db_name.users WHERE mail=:mail AND password=:password AND verified='Y'");
			$userMail = strtolower($userMail);
			$password = hash("whirlpool", $password);
			$sql->execute(array(':mail' => $userMail, ':password' => $password));

			$val = $sql->fetch();
			if ($val == null)
			{
				$sql->closeCursor();
				return (-1);
			}
			$sql->closeCursor();

			return ($val);
		}
		catch (PDOException $e)
		{
			$v['err'] = $e->getMessage();
			return ($v);
		}
	}

?>
