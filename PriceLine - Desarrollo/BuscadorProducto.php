<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    include('includes/init.php');

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
                <script src="js/jquery-ui.min.js"></script>
                <link rel="stylesheet" href="css/jquery-ui.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
                <script>
                  $(function() {
                        var availableTags = [
                            <?php echo $lista_prod; ?>
                        ];
                        $( "#producto" ).autocomplete({
                            minLength: 2,
                            source: function( request, response ) {
                            var term = request.term;
                            if ( term in cache ) {
                            response( cache[ term ] );
                            return;
                            }
                                $.getJSON( "includes/productos.php", request, function( data, status, xhr ) {
                                    cache[ term ] = data;
                                    response( data );
                                });
                            }
                            });
                                  
                        
                        
                        var cache = {};
                        $( "#localidad" ).autocomplete({
                            minLength: 2,
                            source: function( request, response ) {
                            var term = request.term;
                            if ( term in cache ) {
                            response( cache[ term ] );
                            return;
                            }
                                $.getJSON( "includes/localidades.php", request, function( data, status, xhr ) {
                                    cache[ term ] = data;
                                    response( data );
                                });
                            }
                            });
                        });
                </script>
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
					<ul >
						<?php if(isset($_SESSION['usuario_nombre'])){ ?>
						<li><a href="agregarProducto.php" onclick=""  class="buttonReg small fa fa-plus-circle">Agregar Producto</a></li>
						<?php }else{ ?>
						<li><p class="parrafo_presupuesto">Para agregar productos debe <a href="Login.php">ingresar/registrarse</a>.</p></li>
						<?php }?>
				    </ul>
					<div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">

									<div>
										<div class="row">
											<h2>Paso 1</h2>
										</div>
										<div class="row">
											<p>Realizá tu búsqueda</p>
										</div>
										<div class="row">
											<div class="9u">
												<div class="row half">
													<div class="8u">
														<input type="text" class="text" id="producto" name="producto" placeholder="Producto" />
													</div>
													<div class="4u">
														<input type="text" class="text" id="localidad" name="localidad" placeholder="Localidad" />
													</div>
												</div>
											</div>
											<div class="3u">
												<ul>
													<li><a href="ResultadoBusqueda.html" class="button small fa fa-arrow-circle-right">Buscar Precio</a></li>
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
                                    <?php for($i=0;$i<2;$i++) {?>
					<div class="row">
						<?php for($j=0*($i*4); $j<(4*($i*2));$j++){ ?>
                                                <div class="3u">
						
							<!-- Box -->
								<section class="box box-feature">
									<a href="VistaProducto.php?idProducto=<?php echo $vistos_prod[$j]['idProducto'] ?>" class="image image-full"><img src="data:image/png;base64,<?php echo $vistos_prod[$j]['Foto']; ?>" alt="" /></a>
									<div class="box-prod">
											<p><?php echo $vistos_prod[$j]['Nombre']; ?></p>
									</div>
								</section>

						</div>
                                                <?php } ?>
					</div>
                                    <?php }?>
				</div>
			</div>
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php'); ?>
			</div>

	</body>
</html>