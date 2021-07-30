<?php
session_start();
require("../../controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
switch($_GET['action'])
{
case "up":
    if($_FILES['imgusu']['name'] != null)
    {
        $file=addslashes(file_get_contents($_FILES['imgusu']['tmp_name']));
        $cedUsu=$_SESSION['user'];
        $nomUsu=$_POST['nomusu'];
        $apeUsu=$_POST['apeusu'];
        $fecUsu=$_POST['fecusu'];
        $nicUsu=$_POST['nicusu'];
        $corrUsu=$_POST['corrusu'];
        $actPass=$_POST['actpassusu'];
        $newPass=$_POST['newpassusu'];
        if($actPass!="" and $newPass!="")
        {
            $sql="SELECT CONT_USU  FROM usuario WHERE CED_USU=$cedUsu";
            $execute=mysqli_query($connection->getConnection(),$sql);
            if ($row = mysqli_fetch_assoc($execute)) 
            {
                if((password_verify($actPass,$row["CONT_USU"])))
                {
                    $encryptedpass = password_hash($newPass,PASSWORD_DEFAULT);
                    $sql="UPDATE usuario SET NOM_USU='$nomUsu',APE_USU='$apeUsu',FEC_NAC='$fecUsu',FOT_USU='$file',NIC_USU='$nicUsu',CONT_USU='$encryptedpass' WHERE CED_USU=$cedUsu";
                    $execute=mysqli_query($connection->getConnection(),$sql);
                    if($execute)
                    {
                        header("Location:perfilUsuario.php");
                         break;
                     }
                    echo '<script>alert("No se pudo editar el Perfil");location.href="perfilUsuario.php";</script>'; 
                    break;
                }
                else
                {
                    echo '<script>alert("Ingrese su contraseña actual correcta");location.href="editPerfil.php";</script>';
                    break;
                }
            }
            
        }
        if($actPass=="" and $newPass=="")
        {        
            $sql="UPDATE usuario SET NOM_USU='$nomUsu',APE_USU='$apeUsu',FEC_NAC='$fecUsu',FOT_USU='$file',NIC_USU='$nicUsu' WHERE CED_USU=$cedUsu";
            $execute=mysqli_query($connection->getConnection(),$sql);
            if($execute)
            {
                header("Location:perfilUsuario.php");
                 break;
             }
            echo '<script>alert("No se pudo editar el Perfil");location.href="perfilUsuario.php";</script>'; 
            break;           
        }
        else if($actPass!="" and $newPass=="")
        {
            echo '<script>alert("Debe ingresar una nueva Contraseña");location.href="editPerfil.php";</script>'; 
            break;
        }
        else if($actPass=="" and $newPass!="")
        {
            echo '<script>alert("Ingrese su contraseña Actual");location.href="editPerfil.php";</script>'; 
            break;
        }
        
    }
    else
    {
        $cedUsu=$_SESSION['user'];
        $nomUsu=$_POST['nomusu'];
        $apeUsu=$_POST['apeusu'];
        $fecUsu=$_POST['fecusu'];
        $nicUsu=$_POST['nicusu'];
        $corrUsu=$_POST['corrusu'];
        $actPass=$_POST['actpassusu'];
        $newPass=$_POST['newpassusu'];
        if($actPass!="" and $newPass!="")
        {
            $sql="SELECT CONT_USU  FROM usuario WHERE CED_USU=$cedUsu";
            $execute=mysqli_query($connection->getConnection(),$sql);
            if ($row = mysqli_fetch_assoc($execute)) 
            {
                if((password_verify($actPass,$row["CONT_USU"])))
                {
                    $encryptedpass = password_hash($newPass,PASSWORD_DEFAULT);
                    $sql="UPDATE usuario SET NOM_USU='$nomUsu',APE_USU='$apeUsu',FEC_NAC='$fecUsu',NIC_USU='$nicUsu',CONT_USU='$encryptedpass' WHERE CED_USU=$cedUsu";
                    $execute=mysqli_query($connection->getConnection(),$sql);
                    if($execute)
                    {
                        header("Location:perfilUsuario.php");
                         break;
                     }
                    echo '<script>alert("No se pudo editar el Perfil");location.href="perfilUsuario.php";</script>'; 
                    break;
                }
                else
                {
                    echo '<script>alert("Ingrese su contraseña actual correcta");location.href="editPerfil.php";</script>';
                    break;
                }
            }
            
        }
        if($actPass=="" and $newPass=="")
        {        
                    $sql="UPDATE usuario SET NOM_USU='$nomUsu',APE_USU='$apeUsu',FEC_NAC='$fecUsu',NIC_USU='$nicUsu' WHERE CED_USU=$cedUsu";
                    $execute=mysqli_query($connection->getConnection(),$sql);
                    if($execute)
                    {
                        header("Location:perfilUsuario.php");
                         break;
                     }
                    echo '<script>alert("No se pudo editar el Perfil");location.href="perfilUsuario.php";</script>'; 
                    break;           
        }
        else if($actPass!="" and $newPass=="")
        {
            echo '<script>alert("Debe ingresar una nueva Contraseña");location.href="editPerfil.php";</script>'; 
            break;
        }
        else if($actPass=="" and $newPass!="")
        {
            echo '<script>alert("Ingrese su contraseña Actual");location.href="editPerfil.php";</script>'; 
            break;
        }

    }  
   
}
?>