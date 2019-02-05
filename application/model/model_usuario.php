<?php

class Model_Usuario extends Model{
    private $db;
    private $usuario;
    private $clave;

    public function __construct()
    {
        require_once 'modelo_conexion_base_de_datos.php';
        $db=BaseDeDatos::conectarBD();
    }

    public function validarNombre($nombreUsuario){

     $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";     
      
     if (strlen($nombreUsuario)<3 || strlen($nombreUsuario)>20){ 
            return false; 
    } else{
        for ($i=0; $i<strlen($nombreUsuario); $i++){ 
                  if (strpos($permitidos, substr($$nombreUsuario,$i,1))===false){ 
                  return false; 
                 } else{
                    return true; 
                 }
            }   
    }

}

    public function validarlogin($nombreUsuario, $clave)
    {
        $db=BaseDeDatos::conectarBD();
 
        $sql= 'select Rol.tipo as rol, idUsuario as id from Usuario inner join Rol on Usuario.Rol_idRol = Rol.idRol where Usuario.nombreUsuario="'.$nombreUsuario.'" and Usuario.clave="'.$clave.'"; ';
        

        $result=mysqli_query($db, $sql);
 
        $rows=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)==1) {
            $rol=($rows['rol']);
            $id=($rows['id']);
            return $rol;
            }
         else {
            header("location:/login?e=1");

        }
    }

    public function cerrarsesion()
    {
        session_destroy();
        header("location:/main");
    }

    public function insertarCliente($nombreCompleto, $dni, $productoComprado, $idTarjeta, $observaciones,$imagen,$idUsuario,$diaActual){

        $db=BaseDeDatos::conectarBD();

        $sql= 'insert into Clientes (nombreCompleto, dni, productoComprado, Tarjetas_idTarjetas, observaciones, ruta_img, Usuario_idUsuario, fechaDeCreacion) values ("'.$nombreCompleto.'",'.$dni.',"'.$productoComprado.'","'.$idTarjeta.'","'.$observaciones.'","'.$imagen.'",'.$idUsuario.',"'.$diaActual.'"); ';


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

    public function listaDni(){

         $db=BaseDeDatos::conectarBD();

        $sql= 'select dni from Clientes; ';
        
        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function validarSiExisteDni($dni){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Clientes where dni = '.$dni.'; ';

        $result=mysqli_query($db, $sql);

        if(mysqli_num_rows($result)>0){
            return false;
        } else {
            return true;
        }

    }

    public function buscarIdUsuario($nombreUsuario){

        $db=BaseDeDatos::conectarBD();

        $sql='select idUsuario from Usuario where nombreUsuario = "'.$nombreUsuario.'"; ';

        $result=mysqli_query($db, $sql);

         $rows=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)==1) {
            $idUsuario=($rows['idUsuario']);
            return $idUsuario;
            }
    }

    public function listaTarjetas(){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Tarjetas where idTarjetas is not null;';

        $result=mysqli_query($db, $sql);

        return $result;
    }


    public function listaMarcas(){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Marcas where idMarcas is not null order by nombre;';

        $result=mysqli_query($db, $sql);

        return $result;
    }


    public function listaIntegrantes(){
        
        $db=BaseDeDatos::conectarBD();

        $sql='select * from Integrantes;';

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function listaRoles(){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Rol ;';

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function listaUsuarios(){

       $db=BaseDeDatos::conectarBD();

        $sql='select * from Usuario;';

        $result=mysqli_query($db, $sql);

        return $result; 
    }

    public function usuarioBuscado($nombreUsuario){

    $db=BaseDeDatos::conectarBD();

    $sql='select * from Usuario where nombreUsuario like "%'.$nombreUsuario.'%" ;';

    $result=mysqli_query($db, $sql);

    return $result;    
    }

    public function guardarUsuario($nombreUsuario,$idRol,$idIntegrantes,$clave){

    $db=BaseDeDatos::conectarBD();

    $sql='insert into Usuario (nombreUsuario, clave, Rol_idRol, Integrantes_idIntegrantes) values ("'.$nombreUsuario.'","'.$clave.'",'.$idRol.','.$idIntegrantes.');';

    $result=mysqli_query($db, $sql);

    return $result;  
    }

    public function modificarNombreUsuario($nombreUsuario,$usuario1){
        
        $db=BaseDeDatos::conectarBD();

        $sql='update Usuario
        set  nombreUsuario="'.$nombreUsuario.'"
        where idUsuario = '.$usuario1.';';

        $result=mysqli_query($db, $sql);

        return $result;  
    }

    public function modificarClaveUsuario($claveNueva,$usuario1){

        $db=BaseDeDatos::conectarBD();

        $sql='update Usuario
        set  clave="'.$claveNueva.'"
        where idUsuario = '.$usuario1.';';

        $result=mysqli_query($db, $sql);

        return $result;  
    }

   public function  modificarRolUsuario($idRol,$usuario1){

         $db=BaseDeDatos::conectarBD();

        $sql='update Usuario
        set  Rol_idRol='.$idRol.'
        where idUsuario = '.$usuario1.';';

        $result=mysqli_query($db, $sql);

        return $result; 
   }

    public function validarSiExisteUsuario($nombreUsuario){

        $db=BaseDeDatos::conectarBD();

        $sql='select * from Usuario where nombreUsuario = "'.$nombreUsuario.'"; ';

        $result=mysqli_query($db, $sql);

        if(mysqli_num_rows($result)>0){
            return false;
        } else {
            return true;
        }
    }

    public function traerUsuarioPorId($usuario1){
    
    $db=BaseDeDatos::conectarBD();

    $sql='select * from Usuario where idUsuario = '.$usuario1.' ;';

    $result=mysqli_query($db, $sql);

    $rows= mysqli_fetch_assoc($result);
        
    return $rows;
    }

     public function traerClientePorId($cliente){
    
    $db=BaseDeDatos::conectarBD();

    $sql='select * from Clientes where idClientes = '.$cliente.' ;';

    $result=mysqli_query($db, $sql);

    $rows= mysqli_fetch_assoc($result);
        
    return $rows;
    }

    public function modificarUsuario($claveNueva, $nombreUsuario, $idRol,$usuario1){

        $db=BaseDeDatos::conectarBD();

        $sql='update Usuario
        set  nombreUsuario="'.$nombreUsuario.'", Rol_idRol = '.$idRol.',clave = "'.$claveNueva.'"
        where idUsuario = '.$usuario1.';';

        $result=mysqli_query($db, $sql);

        return $result;  
    }

    public function rolUsuario($idRolUsuario){
         $db=BaseDeDatos::conectarBD();

        $sql='select * from Rol where idRol = '.$idRolUsuario.'; ';

        $result=mysqli_query($db, $sql);

         $rows=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)==1) {
            $tipo=($rows['tipo']);
            return $tipo;
            }
    }

   public function usuarioQueAgregoCliente($idUsuarioQueLoAgrego){

    $db=BaseDeDatos::conectarBD();

    $sql='select * from Usuario where idUsuario = '.$idUsuarioQueLoAgrego.'; ';

    $result=mysqli_query($db, $sql);

       $rows=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)==1) {
            $nombre=($rows['nombreUsuario']);
            return $nombre;
            }
   
   }

   public function tarjetaDelCliente($idTarjeta){

    $db=BaseDeDatos::conectarBD();

    $sql='select * from Tarjetas where idTarjetas = '.$idTarjeta.'; ';
    
    $result=mysqli_query($db, $sql);

     $rows=mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result)==1) {
            $nombreTarjeta=($rows['nombre']);
            return  $nombreTarjeta;
            }
   }
} 

