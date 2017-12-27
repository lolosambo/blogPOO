<?php


while ($data2 = $comments->fetch())
{
	if ($data2['validated']==1)
	{
				
?>
		<div class="comment">
			<div class="comment_info">
					
				<?php echo '<p>Publié par :<b> '.$data2['pseudo'].' </b><em>le '.$data2['commentUpdate'].'.</em></p>'; ?>
						
			</div>
					
			<?php echo '<p>'.$data2['comment_content'].'</p><br>'; ?>

		</div><br>

<?php

	}

}

$comments->closeCursor();