<?php


  if (!isset($_SESSION["login"])) {
      header("location:/login");
  }

//ID DEL USUARIO QUE INGRESA AL SISTEMA
$idUsuario=$data;

//ROL DE LA SESSION
$rol = $_SESSION['rol'];

//TRAE EL USUARIO QUE LO AGREGO
$idUsuarioQueLoAgrego = $data2['Usuario_idUsuario'];
$usuario = new Model_Usuario();
$nombre = $usuario->usuarioQueAgregoCliente($idUsuarioQueLoAgrego);

//TARJETA DEL CLIENTE
$idTarjeta = $data2['Tarjetas_idTarjetas'];
$nombreTarjeta = $usuario->tarjetaDelCliente($idTarjeta);



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
                

 </li>
                </ul>
            </div>

        </nav>
        <div id="page-wrapper">
            <!-- /. PAGE INNER  -->


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="POST" action= "<?php echo "../administrador/modificarCliente?idUsuario=".$idUsuario."&cliente=".$data2['idClientes']."" ?>"  enctype="multipart/form-data">
                        <legend class="text-center header">Ver Cliente</legend>                  

  <br>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Nombre de Cliente</span>
                            <div class="col-md-7">
                                <input id="fname" name="nombreCliente" type="text" class="form-control" value="<?php echo $data2['nombreCompleto']; ?>" readonly="readonly">
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">DNI</span>
                            <div class="col-md-7">
                                <input id="fname" name="dni" type="text"  class="form-control" value="<?php echo $data2['dni']; ?>" readonly="readonly">
                            
                            </div>
                        </div>
  <br>
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Producto Comprado</span>
                            <div class="col-md-7">
                                <input id="fname" name="producto" type="text"  class="form-control" value="<?php echo $data2['productoComprado']; ?>" readonly="readonly">
                            
                            </div>
                        </div>
                          <br>
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Usuario que agrego el Cliente</span>
                            <div class="col-md-7">
                                <input id="fname" name="usuarioQueAgregoCliente" type="text"  class="form-control" value="<?php echo $nombre; ?>" readonly="readonly">
                             
                            </div>
                        </div>
 <br>
                         <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Forma de Pago</span>
                            <div class="col-md-7">
                                <input id="fname" name="tarjeta" type="text"  class="form-control" value="<?php echo $nombreTarjeta; ?>" readonly="readonly">
                             
                            </div>
                        </div>
                        
  <br>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Imagen</span>
                            <div class="col-md-7">
                                <?php 
                                if($data2['ruta_img'] == null){

                                } else{
                                    echo " <a href='../application/resources/upload/".$data2['ruta_img']."' target='_blank' >Link </a> "; }  ?>
                            </div>
                        </div>

                         <br><br>
                         <h3 class="col-md-1 col-md-offset-2 text-center">Observaciones</h3>
                         <br><br><br>
                         <div class="form-group">
                            <span class="col-md-2 col-md-offset-2 text-center"><?php echo $data2['observaciones']; ?></span>
                        </div>

<br>
                    <?php
                    if($rol == 'Administrador'){
                        echo "<div class='row'>
                            <div class='col-md-12 text-center'>
                                <input class='btn btn-primary'  type='submit' name='submit' id='submit' value='Modificar'>
                            </div>
                        </div>";
                    }
                    elseif($data2['Usuario_idUsuario'] == $idUsuario){
                        echo "<div class='row'>
                            <div class='col-md-12 text-center'>
                                <input class='btn btn-primary'  type='submit' name='submit' id='submit' value='Modificar'>
                            </div>
                        </div>";
                    } else {

                    }
                      ?>

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