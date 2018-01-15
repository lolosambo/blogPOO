
<?php 
ob_start();
use p5\controllers\frontend\PaginationController;
use p5\entities\Posts;
use p5\entities\Users;


foreach ($res as $posts)
{
    $post = new Posts($posts);
    $user = new Users($posts);
	
	echo '<p><b>'.strtoupper($post->getPost_title()).'</b></p>';
	echo '<p><em>Dernière mise à jour le '.$post->getPostUpdate().'</em> - Edité par : <b>'.$user->getPseudo().'</b></p>';
	echo '<a href="index.php?p=updatePost&postId='.$post->getPostId().'"><button type="button" class=" btn btn-dark">Modifier l\'article</button>  </a>';
	echo '<a href="index.php?p=deletePost&postId='.$post->getPostId().'"><button type="button" class=" btn btn-dark">Supprimer l\'article</button> </a></p>';
	echo '--------------------------------------------------';
					
}

// SHOWS PAGINATION

echo '<p style="text-align : center;">Page : ';

$pagincont->showPagination();

echo '</p><br><br>';


echo '<br><br><a href="index.php?p=addPostForm"><button type="button" class=" btn btn-warning">Nouvel article</button></a><br><br><br>';


$title = "GESTION DES ARTICLES";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
