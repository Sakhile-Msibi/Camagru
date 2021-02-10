<?PHP

	require_once('database.php');
	session_start();

	try
	{
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $error)
	{
		print "Error while connecting!: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$request = "CREATE DATABASE `$DB_NAME` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
		$dbh->exec($request);
		echo "Database created successfully<br/>";
	}
	catch (PDOException $error)
	{
		print "Error creating database!: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$dbh->exec("USE $DB_NAME");
		echo "Connected to the database successfully<br/>";
	}
	catch (PDOException $error)
	{
		print "Error: can not connect to the database!: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$request = "CREATE TABLE users
			(ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			NAME VARCHAR(20),
			PASSWORD VARCHAR(128),
			EMAIL VARCHAR (50),
			NOTIF INT,
			HASH_MAIL VARCHAR (128),
			VALIDATE BOOLEAN)";
		$dbh->exec($request);
		echo "Table users created successfully<br/>";
	}
	catch (PDOException $error)
	{
		print "Error while creating users table !: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$request = "CREATE TABLE likes
			(ID INT,
			USER_ID INT)";
		$dbh->exec($request);
		echo "Table likes created successfully<br/>";
	}
	catch (PDOException $error)
	{
		print "Error while creating likes table !: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$request = "CREATE TABLE comments
			(ID_COMMENT INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			ID_PICTURE INT,
			TEXT LONGTEXT,
			ID_USER INT)";
		$dbh->exec($request);
		echo "Table comment created successfully<br/>";
	}
	catch (PDOException $error)
	{
		print "Error while creating comments table !: " . $error->getMessage() . "<br/>";
		die();
	}

	try
	{
		$request = "CREATE TABLE pictures
			(ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
			USER_ID INT,
			LINK BLOB(4294967295),
			CHOICE VARCHAR(255))";
		$dbh->exec($request);
		if (isset($_SESSION['user']))
		{
			unset($_SESSION['user']);
		}
		if (isset($_SESSION['id_user']))
		{
			unset($_SESSION['id_user']);
		}
		echo "Table pictures created successfully<br/>Redirecting to index.php...";
?>
		<HTML>
			<head>
				<meta http-equiv="refresh" content="2; URL='../index.php'"/>
			</head>
		</HTML>

<?PHP
	
	}
	catch (PDOException $error)
	{
		print "Error while creating pictures table !: " . $error->getMessage() . "<br/>";
		die();
	}

?>
