<?PHP

	include 'database.php';
	try
	{
		$conn = new PDO("mysql:$db_serverhost;dbname=$db_name", $db_username, $db_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully";
	}
	catch (PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

?>
