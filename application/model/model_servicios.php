<?php

class Model_Servicios extends Model{

	private $db;

	 public function __construct()
    {
        require_once 'modelo_conexion_base_de_datos.php';
        $db=BaseDeDatos::conectarBD();
    }


 	public function listaServicios(){

 		 $db=BaseDeDatos::conectarBD();

        $sql= 'select * from Servicios; ';
        
        $result=mysqli_query($db, $sql);

        return $result;
 	}

      public function validarSiExisteServicio($nombreServicio){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Servicios where nombre = "'.$nombreServicio.'"; ';

        $result=mysqli_query($db, $sql);

        if(mysqli_num_rows($result)>0){
            return false;
        } else {
            return true;
        }
    }
    
    public function  guardarServicio($nombreServicio,$domicilio,$telefono,$horarioDeAtencion,$email,$marcas){

    $db=BaseDeDatos::conectarBD();

    $sql='insert into Servicios (nombre, domicilio, telefono, horarioDeAtencion, email, marcas) values ("'.$nombreServicio.'","'.$domicilio.'",'.$telefono.',"'.$horarioDeAtencion.'","'.$email.'","'.$marcas.'");';

    $result=mysqli_query($db, $sql);

    return $result;  
    }

     public function servicioPorId($servicioId){
        
        $db=BaseDeDatos::conectarBD();

        $sql= 'select * from Servicios where idServicios = '.$servicioId.'; ';

        $result=mysqli_query($db, $sql);

        $rows= mysqli_fetch_assoc($result);

        return $rows;
    }

    public function servicioBuscado($nombre){

    $db=BaseDeDatos::conectarBD();

    $sql='select * from Servicios where nombre like "%'.$nombre.'%" ;';

    $result=mysqli_query($db, $sql);

    return $result;    
    }
    
}