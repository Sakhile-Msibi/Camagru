<?PHP
	error_reporting(-1);
	ini_set('display_errors', 'true');

	session_start();
	require_once("../config/pdo.php");

	if (!empty($_POST['choice']) && !empty($_POST['image']))
	{
		if (!isset($_SESSION['id_user']))
		{
			echo "Fail";
			return ;
		}
		$id = $_SESSION['id_user'];
		$choice = $_POST['choice'];
		$image = $_POST['image'];
		$image = str_replace(' ', '+', $image);
		$link_explode = explode(',', $image);
		$decode = base64_decode($link_explode[1]);

		$dest = imagecreatefromstring($decode);
		imagecolortransparent($dest, imagecolorallocatealpha($dest, 0, 0, 0, 127));
		imagealphablending($dest, false);
		imagesavealpha($dest, true);
		if ($choice == 'Happy')
		{
			$src = imagecreatefrompng('images/cat.png');
			$dest_x = $_POST['x_pos'];
			$dest_y = $_POST['y_pos'];
			$src_w = 200;
			$src_h = 109;
		}
		else if ($choice == 'Angerfist')
		{
			$src = imagecreatefrompng('images/angerfist.png');
			$dest_x = $_POST['x_pos'];
			$dest_y = $_POST['y_pos'];
			$src_w = 500;
			$src_h = 500;
		}
		else if ($choice == 'Portal')
		{
			$src = imagecreatefrompng('images/portal.png');
			$dest_x = $_POST['x_pos'];
			$dest_y = $_POST['y_pos'];
			$src_w = 500;
			$src_h = 500;
		}
		else if ($choice == 'Knife')
		{
			$src = imagecreatefrompng('images/gun.png');
			$dest_x = $_POST['x_pos'];
			$dest_y = $_POST['y_pos'];
			$src_w = 5000;
			$src_h = 5000;
		}
		imagecopy($dest, $src, $dest_x, $dest_y, 0, 0, $src_w, $src_h);
		imagepng($dest, 'images/image.png');

		$data = file_get_contents('images/image.png');
		$image = $link_explode[0].','.base64_encode($data);
		echo $image;
	}

	if (!empty($_POST['validate']) && !empty($_POST['image']) && !empty($_POST['choice']))
	{
		if (!isset($_SESSION['id_user']))
		{
			echo "Fail";
			return ;
		}
		$id = $_SESSION['id_user'];
		$image = $_POST['image'];
		$choice = $_POST['choice'];
		$request = "INSERT INTO `pictures` (USER_ID, CHOICE, LINK) VALUES ('$id', '$choice', '$image')";
		$pdo->exec($request);
	}
?>
