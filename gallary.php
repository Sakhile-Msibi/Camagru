<?PHP

	session_start();

	include_once("functions/montage.php");

	$montages = get_all_montage();

?>
<!DOCTYPE html>
<HTML>
	<header>
		<link rel="stylesheet" type="text/css" href="style/gallery.css">
		<meta charset="UTF-8">
		<title>CAMAGRU - gallery</title>
	</header>
	<body>
		<?PHP include('header_footer/header.php') ?>
		<div class="body">
		<?PHP
			if (isset($_SESSION['id']))
			{ ?>
				<div class="main">
					<div class="select">
						<img class="thumbnail" src="images/cadre.png"></img>
						<input id="cadre.png" type="radio" name="images" value="./images/cadre.png" onclick="onCheckBoxChecked(this)">
						<img class="thumbnail" src="images/cigarette.png"></img>
						<input id="cigarette.png" type="radio" name="images" value="./images/cigarette.png" onclick="onCheckBoxChecked(this)">
						<img class="thumbnail" src="images/hat.png"></img>
						<input id="hat.png" type="radio" name="images" value="./images/hat.png" onclick="onCheckBoxChecked(this)">
					</div>
					<video width="100%" autoplay="true" id="webcam"></video>
					<div id="camera-not-available">CAMERA NOT AVAILABLE</div>
					<img id="hat" style="display:none;" src="images/hat.png"></img>
					<img id="cigarette" style="display:none;" src="images/cigarette.png"></img>
					<img id="cadre" style="display:none;" src="images/cadre.png"></img>
					<div class="capture" id="pickImage">
						<img class="camera" src="images/camera.png"></img>
					</div>
					<canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
					<div class="captureFile" id="pickFile">
						<img class="camera" src="images/camera.png"></img>
					</div>
					<input type="file" id="take-picture" style="display:none;" accept="image/*">
				</div>
				<div class="side">
					<div class="title">Montages</div>
					<div id="miniatures">
						<?PHP
							$gallery = "";
							if ($montages != null)
							{
								for ($i = 0; $montages[$i] ; $i++)
								{
									$class = "icon";
									if ($montages[$i]['userid'] === $_SESSION['id'])
									{
										$class .= " removable";
									}
									$gallery .= "<img class=\"" . $class . "\" src=\"./montage/" . $montages[$i]['images'] . "\" data-userid=\"" . $montages[$i]['userid'] . "\"></images>";
								}
								echo $gallery;
							}
						?>
					</div>
				</div>
		<?PHP }
			else
			{ ?>
				You need to connect to use the gallery
        <?PHP } ?>
		</div>
		<?PHP include('header_footer/footer.php') ?>
	</body>
	<?PHP
		if (isset($_SESSION['id']))
		{ ?>
			<script type="text/javascript" src="js/webcam.js"></script>
			<script type="text/javascript" src="js/drop.js"></script>
			<script type="text/javascript" src="js/import.js"></script>
	<?PHP } ?>
</HTML>
