<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    session_start();
	$bandeja = "no_informa_super";
	if ($_GET[idSupermercado]){
		$bandeja = "informa_super";
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
					
						var producto = $('#producto').val();
						var idProducto = $('#idProducto').val();
						var Precio = $('#Precio').val();
						Precio = Precio.replace(".","");
						Precio = Precio.replace(",",".");
						var precioSinComas = Precio.replace(",", "");
						precioSinComas = precioSinComas.replace(".", "");
						var supermercado = "<?php echo $_GET[idSupermercado]; ?>";
						var error = "";
						
						if ( producto == "" ){
							error += 'Debe ingresar un producto</br>';
						}
						
						if ( Precio == "" ){
							error += 'Debe ingresar un precio</br>';
						}
						
						if ( precioSinComas <= 0 ){
							error += 'Debe ingresar un precio distinto de cero</br>';
						}
						
						if ( error != '' ){
							alertify.alert("<u>Registración del Producto</u></br>La registracion del producto tiene los siguientes errores : <br>" + error, function () {    
							});
							$('.alertify-dialog').css('height','550px');
						}else{
						
							$.post("includes/supermercado.php",{ accion : 'registrarProducto' 
								, idProducto : idProducto
								, Precio : Precio
								, supermercado : supermercado
								} , function(data){
									   eval(data);
							});
							
						}
						
						return false;
					
					}
                    $(function(){
						$('#Precio').mask('0.000,00', {reverse: true});
                        var cache = {};
                            $( "#producto" ).autocomplete({
                            minLength: 2,
                            source: function( request, response ) {
                            var term = request.term;
                            if ( term in cache ) {
                            response( cache[ term ] );
                            return;
                            }
                                $.getJSON( "includes/productoPresupuesto.php", request, function( data, status, xhr ) {
                                    cache[ term ] = data;
                                    response( data );
                                });
                            },
                             select: function( event, ui ) {
                                     $( "#producto" ).val(ui.item.value);
                                     $( "#idProducto" ).val(ui.item.id);
                                     return false;
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
										<?php if ($_GET[idSupermercado]){ ?>
											<h2 align="center">Agregar Producto a <br>"<?php echo $datos[0][0][Nombre_Supermercado];?>": </h2>
										<?php }else{ ?>
											<h2 align="center">Agregar Producto: </h2>
										<?php } ?>
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="7u">
											<input type="text" class="textReg" id="producto" name="Producto" placeholder="Ingrese Producto"  /><br>
											<input type="hidden"  id="idProducto" name="idProducto"/>
										</div>
										<div class="3u">
											<input type="text" class="textReg" id="Precio" name="Precio" placeholder="Ingrese Precio"  /><br>
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