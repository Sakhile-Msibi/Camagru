<link rel="stylesheet" type="text/css" href="../stylesheets/webcam.css">

<input type="file" id='file' onchange="onSelectedFile(event)" accept="image/png"/>
<div id="camera">
	<video id="camera-stream" width="500" height="376"></video>
</div>
<?PHP
	$id = $_SESSION['id_user'];
	$request = "SELECT COUNT(*) FROM `pictures` WHERE USER_ID='$id'";
	$nb_images = $pdo->query($request)->fetch()[0];
	if ($nb_images < 21)
	{
		echo "<input type='button' id='snapshot' value='Capture'/>";
	}
	else
	{
		echo "<input type='button' id='snapshot' value='Say cheese !' disabled/>Sorry, you can't take over 21 pictures ! Delete them to take more d:";
	}
?>
<canvas id='canvas'></canvas>
<img id='image' src='' size="auto">
<input class='validate_button' type='button' id='validate' value='Save'/>
<script type="text/javascript" src="snapshot.js"></script>
