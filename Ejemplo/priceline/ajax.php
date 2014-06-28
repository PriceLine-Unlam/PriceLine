<?php


include('classes/SqlSrv.class.php');

$sql = new SqlSrv();


$ph = $sql->fetchArray("execute dbo.spGetNearLocations ".$_POST['lat']." , ".$_POST['long']); //devuelve un array 

$i = 0;
foreach($ph as $supermercado){
    
    $StringJS .= "   var myLatlng".$i." = new google.maps.LatLng(".$supermercado['Latitud'].",".$supermercado['Longitud']."); "
            . "      var marker".$i." = new google.maps.Marker({
                     position: myLatlng".$i.",
                     map: map,
                     title: '".$supermercado['Nombre']."'}); "
            . "      var infowindow".$i." = new google.maps.InfoWindow({
                     content: '".$supermercado['Nombre']."' });
                      google.maps.event.addListener(marker".$i.", 'click', function() {
                        infowindow".$i.".open(map,marker".$i.");
                      }); ";
    $i++;
}

echo $StringJS; 

?>
