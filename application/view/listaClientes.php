<?php
  if (!isset($_SESSION["login"])) {
      header("location:/login");
  }

$rol = $_SESSION['rol'];
  $idUsuario=$data2;
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
    
    <link href="../application/resources/css/listaClientes.css" rel="stylesheet" />
    
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
                        <a href="#"><i class="glyphicon glyphicon-plus"></i> Clientes</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="<?php echo "../cliente/listaClientesVacia?idUsuario=".$idUsuario."" ?>"><i></i>Lista Clientes</a>
                            </li>
                            <li>
                                <a class="active-menu" href="<?php echo "../administrador/index?idUsuario=".$idUsuario."" ?>"><i></i>Cargar Cliente</a>
                            </li>
                        </ul>  
                    </li>
            
                  
                   <?php 
                  if($rol=='Administrador'){
                    echo "<li>";
                    echo " <a href='../administrador/verUsuarios?idUsuario=".$idUsuario."'><i class='glyphicon glyphicon-user'></i> Usuarios</a> ";
                
                    echo "</li>";
                }elseif ($rol=='Operador') {
                    
                }
                    ?>
            
                  

                </ul>
            </div>

        </nav>
        <div id="page-wrapper">
            <!-- /. PAGE INNER  -->
<div id="buscador">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
       <form class="form-inline" method="POST" action=<?php echo "'../cliente/listaClientes?idUsuario=".$idUsuario."'" ?>">
            <h3 class='text-center'>Buscar por DNI</h3>
            <br>
            <input class="form-control" type="number" id="inputs" name="dniBuscado">
<br>
            <h3 class='text-center'> Buscar por Nombre</h3>
            <br>
            <input class="form-control " type="text" id="inputs" name="nombreBuscado">
           <br>
             <input class="form-control " type="submit" name="submit" id="submit" value="Buscar">    
        </form>
    </nav>
</div>
<br>
<h1 class='text-center'>Clientes</h1>
<br><br>

<div class="row">
<?php
                if(mysqli_num_rows($data) >= 1){
                    while($clientes = mysqli_fetch_assoc($data)){
                        echo "<ul class='list-group list-group-flush'>
  <li class='list-group-item'>DNI: ".$clientes['dni']." <br> Nombre Cliente:  ".$clientes['nombreCompleto']."<br><a class='btn btn-info' role='button'  href='../administrador/verClienteParticular?idUsuario=".$idUsuario."&cliente=".$clientes['idClientes']." ' >Ver</a> </li
</ul>
<br>

                        ";
                    }
                }
                
?>    
</div>

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