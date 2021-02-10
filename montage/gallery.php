<link rel="stylesheet" type="text/css" href="../stylesheets/gallery.css">

<?PHP
	$id = $_SESSION['id_user'];
	$request = "SELECT link FROM `pictures` WHERE USER_ID='$id' ORDER BY id DESC";
	$images = $pdo->query($request);
	foreach ($images as $image)
	{
		$officiel = str_replace(' ', '+', $image[0]);
		echo "<img class='officiel' src='$officiel'/>";
	}
?>
