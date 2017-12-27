
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


<?php


$res=$data->fetch(); 

?>

	<form method="POST" action="http://www.b-log-lille.fr/p5/public/admin/index.php?p=postUpdated&amp;postId=<?php echo $res['id']; ?>" enctype="multipart/form-data" name="update_post">

		<label for="title">Titre : </label>
		<input type="text" name="title" lenght=400 value="<?php echo $res['post_title'];?>"></input><br><br>

		<label for="heading">Chapô : </label>
		<textarea name="heading" cols=130 rows=10><?php echo $res['post_heading'];?></textarea><br><br>

		<label for="content">Contenu : </label>
		<textarea name="content" cols=130 rows=20><?php echo $res['post_content'];?></textarea><br><br>
  
		<button type="submit" class="btn btn-warning btn-sm" name="publier">Publier</button><br><br>

	</form>

<?php


$title = "MODIFIER UN ARTICLE";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>