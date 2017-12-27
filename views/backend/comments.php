
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

 while ($data = $res->fetch())

{
    ?>

     <div class="comment">

        <div class="comment_info">
            
            <?php echo '<p>Commentaire publié par <b>: '.$data['pseudo'].' </b><em>le '.$data['commentUpdate'].'.</em></p>';?>
                            
        </div>

                         
            <?php echo '<p>Article : <b>'.$data['post_title'].'</b></p>';
                            
            echo '<p>Contenu : '.$data['comment_content'].'</p>'; ?>

            <!-- "Publier" and "Refuser" buttons for each comment -->

                               
            <a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=validComment&amp;commentId=<?php echo $data['commentId']; ?>">
            
            <button  class="btn btn-warning btn-sm btn-sm-active" name="publier<?php echo $data['commentId']; ?>">Publier</button> </a>
                                  
            <a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=refuseComment&amp;commentId=<?php echo $data['commentId']; ?>">
            
            <button  class="btn btn-warning btn-sm btn-sm-active" name="refuser<?php echo $data['commentId']; ?>">Refuser</button></a><br>
                        
        </div><br>

 <?php          
            
}


//SHOWS PAGINATION
echo '<p style="text-align : center;">Page : ';

for($i=1; $i<=$pagesNbr; $i++)
{
    
    if($i==$currentPage)
    {
     	echo ' [ '.$i.' ] '; 
    }

    else
    {
        echo ' <a href="http://www.b-log-lille.fr/p5/public/admin/index.php?p=comments&amp;cpage='.$i.'">'.$i.'</a> ';
    }

}

echo '</p><br><br>';


$title = "GESTION DES COMMENTAIRES";
$content = ob_get_clean();

require('../../views/backend/admin_template.php');

?>

</body>
</html>