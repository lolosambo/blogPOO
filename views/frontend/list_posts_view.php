<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start(); 



$title = 'ACCUEIL BLOG';

ob_start();
?>
<div class="row">

	<?php	while ($data = $posts->fetch())
	{
	?>		
		
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

			<div class="row post">

				<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">

					<div class="row">

						<div class="col-md-12 col-sm-12  thumbnail" style="background-image: url(<?php echo $data['post_img_url']; ?>);"></div>

					</div>

					<div class="row">

		  				<div class="col-md-12 col-sm-12  post_info">
		  	
		  					<?php echo '<p>Ecrit par<b> '.$data['pseudo'].'</b><br>Modifé le '.$data['postUpdate'].'</p>'; ?>
		  			
		  				</div>

		  			</div>

		  		</div>

				<div class="col-lg-7 col-md-11 col-sm-11  post_content">

				<?php

					echo '<p><b><h1>'.$data['post_title'].'</h1></b></p>';
		
					echo '<p>'.substr($data['post_heading'], 0, 200).'</p>';

					?>
						
					<a href="index.php?action=singlePost&amp;id=<?php echo $data['postId'];?>">

						<button type="button" class="btn btn-warning">Lire la suite</button>

					</a><br>

				</div>

			</div>

		</div>
		
<?php

} 

?>

</div>
<?php

$posts->closeCursor();

// SHOWS PAGINATION
echo '<p style="text-align : center;">Page : ';

	for($i=1; $i<=$pagesNbr; $i++)
	{
    
     	if($i==$currentPage)
     	{
        	echo ' [ '.$i.' ] '; 
    	}	
    	 else
     	{
          	echo ' <a href="http://www.b-log-lille.fr/p5/index.php?page='.$i.'">'.$i.'</a> ';
     	}
	}
	echo '</p>';


$content = ob_get_clean();

require('views/frontend/template.php');

?>

	

	

	
		
