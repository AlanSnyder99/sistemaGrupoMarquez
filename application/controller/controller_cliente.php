<?php

include 'application/model/model_usuario.php';

class Controller_Cliente extends Controller{
   
    public function guardarCliente()
    {
        $usuario = new Model_Usuario();
        $nombreCompleto = $_POST['nombreCompleto'];
        $dni = $_POST['dni'];
        $productoComprado = $_POST['productoComprado'];
        $formaPago = $_POST['formaPago'];
        $idTarjeta = preg_replace("/[^0-9]{1,4}/", '', $formaPago); //EXTRAE EL NUMERO DEL STRING DE LA FORMA DE PAGO
        $observaciones = $_POST['observaciones'];
        $imagen = $_FILES['imagen']['name'];
        $idUsuario = $_POST['idUsuario'];
        $diaActual = date('m/d/Y h:i:s a', time());



       //$validarDni = $usuario->validarSiExisteDni($dni);
        
        if(strlen($dni) < 8 || strlen($dni) > 8 ){

        $this->view->generateSt('adminHome.php',$idUsuario);
    
        echo'<script type="text/javascript">
             alert("Inserte un DNI valido");
             </script>';    

        } elseif(!$usuario->validarSiExisteDni($dni)){

        $this->view->generateSt('adminHome.php',$idUsuario);
    
        echo'<script type="text/javascript">
             alert("El dni ya existe");
             </script>';  

        } else{
            if($_FILES["imagen"]["error"] > 0){
            echo'<script type="text/javascript">
             alert("*Advertencia*No cargo una imagen");
             </script>'; 
    }else{

        move_uploaded_file($_FILES["imagen"]["tmp_name"],
        "application/resources/upload/" . $_FILES["imagen"]["name"]);
        }

     $usuario->insertarCliente($nombreCompleto, $dni, $productoComprado, $idTarjeta, $observaciones,$imagen,$idUsuario,$diaActual);
        
        $this->view->generateSt('adminHome.php', $idUsuario);
       

       echo'<script type="text/javascript">
    alert("Cliente guardado con exito");
    </script>'; 

    }

        }

    public function listaClientesVacia(){
        $usuario = new Model_Usuario();
        $idUsuario = $_GET['idUsuario'];
      $this->view->generateSt('listaClientesHome.php',$idUsuario);   
    }

    public function listaClientes(){
        $usuario = new Model_Usuario();
        $dni = $_POST['dniBuscado'];
        $nombreCompleto = $_POST['nombreBuscado'];
        $idUsuario = $_GET['idUsuario'];

        if($dni == null){

        $clientes = $usuario->listaClientesPorNombre($nombreCompleto);
        $this->view->generateSt('listaClientes.php', $clientes,$idUsuario); 
        
        } elseif ( $nombreCompleto== null) {
        
        $clientes = $usuario->listaClientesPorDni($dni);
        $this->view->generateSt('listaClientes.php', $clientes,$idUsuario); 
        
        } else {

        $this->view->generateSt('listaClientesHome.php',$idUsuario); 
 
        }

}

}