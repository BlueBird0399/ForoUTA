<?php
session_start();
require_once("controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
$user=$_POST["user"];
$pass=$_POST["userpassword"];
$search="SELECT CED_USU,NIC_USU,CONT_USU  FROM usuario";
$busqueda=mysqli_query($connection->getConnection(),$search);
$finduser=FALSE;
while ($row = mysqli_fetch_assoc($busqueda)) {
    if(($row["NIC_USU"]==$user)and(password_verify($pass,$row["CONT_USU"])))
    {
        $finduser=TRUE; 
        $_SESSION["user"]=$row["CED_USU"];
    }
}
if($finduser)
{
header("Location:forum.php");
}
else
{
echo '<script>alert("Nombre de Usuario o Contraseña Incorrectos");location.href="login.html";</script>'; 
}
/* liberar el conjunto de resultados */
mysqli_free_result($busqueda);
?>