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
                <link rel="stylesheet" href="css/alertify.default.css"/>
                <link rel="stylesheet" href="css/alertify.core.css"/>
		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
                
                <script type="text/javascript">
                        function borrarProducto(idLista, id){
                            
                            quitarProducto(id);
                            $("#"+idLista).remove();
                        }   
                        
                        function quitarProducto(id){
                             
                            var idProd = $('#ListaProducto').val();
                             
                             idProd = idProd.replace("|"+id,"");
                             $('#ListaProducto').val(idProd);
                             
                        }
                        function GuardarPresupuesto(){
                            
                            var nombre = $('#Nombre').val();
                            var productos = $('#ListaProducto').val();
                            var error = '';
                            
                            if(nombre == ''){
                                error += 'Debe ingresar un nombre para el presupuesto</br>';
                            }
                            if(productos == ''){
                                error += 'Debe ingresar por lo menos un producto</br>';
                            }
                            if(error != ''){
                                 alertify.alert("<u>Presupuesto</u></br>" + error, function () {    
                              });
                               $('.alertify-dialog').css('height','220px');
                            }else{
                                
                                 $.post("includes/presupuesto.php",{ accion : 'agregarLista' , nombre : nombre, productos : productos} , function(data){
                                       eval(data);
                               });
                            }
                            return false;
                        }
                    $(function(){
                        
                        function borrarProducto(idLista, id){
                            
                            quitarProducto(id);
                            $(idLista).remove();
                        }
                         function log( message , id ) {
                            // alert(1);
                            //$( "<div>" ).text( message ).prependTo( "#lista" );
                            $("#lista").append('<p style="font-size:16px;" id="list'+id+'">'+message+'<span onclick="borrarProducto(\'list'+id+'\','+id+');">x</span></p>');
                           // $( "#lista" ).scrollTop( 0 );
                         }
                         function listaProducto(id){
                             
                             var idProd = $('#ListaProducto').val();
                             
                             idProd += id+'|';
                             $('#ListaProducto').val(idProd);
                             
                         }
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
                                    log( ui.item.value,ui.item.id);
                                    listaProducto(ui.item.id);
                                     this.val = "";
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
										<h2 align="center">Nuevo Presupuesto: </h2>
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="9u">
                                                                                    <input type="text" class="textReg" id="Nombre" name="Nombre" placeholder="Nombre del Presupuesto"  /><br>
										</div>
										<div class="1u">
										</div>
									</div>
                                                                    	<div class="row half">
										<div class="1u">
										</div>
										<div class="9u">
                                                                                    <input type="text" class="textReg" id="producto" name="Producto" placeholder="Ingrese Producto"  /><br>
										</div>
										<div class="1u">
										</div>
									</div>
                                                                        <div class="row half">
										<div class="1u">
										</div>
										<div class="9u">
                                                                                    <div id="lista" class="textReg" ></div>
                                                                                    <input type="hidden"  id="ListaProducto" name="ListaProducto"   /><br>
										</div>
										<div class="1u">
										</div>
									</div>
									<div class="row">
										<div class="4u">
										</div>
										<div class="2u">
											<ul align="center">
                                                                                            <li><a href="" onclick="return GuardarPresupuesto()" class="buttonReg big fa fa-save">Guardar</a></li>
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