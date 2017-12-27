<?php 
session_cache_limiter('private_no_expire, must-revalidate');
session_start();  
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="public/css/style.css" type="text/css"/>
		<link href="https://fonts.googleapis.com/css?family=Muli|Nunito|Nunito+Sans|Oswald" rel="stylesheet"> 	
	</head>
	
<body>

<div class="container-fluid">

	<div class="row content">

		<div class="col-lg-9 col-md-9 col-sm-12 col-12">

			<?php include('includes/frontend/header.php'); ?>

		</div>

		<div class="col-lg-3 col-md-3 col-sm-12 col-12 connexion">

			<?php include('includes/frontend/sidebar.php'); ?>

		</div>



		<div class="col-lg-12 col-md-12 col-sm-12 col-12">

			<?php require('views/frontend/menu_view.php'); ?>

		</div>

		
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 content">

			<?php echo $content; ?>

		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-12 contactForm">
			
			<?php require('views/frontend/contact_view.php'); ?>
		
		</div>	
		
		
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 footer">

			<?php require('includes/frontend/footer.php'); ?>
			
		</div>

	</div>

</div>


</body>
</html>