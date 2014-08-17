<!DOCTYPE HTML>
<html>
	<head>
		<title>PriceLine</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,800" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="css/jquery-ui.css" />
                <script src="js/jquery.min.js"></script>
                <script src="js/jquery-ui.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
                <script src="js/jqModal.min.js"></script>
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
                        
                        $('#answerbox').jqm();
                        $('#answerbox1').jqm();
                        
                        
                        $('#crear').click(function(){
                             window.location.href = "index.php";
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
										<h2 align="center">Formulario de Registración</h2>
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="5u">
                                                                                    <input type="text" class="textReg" id="Nombre" name="Nombre" placeholder="Nombre"  /><br>
										</div>
										<div class="5u">
                                                                                    <input type="text" class="textReg" id="Apellido" name="Apellido" placeholder="Apellido" /><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="5u">
                                                                                    <select  class="textSel" id="Provincia" name="Provincia" onchange="localidadSelect();" ><option value="volvo"></option></select>
                                                                                   <!-- <input type="text" class="textReg" id="Provincia" name="Provincia" placeholder="Provincia" />--><br>
										</div>
										<div class="5u">
                                                                                    <select  class="textSel" id="Localidad" name="Localidad" ><option value=''>- Seleccione una localidad -</option></select>
                                                                                   <!-- <input type="text" class="textReg" id="Localidad" name="Localidad" placeholder="Localidad" />--><br>
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
										<div class="10u">
                                                                                    <input type="text" class="textReg" id="Email" name="Email" placeholder="Email" /><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="5u">
											<input type="password" class="textReg" id="Password" name="Password" placeholder="Password" /><br>
										</div>
										<div class="5u">
											<input type="password" class="textReg" id="RepertirPassword" name="RepetirPassword" placeholder="Repetir Password" /><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row">
										<div class="4u">
										</div>
										<div class="2u">
											<ul align="center">
                                                                                            <li><a href="" onclick="return validacionRegistracion()" class="buttonReg big fa fa-save">Guardar</a></li>
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
                
    <div class="answerbox jqmWindow home-answer" id="answerbox">
    <div class="titlesection">
        <div class="subplace">
        <h2>Registración</h2>
         <div class="clear"></div>
        </div>
    </div>

    <div class="clear"></div>
    <div class="mensajewindowbox">Se ha registrado correctamente!</div>
    <a href="javascript:" id="crear" class="yep aselection jqmClose">Ok</a>
    </div>
                
    <div class="answerbox jqmWindow home-answer" id="answerbox1">
    <div class="titlesection">
        <div class="subplace">
        <h2>Error</h2>
         <div class="clear"></div>
        </div>
    </div>

    <div class="clear"></div>
    <div class="mensajewindowbox" id="error"></div>
    <a href="javascript:" id="editado" class="yep aselection jqmClose">Ok</a>
    </div>            
                
                <script>
                    function localidadSelect(){
                        
                        var provincia = $('#Provincia').val();
                        //alert(provincia);
                        
                         $.post("includes/provincias.php",{ loc : 'localidad' , provincia : provincia } , function(data){
                               $('#Localidad').html(data);
                       });
                    }
                    
                    
                    function validacionRegistracion(){
                        
                        var nombre = $('#Nombre').val();
                        var apellido = $('#Apellido').val();
                        var provincia = $('#Provincia').val();
                        var provincia_nombre =  $("#Provincia option:selected").text();
                        var localidad = $('#Localidad').val();
                        var localidad_nombre = $("#Localidad option:selected").text();
                        var direccion = $('#Direccion').val();
                        var numero = $('#Numero').val();
                        var email = $('#Email').val();
                        var password = $('#Password').val();
                        var repPass = $('#RepertirPassword').val();
                        
                        var error = '';
                        
                        if(nombre == ''){
                            error += 'Debe ingresar nombre <br>';
                        }
                        if(apellido == ''){
                            error += 'Debe ingresar apellido <br>';
                        }
                        if(provincia == ''){
                            error += 'Debe ingresar una provincia <br>';
                        }
                        if(localidad == ''){
                            error += 'Debe ingresar una localidad <br>';
                        }
                        if(direccion == ''){
                            error += 'Debe ingresar una dirección  <br>';
                        }
                        if(numero == ''){
                            error += 'Debe ingresar un numero <br>';
                        }
                        if(email == ''){
                            error += 'Debe ingresar un email <br>'
                        }else{
                            var RegExPatternEmail = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
                            if(!email.match(RegExPatternEmail)){
                                error += "Ingrese un email valido <br>";
                            }
                        }
                        if(password != repPass){
                            error += 'Las contraseñas no son iguales <br>';
                        }else{
                            var RegExPattern = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;
                            if(!password.match(RegExPattern)){
                                error += "La contraseña debe tener entre 8 y 10 caracteres, por lo menos un digito y un alfanumérico, y no puede contener caracteres espaciales <br>";
                            }
                        }
                        
                       // password = Base64.encode(password);
                       // alert(password);
                        if(error != ''){
                           
                           /* $( '#dialog-message' ).dialog({
                            modal: true,
                            buttons: {
                            Ok: function() {
                                    $( this ).dialog( "close" );
                                }}
                            }).css('width','500px');
                            $('.ui-dialog').css('width','500px');*/
                            $('#error').empty();
                            $('#error').append(error);
                            $('#answerbox1').jqmShow();
                            
                        }else{
                            
                            $.post("includes/acciones.php",{ accion : 'registrar' , nombre : nombre, apellido : apellido
                                , provincia : provincia , provincia_nombre : provincia_nombre , localidad_nombre : localidad_nombre,
                                localidad : localidad , direccion : direccion, numero : numero , email : email , password : password
                            } , function(data){
                                   eval(data);
                           });
                        }
                        
                        return false;
                    }
                </script>
	</body>
</html>