<?php

class Model_Cliente extends Model
{
    private $db;
    private $usuario;
    private $clave;

    public function __construct()
    {
        require_once 'modelo_conexion_base_de_datos.php';
        $db=BaseDeDatos::conectarBD();
    }




    public function insertarCliente($nombreCompleto, $dni, $productoComprado, $idTarjeta, $observaciones,$imagen,$idUsuario){

        $db=BaseDeDatos::conectarBD();
    
       // if (file_exists("..application/resources/img/clientes" . $foto["name"])) {
      //      unlink($_SERVER['DOCUMENT_ROOT']."..application/resources/img/clientes" . $foto["name"]);
//}
     //   move_uploaded_file(
      //          $foto["tmp_name"],
      //      "..application/resources/img/clientes/" . $foto["name"]
      //      );



        $sql= 'insert into Clientes (nombreCompleto, dni, productoComprado, Tarjetas_idTarjetas, observaciones, ruta_img, Usuario_idUsuario) values ("'.$nombreCompleto.'",'.$dni.',"'.$productoComprado.'","'.$idTarjeta.'","'.$observaciones.'","'.$imagen.'",'.$idUsuario.'); ';
        
        //echo $sql;

        $result=mysqli_query($db, $sql);

    }

    public function listaClientesPorDni($dni){
        
        $db=BaseDeDatos::conectarBD();

        $sql= 'select * from Clientes where dni = '.$dni.' order by dni asc; ';

        $result=mysqli_query($db, $sql);

        return $result;

    }

    public function listaClientesPorNombre($nombreCompleto){
        
        $db=BaseDeDatos::conectarBD();

        $sql= 'select * from Clientes where nombreCompleto like "%'.$nombreCompleto.'%" order by dni asc; ';
        
        $result=mysqli_query($db, $sql);

        return $result;
    }



    public function modificarNombreCliente($nombreCliente,$idCliente){
        
        $db=BaseDeDatos::conectarBD();

        $sql='update Clientes
        set  nombreCompleto="'.$nombreCliente.'"
        where idClientes = '.$idCliente.';';

       

        $result=mysqli_query($db, $sql);

        return $result;  
    }

    public function modificarDniCliente($dni,$idCliente){

        $db=BaseDeDatos::conectarBD();

        $sql='update Clientes
        set  dni="'.$dni.'"
        where idClientes = '.$idCliente.';';

        $result=mysqli_query($db, $sql);

        return $result;  
    }

   public function  modificarProductoCliente($producto,$idCliente){

        $db=BaseDeDatos::conectarBD();

        $sql='update Clientes
        set  productoComprado="'.$producto.'"
        where idClientes = '.$idCliente.';';


        $result=mysqli_query($db, $sql);

        return $result; 
   }

   public function listaClientesParaBuscador(){
        
        $db=BaseDeDatos::conectarBD();

        $texto = '';

        $sql= 'select * from Clientes';
        
        $result=mysqli_query($db, $sql);

        if (mysqli_num_rows($result) > 0){ 

         while($fila = mysqli_fetch_assoc($result)){ 
              // se recoge la información según la vamos a pasar a la variable de javascript
              $texto .= '"' . $fila['nombreCompleto'] . '",';
             }
      
      }else{
               $texto = "NO HAY RESULTADOS EN LA BBDD"; 
      }

       return $texto; 
    }
 
} 

