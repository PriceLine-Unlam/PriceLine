<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php 
    function asignacionClass($val){
        if($val == 3){
            return "green";
        }
        if($val == 2){
            return "yellow";
        }
        if($val == 1){
            return "red";
        }
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
                <script src="js/jquery.dataTables.js"></script>
                <link rel="stylesheet" href="css/jquery.dataTables.css" />
                <link rel="stylesheet" href="css/jquery.dataTables_themeroller.css" />
                <script type="text/javascript" src="js/alertify.js"></script>
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
			<link rel="stylesheet" href="css/app.css">
		</noscript>
                <script>
                    $(document).ready(function(){
                        
                        $('#DataTables_Table_0').dataTable( {
                                "paging":   false,
                                "ordering": false,
                                "info":     false,
                                "bFilter" : false,
                                "bSort" : false
                            } );
                    });
                    function mostrarDatos(nombre,descripcion,marca,categoria){
                        alertify.alert("<u>Información del Producto  "+nombre+"</u></br></br>Descripción : "+descripcion+"</br>Marca :"+marca+"</br>Categoria : "+categoria+"</br>",function (){});
                        $('.alertify-dialog').css('height','300px');
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
								<?php include('includes/header.php');  ?>

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
												<!--<a href="DetallePresupuesto.html" class="image image-canasta"><img src="images/canasta1.jpg" alt="" /></a>-->
                                                                                            <h2>Detalle</h2>
											</div>
											<div class="8u">
                                                                                            <table id="DataTables_Table_0" style="width:163%">
                                                                                                    <thead>
                                                                                                        <tr role="row">
                                                                                                            <th>Producto</th>
                                                                                                            <th> <?php echo $datos[3][0]['Nombre'] ?></th>
                                                                                                            <th> <?php echo $datos[3][1]['Nombre'] ?></th>
                                                                                                            <th> <?php echo $datos[3][2]['Nombre'] ?></th>
                                                                                                            <th> <?php echo $datos[3][3]['Nombre'] ?></th>
                                                                                                            <th> <?php echo $datos[3][4]['Nombre'] ?></th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody role="alert" aria-live="polite" aria-relevant="all">
                                                                                                        <?php for($i=0;$i<count($datos[0]);$i++){ ?>
                                                                                                            <tr class="<?php echo asignacionClass($datos[0][$i]['importancia']); ?>">
                                                                                                                <td style="cursor : pointer" onclick="mostrarDatos('<?php echo $datos[2][$i]['Nombre']?>','<?php echo $datos[2][$i]['Descripcion']?>','<?php echo $datos[2][$i]['Marca']?>','<?php echo $datos[2][$i]['Categoria']?>');"><?php echo $datos[2][$i]['Nombre'] ?></td>
                                                                                                                <td>$ <?php echo $datos[0][$i]['Supermercado1'] ?></td>
                                                                                                                <td >$ <?php echo $datos[0][$i]['Supermercado2'] ?></td>
                                                                                                                <td >$ <?php echo $datos[0][$i]['Supermercado3'] ?></td>
                                                                                                                <td >$ <?php echo $datos[0][$i]['Supermercado4'] ?></td>
                                                                                                                <td >$ <?php echo $datos[0][$i]['Supermercado5'] ?></td>
                                                                                                            </tr>
                                                                                                        <?php } ?>
                                                                                                            <tr class="odd">
                                                                                                                <td >Total: </td>
                                                                                                                <td>$ <?php echo $datos[1][0]['CostoTotal1'] ?></td>
                                                                                                                <td >$ <?php echo $datos[1][0]['CostoTotal2'] ?></td>
                                                                                                                <td >$ <?php echo $datos[1][0]['CostoTotal3'] ?></td>
                                                                                                                <td >$ <?php echo $datos[1][0]['CostoTotal4'] ?></td>
                                                                                                                <td >$ <?php echo $datos[1][0]['CostoTotal5'] ?></td>
                                                                                                            </tr>
                                                                                                    </tbody>
                                                                                                </table>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>
				</div>
			</div>
			
		
		

		<!-- Footer Wrapper -->
			<div id="footer-wrapper">
				<?php include('includes/footer.php');  ?>
			</div>
	</body>
</html>

