<?php
session_start();
$sesssion=$_SESSION["user"];
$user;
$userAvatar;
require("../../controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
//DATOS DEL USUARIO CONECTADO
$searchUser="SELECT NIC_USU,FOT_USU FROM usuario  WHERE CED_USU = $sesssion";
$busquedaU=mysqli_query($connection->getConnection(),$searchUser);
if ($row = mysqli_fetch_assoc($busquedaU))
{
    $user=$row["NIC_USU"];
    $userAvatar=$row["FOT_USU"];
}
//PUBLICACIONES HECHAS POR EL USUARIO
$search="SELECT p.ID_PUB,p.TIT_PUB,p.DES_PUB,p.IMG_PUB,u.NIC_USU,u.FOT_USU FROM publicacion p ,usuario u WHERE p.CED_USU_PUB = u.CED_USU and p.CED_USU_PUB=$sesssion";
$busqueda=mysqli_query($connection->getConnection(),$search);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/foro.css?v=<?php echo time(); ?>">
    <title>Document</title>
   

</head>

<body>


    <!--NavbarSuperior-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html"><img class="logo-brand" src="../../assets/images/Screenshot_6.png"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../perfil/perfilUsuario.php"><?php echo $user; ?></a></li>
                    <li class="nav-item"><img class="avatar-user"src="data:image/jpg;base64,<?php echo base64_encode($userAvatar); ?>" alt="">  </li>
                    <li class="nav-item"><a class="nav-link" href="../../sessionClose.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!--NavbarIzquierda-->
            <div class="col-2  border border-3 border-dark text-center" style="padding-bottom: 15.3%; background-color:#6c757d;">
                <h3 class="nav-foro fw-bold">PUBLICACIONES</h3>
                <ul class="nav flex-column ">
                    <li class="nav-item">
                        <a class="nav-link" href="../../forum.php">Todas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="misPublicaciones.php">Mis Publicaciones</a>
                    </li>
                    <h3 class="nav-foro fw-bold">CURSOS</h3>
                    <li class="nav-item">
                        <a class="nav-link" href="../cursos/cursosInscritos.php">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cursos/misCursos.php">Mis Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../cursos/verCursos.php">Ver Cursos</a>
                    </li>
                </ul>
            </div>
            <!--ForoPublicaciones-->
            <div class="col-10">
                <a class="nav-link" href="crearPublicacion.php">Crear Publicación</a>               
                <table id="table" class="table">
                    <thead class="table-dark">
                        <th>Pubicaciones</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($busqueda)) {?>
                        <tr>
                            <td><?php echo '<a class="tit-pub" href="misPublicacionesInfo.php?publi='.$row['ID_PUB'].'">';
                                     echo $row['TIT_PUB']; 
                                    
                                     echo  '<br>';
                                     echo  '</a>';
                                     echo $row['DES_PUB'];
                                ?>
                            </td>
                            <td>
                                <a class="edit"  <?php echo 'href="editPublicacion.php?publi='.$row['ID_PUB'].'"'?>>Editar</a>
                                <a onClick="return confirm('Estas seguro de eliminar?');" class="delete" <?php echo 'href="crudPublicaciones.php?action=d&publi='.$row['ID_PUB'].'"'?>>Eliminar</a> 
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>

    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>