<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
session_start();
$bandeja = 'sin_usuario';
if(isset($_SESSION['usuario_nombre'])){
    
    $bandeja = 'usuario_login';
}
include('includes/supermercado.php');

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
                <script type="text/javascript" src="js/alertify.js"></script>
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
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
						<div  class="12u">
						
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
						<?php if(isset($_SESSION['usuario_nombre'])){ ?>
						<li><a href="agregarSupermercado.php" onclick=""  class="buttonReg small fa fa-plus-circle">Agregar Supermercado</a></li>
						<?php }else{ ?>
						<li><p class="parrafo_presupuesto">Para agregar supermercados debe <a href="Login.php">ingresar/registrarse</a>.</p></li>
						<?php }?>
				    </ul>
					
					<?php 	if ( count( $datos[0] ) > 0 ){
					
								for($i=0;count($datos[0])>$i;$i++){?>
					
					<div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">
									<div>
										<div class="row">
											<div class="5u">
												<a href="agregarProducto.php?idSupermercado=<?php echo base64_encode(base64_encode($datos[0][$i][idSupermercado])); ?>" class="image image-canasta">
												<img src="images/supermercado.jpg" onmouseover="this.src='images/agregarProductos.jpg';" onmouseout="this.src='images/supermercado.jpg';" alt="" /></a>
											</div>
											<div class="7u">
												<div class="row">
													<p><b><u><?php echo $datos[0][$i][Nombre];?></u></b><br>
													<?php echo $datos[0][$i][Direccion];?><br>
													<?php echo ucwords(strtolower($datos[0][$i][Provincia]));?><br>
													<?php echo str_replace('de', '<br>de', $datos[0][$i][Horario]);?></p>
												</div>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>
					
					<?php 	}
						}?>
					
				</div>
			</div>
			
		
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php'); ?>
			</div>
	</body>
</html>