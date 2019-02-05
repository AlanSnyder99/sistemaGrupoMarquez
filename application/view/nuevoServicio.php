<?php

 if (!isset($_SESSION["login"])) {
     header("location:/login");
}

$usuario = new Model_Usuario();

$marcas = $usuario->listaMarcas();

$idUsuario=$data;

$rol = $_SESSION['rol'];


?>
	

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Grupo Marquez</title>
    <!-- Bootstrap Styles-->
    <link href="/application/resources/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="/application/resources/css/font-awesome.css" rel="stylesheet" />
    
    <link href="/application/resources/css/custom-styles.css" rel="stylesheet" />
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
                                <a class="active-menu" href="<?php echo "../cliente/listaClientesVacia?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-align-justify'></i>Lista Fraudes</a>
                            </li>
                            <li>
                                <a class="active-menu" href="<?php echo "../administrador/index?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-pencil'></i>Cargar Fraudes</a>
                            </li>
                        </ul>  
                    </li>
                
                <li>
                        <a href="#"><i class="glyphicon glyphicon-plus"></i>Servicios</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="active-menu" href="<?php echo "../cliente/listaClientesVacia?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-th-list'></i>Lista Servicios</a>
                            </li>
                    <?php
                        if($rol=='Administrador'){
                    echo "<li>";
                    echo "<a class='active-menu' href='../administrador/index?idUsuario=".$idUsuario."'><i class='glyphicon glyphicon-pencil'></i>Cargar Servicio</a>";
                    echo "</li>";    
                    }
                    ?>
                           
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


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="POST" action= "../administrador/guardarServicio"  enctype="multipart/form-data">
                        <legend class="text-center header">Nuevo Servicio</legend>

                       
               


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Nombre</span>
                            <div class="col-md-7">
                                <input id="fname" name="nombre" type="text" required="" placeholder="Nombre del Servicio" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Domicilio</span>
                            <div class="col-md-7">
                                <input id="fname" name="domicilio" type="text" required="" placeholder="Domicilio" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Telefono</span>
                            <div class="col-md-7">
                                <input id="fname" name="telefono" type="number" placeholder="Telefono" class="form-control">
                            </div>
                        </div>


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Horario de Atencion</span>
                            <div class="col-md-7">
                                <input id="fname" name="horario" type="text" required="" placeholder="Horario de atencion" class="form-control">
                            </div>
                        </div>



                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Email</span>
                            <div class="col-md-7">
                                <input id="fname" name="email" type="email" required="" placeholder="Email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Marcas</span>
                            <div class="col-md-7">
                                <select name="marcas[]" multiple>
                               <?php if(mysqli_num_rows($marcas)>0){
                                     while($rows=mysqli_fetch_assoc($marcas)){
                                         echo "<option>";
                                         echo $rows['idMarcas'].",".$rows['nombre'];
                                         echo "</option>";
                                    }
                                 }  ?>
                                </select>
                            </div>
                        </div>

                         <input  name="idUsuario" type="hidden" value="<?php echo $idUsuario ?>">

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input class="btn btn-primary"  type="submit" name="submit" id="submit" value="Cargar">
                            </div>
                        </div>

                         

                </form>


            </div>
        </div>
    </div>
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