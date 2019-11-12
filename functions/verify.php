<?PHP

	function verify($token)
	{
		include_once './config/database.php';
		
		try
		{
			$conn = new PDO("mysql:host=$db_serverhost",$db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT id FROM $db_name.users WHERE token=:token");
			$sql->execute(array(':token' => $token));

			$val = $sql->fetch();
			if ($val == null)
			{
				return (-1);
			}
			$sql->closeCursor();

			$sql= $conn->prepare("UPDATE $db_name.users SET verified='Y' WHERE id=:id");
			$sql->execute(array('id' => $val['id']));
			$sql->closeCursor();
			return (0);
		}
		catch (PDOException $e)
		{
			return (-2);
		}
	}

?>
