<?php
session_start();
if($_GET['action']=="c")
{
    $nomCur=$_POST['nomcur'];
    $desCur=$_POST['descur'];
    $cedUsuCre=$_SESSION['user'];
    $preCur=$_POST['precur'];
    require("../../controllers/BDController/connectionController.php");
    $connection = new connection('localhost','root','','bd_for_grup');
    $sql="INSERT INTO curso (NOM_CUR,DES_CUR,CED_USU_CREA,PRE_CUR) VALUES ('$nomCur','$desCur','$cedUsuCre',$preCur)";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
    header("Location:misCursos.php");
    }
    echo '<script>alert("No se pudo crear el curso");location.href="misCursos.php";</script>'; 
}
else if($_GET['action']=="d")
{
    $idCur=$_GET['curso'];
    require("../../controllers/BDController/connectionController.php");
    $connection = new connection('localhost','root','','bd_for_grup');
    $sql="DELETE FROM curso WHERE ID_CUR=$idCur";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:misCursos.php");
    }
    echo '<script>alert("No se pudo eliminar curso");location.href="misCursos.php";</script>';    
}
else if($_GET['action']=="ddc")
{
    $idCur=$_GET['curso'];
    $cedUsuPer=$_SESSION['user'];
    require("../../controllers/BDController/connectionController.php");
    $connection = new connection('localhost','root','','bd_for_grup');
    $sql="DELETE FROM detalle_curso WHERE ID_CUR_PER=$idCur and CED_USU_PER =$cedUsuPer";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:misCursos.php");
    }
    echo '<script>alert("No se pudo eliminar curso");location.href="misCursos.php";</script>';    
}
?>