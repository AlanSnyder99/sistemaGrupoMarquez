<?php

 if (!isset($_SESSION["login"])) {
     header("location:/login");
}

$usuario = new Model_Usuario();

$tarjetas = $usuario->listaTarjetas();

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
                                <a class="active-menu" href="<?php echo "../administrador/listaServiciosVacia?idUsuario=".$idUsuario."" ?>"><i class='glyphicon glyphicon-th-list'></i>Lista Servicios</a>
                            </li>
                    <?php
                        if($rol=='Administrador'){
                    echo "<li>";
                    echo "<a class='active-menu' href='../administrador/nuevoServicio?idUsuario=".$idUsuario."'><i class='glyphicon glyphicon-pencil'></i>Cargar Servicio</a>";
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
                <form class="form-horizontal" method="POST" action= "../cliente/guardarCliente"  enctype="multipart/form-data">
                        <legend class="text-center header">Guardar Cliente</legend>

                       
               


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Nombre y Apellido</span>
                            <div class="col-md-7">
                                <input id="fname" name="nombreCompleto" type="text" required="" placeholder="Nombre y Apellido" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">DNI</span>
                            <div class="col-md-7">
                                <input id="fname" name="dni" type="number" required="" placeholder="DNI" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Producto Comprado</span>
                            <div class="col-md-7">
                                <input id="fname" name="productoComprado" type="text" placeholder="Producto" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Forma de pago</span>
                            <div class="col-md-7">
                                <select name="formaPago">
                               <?php if(mysqli_num_rows($tarjetas)>0){
                                     while($rows=mysqli_fetch_assoc($tarjetas)){
                                         echo "<option>";
                                         echo $rows['idTarjetas']."-".$rows['nombre'];
                                         echo "</option>";
                                    }
                                 }  ?>
                                </select>
                            </div>
                        </div>

                    

                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Imagen</span>
                            <div class="col-md-7">
                                <input  name="imagen" type="file" >
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Observaciones </span>
                            <div class="col-md-7">
                                <textarea class="form-control" id="message"  name="observaciones"  rows="4"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <input class="btn btn-primary"  type="submit" name="submit" id="submit" value="Cargar">
                            </div>
                        </div>

                         <input  name="idUsuario" type="hidden" value="<?php echo $idUsuario  ?>"> 

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