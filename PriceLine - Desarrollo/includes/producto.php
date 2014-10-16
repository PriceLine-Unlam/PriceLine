<?php
include('../classes/SqlSrv.class.php');

$sql = new SqlSrv();

if( $_POST[prod] == "obtenerCategorias" ){

    $categoria = $sql->fetchArray("SELECT id_categoria idCategoria,nombre nombreCategoria 
									FROM priceline..Categorias");
	
    $categ = "<option value=''>Seleccione una Categoria</option>";
    foreach ($categoria as $cat){
        $categ .="<option value='".$cat['idCategoria']."'>".$cat['nombreCategoria']."</option>";
    }

    echo utf8_encode($categ);

}

if( $_POST[accion] == "registrar" ){

    //print_r($_REQUEST);
    $nombreProducto = $_POST['nombreProducto'];
    $marcaProducto = $_POST['marcaProducto'];
    $categoria = $_POST['categoria'];
    $tamano = $_POST['tamano'];
    
    $query = " EXEC dbo.PLInsertarNuevoProducto '".$nombreProducto."', '".$marcaProducto."', '".$categoria."', '".$tamano."', '".$_SESSION['usuario_email']."' ";
		   
    $ok = $sql->query($query);
    
    echo 'alertify.alert("<u>Supermercado</u></br> El supermercado fué registrado con éxito!", function () { window.location.reload(); });$(".alertify-dialog").css("height","250px");';    

}