<!DOCTYPE HTML>
<!--
	Verti 2.5 by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<?php
    
    
    session_start();
    include('includes/init.php');
    include('includes/presupuesto.php');
    
    function valueSelect($value,$select){
        
        if($value == $select){
            return "selected";
        }
        return '';
    }
    
    
    //print_r($datos); die();

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
                
                <script type="text/javascript">
                        function borrarProducto(idLista, id){
                            
                            quitarProducto(id);
                            $("#"+idLista).remove();
                        }   
                        function isEmpty(value){
                            return (typeof value === "undefined" || value === null);
                        }
                        function quitarProducto(id){
                             
                            var idProd = $('#ListaProducto').val();
                             idProd = idProd.replace(id+"|","");
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
                                
                                var idProductos = productos.split("|");
                                var importancia = '';
                                //imp
                                for(i=0;i<(idProductos.length-1);i++){
                                   // alert('#imp'+idProductos[i]);
                                     var imp = $('#imp'+idProductos[i]).val();
                                    importancia += imp + "|";
                                }
                                
                                //alert(importancia);
                                
                                 $.post("includes/presupuesto.php",{ accion : 'modificarLista' , nombre : nombre, productos : productos, importancia : importancia, idLista : <?php echo $datos[0]['idLista'] ?>} , function(data){
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
                            $("#lista").append('<div style="font-size:16px;height: 30px;" id="list'+id+'">'+message+' <div style="position: relative;top:-34px;left:550px;">Importancia: <select id="imp'+id+'"><option value="1">Alta</option><option value="2">Media</option><option value="3">Baja</option></select></div><span style="cursor:pointer;position:relative; top:-65px;left:730px;" onclick="borrarProducto(\'list'+id+'\','+id+');"><img style="width:18px;height:18px;" src="images/cruz_naranja.png"></span></div>');
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
										<h2 align="center">Editar Presupuesto: </h2>
										</div>
									</div>
									<div class="row half">
										<div class="1u">
										</div>
										<div class="9u">
                                                                                    <input type="text" class="textReg" id="Nombre" name="Nombre" placeholder="Nombre del Presupuesto" value="<?php echo $datos[0]['Titulo'] ?>"  /><br>
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
                                                                                    <div id="lista" class="textReg" >
                                                                                        <?php 
                                                                                        $lista = '';
                                                                                        foreach ($datos as $producto){
                                                                                            $lista .= $producto['idProducto'].'|';
                                                                                        ?>
                                                                                             <div style="font-size:16px;height: 30px;" id="list<?php echo $producto['idProducto'] ?>"><?php echo $producto['Nombre'] ?> <div style="position: relative;top:-34px;left:550px;">Importancia: <select id="imp<?php echo $producto['idProducto'] ?>"><option value="1"  <?php echo valueSelect("1",$producto['importancia']); ?> >Alta</option><option value="2" <?php echo valueSelect("2",$producto['importancia']); ?> >Media</option><option value="3" <?php echo valueSelect("3",$producto['importancia']); ?> >Baja</option></select></div><span style="cursor:pointer;position:relative; top:-65px;left:730px;" onclick="borrarProducto('list<?php echo $producto['idProducto'] ?>','<?php echo $producto['idProducto'] ?>');"><img style="width:18px;height:18px;" src="images/cruz_naranja.png"></span></div>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <input type="hidden"  id="ListaProducto" name="ListaProducto"  value="<?php echo $lista; ?>" /><br>
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