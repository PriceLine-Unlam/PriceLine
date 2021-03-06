<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

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
		</noscript>
                <script>
                   function recuperarContrasena(){
                       alertify.confirm("<p>Ingrese el email registrado : <input type='text' id='emailRec' style='height: 35px; width:255px; padding-bottom: 2px;'> </p>", function (e) {
                                if (e) {
                                        var valor =  $('#emailRec').val();
                                          $.post("includes/acciones.php",{ accion : 'RecuperarContrasena', email : valor } , function(data){
                                                                           eval(data);     
                                                                        });
                                      
                                } 
                            });
                            $('.alertify-dialog').css('height','190px');
                              return false;
                   }
                    
                </script>
                <script>
  window.fbAsyncInit = function() {
         FB.init({
           appId      : '313421392182907',//'853152691361977' version anterior, // App ID
           status     : true, // check login status
           cookie     : true, // enable cookies to allow the server to access the session
           xfbml      : true  // parse XFBML
         });
 
        FB.getLoginStatus(function(response) {
                    if (response.status == 'connected') {
                                login();
                    } else {
                      logout();
                    }
                  });
 
         /* Eventos para capturar el login del usuario */
         FB.Event.subscribe('auth.login', function(response) { // cuando autoriza conexion
             login();
         });
 
       /* Funcion que se ejecuta cuando ya se autoriza la conexion */
       function login(){
           console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                      $.post("ingreso.php",{ accion : 'facebook' , email: response.email,nombre : response.first_name , apellido : response.last_name} , function(data){ eval(data);});
                      });
       }
       
       /* Funcion que se ejecuta cuando aun no se hace la conexion con facebook */
       function logout(){
          // window.location.href = 'index.php';
          //alert('usted se ha desconectado de facebook!');
          console.log('deslogueo');
       }
       /* Funcion para extraer algunos datos del susuario, como nombre y foto */
       function fqlQuery(){
           FB.api('/me', function(response) {
                var query = FB.Data.query('select name,email, hometown_location, sex, pic_square from user where uid={0}', response.id);
                query.wait(function(rows) {
                        console.log(rows);
                });
           });
       }};
        
 
       // Load the SDK Asynchronously
       (function(d){
          var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
          if (d.getElementById(id)) {return;}
          js = d.createElement('script'); js.id = id; js.async = true;
          js.src = "//connect.facebook.net/en_US/all.js";
          ref.parentNode.insertBefore(js, ref);
        }(document));
        
               
       /* Funcion para abrir la ventanita y conectarse a facebook */
        function facebookLogin() {
                FB.login(function(response) {
                                if (response.authResponse){
                                    login();
                                } else {
                                    logout();
                                }
                              },{ scope: 'email' });
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

									<div class="row half">
										<div class="6u">
											<h2 align="center">Login</h2><br>
											<input type="text" class="textLog" id="email" name="email" placeholder="Usuario" /><br>
											<input type="password" class="textLog" id="password" name="password" placeholder="Password" /><br>
											<ul align="center">
                                                                                            <li><a href="" onclick="return ingreso();" class="buttonLog small fa fa-arrow-circle-right">Ingresar</a></li>
                                                                                            <li><a href="" onclick="return recuperarContrasena();" >Recuperar Contraseña</a> </li>
											</ul>
										</div>
										<div class="6u">
											<h2 align="center">Regístrate</h2><br>
											<p align="center">Es facíl<br>
											Haciendo click aquí</p><br>
											<ul align="center">
												<li><a href="Registrar.php" class="buttonReg big fa fa-save">Registrar</a></li>
                                                                                                <li><a id='fb-login' href='#' onclick='facebookLogin()' style=""><img src="http://oundmedia.com/facebook-connect-button.png" border="0"/></a></li>
											</ul>
                                                                                        
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
                <script>
                    function ingreso(){
                        var email = $('#email').val();
                        var password = $('#password').val();
                        
                         $.post("ingreso.php",{ accion : 'ingreso' , email : email , password : password   } , function(data){
                                  //if(data !=""){
                                        eval(data);
                                    //}
                           });
                        return false;
                    }
                    <?php
                       if(isset($_GET['error'])){
                    ?>
                        $().ready(function(){

                                 alertify.alert("<u>Login</u></br> El usuario y/o la contraseña incorrectas!", function () {  })
                                 ;$(".alertify-dialog").css("height","200px");
                        
                      });
                    <?php
                      }
                    ?>
                </script>
	</body>
</html>
