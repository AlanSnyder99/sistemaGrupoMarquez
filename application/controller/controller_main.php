<?php

include 'application/model/model_servicios.php';

class Controller_Main extends Controller{
    
    function index(){
        $servicio = new Model_Servicios();
        $novedades = $servicio->ultimasNovedades();
        $this->view->generateSt('index.php',$novedades);
    }

    function empresa(){
        $this->view->generateSt('empresa.php');
    }

    function proveedores(){
        $this->view->generateSt('proveedores.php');
    }

    function emailProveedores(){
    	$servicio = new Model_Servicios();
        $titulo = "Contacto Proveedor";
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
      	$web = $_POST['web'];
        $mensaje = $_POST['mensaje'];

        $txt = "Nombre:".$nombre."<br>Email:".$email."<br>Web:".$web."<br>".$mensaje."";

        $servicio->enviarEmail($titulo,$txt,$nombre);
        $this->view->generateSt('proveedores.php');
    }

    function enviarEmailContacto(){
        $servicio = new Model_Servicios();
        $titulo = "Contacto";
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $localidad = $_POST['localidad'];
        $mensaje = $_POST['mensaje'];
        $txt = "<strong>Nombre:</strong> ".$nombre."<br><strong>Email:</strong> ".$email."<br><strong>Localidad:</strong> ".$localidad."<br><br>".$mensaje."";
        $servicio->enviarEmail($titulo,$txt,$nombre);
        header("location: /main/index");  
    }

    function sumateALaRed(){
        $this->view->generateSt('sumateALaRed.php');
    }

     function marketing(){
        $this->view->generateSt('marketing.php');
    }

     function accionesEnPuntosDeVenta(){
        $this->view->generateSt('accionesEnPuntosDeVenta.php');
    }

    function catalogos(){
        $this->view->generateSt('catalogos.php');
    }

     function revistasDelSector(){
        $this->view->generateSt('revistasDelSector.php');
    }

     function revistasDeGranTirada(){
        $this->view->generateSt('revistasDeGranTirada.php');   
     }

     function contacto(){
        $this->view->generateSt('contacto.php');   
     }


    function beneficioAnses(){
    $servicio = new Model_Servicios();
    $tablaSucursales = $servicio->tablaSucursales();
    $this->view->generateSt('beneficioAnses.php',$tablaSucursales);   
    }

    function tablaSucursales(){
        $servicio = new Model_Servicios();
        $localidad = $_POST['localidad'];
        $zona = $_POST['zona'];
        $provincia = $_POST['provincia'];

        if ($localidad != null && $zona == null && $provincia == null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorLocalidad($localidad);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad == null && $zona != null && $provincia == null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorZona($zona);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad == null && $zona == null && $provincia != null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorProvincia($provincia);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad != null && $zona != null && $provincia == null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorLocalidadZona($localidad,$zona);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad != null && $zona == null && $provincia != null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorLocalidadProvincia($localidad,$provincia);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad == null && $zona != null && $provincia != null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorProvinciaZona($zona,$provincia);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } elseif ($localidad != null && $zona != null && $provincia != null ) {
            $tablaSucursales = $servicio->tablaSucursalesPorTodo($zona,$provincia,$localidad);
            $this->view->generateSt('beneficioAnses.php',$tablaSucursales);  
        } else{
            $tablaSucursales = $servicio->tablaSucursalesPor($localidad,$zona,$provincia);
         $this->view->generateSt('beneficioAnses.php',$tablaSucursales);
        }

          
    }

     function novedades(){

        $servicio = new Model_Servicios();
        $fecha = new DateTime();
        $diaActual = date('m/d/Y h:i:s a', time());
        $novedades = $servicio->totalNovedades($diaActual);
        $fechasDeNovedades = $servicio->fechasDeNovedades();   
        $this->view->generateSt('novedades.php',$novedades,$fechasDeNovedades);

    }

      function verNovedad(){
        
        $idNovedad = $_GET['idNovedad'];
        $servicio = new Model_Servicios();
        $novedad = $servicio->novedadPorId($idNovedad);
        $this->view->generateSt('verNovedad.php',$novedad);
    }

    function novedadesPorFecha(){
        
        $servicio = new Model_Servicios();
        $fecha = $_POST['fecha'];
        //$resultado = str_replace("/", " ", $fecha);
        list($month, $year) = explode("/", $fecha);
       
        $novedades = $servicio->totalNovedadesPorFecha($month, $year);
        $fechasDeNovedades = $servicio->fechasDeNovedades();   
        $this->view->generateSt('novedades.php',$novedades,$fechasDeNovedades);
        //$novedad = $servicio->novedadPorId($idNovedad);
        //$this->view->generateSt('verNovedad.php',$novedad);
    }
    
}