
<!DOCTYPE html>

<html>

	<head>

		<meta charset="utf-8" />
		<link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="public/css/style.css" type="text/css"/>
			
	</head>
	
<body>

<div class='comment_form'>

<form method="POST" action="http://www.b-log-lille.fr/p5/index.php?action=addComment&postId=<?php echo $_GET['id'];?>" name="add_comment">

	<label for="comment">Votre commentaire : </label><br>

		<textarea name="comment" cols=100 rows=10></textarea><br><br>

	<button type="submit" class="btn btn-default btn-sm" name="validComment">Soumettre votre commentaire</button><br><br>

</form>

</div>

</body>
</html>