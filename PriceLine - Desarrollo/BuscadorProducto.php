<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
include('includes/init.php');
?>
<html>
	<head>
		<title>Verti by HTML5 UP</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,800" rel="stylesheet" type="text/css" />
                <link href="css/jquery-ui.min.css"/>
                <link href="css/wizard.css" rel="stylesheet" type="text/css" />
                <noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<script src="js/jquery.min.js"></script>
                <script src="js/jquery-ui.min.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>
                <script src="js/jquery.steps.js"></script>
                <script>
                 $(function() {
                        var availableTags = [
                            <?php echo $lista_prod; ?>
                        ];
                        $( "#producto" ).autocomplete({
                                source: availableTags,
                                open: function(event, ui) {
                                        $(this).autocomplete("widget").css({
                                            "width": 778,
                                            "backgroundColor": "#fff",
                                            "border": "2px solid #f0f0f0",
                                            "box-shadow": "-2px 2px 3px #898c66",
                                            "padding-left" : "5px"
                                        });
                                    }
                        });
                        });
                  $(document).ready(function(){
                        $("#wizard").steps();
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

									<div id="wizard">
                                                                            
										<h1>
											
											<p>Realizá tu búsqueda</p>
										</h1>
                                                                                
										<div class="row">
											<div class="9u">
												<div class="row half">
													<div class="12u">
                                                                                                            <input type="text" class="text" id="producto" name="producto" placeholder="Producto" />
													</div>
													<!--<div class="4u">  
														<input type="text" class="text" name="email" placeholder="Categoria" />
													</div>-->
												</div>
											</div>
											<div class="3u">
												<ul>
													<li><a href="ResultadoBusqueda.html" class="button small fa fa-arrow-circle-right">Buscar Precio</a></li>
												</ul>
											</div>
										</div>
                                                                                 
                                                                                <h1>

                                                                                            <p>Realizá tu búsqueda</p>
                                                                                </h1>
                                                                                
                                                                                <div class="row">
                                                                                        <div class="9u">
                                                                                                <div class="row half">
                                                                                                        <div class="12u">
                                                                                                            <input type="text" class="text" id="producto" name="producto" placeholder="Producto" />
                                                                                                        </div>
                                                                                                        <!--<div class="4u">  
                                                                                                                <input type="text" class="text" name="email" placeholder="Categoria" />
                                                                                                        </div>-->
                                                                                                </div>
                                                                                        </div>
                                                                                        <div class="3u">
                                                                                                <ul>
                                                                                                        <li><a href="ResultadoBusqueda.html" class="button small fa fa-arrow-circle-right">Buscar Precio</a></li>
                                                                                                </ul>
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
                                    <?php for($i=0;$i<count($vistos_prod)/4;$i++){ ?>
                                            <div class="row">
                                                <?php for($j=0;$j<count($vistos_prod)/2;$j++){ if($j!=0) $j*2; ?>
                                                    <div class="3u">

                                                            <!-- Box -->
                                                                    <section class="box box-feature">
                                                                            <a href="VistaProducto.html" class="image image-full"><img src="data:image/png;base64,<?php echo $vistos_prod[$j]['Foto'] ?>" alt="" /></a>
                                                                            <div class="box-prod">
                                                                                            <p><?php echo $vistos_prod[$j]['Nombre'] ?></p>
                                                                            </div>
                                                                    </section>

                                                    </div>
                                            
                                                <?php } ?>
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
