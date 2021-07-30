<?php
session_start();
$publi=$_GET['publi'];
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
//OBTENER DATOS DE LA PUBLICACION
$sqlPubli="SELECT CED_USU_PUB,IMG_PUB,DES_PUB,TIT_PUB FROM publicacion WHERE ID_PUB=$publi";
$executePubli=mysqli_query($connection->getConnection(),$sqlPubli);
$row=mysqli_fetch_assoc($executePubli);
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
            <a class="navbar-brand" href="../../forum.php"><img class="logo-brand"
                    src="../../assets/images/Screenshot_6.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="../perfil/perfilUsuario.php">
                            <?php echo $user; ?>
                        </a></li>
                    <li class="nav-item">
                        <img class="avatar-user" src="data:image/jpg;base64,<?php echo base64_encode($userAvatar); ?>" alt=""> </li>
                    <li class="nav-item"><a class="nav-link" href="../../sessionClose.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!--NavbarIzquierda-->
            <div class="col-2  border border-3 border-dark text-center"
            style="padding-bottom: 15.3%; background-color:#6c757d;">
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
            <div class="col-7">
                <table class="table">
                    <thead class="table-dark">
                        <th>Editar Publicación</th>
                        <th></th>
                        <th></th>
                    </thead>

                </table>
                <?php if($row) { ?>
                <div class="mb-4">
                    <form <?php echo 'action="crudPublicaciones.php?action=up&publi='.$publi.'"' ?>  method="POST" enctype="multipart/form-data">
                        <div class="form-floating mb-3">
                            <input type="text" name="titpub" class="form-control" id="floatingInput"
                                placeholder="Titulo Publicacion" <?php echo 'value="' .$row['TIT_PUB'].'"'?> required
                            autofocus>
                            <label for="floatingInput">Titulo</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" name="despub" placeholder="Leave a comment here"
                                id="floatingTextarea2" style="height: 100px"
                                required><?php echo $row['DES_PUB']?></textarea>
                            <label for="floatingTextarea2">Descripción de La Publicacion</label>
                        </div>
                </div>
                <div class="form-floating mb-3">
                    <h5>Cambiar ó Subir una nueva Imagen</h5>
                    <input type="file" name="filepub"  accept=".jpg,.png" id="imgpub">
                    <input type="submit" style="display: inline-block;" class="create" value="Editar">
                </div>
                </form>
            </div>
            <?php } ?>
            <!--ChatIzquierda-->
            <div class="col-3">
            <?php if($row['IMG_PUB']!=NULL) {?>
            <img class="img-publi" src="data:image/jpg;base64,<?php echo base64_encode($row['IMG_PUB']); ?>" alt=""> </li>
            <?php } ?>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>