<?php 
use p5\entities\Posts;
use p5\entities\Users;
use p5\entities\Comments;


?>


<?php ob_start(); ?>

<h6>Les 5 utilisateurs enregistrés</h6>

<?php 
	
foreach ($users as $data)
{
	$post = new Posts($data);
	$author = new Users($data);
		
	
	echo '<p><b>'.$author->getPseudo().'</b> - Inscrit(e) le : '.$author->getInscr_date().'</p>';
}

$users = ob_get_clean();



ob_start(); ?>

<h6>Les 3 derniers articles</h6>

<?php 

foreach ($posts as $data)
{
	$post = new Posts($data);

	echo '<p><em>Dernière mise à jour le :'.$post->getPostUpdate().'</em><br>';
	echo '<b>'.$post->getPost_title().'</b><br></p>';
}

$posts = ob_get_clean();





ob_start(); ?>

<h6>Les 3 derniers commentaires validés</h6>

<?php 

foreach ($comments1 as $data)
{
	$comment = new Comments($data);
	$post = new Posts($data);
	
	echo '<p><em>Posté le : '.$comment->getCommentUpdate().'</em><br>';
	echo '<b>'.$post->getPost_title().'</b><br>';
	echo $comment->getComment_content().'<br>';
	echo '---------------------------------------</p>';
}

$validComments = ob_get_clean();





ob_start(); ?>

<h6>Les 3 derniers commentaires à valider</h6>

<?php 

foreach ($comments0 as $data)
{
	$comment = new Comments($data);
	$post = new Posts($data);
	
	echo '<p><em>Posté le : '.$comment->getCommentUpdate().'</em><br>';
	echo '<b>'.$post->getPost_title().'</b><br>';
	echo $comment->getComment_content().'<br>';
	echo '---------------------------------------</p>';
}

$comments = ob_get_clean();

?>


<?php require('../../views/templates/daschboard_template.php'); ?>

