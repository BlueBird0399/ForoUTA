<?php
session_start();
$sesssion=$_SESSION["user"];
$user;
$link= mysqli_connect('localhost','root','');
if(!$link)
{
echo "No se pudo conectar con el servidor";
}
else
{
$db="bd_for_grup";
$sdb=mysqli_select_db($link,$db);
if(!$sdb)
{
echo "No se pudo encotrar la base de datos";
}
$searchUser="SELECT * FROM usuario  WHERE CED_USU = $sesssion";
$busquedaU=mysqli_query($link,$searchUser);
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
$searchPubli="SELECT c.NOM_CUR,u.NOM_USU FROM publicacion p c,usuario u WHERE c.COD_USU_CRE = u.COD_USU";
$busquedaP=mysqli_query($link,$searchPubli);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/foro.css">

</head>

<body>


    <!--NavbarSuperior-->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="logo-brand" src="assets/images/Screenshot_6.png"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                  <li class="nav-item"><a class="nav-link" href="forum.php">Pagina Principal</a></li>
                    <li class="nav-item"><a class="nav-link" href="perfilUsuario.php"><?php echo $nicU; ?></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.html">Cerrar sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid" style="padding-top: 100px;">
        <div class="row">
            <!--NavbarIzquierda-->
            <div class="col-3  border border-3 border-dark text-center" style="padding-bottom: 11%; background-color: #90B3EF;">
                <h3 class="nav-foro fw-bold">PUBLICACIONES</h3>
                <ul class="nav flex-column ">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Importantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Académicas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Otros</a>
                    </li>
                    <h3 class="nav-foro fw-bold">CURSOS</h3>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Mis Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ver Cursos</a>
                    </li>
                </ul>
            </div>
            <!--ForoPublicaciones-->  
            <div class="col-6">
              <ul class="datos">
                <li>NOMBRE:</li>
                <p><?php echo $nomU ?></p>
                <li>APELLIDO: </li>
                <p><?php echo $apeU ?></p>
                <li>CEDULA: </li>
                <p><?php echo $cedU ?></p>
                <li>FECHA DE NACIMIENTO: </li>
                <p><?php echo $fecNacU ?></p>
                <li>USUARIO: </li>
                <p><?php echo $nicU ?></p>
                <!--<li>CONTRASEÑA: <?php echo "***"; ?></li>-->
                <li>CORREO:</li>
                <p><?php echo $corrU ?></p>
              </ul>
            </div>
            <div class="col-1">
                <img class="avatar"src="data:image/jpg;base64,<?php echo base64_encode($fotU); ?>" alt="SIN IMAGEN">
            </div>
        </div>

    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>