<?PHP

	include 'database.php';

	try
	{
		$conn =  new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DROP DATABASE $DB_NAME";
		$conn->exec($sql);
		echo "Database deleted successfully<br>";
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;

?>
