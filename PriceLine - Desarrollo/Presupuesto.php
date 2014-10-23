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
                <script type="text/javascript" src="js/alertify.js"></script>
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/app.css">
                        
		</noscript>
                
                <script type="text/javascript">
                    
                    function verInfo(nombre,direccion,horario){
                        
                        alertify.alert("<b><u>Informacion del Supermercado</u></b><br><b>Nombre: "+ nombre+"</b><br> Direccion: "+ direccion+"<br> Horario: "+ horario +"", function () {
                                    
                                    
                              });
                              $('.alertify-dialog').css('height','250px');
                    }
                    function borrarPresupuesto(id){
                         alertify.confirm("<p>Esta seguro que quiere borrar el presupuesto?</p>", function (e) {
                                if (e) {
                                       $.post("includes/presupuesto.php",{ accion : 'borrarLista' , id : id  } , function(data){
                                  //if(data !=""){
                                        eval(data);
                                    //}
                                     });
                                    return false;
                                } 
                            });
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
                                        <li><a href="agregarPresupuesto.php" onclick=""  class="buttonReg small fa fa-plus-circle">Agregar Presupuesto</a></li>
                                        <?php }else{ ?>
                                        <li><p class="parrafo_presupuesto">Para presupuestos personalizados debe <a href="Login.php">ingresar/registrarse</a>.</p></li>
                                        <?php }?>
                                        <!--<li><a href="" onclick="borrarPresupuesto();" style=" position: relative;top:-61px;left:250px;"class="buttonReg small fa fa-minus-circle">Borrar Presupuesto</a></li>-->
				    </ul>
                                    
                       <?php if(count($datos) > 1){ 
                                foreach($datos as $presupuesto){ ?>
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
                                                                                                    <p><b><u><?php echo $presupuesto[0][0]['TituloLista'] ?></u></b><br>
                                                                                                        Supermercado : <span style="cursor:pointer;" onclick="verInfo('<?php echo $presupuesto[0][0]['Nombre'] ?>','<?php echo $presupuesto[0][0]['Direccion'] ?>','<?php echo $presupuesto[0][0]['Horario'] ?>');"> <?php echo $presupuesto[0][0]['Nombre'] ?></span><br>
                                                                                                        <a href="DetallePresupuesto.php?id=<?php echo $presupuesto[0][0]['idLista'] ?>">Detalle</a><br>
													Costo : <?php echo '$ '. $presupuesto[0][0]['COSTO'] ?></p>
												</div>
											</div>
                                                                                    <?php if(isset($_SESSION['usuario_email'])) {?>
                                                                                        <a href="modificarPresupuesto.php?idLista=<?php echo $presupuesto[0][0]['idLista'] ?>" style="position:relative;top:40px;left:850px; width: 140px; padding-bottom: 0px;" class="buttonReg small fa fa-minus-circle">Modificar</a>
                                                                                        <a href="" onclick="return borrarPresupuesto(<?php echo $presupuesto[0][0]['idLista'] ?>);" style="position:relative;top:40px;left:870px; width: 140px; padding-bottom: 0px;" class="buttonReg small fa fa-minus-circle">Borrar</a>
                                                                                    <?php } ?>
										</div>
									</div>
								</div>

						</div>
				    </div>
                            <?php } }else if(count($datos) == 1 && $datos[0] != ''){?>
                                    <div class="row">
						<div class="12u">
						
							<!-- Banner -->
								<div id="banner" class="box">
									<div>
										<div class="row">
											<div class="5u">
												<a href="DetallePresupuesto.php?id=<?php echo $datos[0][0]['idLista'] ?>" class="image image-canasta"><img src="images/canasta1.jpg" alt="" /></a>
											</div>
											<div class="7u">
												<div class="row">
                                                                                                    <p><b><u><?php echo $datos[0][0]['TituloLista'] ?></u></b><br>
                                                                                                        Supermercado : <span style="cursor:pointer;" onclick="verInfo('<?php echo $datos[0][0]['Nombre'] ?>','<?php echo $datos[0][0]['Direccion'] ?>','<?php echo $datos[0][0]['Horario'] ?>');"> <?php echo $datos[0][0]['Nombre'] ?></span><br>
                                                                                                        <a href="DetallePresupuesto.php?id=<?php echo $datos[0][0]['idLista'] ?>">Detalle</a><br>
													Costo : <?php echo '$ '. $datos[0][0]['COSTO'] ?></p>
												</div>
											</div>
                                                                                    <?php if(isset($_SESSION['usuario_email'])) {?>
                                                                                    <a href="modificarPresupuesto.php?idLista=<?php echo $presupuesto[0][0]['idLista'] ?>" style="position:relative;top:40px;left:850px; width: 140px; padding-bottom: 0px;" class="buttonReg small fa fa-minus-circle">Modificar</a>
                                                                                        <a href="" onclick="return borrarPresupuesto(<?php echo $presupuesto[0][0]['idLista'] ?>);" style="position:relative;top:40px;left:870px; width: 140px; padding-bottom: 0px;" class="buttonReg small fa fa-minus-circle">Borrar</a>
                                                                                    <?php } ?>
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