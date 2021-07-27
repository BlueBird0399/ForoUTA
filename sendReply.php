<?php
session_start();
$idPubPer=$_POST['idpub'];
$CedUsuPub=$_POST['cedusupub'];
$DetPub=$_POST['detpub'];
require_once("controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
$insert="INSERT INTO detalle_publicacion (ID_PUB_PER,CED_USU_PUB,DET_PUB) VALUES ('$idPubPer','$CedUsuPub','$DetPub')";
$execute=mysqli_query($connection->getConnection(),$insert);
if($execute)
{
    //$_SESSION["user"]=$CedUsuPub;
    header("Location:publicacion.php?publi=$idPubPer");

}
echo '<script>alert("No se pudo enviar la respuesta");location.href="publicacion.html";</script>'; 
?>