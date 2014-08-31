<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
session_start();
if(isset($_GET['login'])){
    
     session_destroy();
    
}
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
								<?php include('includes/header.php'); ?>

						</div>
					</div>
				</div>
			</div>
		
		<!-- Banner Wrapper -->
			<div id="banner-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">

									<div>
										<div class="row">
											<div class="7u">
												<h2>Price Line.</h2>
												<p>Un lugar donde encontras todos los precios</p>
											</div>
											<div class="5u">
												<ul>
													<li><a href="BuscadorProducto.php" class="button big fa fa-arrow-circle-right">Buscar Precio</a></li>
													<li><a href="Registrar.php" class="button alt big fa fa-save">Registrate</a></li>
												</ul>
											</div>
										</div>
									</div>
								
								</div>

						</div>
					</div>
				</div>
			</div>
		
		<!-- Features Wrapper -->
			<div id="features-wrapper">
				<div class="container">
					<div class="row">
						<div class="4u">
						
							<!-- Box -->
								<section class="box box-feature">
									<a href="#" class="image image-full"><img src="images/fotolia_60056336.jpg" alt="" /></a>
									<div class="inner">
										<header>
											<h2>Buscá tus productos</h2>
											<span class="byline">Buscalos por tu categoria preferida</span>
										</header>
										<p>En esta sección puedes buscar todos los productos, pero antes selecciona<!--You can put all kinds of stuff here, though I’m not sure what. Maybe a-->
										la categoria a la que corresponda tu busqueda</p>
									</div>
								</section>

						</div>
						<div class="4u">
						
							<!-- Box -->
								<section class="box box-feature">
									<a href="#" class="image image-full"><img src="images/fotolia_50972570.jpg" alt="" /></a>
									<div class="inner">
										<header>
											<h2>Buscá tu supermercado</h2>
											<span class="byline">Encontrá los locales mas cercanos</span>
										</header>
										<p>Aquí podrás encontrar los locales y todos sus productos,
										dentro de tu localidad</p>
									</div>
								</section>

						</div>
						<div class="4u">
						
							<!-- Box -->
								<section class="box box-feature last">
									<a href="#" class="image image-full"><img src="images/fotolia_47614704.jpg" alt="" /></a>
									<div class="inner">
										<header>
											<h2>Presupuestos</h2>
											<span class="byline">Encuentra los mejores presupuestos</span>
										</header>
										<p>En esta sección podrás encontrar los presupuestos mas convenientes con 
										los productos que mas te gustan</p>
									</div>
								</section>

						</div>
					</div>
				</div>
			</div>
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php'); ?>
			</div>

	</body>
</html>