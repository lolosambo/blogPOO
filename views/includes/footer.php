
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title><?php echo $title; ?></title>
		<link rel="stylesheet" href="public/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
		<link rel="stylesheet" href="public/css/style.css" type="text/css"/>	
	</head>
	
<body>


	<div class="row footer">
		<div class="col-lg-4 col-md-4 col-sm-12 col-12 footer_col_1">
			
			<div>
				<a href ="http://www.b-log-lille.fr/p5/index.php">Blog professionnel de Laurent BERTON</a>
				<p>Développeur web PHP / Symfony / HTML5-CSS3</p>
				<p>20 allée Baudelaire - 59139 Wattignies</p>
				<p>Tél : 07 68 34 33 15</p>
				<p>contact@b-log-lille.fr</p>
			</div>

		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-12 footer_col-2">
			
			<?php

			if ($_SESSION['id_role'] == 2)
			{
				echo '<a href="http://www.b-log-lille.fr/p5/public/admin/">Accéder à l\'administration</a>';
			}
			?>


		</div>

		<div class="col-lg-4 col-md-4 col-sm-12 col-12 footer_col_3">
			



		</div>




				
	
		
	</div>



</body>
</html>






			
