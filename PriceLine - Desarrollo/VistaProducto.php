<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
    include('includes/infoProducto.php');
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
                <script>
                     function verInfo(nombre,direccion,horario){
                        
                        alertify.alert("<b><u>Informacion del Supermercado</u></b><br><b>Nombre: "+ nombre+"</b><br> Direccion: "+ direccion+"<br> Horario: "+ horario +"", function () {
                                    
                                    
                              });
                              $('.alertify-dialog').css('height','250px');
                    }
                </script>    
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
							<?php  include('includes/header.php');?>
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
											<div class="5u">
												<a href="" class="image image-full"><img src="data:image/png;base64,<?php echo $info_producto[0][0]['Foto'] ?>" alt="" /></a>
											</div>
											<div class="5u">
                                                                                            <div class="row">
                                                                                                <p><b><u><?php echo $info_producto[0][0]['Nombre'] ?></u></b><br>
                                                                                                <?php if($info_producto[0][0]['nombre_supermercado'] != ''){ ?>
                                                                                                    Supermercado : <span style="cursor:pointer;" onclick="verInfo('<?php echo $info_producto[0][0]['nombre_supermercado'] ?>','<?php echo $info_producto[0][0]['Direccion'] ?>','<?php echo $info_producto[0][0]['Horario'] ?>');"> <?php echo $info_producto[0][0]['nombre_supermercado'] ?></span><br>
                                                                                                <?php }else{ ?>
                                                                                                    Supermercado : -
                                                                                                <?php } ?>
                                                                                                <?php if($info_producto[0][0]['Valor'] !=''){ 
                                                                                                     $valor = $info_producto[0][0]['Valor'];
                                                                                                }else{
                                                                                                    $valor = 0.00;
                                                                                                }
?>
                                                                                                Precio : <?php echo '$ '. number_format($valor, 2, ',', '.'); ?></p>
                                                                                                <?php if(isset($_SESSION['email_usuario'])){ ?>
                                                                                                <?php if($info_producto[0][0]['nombre_supermercado'] !='' ){ ?>
                                                                                                    <a href="">Validar</a><a href="">Modificar Precio</a>
                                                                                                <?php }else{ ?>
                                                                                                    <a href="">Agregar a Supermercado</a>
                                                                                                <?php }} ?>
                                                                                            </div>
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
						<div class="3u">
						
							<!-- Box -->
								<section class="box box-feature">
									<a href="#" class="image image-full"><img src="images/fotolia_60056336.jpg" alt="" /></a>
									<div class="box-prod">
											<p>Busc� tus productos</p>
									</div>
								</section>

						</div>
					</div>
				</div>
			</div>
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
                            <?php  include('includes/footer.php'); ?>
                        </div>
	</body>
</html>