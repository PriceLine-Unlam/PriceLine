<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    session_start();
	
	$bandeja = 'sin_usuario';
	if($_SESSION['usuario_email']){
		
		$bandeja = 'usuario_login';
	}
	
    include('includes/busqueda.php');
	
	//echo base64_decode($_GET[idProducto])."<br>";
	//echo base64_decode($_GET[idLocalidad]);
	
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
									<section id="menu">
										<div class="row">
											<h2>Paso 2</h2>
										</div>
										<div class="row">
											<p>Seleccioná Tu Supermercado</p>
										</div>
										<div class="row">
										</div>
										<div class="row">
											<div class="12u">
											<div id="gmap-4" style="width:100%;height:300px;"></div>
											</div>
										</div>
									</section>
								</div>
													
									
							
							</div>

					</div>
				</div>
			</div>
		</div>
		
		<!-- Footer Wrapper -->
		<div id="footer-wrapper">
			<?php include('includes/footer.php'); ?>
		</div>
		
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
		<script>
			// Note: This example requires that you consent to location sharing when
			// prompted by your browser. If you see a blank space instead of the map, this
			// is probably because you have denied permission for location sharing.

			function initialize() {
				var myLatlng = new google.maps.LatLng(<?php echo $datosUsr[0][0][Latitud]; ?>,<?php echo $datosUsr[0][0][Longitud]; ?>);

				var mapOptions = {
					zoom: 15,
					center: myLatlng
				}
				
				var map = new google.maps.Map(document.getElementById('gmap-4'), mapOptions);

				var marker = new google.maps.Marker({
					position: myLatlng,
					map: map,
					title: '',
					icon: 'http://maps.google.com/mapfiles/arrow.png'
				});

				var infowindow = new google.maps.InfoWindow({
					content: '<div style="width:200px; height:75px"><h2 align="center"><?php if ( $_SESSION['usuario_email'] ) echo "Mi Casa"; else echo "Localidad"; ?></h2><p align="center"><?php echo $datosUsr[0][0][Direccion].' '.$datosUsr[0][0][Nro]; ?></p><p align="center"><?php echo ucwords(strtolower($datosUsr[0][0][provincia])); ?></p></div>' 
				});

				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});

				$.post("includes/busqueda.php",{ accion : 'traerSupermercados' 
				,lat : <?php echo $datosUsr[0][0][Latitud]; ?> 
				,longitud : <?php echo $datosUsr[0][0][Longitud]; ?>
				,idProducto : <?php echo base64_decode($_GET[idProducto]); ?>
				},function(data){
					eval(data);
				});
			}

			google.maps.event.addDomListener(window, 'load', initialize);

		</script>
	</body>
</html>