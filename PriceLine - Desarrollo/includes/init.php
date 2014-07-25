<?php

include('classes/SqlSrv.class.php');

$sql = new SqlSrv();

$vistos_prod = $sql->fetchArray("SELECT TOP 8 (Nombre +' - '+ Marca) Nombre , Foto ,idProducto from Producto ORDER BY Visitado desc"); //devuelve un array





 
//print_r($vistos_prod);exit();
