
<?php 
use p5\entities\Users;
use p5\entities\Posts;
use p5\entities\Comments;


ob_start();

foreach ($res as $data)
{
    $user = new Users($data);
    $comment = new Comments($data);
    $post = new Posts($data);


    ?>

     <div class="comment">

        <div class="comment_info">
            
            <?php echo '<p>Commentaire publié par <b>: '.$user->getPseudo().' </b><em>le '.$comment->getCommentUpdate().'.</em></p>';?>
                            
        </div>

                         
            <?php echo '<p>Article : <b>'.$post->getPost_title().'</b></p>';
                            
            echo '<p>Contenu : '.$comment->getComment_content().'</p>'; ?>

            <!-- "Publier" and "Refuser" buttons for each comment -->

                               
            <a href="index.php?p=validComment&amp;commentId=<?php echo $comment->getCommentId(); ?>">
            
            <button  class="btn btn-warning btn-sm btn-sm-active" name="publier<?php echo $comment->getCommentId(); ?>">Publier</button> </a>
                                  
            <a href="index.php?p=refuseComment&amp;commentId=<?php echo $comment->getCommentId(); ?>">
            
            <button  class="btn btn-warning btn-sm btn-sm-active" name="refuser<?php echo $comment->getCommentId(); ?>">Refuser</button></a><br>
                        
        </div><br>

 <?php          
            
}


//SHOWS PAGINATION
echo '<p style="text-align : center;">Page : ';

$pagincont->showCommentsPagination();

echo '</p><br><br>';


$title = "GESTION DES COMMENTAIRES";
$content = ob_get_clean();

require('../../views/templates/admin_template.php');

?>
