<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    session_start();
    $bandeja = "traer_datos_producto";
    include('includes/busqueda.php');
	
	
?>
<html>
	<head>
		<title>Price Line</title>
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
                <script>
                     function verInfo(nombre,direccion,horario){
                        
                        alertify.alert("<b><u>Informacion del Supermercado</u></b><br><b>Nombre: "+ nombre+"</b><br> Direccion: "+ direccion, function () {
                                    
                                    
                              });
                              $('.alertify-dialog').css('height','250px');
                    }
                    function validarPrecio(){
                         alertify.confirm("<p>Esta seguro que quiere validar el precio de este producto?</p>", function (e) {
                                if (e) {
                                      $.post("includes/acciones.php",{ accion : 'validarPrecio', idSupermercado : <?php echo $datosPrd[0][0]['idSupermercado'] == ''? '"-"':$datosPrd[0][0]['idSupermercado']  ?> , idProducto : <?php echo $datosPrd[0][0]['idProducto'] == ''?'"-"':$datosPrd[0][0]['idProducto']  ?> } , function(data){
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
                                          $.post("includes/acciones.php",{ accion : 'modificarPrecio', valor : valor, idSupermercado : <?php echo $datosPrd[0][0]['idSupermercado'] == ''? '"-"':$datosPrd[0][0]['idSupermercado']  ?> , idProducto : <?php echo $datosPrd[0][0]['idProducto'] == ''?'"-"':$datosPrd[0][0]['idProducto']  ?> } , function(data){
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
                                          $.post("includes/acciones.php",{ accion : 'agregarSupermercado', valor : valor, idSupermercado : supermercado , idProducto : <?php echo $datosPrd[0][0]['producto'] == ''?'"-"':$datosPrd[0][0]['producto']  ?> } , function(data){
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
											<h2>Paso 3</h2>
											<p>- Obtené el producto</p>
										</div>
										<div class="row">
											<div class="5u">
												<a href="#" class="image image-present"><img src="data:image/png;base64,<?php echo $datosPrd[0][0][Foto]; ?>" alt="" /></a>
											</div>
											<div class="7u">
												<div class="row">
                                                                                                <p><b><u><?php echo $datosPrd[0][0]['producto'] ?></u></b><br>
                                                                                                <?php if($datosPrd[0][0]['Nombre'] != ''){ ?>
                                                                                                   Supermercado : <span style="cursor:pointer;" onclick="verInfo('<?php echo $datosPrd[0][0]['Nombre']  ?>','<?php echo $datosPrd[0][0]['direccion'] ?>','<?php echo $datosPrd[0][0]['Horario'] ?>');"> <?php echo $datosPrd[0][0]['Nombre']  ?></span><br>
                                                                                                <?php }else{ ?>
                                                                                                    Supermercado : -
                                                                                                <?php } ?>
                                                                                                <?php if($datosPrd[0][0]['valor'] !=''){ 
                                                                                                     $valor = $datosPrd[0][0]['valor'];
                                                                                                }else{
                                                                                                    $valor = 0.00;
                                                                                                }
?>
                                                                                                    Precio : <?php echo '$ '.$valor; ?></p>
                                                                                                
                                                                                                <?php if(isset($_SESSION['usuario_email'])){ ?>
                                                                                                <?php if($datosPrd[0][0]['Nombre'] !='' ){ ?>
                                                                                                <span style="font-size:20px;">Cantidad de Votos : <?php echo $datosPrd[0][0]['Validez'] ?></span>
                                                                                                   <a href="" onclick="return validarPrecio();">Votar</a><a href="" id="modificarPrecio" onclick="return ModificarPrecio();">Modificar Precio</a>
                                                                                                   <!-- <a href="" id="agregarSupermercado" onclick="return agregarSupermercado()"> Modificar Otro Supermercado</a> -->
                                                                                                <?php }else{ ?>
                                                                                                    <a href="" id="agregarSupermercado" onclick="return agregarSupermercado(<?php echo $datosPrd[0][0]['producto'] ?>)">Agregar a Supermercado</a>
                                                                                                <?php }} ?>
                                                                                            </div>
											</div>
										</div>
									</div>
										
								</div>

						</div>
					</div>
				</div>
			</div><br>
			
			<div id="banner-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">
															
									<div>
										<div class="row">
											<p>Encontrá el mismo producto en otros supermercados:</p>
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
						<?php for($j=0; $j<count($datosPrdSec[0]);$j++){ ?>
						<div class="3u">
						
							<!-- Box -->
							<section class="box box-feature">
                                                            <a href="VistaProducto.php?idSuper=<?php echo base64_encode($datosPrdSec[0][$j]['idSupermercado']); ?>&idProd=<?php echo base64_encode($datosPrdSec[0][$j]['idProducto']); ?>" class="image image-full"><img src="data:image/png;base64,<?php echo $datosPrdSec[0][$j][Foto]; ?>" alt="" /></a>
								<div class="box-prod">
										<p><?php echo utf8_encode(ucwords(strtolower($datosPrdSec[0][$j][nombre]))); ?></p>
										<p><?php echo "$".$datosPrdSec[0][$j][valor]; ?></p>
								</div>
							</section>

						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php'); ?>
			</div>
	</body>
</html>