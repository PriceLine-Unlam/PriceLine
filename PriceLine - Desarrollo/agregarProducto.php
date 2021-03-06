<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    session_start();
	
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
                <script type="text/javascript" src="js/alertify.js"></script>
                <script type="text/javascript" src="js/jquery.mask.js"></script>
                <link rel="stylesheet" href="css/jquery-ui.css"/>
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
                
                <script type="text/javascript">
					function GuardarProducto(){
					
						var categoria = $('#categoriaProducto').val();
						var nombreProducto = $('#nombreProducto').val();
						var marcaProducto = $('#marcaProducto').val();
						var tamano = $('#tamano').val();
						var error = "";
						
						if ( nombreProducto == "" ){
							error += "Debe ingresar un nombre de producto<br>";
						}
						
						if ( marcaProducto == "" ){
							error += "Debe ingresar una marca del producto<br>";
						}
						
						if ( categoria == "" ){
							error += "Debe ingresar una categoria del producto<br>";
						}
						
						if ( tamano == "" ){
							error += "Debe ingresar un tamaño del producto<br>";
						}
						
						if(error != ''){
							alertify.alert("<u>Registración de Producto</u></br>La registracion del producto tiene los siguientes errores : <br>" + error, function () {    
							});
							$('.alertify-dialog').css('height','550px');
						}else{

							$.post("includes/producto.php",{ accion : 'registrar' 
							, nombreProducto : nombreProducto
							, marcaProducto : marcaProducto 
							, categoria : categoria
							, tamano : tamano
							} , function(data){
								eval(data);
							});
							
						}

						return false;
						
					}
                    $(function(){
						$.post("includes/producto.php",{ prod : 'obtenerCategorias' } , function(data){
							$('#categoriaProducto').html(data);
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
					<div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">
									
									<div class="row">
										<div class="12u">
											<h2 align="center">Agregar Producto: </h2>
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="7u">
											<input type="text" class="textReg" id="nombreProducto" name="nombreProducto" placeholder="Ingrese Nombre Producto"  /><br>
										</div>
										<div class="3u">
											<input type="text" class="textReg" id="tamano" name="tamano" placeholder="Ingrese Tamaño Producto"  /><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="5u">
											<input type="text" class="textReg" id="marcaProducto" name="marcaProducto" placeholder="Ingrese Marca Producto"  /><br>
										</div>
										<div class="5u">
											<select  class="textSel" id="categoriaProducto" name="categoriaProducto"><option value="volvo"></option></select><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row">
										<div class="4u">
										</div>
										<div class="2u">
											<ul align="center">
												<li><a href="" onclick="return GuardarProducto()" class="buttonReg big fa fa-save">Guardar</a></li>
											</ul>
										</div>
										<div class="6u">
										</div>
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
	</body>
</html>