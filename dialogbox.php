<link rel="stylesheet" type="text/css" href="stylesheets/dialogbox.css">

	<div id="hide" size="auto">
		<div id="popup">
			<div id='user_name'></div>
			<img id='image_gallery' src='' size="auto"><br/>
			<div id="like" class="fas fa-thumbs-up" onClick='askedLike()'></div>
			<div id="comment_body" style="overflow: auto; overflow-x:hidden; overflow-y:scroll;">
				<div id="null42"></div>
			</div>
			<?PHP
				if (isset($_SESSION['id_user']))
				{
					echo "<textarea id='comment' name='comments' maxlength='500' placeholder='Max 500 char'></textarea><br/>";
					echo "<input class='button_validate' type='button' onClick='askedComment()' value='Comment'>";
				}
			?>
			<div id="null"></div>
		</div>
	</div>
<script type="text/javascript" src="dialog.js"></script>

<?PHP

?>
