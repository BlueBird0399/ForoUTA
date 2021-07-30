<?php
session_start();
$sesssion=$_SESSION["user"];
$user;
require("../../controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
//DATOS DEL USUARIO CONECTADO
$searchUser="SELECT * FROM usuario  WHERE CED_USU = $sesssion";
$busquedaU=mysqli_query($connection->getConnection(),$searchUser);
if ($row = mysqli_fetch_assoc($busquedaU))
{
    $nomU=$row["NOM_USU"];
    $apeU=$row["APE_USU"];
    $cedU=$row["CED_USU"];
    $fecNacU=$row["FEC_NAC"];
    $fotU=$row["FOT_USU"];
    $nicU=$row["NIC_USU"];
    $contU=$row["CONT_USU"];
    $corrU=$row["CORR_USU"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../css/foro.css?v=<?php echo time(); ?>">
    

</head>

<body>


    <!--NavbarSuperior-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="logo-brand" src="../../assets/images/Screenshot_6.png"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item"><a class="nav-link" href="../../forum.php">Pagina Principal</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfilUsuario.php"><?php echo $nicU; ?></a></li>
                    <li class="nav-item"><img class="avatar-user"src="data:image/jpg;base64,<?php echo base64_encode($fotU); ?>" alt="">  </li>
                    <li class="nav-item"><a class="nav-link" href="../../index.html">Cerrar sesión</a></li>
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
                        <a class="nav-link" href="../publicaciones/misPublicaciones.php">Mis Publicaciones</a>
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
                <h3 class="perfil-text"><?php echo $nicU; ?></h3>
              <img class="ava_img"src="data:image/jpg;base64,<?php echo base64_encode($fotU); ?>" alt="SIN IMAGEN">
                <form action="crudPerfil.php?action=up"method="POST" enctype="multipart/form-data">
              <ul class="datos">
                <li>
                <div class="form-floating mb-3">
                <p>Cambiar foto de Perfil</p>
                <input type="file" name="imgusu"  accept=".jpg,.png" id="imgusu">
                </div> 
                </li>
                <li>
                <div class="form-floating mb-3">
                <input type="text" name="nomusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" <?php echo 'value="'.$nomU.'"'?> required autofocus>
                <label for="floatingInput">NOMBRE:</label>
                </div> 
                </li>
                <li>
                <div class="form-floating mb-3">
                <input type="text" name="apeusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" <?php echo 'value="'.$apeU.'"'?> required >
                <label for="floatingInput">APELLIDO:</label>
                </div> 
                </li>
                
                <li>
                <div class="form-floating mb-3">
                <input type="date" name="fecusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" <?php echo 'value="'.$fecNacU.'"'?> required >
                <label for="floatingInput">FECHA DE NACIMIENTO:</label>
                </div> 
                </li>
                
                <li>
                <div class="form-floating mb-3">
                <input type="text" name="nicusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" <?php echo 'value="'.$nicU.'"'?> required >
                <label for="floatingInput">USUARIO:</label>
                </div> 
                </li>
                <li>
                <div class="form-floating mb-3">
                <input type="email" name="corrusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" <?php echo 'value="'.$corrU.'"'?> required >
                <label for="floatingInput">CORREO:</label>
                </div> 
                </li>
                <li>
                <div class="form-floating mb-3">
                <input type="password" name="actpassusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" required>
                <label for="floatingInput">Contraseña Actual:</label>
                </div> 
                <div class="form-floating mb-3">
                <input type="password" name="newpassusu" class="form-control" id="floatingInput" placeholder="Nombre del Curso" required>
                <label for="floatingInput">Nueva Contreseña:</label>
                </div> 
                </li>
                <input type="submit" style="margin-left: auto;" class="create" value="Guardar">
              </ul>
              </form>
            </div>
        </div>

    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>