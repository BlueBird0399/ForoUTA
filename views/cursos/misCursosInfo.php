<?php
session_start();
$sesssion=$_SESSION["user"];
$user;
$userAvatar;
$curso=$_GET['curso'];
require("../../controllers/BDController/connectionController.php");
$connection = new connection('localhost','root','','bd_for_grup');
//DATOS DE USUARIO CONECTADO
$searchUser="SELECT NIC_USU,FOT_USU FROM usuario  WHERE CED_USU = $sesssion";
$busquedaU=mysqli_query($connection->getConnection(),$searchUser);
if ($row = mysqli_fetch_assoc($busquedaU))
{
    $user=$row["NIC_USU"];
    $userAvatar=$row["FOT_USU"];
}
//DATOS DEL CURSO SELECCIONADO
$searchC="SELECT c.ID_CUR,c.DES_CUR,c.NOM_CUR,c.PRE_CUR,u.NIC_USU,u.FOT_USU FROM curso c,usuario u WHERE c.CED_USU_CREA = u.CED_USU and c.ID_CUR=$curso";
$busquedaC=mysqli_query($connection->getConnection(),$searchC);
$row = mysqli_fetch_assoc($busquedaC);
//NÚMERO DE ALUMNOS DEL CURSO
$searchStudent="SELECT COUNT(ID_CUR_PER) as TOTAL FROM detalle_curso WHERE ID_CUR_PER=$curso";
$busquedaS=mysqli_query($connection->getConnection(),$searchStudent);
//ALUMNOS INCRITOS EN EL CURSO
$searchAlumnos="SELECT CED_USU,NIC_USU,CORR_USU FROM usuario WHERE CED_USU IN (SELECT CED_USU_PER FROM detalle_curso WHERE ID_CUR_PER=$curso)";
$busquedaA=mysqli_query($connection->getConnection(),$searchAlumnos);

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
            <a class="navbar-brand" href="../../forum.php"><img class="logo-brand" src="../../assets/images/Screenshot_6.png"
                    alt="logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link " href="../perfil/perfilUsuario.php#"><?php echo $user; ?> <img class="avatar-user"src="data:image/jpg;base64,<?php echo base64_encode($userAvatar); ?>" alt=""></a></li>
                <li class="nav-item"><a style="padding-top: 15px;" class="nav-link" href="../../controllers/session/sessionClose.php">Cerrar sesión</a></li>
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
                        <a class="nav-link" href="cursosInscritos.php">Inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="misCursos.php">Mis Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="verCursos.php">Ver Cursos</a>
                    </li>
                </ul>
            </div>
            <!--ForoPublicaciones-->
            <div class="col-10"> 
                <table id="table" class="table">
                    <thead class="table-dark">
                        <th>Curso</th>
                        <th>Docente</th>
                        <th>Costo</th>
                        <th>Estudiantes Inscitos</th>
                    </thead>
                    <tbody>
                      
                        <tr>
                            <td><?php echo '<a class="tit-pub" href="cursoInfo.php?curso='.$row['ID_CUR'].'">';
                                    echo $row['NOM_CUR'];
                                    echo "</a>";
                                ?>
                            </td>
                                <td>
                                <a class="tit-pub" href="../perfil/perfilUsuario.php">
                                    <?php echo $row['NIC_USU']; ?>
                                    <img class="avatar" src="data:image/jpg;base64,<?php echo base64_encode($row['FOT_USU']); ?>" alt="">
                                    </a>
                                </td>
                            <td>
                                    <?php echo $row['PRE_CUR']; ?>
                            </td>
                            <td>
                                    <?php 
                                    if($rowt = mysqli_fetch_assoc($busquedaS)) 
                                    {
                                        echo $rowt['TOTAL'];
                                    }  
                                    ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
                <table id="table" class="table">
                    <thead class="table-dark">
                        <th>Descripción</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                            <?php echo $row['DES_CUR'];?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </table>
                <div class="mb-4">
                <a class="edit" style="text-align:center"  <?php echo 'href="editCurso.php?curso='.$row['ID_CUR'].'"'?>>Editar Curso</a>
                <a onClick="return confirm('Estas seguro de eliminar?');" class="delete" <?php echo 'href="crudCurso.php?action=d&publi='.$row['ID_CUR'].'"'?>>Eliminar Curso</a>                 
                </div>
                <table id="table" class="table">
                    <thead class="table-dark">
                        <th>Alumnos</th>
                        <th>Cédula</th>
                        <th>Correo</th>
                    </thead>
                    <tbody>
                        <?php while($rowA = mysqli_fetch_assoc($busquedaA)) {  ?>
                        <tr>
                            <td>
                            <?php echo $rowA['NIC_USU'];?>
                            </td>
                            <td>
                            <?php echo $rowA['CED_USU'];?>
                            </td>
                            <td>
                            <?php echo $rowA['CORR_USU'];?>
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