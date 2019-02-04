<?php


  if (!isset($_SESSION["login"])) {
      header("location:/login");
  }

$rol = $_SESSION['rol'];

 $usuario = new Model_Usuario();

 $tarjetas = $usuario->listaTarjetas();

$idUsuario=$data;

?>
	

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grupo Marquez</title>
    <!-- Bootstrap Styles-->
    <link href="../application/resources/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="../application/resources/css/font-awesome.css" rel="stylesheet" />
    
    <link href="../application/resources/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>

<body>



    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
            </button>    
                <a class="navbar-brand">Grupo Marquez</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" href="/login/cerrarsesion" >
                        <i href="/login/cerrarsesion">Cerrar Sesion </i>
                    </a>
               </ul>
        </nav>


        <!--/. NAV TOP  -->
         <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">

                    <li>
                        <a href="#"><i class="glyphicon glyphicon-plus"></i>Fraudes</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="<?php echo "../cliente/listaClientesVacia?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-th-list'></i>Lista Fraudes</a>
                            </li>
                            <li>
                                <a class="active-menu" href="<?php echo "../administrador/index?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-pencil'></i>Cargar Fraudes</a>
                            </li>
                        </ul>  
                    </li>
            
                
                <?php
                if($rol=='Administrador'){
                    echo "<li>";
                    echo "  <a href='#''><i class='glyphicon glyphicon-plus'></i> Administrador</a>
                        <ul class='nav nav-second-level'> <li>
                            <a class='active-menu' href='../administrador/verUsuarios?idUsuario=".$idUsuario."'><i class='glyphicon glyphicon-user'></i> Usuarios</a></li> </ul>  ";
                
                    echo "</li>";
                }elseif ($rol=='Operador') {
                    
                }
                  ?>


                </ul>
            </div>
        </nav>
        
        <div id="page-wrapper">
            <!-- /. PAGE INNER  -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <form class="form-inline" method="POST" action=<?php echo "'../administrador/verUsuarioBuscado?idUsuario=".$idUsuario."'" ?>">
            <label>Buscar por Nombre de Usuario</label>
            <input class="form-control mr-sm-2" type="text" name="nombre">
             <input  type="submit" name="submit" id="submit" value="Buscar"> 
              <br> <br>
        <a href="<?php echo "../administrador/nuevoUsuario?idUsuario=".$idUsuario."" ?>" class="btn btn-primary" role="button">Nuevo usuario</a>   
        </form>
    </nav>
            <br>
            <h1>Usuarios</h1>
            <br>
<?php
                if(mysqli_num_rows($data2) >= 1){
                    while($usuarios = mysqli_fetch_assoc($data2)){
                        echo "<ul class='list-group list-group-flush'>
  <li class='list-group-item'>idUsuario: ".$usuarios['idUsuario']." <br> Nombre Usuario:  ".$usuarios['nombreUsuario']."<br><a class='btn btn-info' role='button'  href='../administrador/modificarUsuario?idUsuario=".$idUsuario."&usuario=".$usuarios['idUsuario']." ' >Modificar</a> </li
</ul>
<br>

                        ";
                    }
                }
                
?>

        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="../application/resources/js/jquery-1.10.2.js"></script>
    <!-- Bootstrap Js -->
    <script src="../application/resources/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="../application/resources/js/jquery.metisMenu.js"></script>
    <!-- Morris Chart Js -->
    <script src="../application/resources/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../application/resources/js/morris/morris.js"></script>
    <!-- Custom Js -->
    <script src="../application/resources/js/custom-scripts.js"></script>


</body>

</html>