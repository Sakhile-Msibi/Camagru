<?PHP

	include 'database.php';

	try
	{
		$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE $db_name";
		$conn->exec($sql);
		echo "Database deleted successfully<br>";
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;

?>
