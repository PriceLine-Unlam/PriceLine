<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    session_start();
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
                <script type="text/javascript" src="js/alertify.js"></script>
                <link rel="stylesheet" href="css/jquery-ui.css"/>
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
                
                <script>
                    $(function(){
                        
                        $.post("includes/provincias.php",{ prov : 'provincia' } , function(data){
                               $('#Provincia').html(data);
                       });
                        
                       // $('#answerbox').jqm();
                       // $('#answerbox1').jqm();
                        
                        
                        $('#crear').click(function(){
                             window.location.href = "index.php";
                        });

                        
                    });
                    
                </script>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
		<!--[if lte IE 7]><link rel="stylesheet" href="css/ie7.css" /><![endif]-->
	</head>
	<body class="homepage">
		
		<!-- Banner Wrapper -->
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
							
							<div class="row">
								<div class="12u">
								<h2 align="center">Registrar Supermercado</h2>
								</div>
							</div>
							<div class="row half">
								<div class="1u">
								</div>
								<div class="10u">
									<input type="text" class="textReg" id="Nombre" name="Nombre" placeholder="Nombre Supermercado"  /><br>
								</div>
								<div class="1u">
								</div>
							</div>
							<div class="row half">
								<div class="1u">
								</div>
								<div class="7u">
									<input type="text" class="textReg" id="Direccion" name="Direccion" placeholder="Direccion" /><br>
								</div>
								<div class="3u">
									<input type="text" class="textReg" id="Numero" name="Numero" placeholder="Numero" /><br>
								</div>
								<div class="1u">
								</div>
							</div>
							<div class="row half">
								<div class="1u">
								</div>
								<div class="5u">
									<select  class="textSel" id="Provincia" name="Provincia" onchange="localidadSelect();" ><option value="volvo"></option></select><br>
								</div>
								<div class="5u">
									<select  class="textSel" id="Localidad" name="Localidad" ><option value=''>Seleccione una localidad</option></select><br>
								</div>
								<div class="1u">
								</div>
							</div>
							<div class="row half">
								<div class="1u">
								</div>
								<div class="3u">
									<select  class="textSel" id="HorarioDesde" name="HorarioDesde" ><option value=''>Horario Desde</option>
									<?php 
									for($i=0;$i<24;$i++){
										$salida .= "<option value='".$i."'>".$i." hs</option>";
									}
									echo $salida;
									?>
									</select><br>
								</div>
								<div class="3u">
									<select  class="textSel" id="HorarioHasta" name="HorarioHasta" ><option value=''>Horario Hasta</option>
									<?php 
									for($i=0;$i<24;$i++){
										$salida .= "<option value='".$i."'>".$i." hs</option>";
									}
									echo $salida;
									?>
									</select><br>
								</div>
								<div class="4u">
									<select  class="textSel" id="AbiertoDias" name="AbiertoDias" >
										<option value=''>De</option>
										<option value='1'>Lunes a Viernes</option>
										<option value='2'>Lunes a Sabado</option>
										<option value='3'>Lunes a Domingo</option>
									</select><br>
								</div>
								<div class="1u">
								</div>
							</div>
							<div class="row">
								<div class="4u">
								</div>
								<div class="2u">
									<ul align="center">
										<li><a href="" onclick="return validacionAgregarSupermercado()" class="buttonReg big fa fa-save">Guardar</a></li>
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
			
		<div id="dialog-message" title="Registración">
			<p id="mensaje">
				<span class="ui-icon ui-icon-circle-check"  style="float:left; margin:0 7px 50px 0;"></span>
			</p>
		</div>
		

		<!-- Footer Wrapper -->
		<div id="footer-wrapper">
			<?php include('includes/footer.php'); ?>
		</div>
		
		<script>
		
			function localidadSelect(){
				
				var provincia = $('#Provincia').val();
				//alert(provincia);
				
				 $.post("includes/provincias.php",{ loc : 'localidad' , provincia : provincia } , function(data){
					   $('#Localidad').html(data);
			   });
			}
			
			function validacionAgregarSupermercado(){
				
				var nombre = $('#Nombre').val();
				var direccion = $('#Direccion').val();
				var numero = $('#Numero').val();
				var provincia = $('#Provincia').val();
				var provincia_nombre =  $("#Provincia option:selected").text();
				var localidad = $('#Localidad').val();
				var localidad_nombre = $("#Localidad option:selected").text();
				var HorarioDesde = $('#HorarioDesde').val();
				var HorarioHasta = $('#HorarioHasta').val();
				var AbiertoDias = $('#AbiertoDias').val();
				var AbiertoDias_nombre = $("#AbiertoDias option:selected").text();
				
				var error = '';
				
				if(nombre == ''){
					error += 'Debe ingresar nombre <br>';
				}
				if(direccion == ''){
					error += 'Debe ingresar una dirección  <br>';
				}
				if(numero == ''){
					error += 'Debe ingresar un numero <br>';
				}
				if(provincia == ''){
					error += 'Debe ingresar una provincia <br>';
				}
				if(localidad == ''){
					error += 'Debe ingresar una localidad <br>';
				}
				if(HorarioDesde == ''){
					error += 'Debe ingresar el horario desde<br>';
				}
				if(HorarioHasta == ''){
					error += 'Debe ingresar el horario hasta<br>';
				}
				if(AbiertoDias == ''){
					error += 'Debe ingresar los días hábiles<br>';
				}
				
			   // password = Base64.encode(password);
			   // alert(password);
				if(error != ''){
					alertify.alert("<u>Registración de Supermercado</u></br>La registracion del supermerado tiene los siguientes errores : <br>" + error, function () {    
					  });
					   $('.alertify-dialog').css('height','550px');
				}else{
					
					$.post("includes/supermercado.php",{ accion : 'registrar' 
					, nombre : nombre
					, direccion : direccion 
					, numero : numero
					, provincia : provincia					
					, provincia_nombre : provincia_nombre 
					, localidad : localidad
					, localidad_nombre : localidad_nombre
					, HorarioDesde : HorarioDesde
					, HorarioHasta : HorarioHasta
					, AbiertoDias_nombre : AbiertoDias_nombre
					} , function(data){
						   alert(data);
				   });
				}
				
				return false;
			}
		</script>
	</body>
</html>