<?PHP
	
	include 'database.php';

	try
	{
		$conn = new PDO("mysql:host=$db_serverhost", $db_username, $db_password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE $db_name";
		$conn->exec($sql);
		echo "Database created successfully<br>";
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}

	try
	{
		$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE users
			(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(50) NOT NULL,
			mail VARCHAR(100) NOT NULL,
			password VARCHAR(255) NOT NULL,
			token VARCHAR(50) NOT NULL,
			verified VARCHAR(1) NOT NULL DEFAULT 'N')";
		$conn->exec($sql);
		echo "Table users created successfully";
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}

	try
    {
		$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE gallery
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY
KEY,
            userid INT(11) NOT NULL,
            image VARCHAR(100) NOT NULL,
            FOREIGN KEY (userid) REFERENCES users(id))";
    	$conn->exec($sql);
    	echo "Table galley created successfully";
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
    }

	try
    {
        $conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE likes
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY
KEY,
            userid INT(11) NOT NULL,
            galleryid INT(11) NOT NULL,
			type VARCHAR(1) NOT NULL,
			FOREIGN KEY (userid) REFERENCES users(id),
			FOREIGN KEY (galleryid) REFERENCES gallery(id))";
    	$conn->exec($sql);
    	echo "Table like created successfully";
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
	}

	try
    {
        $conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE comment
            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY
KEY,
            userid INT(11) NOT NULL,
            galleryid INT(11) NOT NULL,
            comment VARCHAR(255) NOT NULL,
            FOREIGN KEY (userid) REFERENCES users(id),
            FOREIGN KEY (galleryid) REFERENCES gallery(id))";
    	$conn->exec($sql);
    	echo "Table comment created successfully";
    }
    catch (PDOException $e)
    {
        echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
	
?>
