<?php
require '../vendor/autoload.php';
use p5\entities\Users;
use p5\entities\Comments;
use p5\controllers\frontend\CommentsController;

	
foreach ($res2 as $comments)
{
			
	$commentContent = new Comments($comments);
	$commentAuthor = new Users($comments);

		
?>
	<div class="comment">
		<div class="comment_info">
					
			<?php echo '<p>Publié par :<b> '.$commentAuthor->getPseudo().' </b><em>le '.$commentContent->getCommentUpdate().'.</em></p>'; ?>
						
		</div>
					
		<?php echo '<p>'.$commentContent->getComment_content().'</p><br>'; ?>

	</div><br>

<?php
	

}

