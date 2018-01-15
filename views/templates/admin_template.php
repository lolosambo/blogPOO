
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>ADMINISTRATION DU BLOG</title>
	<link rel="stylesheet" href="../css/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="../../public/css/admin_style.css" type="text/css"/>
	</head>
	
	<body>


<div class="container">

	<div class="row content no-padding">

		<div class="col-lg-3 col-md-3 col-sm-12 col-12 left_col">

			<?php require('../../views/backend/menu.php'); ?>
		
		</div>	

			
		<div class="col-lg-9 col-md-9 col-sm-12 col-12">

			<div class="row no-padding">
				
				<div class="col-lg-12 col-md-12 col-sm-12- col-12 admin_header">

					<h2><?= $title ?></h2>

				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-12 right_col">
					<?= $content ?>
		
				</div>

			</div>

		</div>	
		
	
		<div class="col-lg-12 col-md-12 col-sm-12 col-12 footer"></div>

	</div>

</div>


</body>
</html>