<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 

include('includes/presupuesto.php');

?>
<html>
	<head>
		<title>PriceLine</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,800" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/app.css">
		</noscript>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
	</head>
	<body class="homepage">

		<!-- Header Wrapper -->
			<div id="header-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Header -->
								<?php include('includes/header.php');?>

						</div>
					</div>
				</div>
			</div>
		
		<!-- Banner Wrapper -->
			<div id="banner-wrapper">
				<div class="container">
                                    <ul >
                                        <li><a href="" onclick="" class="buttonReg small fa fa-plus-circle">Agregar Presupuesto</a></li>
                                        <li><a href="" onclick="" style=" position: relative;top:-61px;left:250px;"class="buttonReg small fa fa-minus-circle">Borrar Presupuesto</a></li>
				    </ul>
                                    
                            <?php foreach($datos as $presupuesto){  ?>
                                    <div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">
									<div>
										<div class="row">
											<div class="5u">
												<a href="DetallePresupuesto.html" class="image image-canasta"><img src="images/canasta1.jpg" alt="" /></a>
											</div>
											<div class="7u">
												<div class="row">
                                                                                                    <p><b>Presupuesto : <?php echo $presupuesto[0]['TituloLista'] ?></b><br>
													Supermercado : <?php echo $presupuesto[0]['Nombre'] ?><br>
                                                                                                        <a href="Detalle.php?id=<?php echo $presupuesto[0]['idLista'] ?>">Detalle</a><br>
													Costo : <?php echo '$ '. $presupuesto[0]['COSTO'] ?></p>
												</div>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>
                            <?php } ?>
				
				</div>
			</div>
			
		
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php'); ?>
			</div>
	</body>
</html>