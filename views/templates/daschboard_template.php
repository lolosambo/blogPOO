<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>ADMINISTRATION DU BLOG</title>
		<link rel="stylesheet" href="../../public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="../../public/css/admin_style.css" type="text/css"/>	
	</head>
	
	<body>


<div class="container">

	<div class="row content no-padding">
		
		<div class="col-lg-3 col-md-3 col-sm-12 col-12 left_col no-padding">

			<?php require('../../views/backend/menu.php'); ?>
		
		</div>	

		
		<div class="col-lg-9 col-md-9 col-sm-12 col-12 right_col">

			<div class="row no-padding">
				
				<div class="col-lg-6 col-md-6 col-sm-12 col-12 users">		

					<?= $users ?>	
					
				</div>
				
				<div class="col-lg-6 col-md-6 col-sm-12 col-12 posts">
			
					<?= $posts ?>

				</div>

			</div>

			<div class="row no-padding">

				<div class="col-lg-6 col-md-6 col-sm-12 col-12 valComments">
				
					<?= $validComments ?>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-12 col-12 unvalComments">
			
					<?= $comments ?>
				</div>

			</div>
		
		</div>	
		
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 footer"></div>

	</div>

</div>


</body>
</html>