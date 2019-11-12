<?PHP
session_start();
include_once 'functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
	<header>
		<link rel="stylesheet" type="text/css" href="style/index.css">
		<meta charset="UTF-8">
		<title>CAMAGRU - VERIFY</title>
	</header>
	<body>
		<?PHP include('header_footer/header.php') ?>
		<?PHP include('header_footer/footer.php') ?>
		<div id="login">
			<div class="title">VERIFY</div>
			<?PHP
				if (verify($_GET["token"]) == 0)
				{ ?>
					<strong>
						Your account as been verified
					</strong>
			<?PHP }
				else
				{ ?>
					<strong>
						Account not found
					</strong>
			<?PHP } ?>
		</div>
	</body>
</HTML>
