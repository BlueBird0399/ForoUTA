<?php
session_start();
$sesssion=$_SESSION["user"];
$user;
$userAvatar;
require_once("controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
$searchUser="SELECT NIC_USU,FOT_USU FROM usuario  WHERE CED_USU = $sesssion";
$busquedaU=mysqli_query($connection->getConnection(),$searchUser);
if ($row = mysqli_fetch_assoc($busquedaU))
{
    $user=$row["NIC_USU"];
    $userAvatar=$row["FOT_USU"];
}
$searchPubli="SELECT p.ID_PUB,p.CED_USU_PUB,p.TIT_PUB,p.DES_PUB,u.NIC_USU,u.FOT_USU FROM publicacion p,usuario u WHERE p.CED_USU_PUB = u.CED_USU";
$busquedaP=mysqli_query($connection->getConnection(),$searchPubli);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/foro.css?v=<?php echo time(); ?>">
    <script src="//code.tidio.co/utd8ih72uzatqlw38gabsrralqaijny0.js" async></script>
</head>

<body>


    <!--NavbarSuperior-->
    <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">
      <a title="Ir a la página principal UTA help!!" class="navbar-brand" href="forum.php"> <img src="assets/images/Screenshot_6.png" class="logo-brand"
          alt="logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link " href="views/perfil/perfilUsuario.php#"><?php echo $user; ?> <img class="avatar-user"src="data:image/jpg;base64,<?php echo base64_encode($userAvatar); ?>" alt=""></a></li>
            <li class="nav-item"><a style="padding-top: 15px;" class="nav-link" href="controllers/session/sessionClose.php">Cerrar sesión</a></li>
      </ul>
      </div>
    </div>
  </nav>
    <div class="container-fluid" style="padding-top: 100px;heigh:100%;">
        <div class="row">
            <!--NavbarIzquierda-->
            <div class="col-2  border border-3 border-dark text-center" style="padding-bottom: 15.3%; background-color:#6c757d;">
                <h3 class="nav-foro fw-bold">PUBLICACIONES</h3>
                <ul class="nav flex-column ">
                    <li class="nav-item">
                        <a class="nav-link" href="forum.php">Todas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/publicaciones/misPublicaciones.php">Mis Publicaciones</a>
                    </li>
                    <h3 class="nav-foro fw-bold">CURSOS</h3>
                    <li class="nav-item">
                        <a class="nav-link" href="views/cursos/cursosInscritos.php">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/cursos/misCursos.php">Mis Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/cursos/verCursos.php">Ver Cursos</a>
                    </li>
                </ul>
            </div>
            <!--ForoPublicaciones-->
            <div class="col-10">
            <table class="table">
                    <thead class="table-dark">
                        <th>Pubicaciones</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                    <?php  while ($row = mysqli_fetch_assoc($busquedaP)) {?>
                        <?php  if($row['CED_USU_PUB']==$sesssion) { ?>
                        <tr>
                            <td>
                                <?php
                                echo '<a class="tit-pub" href="views/publicaciones/misPublicacionesInfo.php?publi='.$row["ID_PUB"].'">';
                                    echo $row['TIT_PUB']; 
                                    
                                echo  '<br>';
                                echo  '</a>';
                                     echo $row['DES_PUB'];
                                ?>
                            </td>
                            <td>
                            <a class="nic-usu" href="views/perfil/perfilUsuario.php">      
                                    <?php echo $row['NIC_USU']; ?><img class="avatar" src="data:image;base64,<?php echo base64_encode($row['FOT_USU']); ?>" alt="">  
                            </a>
                            </td>
                            <td>
                            <div class="mb-4">
                            <a class="edit" style="text-align:center;"  <?php echo 'href="views/publicaciones/editPublicacion.php?publi='.$row['ID_PUB'].'"'?>>Editar</a>
                            <a onClick="return confirm('Estas seguro de eliminar?');" class="delete" <?php echo 'href="views/publicaciones/crudPublicaciones.php?action=d&forum=s&publi='.$row['ID_PUB'].'"'?>>Eliminar</a>                 
                            </div>
                            </td>
                        </tr>
                        <?php } else { ?>
                            <tr>
                            <td>
                                <?php
                                echo '<a class="tit-pub" href="views/publicaciones/publicacionInfo.php?publi='.$row["ID_PUB"].'">';
                                    echo $row['TIT_PUB']; 
                                    
                                echo  '<br>';
                                echo  '</a>';
                                     echo $row['DES_PUB'];
                                ?>
                            </td>
                            <td>
                            <a class="nic-usu" style="font-weight: bold;" <?php echo 'href="views/perfil/perfilOthers.php?usced='.$row['CED_USU_PUB'].'"'  ?> >
                                    <?php echo $row['NIC_USU']; ?><img class="avatar" src="data:image;base64,<?php echo base64_encode($row['FOT_USU']); ?>" alt="">     
                            </a>
                            </td>
                        </tr>
                        <?php } ?> 
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>