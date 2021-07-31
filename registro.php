<?php
//conexion con la base de datos y el servidor
session_start();
require_once("controllers/BDController/connectionController.php");
require_once("controllers/validador/ValidarIdentificacion.php");
$connection = new connection('localhost','root','','bd_for_grup');
//obtenemos los valores del formulario
$ced = $_POST['userCed'];
$name = $_POST['username'];
$surname = $_POST['usersurname'];
$user= $_POST['user'];
$date= $_POST['userBdate'];
$email = $_POST['useremail'];
$pass = $_POST['userpassword'];
$valCed=new ValidarIdentificacion;
if(!$valCed->validarCedula($ced)){
    session_destroy(); 
    echo '<script>alert("Ingrese una cédula verdadera");location.href="formulario.html";</script>';
    
}
else
{
$avatar=fopen("assets/images/default.png","r");
echo filesize("assets/images/default.png");
$avatarBLOB = fread($avatar,filesize("assets/images/default.png"));
$avatarBLOB=addslashes($avatarBLOB);
fclose($avatar);
$search="SELECT NIC_USU,CONT_USU  FROM usuario";
$busqueda=mysqli_query($connection->getConnection(),$search);
$finduser=FALSE;
while ($row = mysqli_fetch_assoc($busqueda)) {
    if(($row["NIC_USU"]==$user)or($row["CONT_USU"]==$email))
    {
        $finduser=TRUE; 
    }
}
if($finduser)
{
	echo '<script>alert("Nombre de Usuario o Correo ya Utilizado");location.href="formulario.html";</script>'; 
}
else
{
	//se encripta la contraseña
$encryptedpass = password_hash($pass,PASSWORD_DEFAULT);
//Se realiza la sentencia sql
$insert="INSERT INTO usuario
(CED_USU,NOM_USU,APE_USU,FEC_NAC,FOT_USU,NIC_USU,CONT_USU,CORR_USU) VALUES ('$ced','$name','$surname','$date','$avatarBLOB','$user','$encryptedpass','$email')";
//Se ingresa la información a la base de datos
$execute=mysqli_query($connection->getConnection(),$insert);
if($execute)
{
$_SESSION["user"]=$ced;
mysqli_close($connection->getConnection());
header("Location:forum.php");
}
echo '<script>alert("No se pudo realizar el registro, contactese con los responsables del servicio");location.href="formulario.html#contactos";</script>'; 
}
}


?>