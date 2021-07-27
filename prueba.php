<?php
$fecha = DateTime::createFromFormat('d/m/Y', '21/06/2016');
$hola=$fecha->format('Y-m-d');
echo $hola;
?>