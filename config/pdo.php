<?PHP

	require_once('database.php');

	try
	{
		$pdo = new PDO($DB_NEW_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $error)
	{
		print "Connection failed!: " . $error->getMessage() . "<br/>";
		die();
	}

?>
