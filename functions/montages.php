<?PHP

	function add_montage($userId, $imgPath)
	{
		include_once '../config/database.php';
		
		try
		{
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("INSERT INTO gallery (userid, img) VALUES (:userid, :img)");
			$sql->execute(array(':userid' => $userId, ':img' => $imgPath));
			return (0);
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}

	function get_all_montage()
	{
		include_once './config/database.php';

		try
		{
			 $conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 $sql= $conn->prepare("SELECT userid, img FROM gallery");
			 $sql->execute();

			 $i = 0;
			 $tab = null;
			 while ($val = $sql->fetch())
			 {
				 $tab[$i] = $val;
				 $i++;
			 }
			 $sql->closeCursor();

			 return ($tab);
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}
	
	function remove_montage($uid, $img)
	{
		include_once '../config/database.php';

		try
		{
			 $conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 $sql= $conn->prepare("SELECT * FROM gallery WHERE img=:img AND userid=:userid");
			 $sql->execute(array(':img' => $img, ':userid' => $uid));

			 $val = $sql->fetch();
			 if ($val == null)
			 {
				 $sql->closeCursor();
				 return (-1);
			 }
			 $sql->closeCursor();

			 $sql= $conn->prepare("DELETE FROM likes WHERE galleryid=:galleryid");
			 $sql->execute(array(':galleryid' => $val['id']));
			 $sql->closeCursor();

			 $sql= $conn->prepare("DELETE FROM comment WHERE galleryid=:galleryid");
			 $sql->execute(array(':galleryid' => $val['id']));
			 $sql->closeCursor();

			 $sql= $conn->prepare("DELETE FROM gallery WHERE img=:img AND userid=:userid");
			 $sql->execute(array(':img' => $img, ':userid' => $uid));
			 $sql->closeCursor();
			 return (0);
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}

	function get_montages($start, $nb)
	{
		include_once './config/database.php';

		try
		{
			if ($start < 0)
			{
				$start = 0;
			}
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
			$sql->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
			$sql->bindValue(':id', $start, PDO::PARAM_INT);
			$sql->execute();

			$i = 0;
			$tab = null;
			while (($val = $sql->fetch()))
			{
				if ($i >= $nb)
				{
					$tab['more'] = true;
				}
				else
				{
					$tab[$i] = $val;
				}
				$i++;
			}
			$sql->closeCursor();

			return ($tab);
		}
		catch (PDOException $e)
		{
			$s;
			$s['error'] = $e->getMessage();
			return ($s);
		}
	}

	function get_montages2($start, $nb)
	{
		include_once '../config/database.php';

		try
		{
			if ($start < 0)
			{
				$start = 0;
			}
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT userid, img, id FROM gallery WHERE id > :id ORDER BY id ASC LIMIT :lim");
			$sql->bindValue(':lim', $nb + 1, PDO::PARAM_INT);
			$sql->bindValue(':id', $start, PDO::PARAM_INT);
			$sql->execute();

			$i = 0;
			$tab = null;
			while (($val = $sql->fetch()))
			{
				if ($i >= $nb)
				{
					$tab['more'] = true;
				}
				else
				{
					$tab[$i] = $val;
				}
				$i++;
			}
			$sql->closeCursor();

			return ($tab);
		}
		catch (PDOException $e)
		{
			$s;
			$s['error'] = $e->getMessage();
			return ($s);
		}
	}

	function comment($uid, $imgSrc, $comment)
	{
		include_once '../config/database.php';

		try
		{
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("INSERT INTO comment(userid, galleryid, comment) SELECT :userid, id, :comment FROM gallery WHERE img=:img");
			$sql->execute(array(':userid' => $uid, ':comment' => $comment, ':img' => $imgSrc));
			return (0);
		}
		catch (PDOException $e)
		{
			return ($e->getMessage());
		}
	}

	function get_comments($imgSrc)
	{
		include './config/database.php';

		try
		{
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
			$sql->execute(array(':img' => $imgSrc));

			$i = 0;
			$tab = "";
			while ($val = $sql->fetch())
			{
				$tab[$i] = $val;
				$i++;
			}
			$tab[$i] = null;
			$sql->closeCursor();

			return ($tab);
		}
		catch (PDOException $e)
		{
			$ret = "";
			$ret['error'] = $e->getMessage();
			return ($ret);
		}
	}

	function get_comments2($imgSrc)
	{
		include '../config/database.php';
		
		try
		{
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT c.comment, u.username FROM comment AS c, users AS u, gallery AS g WHERE g.img=:img AND g.id=c.galleryid AND c.userid=u.id");
			$sql->execute(array(':img' => $imgSrc));

			$i = 0;
			$tab = "";
			while ($val = $sql->fetch())
			{
				$tab[$i] = $val;
				$i++;
			}
			$tab[$i] = null;
			$sql->closeCursor();

			return ($tab);
		}
		catch (PDOException $e)
		{
			$ret = "";
			$ret['error'] = $e->getMessage();
			return ($ret);
		}
	}

	function get_userinfo_from_montage($imgSrc)
	{
		include '../config/database.php';

		try
		{
			$conn = new PDO("mysql:host=$db_serverhost;dbname=$db_name", $db_username, $db_password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql= $conn->prepare("SELECT mail, username FROM users, gallery WHERE gallery.img=:img AND users.id=gallery.userid");
			$sql->execute(array(':img' => $imgSrc));

			$val = $sql->fetch();
			$sql->closeCursor();

			return ($val);
		}
		catch (PDOException $e)
		{
			$ret = "";
			$ret['error'] = $e->getMessage();
			return ($ret);
		}
	}

?>
