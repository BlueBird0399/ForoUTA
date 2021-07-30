<?php
session_start();
require("../../controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
switch($_GET['action'])
{
case "c" :
    $nomCur=$_POST['nomcur'];
    $desCur=$_POST['descur'];
    $cedUsuCre=$_SESSION['user'];
    $preCur=$_POST['precur'];
    $sql="INSERT INTO curso (NOM_CUR,DES_CUR,CED_USU_CREA,PRE_CUR) VALUES ('$nomCur','$desCur','$cedUsuCre',$preCur)";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
    header("Location:misCursos.php");
    break;
    }
    echo '<script>alert("No se pudo crear el curso");location.href="misCursos.php";</script>';
    break;
case "d" :
    $idCur=$_GET['curso'];
    $sql="DELETE FROM detalle_curso WHERE ID_CUR_PER=$idCur";
    $execute=mysqli_query($connection->getConnection(),$sql);
    $sql="DELETE FROM curso WHERE ID_CUR=$idCur";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:misCursos.php");
        break;
    }
    echo '<script>alert("No se pudo eliminar curso");location.href="misCursos.php";</script>';   
    break;
case "ddc":
    $idCur=$_GET['curso'];
    $cedUsuPer=$_SESSION['user'];
    $sql="DELETE FROM detalle_curso WHERE ID_CUR_PER=$idCur and CED_USU_PER =$cedUsuPer";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:cursosInscritos.php");
        break;
    }
    echo '<script>alert("No se pudo salir del Curso");location.href="cursosInscritos.php";</script>'; 
    break;
case "ic":
    $idCur=$_GET['curso'];
    $cedUsuPer=$_SESSION['user'];
    $sql="INSERT INTO detalle_curso (CED_USU_PER,ID_CUR_PER) VALUES('$cedUsuPer','$idCur')";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:cursosInscritos.php");
        break;
    }
    echo '<script>alert("No se pudo Inscribir en el Curso");location.href="verCursos.php";</script>'; 
    break;
case "uc":
    $idCur=$_GET['curso'];
    $nomCur=$_POST['nomcur'];
    $desCur=$_POST['descur'];
    $preCur=$_POST['precur'];
    $sql="UPDATE curso SET NOM_CUR='$nomCur',DES_CUR='$desCur',PRE_CUR=$preCur WHERE ID_CUR=$idCur";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        header("Location:misCursos.php");
        break;
    }
    echo '<script>alert("No se pudo editar el Curso");location.href="misCursos.php";</script>'; 
    break;
}
?>