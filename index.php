<?PHP session_start(); ?>
<!DOCTYPE html>
<HTML>
	<header>
		<link rel="stylesheet" type="text/css" href="style/index.css">
		<meta charset="UTF-8">
		<title>CAMAGRU</title>
	</header>
	<body>
		<?PHP include('header_footer/header.php') ?>
		<?PHP include('header_footer/footer.php') ?>
		<div id="login">
      		<div class="title">LOGIN</div>
      		<div id="blue">
				<?PHP
					if (isset($_SESSION['id']))
					{ ?>
          				You are connected as <?PHP print_r(htmlspecialchars($_SESSION['username'])) ?>
        			<?PHP }
					else
					{ ?>
       					<form method="post" style="position: relative;" action="forms/signin.php">
		          			<label>Email: </label>
	    	      			<input id="mail" name="email" placeholder="email" type="mail">
    	    	  			<label>Password: </label>
        			  		<input id="password" name="password" placeholder="password" type="password">
    	    	  			<input name="submit" type="submit" value=" SEND ">
	          				<a href="signup.php">Create account</a>
	          				<a href="forgot.php">Forget password ?</a>
    	      				<span>
        		    			<?PHP
									if ($_SESSION['error'])
									{
    	                				echo $_SESSION['error'];
        	        				}
            	  					$_SESSION['error'] = null;
            					?>
          					</span>
	        			</form>
					<?PHP } ?>
			</div>
		</div>
	</body>
</HTML>
