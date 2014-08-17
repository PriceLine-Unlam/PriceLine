<?php
session_start();
include('classes/SqlSrv.class.php');
$sql = new SqlSrv();


if(isset($_SESSION['usuario_nombre'])){
    
    $lista = $_SESSION['listas'];
    $listas = explode('|', $lista);
    

    for($i=0;$i<count($listas);$i++){
        $query = "EXEC [SPPresupuestoMenor] '".$_SESSION['usuario_email']."',".$listas[$i].",".$_SESSION['usuario_lat'].",".$_SESSION['usuario_lon'];
      // print_r($query);
       
        
        $datos['listas_costo'] = $sql->fetchArray($query);
    }
    
    //echo "<pre>";
    //print_r($datos); 
    //echo "</pre>";
    //die();
}


/*Array
(
    [listas_costo] => Array
        (
            [0] => Array
                (
                    [idLista] => 1
                    [TituloLista] => Prueba
                    [COSTO] => 25.95
                    [idSupermercado] => 2
                    [Nombre] => Carlitos
                    [Direccion] => Coronel Brandsen 2398, ItuzaingÃ³
                    [Longitud] => -58.687975
                    [Latitud] => -34.640976
                    [Horario] => Lunes a Sabado 9hs. a 22hs.
                    [Borrado] => 0
                )

        )

)
 * */
 