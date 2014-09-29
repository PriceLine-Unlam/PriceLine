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
                    $(function(){
                       // $('#answerbox1').jqm();
                             
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

									<div class="row half">
										<div class="6u">
											<h2 align="center">Login</h2><br>
											<input type="text" class="textLog" id="email" name="email" placeholder="Usuario" /><br>
											<input type="password" class="textLog" id="password" name="password" placeholder="Password" /><br>
											<ul align="center">
                                                                                            <li><a href="" onclick="return ingreso();" class="buttonLog small fa fa-arrow-circle-right">Ingresar</a></li>
                                                                                            <li><a href="" onclick="" >Recuperar Contraseña</a> </li>
											</ul>
										</div>
										<div class="6u">
											<h2 align="center">Regístrate</h2><br>
											<p align="center">Es facíl<br>
											Haciendo click aquí</p><br>
											<ul align="center">
												<li><a href="Registrar.php" class="buttonReg big fa fa-save">Registrar</a></li>
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
