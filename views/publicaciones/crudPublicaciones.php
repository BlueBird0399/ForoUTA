<?php
session_start();
switch($_GET['action'])
{
case "d":
    $idPub=$_GET['publi'];
    require("../../controllers/BDController/connectionController.php");
    $connection = new connection('localhost','root','','bd_for_grup');
    $sql="DELETE FROM detalle_publicacion WHERE ID_PUB_PER=$idPub";
    $execute=mysqli_query($connection->getConnection(),$sql);
    $sql="DELETE FROM publicacion WHERE ID_PUB=$idPub";
    $execute=mysqli_query($connection->getConnection(),$sql);
    if($execute)
    {
        if(isset($_GET['forum']))
        {
            header("Location:../../forum.php");
            break;
        }
        header("Location:misPublicaciones.php");
        break;
    }
    echo '<script>alert("No se pudo eliminar la Publicación");location.href="misPublicaciones.php";</script>';   
    break;
case "c":
    if($_FILES['filepub']['name'] != null)
    {  
        $file=addslashes(file_get_contents($_FILES['filepub']['tmp_name']));
        $titPub=$_POST['titpub'];
        $desPub=$_POST['despub'];
        $cedUsuPub=$_SESSION["user"];
        require("../../controllers/BDController/connectionController.php");
        $connection = new connection('localhost','root','','bd_for_grup');
        $sql="INSERT INTO publicacion (CED_USU_PUB,IMG_PUB,DES_PUB,TIT_PUB) VALUES ('$cedUsuPub','$file','$desPub','$titPub')";
        $execute=mysqli_query($connection->getConnection(),$sql);
        if($execute)
        {
            header("Location:misPublicaciones.php");
            break;
        }
        echo '<script>alert("No se pudo crear la Publicación");location.href="misPublicaciones.php";</script>'; 
        break;
    }
    else
    {
        $titPub=$_POST['titpub'];
        $desPub=$_POST['despub'];
        $cedUsuPub=$_SESSION["user"];
        require("../../controllers/BDController/connectionController.php");
        $connection = new connection('localhost','root','','bd_for_grup');
        $sql="INSERT INTO publicacion (CED_USU_PUB,DES_PUB,TIT_PUB) VALUES ('$cedUsuPub','$desPub','$titPub')";
        $execute=mysqli_query($connection->getConnection(),$sql);
        if($execute)
        {
            header("Location:misPublicaciones.php");
            break;
        }
        echo '<script>alert("No se pudo crear la Publicación");location.href="misPublicaciones.php";</script>'; 
        break;
    } 
    break;
case "up":
    if($_FILES['filepub']['name'] != null)
    {  
        $file=addslashes(file_get_contents($_FILES['filepub']['tmp_name']));
        $idPub=$_GET['publi'];
        $titPub=$_POST['titpub'];
        $desPub=$_POST['despub'];
        require("../../controllers/BDController/connectionController.php");
        $connection = new connection('localhost','root','','bd_for_grup');
        $sql="UPDATE publicacion SET IMG_PUB='$file',DES_PUB='$desPub',TIT_PUB='$titPub' WHERE ID_PUB=$idPub";
        $execute=mysqli_query($connection->getConnection(),$sql);
        if($execute)
        {
            header("Location:misPublicaciones.php");
            break;
        }
        echo '<script>alert("No se pudo actualizar la Publicación");location.href="misPublicaciones.php";</script>'; 
        break;
    }
    else
    {
        $idPub=$_GET['publi'];
        $titPub=$_POST['titpub'];
        $desPub=$_POST['despub'];
        require("../../controllers/BDController/connectionController.php");
        $connection = new connection('localhost','root','','bd_for_grup');
        $sql="UPDATE publicacion SET DES_PUB='$desPub',TIT_PUB='$titPub' WHERE ID_PUB=$idPub";
        $execute=mysqli_query($connection->getConnection(),$sql);
        if($execute)
        {
            header("Location:misPublicaciones.php");
            break;
        }
        echo '<script>alert("No se pudo actualizar la Publicación");location.href="misPublicaciones.php";</script>'; 
        break;
    } 
    break;
    
}

?>