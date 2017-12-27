
<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  


ob_start();

?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../../public/css/menu.css" type="text/css">
</head>

<body>


<form method="POST" action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=addPost" enctype="multipart/form-data" name="add_post">

	<label for="title">Titre : </label>
	<input type="text" name="title" lenght=230 value="<?= $_POST['title'] ?> "></input><br>

	<label for="heading">Chapô : </label>
	<textarea name="heading" cols=60 rows=5><?= $_POST['heading'] ?> </textarea><br>

	<label for="content">Contenu : </label>
	<textarea name="content" cols=60 rows=10><?= $_POST['content'] ?> </textarea><br><br>

 
	<!-- Image insertion field -->
 	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
 	<label for="img">Insérer une image : </label>
 	<input name="img" type="file"/><br><br>
  
	<button type="submit" class="btn btn-warning" name="publier">Publier</button><br><br>

</form>

<?php

if (isset($_POST['publier']) && !isset($img_url))

{
	echo '<p>Le chargement de votre image n\'a pu aboutir.</p>
	<p>Vérifiez que votre image ne dépasse pas <b>5mo</b> et qu\'elle soit bien au format <b>.jpeg, .jpg, .gif ou .png</b></p><br><br>';
}


echo '<a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=posts"><button type="button" class=" btn btn-warning">Retour à la liste des articles</button></a>';








$title = "MODIFIER UN ARTICLE";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>