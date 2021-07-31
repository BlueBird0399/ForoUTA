<?php
include("controllers/validador/ValidarIdentificacion.php");
$valCed=new ValidarIdentificacion;

if($valCed->validarCedula("1805283452")){
  echo "nice";
}
?>

