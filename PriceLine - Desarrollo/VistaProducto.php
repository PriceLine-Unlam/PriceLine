<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
    session_start();
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
                    function validarPrecio(){
                         alertify.confirm("<p>Esta seguro que quiere validar el precio de este producto?</p>", function (e) {
                                if (e) {
                                      $.post("includes/acciones.php",{ accion : 'validarPrecio', idSupermercado : <?php echo $info_producto[0][0]['idSupermercado'] == ''? '"-"':$info_producto[0][0]['idSupermercado']  ?> , idProducto : <?php echo $info_producto[0][0]['idProducto'] == ''?'"-"':$info_producto[0][0]['idProducto']  ?> } , function(data){
                                                                           eval(data);
                                                                        });
                                }
                            });
                             $('.alertify-dialog').css('height','195px');
                      return false
                    }
                    function ModificarPrecio(){
                        alertify.confirm("<p>Ingrese el nuevo precio : $ <input type='text' id='precioNuevo' style='height: 35px; padding-bottom: 2px;'> </p>", function (e) {
                                if (e) {
                                      //alertify.success("Has pulsado '" + alertify.labels.ok + "'");
                                      var exp = /^[0-9]+(\,[0-9]+)?$/;
                                        var valor =  $('#precioNuevo').val();
                                      if(valor.match(exp)){
                                          $.post("includes/acciones.php",{ accion : 'modificarPrecio', valor : valor, idSupermercado : <?php echo $info_producto[0][0]['idSupermercado'] == ''? '"-"':$info_producto[0][0]['idSupermercado']  ?> , idProducto : <?php echo $info_producto[0][0]['idProducto'] == ''?'"-"':$info_producto[0][0]['idProducto']  ?> } , function(data){
                                                                           eval(data);     
                                                                        });
                                      }else{
                                          alertify.error('"El valor ingresado es incorrecto."');
                                          $('#modificarPrecio').click();
                                          
                                      }
                                      
                                }
                            });
                            $('.alertify-dialog').css('height','190px');
                              return false;
                    }
                    function agregarSupermercado(idProducto){
                    
                        alertify.confirm("<p>Seleccione un supermercado de la lista :<select id='supermercadoCercano' style='height: 35px; padding-bottom: 2px;'><?php echo $option_sup; ?></select> </p><p>Ingrese el precio : $ <input type='text' id='precioNuevo' style='height: 35px; padding-bottom: 2px;'> </p>", function (e) {
                                if (e) {
                                      //alertify.success("Has pulsado '" + alertify.labels.ok + "'");
                                      var exp = /^[0-9]+(\,[0-9]+)?$/;
                                        var valor =  $('#precioNuevo').val();
                                        var supermercado = $('#supermercadoCercano').val();
                                       // alert(supermercado);
                                      if(valor.match(exp) && supermercado !=''){
                                          $.post("includes/acciones.php",{ accion : 'agregarSupermercado', valor : valor, idSupermercado : supermercado , idProducto : <?php echo $info_producto[0][0]['producto'] == ''?'"-"':$info_producto[0][0]['producto']  ?> } , function(data){
                                                                           eval(data);     
                                                                        });
                                      }else{
                                          alertify.error('"El valor ingresado es incorrecto o no ha seleccionado supermercado."');
                                          $('#agregarSupermercado').click();
                                          
                                      }
                                      
                                }
                            });
                            $('.alertify-dialog').css('height','300px');
                              return false;
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
                                                                                                    Precio : <?php echo '$ '. number_format($valor, 2, ',', '.'); ?><img id="imagen_validez" val="<?php echo $info_producto[0][0]['Validez']!= ''? $info_producto[0][0]['Validez'] :'0'; ?>" src="images/val_<?php echo $info_producto[0][0]['Validez']!= ''? $info_producto[0][0]['Validez'] :'0'; ?>.png" style="width:85px;height:30px;"></p>
                                                                                                <?php if(isset($_SESSION['usuario_email'])){ ?>
                                                                                                <?php if($info_producto[0][0]['nombre_supermercado'] !='' ){ ?>
                                                                                                    <a href="" onclick="return validarPrecio();">Validar</a><a href="" id="modificarPrecio" onclick="return ModificarPrecio();">Modificar Precio</a>
                                                                                                    <a href="" id="agregarSupermercado" onclick="return agregarSupermercado()"> Modificar Otro Supermercado</a>
                                                                                                <?php }else{ ?>
                                                                                                    <a href="" id="agregarSupermercado" onclick="return agregarSupermercado(<?php echo $info_producto[0][0]['producto'] ?>)">Agregar a Supermercado</a>
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
                                    <h2>Productos más Visitados</h2> 
					<div class="row">
                                           <?php  foreach($productos_visitados[0] as $pr){ ?>
						<div class="3u">
						
							<!-- Box -->
								<section class="box box-feature">
                                                                    <a href="VistaProducto.php?idProducto=<?php echo $pr['idProducto'] ?>" class="image image-full"><img src="data:image/png;base64,<?php echo $pr['Foto'] ?>" alt="" /></a>
									<div class="box-prod">
											<p><?php echo $pr['Nombre'] .'-'. $pr['Cantidad'] ?></p>
									</div>
								</section>

						</div>
                                            <?php } ?> 
					</div>
				</div>
			</div>
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
                            <?php  include('includes/footer.php'); ?>
                        </div>
	</body>
</html>