<?php

class Model_Servicios extends Model{

	private $db;

	 public function __construct()
    {
        require_once 'modelo_conexion_base_de_datos.php';
        $db=BaseDeDatos::conectarBD();

        require_once 'modelo_conexion_base_de_datosSql.php';
        $dbSql=BaseDeDatosSql::conectarBDSql();
    }


 	 public function enviarEmail($titulo,$txt,$nombre)
    {
    
        $emailSalida = "alan.boca12@gmail.com";
        $mensaje = $txt;
        $titulo = $titulo;
        $nombre = $nombre;
                
        /*Configuracion de variables para enviar el correo*/
        $mail_username="restocomidas@gmail.com";//Correo electronico saliente ejemplo: tucorreo@gmail.com
        $mail_userpassword="unlam2018";//Tu contraseña de gmail
        $mail_addAddress=$emailSalida;//correo electronico que recibira el mensaje
        //$template="application/view/email_template.html"; // $template="email_template.html";//Ruta de la plantilla HTML para enviar nuestro mensaje
                
        /*Inicio captura de datos enviados por $_POST para enviar el correo */
        $mail_setFromEmail=$emailSalida;
        $mail_setFromName=$nombre;
        $txt_message=$mensaje;
        $mail_subject= $titulo;
                
        $this->sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject);//Enviar el mensaje
    }

    public function sendemail($mail_username, $mail_userpassword, $mail_setFromEmail, $mail_setFromName, $mail_addAddress, $txt_message, $mail_subject)
    {
        
        require 'PHPMailer/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();                            // Establecer el correo electrónico para utilizar SMTP
    $mail->Host = 'smtp.gmail.com';             // Especificar el servidor de correo a utilizar
    $mail->SMTPAuth = true;                     // Habilitar la autenticacion con SMTP
    $mail->Username = $mail_username;          // Correo electronico saliente ejemplo: tucorreo@gmail.com
    $mail->Password = $mail_userpassword;       // Tu contraseña de gmail
    $mail->SMTPSecure = 'tls';                  // Habilitar encriptacion, `ssl` es aceptada
    $mail->Port = 587;                      // Puerto TCP  para conectarse
    $mail->setFrom($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe aparecer el correo electrónico. Puede utilizar cualquier dirección que el servidor SMTP acepte como válida. El segundo parámetro opcional para esta función es el nombre que se mostrará como el remitente en lugar de la dirección de correo electrónico en sí.
    $mail->addReplyTo($mail_setFromEmail, $mail_setFromName);//Introduzca la dirección de la que debe responder. El segundo parámetro opcional para esta función es el nombre que se mostrará para responder
    $message = ($txt_message);
        $mail->addAddress($mail_addAddress);   // Agregar quien recibe el e-mail enviado
        $message = str_replace('{{first_name}}', $mail_setFromName, $message);
        $message = str_replace('{{message}}', $txt_message, $message);
        $message = str_replace('{{customer_email}}', $mail_setFromEmail, $message);
        $mail->isHTML(true);  // Establecer el formato de correo electrónico en HTML
    
        $mail->Subject = $mail_subject;
        $mail->msgHTML($message);
        $mail->send();
    }

    public function listaSucursales(){

        $db=BaseDeDatos::conectarBD();

        $sql= 'SELECT s.descripcion as descripcion, s.latitude as latitude, s.longitude as longitude, i.nombre, s.domicilio as domicilio, s.telefono as telefono 

        FROM Sucursales as s
        
        INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes';

        $result=mysqli_query($db, $sql);

        return $result;
    }

      public function listaZonas(){

        $db=BaseDeDatos::conectarBD();

        $sql= 'SELECT z.idZonas as id, z.zona as zona, COUNT(s.idSucursales) AS CantSucursales
                FROM zonas as z
                INNER JOIN sucursales as s on z.idZonas = s.idZonas
                GROUP BY z.idZonas';

        $result=mysqli_query($db, $sql);

        return $result;
    }

     public function listaSucursalesPorZona($idZona){

        $db=BaseDeDatos::conectarBD();

        $sql= 'SELECT s.descripcion as descripcion, s.latitude as latitude, s.longitude as longitude, i.nombre, s.domicilio as domicilio, s.telefono as telefono FROM Sucursales as s
        
        INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes 

        WHERE idZonas = '.$idZona.' ';

        $result=mysqli_query($db, $sql);

        return $result;
     }

    public function ultimasNovedades(){

        $db=BaseDeDatos::conectarBD();


        
        $sql= 'SELECT  * FROM Novedades ORDER BY idNovedades ASC LIMIT 3';

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function novedadPorId($idNovedad){

        $db=BaseDeDatos::conectarBD();

        $sql= 'SELECT  * FROM Novedades WHERE idNovedades= '.$idNovedad.' ';

        $result=mysqli_query($db, $sql);

        return $result;
    }

     public function totalNovedades($diaActual){

        $db=BaseDeDatos::conectarBD();

        $month = date("m",strtotime($diaActual));
        $year = date("Y",strtotime($diaActual));
     

        $sql= 'SELECT * FROM Novedades WHERE MONTH(fechaCalendario) = '.$month.' AND YEAR(fechaCalendario) = '.$year.' ORDER BY DAY(fechaCalendario) asc ';

        $result=mysqli_query($db, $sql);

        return $result;

     }

    public function totalNovedadesPorFecha($month, $year){

         $db=BaseDeDatos::conectarBD();
     
        $sql= 'SELECT * FROM Novedades WHERE MONTH(fechaCalendario) = '.$month.' AND YEAR(fechaCalendario) = '.$year.' ORDER BY DAY(fechaCalendario) asc ';

        $result=mysqli_query($db, $sql);

        return $result;
    }

     public function totalNovedadesSiguiente($siguiente){

        $db=BaseDeDatos::conectarBD();

        $valor = 3;

        $sql= 'SELECT * FROM Novedades LIMIT '.$siguiente.','.$valor.' ';

        $result=mysqli_query($db, $sql);

        return $result;
     }

     public function totalNovedadesAnterior($anterior){

        $db=BaseDeDatos::conectarBD();

        $valor = $anterior - 3;

        $sql= 'SELECT * FROM Novedades LIMIT '.$valor.','.$anterior.' ';

        $result=mysqli_query($db, $sql);

        return $result;
     }

     public function fechasDeNovedades(){
        
        $db=BaseDeDatos::conectarBD();

        $sql= '  SELECT DISTINCT MONTH(fechaCalendario) AS month, YEAR(fechaCalendario) as year 
                FROM Novedades ORDER BY fechaCalendario DESC ';

        $result=mysqli_query($db, $sql);

        return $result;
     }

     public function insertarIntegranteSql(){

        $dbSql=BaseDeDatosSql::conectarBDSql();

        $sql="SELECT * FROM Clientes WHERE nombreCompleto = ('%".$nombreCompleto."%') order by dni asc; ";

        $result= sqlsrv_query($dbSql, $sql , array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));
        
        return $result;
     }

    public function tablaSucursales(){

         $db=BaseDeDatos::conectarBD();

         $sql="SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;


    }

    public function localidades(){

         $db=BaseDeDatos::conectarBD();

         $sql="SELECT * FROM Localidades";

        $result=mysqli_query($db, $sql);

        return $result;
    }

       public function provincias(){

         $db=BaseDeDatos::conectarBD();

         $sql="SELECT * FROM Provincias";

        $result=mysqli_query($db, $sql);

        return $result;
    }

       public function zonas(){

         $db=BaseDeDatos::conectarBD();

         $sql="SELECT * FROM Zonas";

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function tablaSucursalesPor($localidad,$zona,$provincia){

        $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias 
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;

    }

    public function tablaSucursalesPorLocalidad($localidad){

        $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                WHERE  l.localidad = '".$localidad."' 
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function tablaSucursalesPorZona($zona){

          $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                INNER JOIN Zonas as z on s.idZonas = z.idZonas
                WHERE  z.zona = '".$zona."'
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function tablaSucursalesPorProvincia($provincia){

        $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                WHERE  p.provincia = '".$provincia."' 
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function tablaSucursalesPorLocalidadZona($localidad,$zona){

          $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                INNER JOIN Zonas as z on s.idZonas = z.idZonas
                WHERE  z.zona = '".$zona."' AND l.localidad = '".$localidad."'
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }
   
    public function  tablaSucursalesPorLocalidadProvincia($localidad,$provincia){

        $db=BaseDeDatos::conectarBD();

        $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                WHERE  p.provincia = '".$provincia."' AND l.localidad = '".$localidad."' 
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }

    public function tablaSucursalesPorProvinciaZona($zona,$provincia){

        $db=BaseDeDatos::conectarBD();

       $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                INNER JOIN Zonas as z on s.idZonas = z.idZonas
                WHERE  z.zona = '".$zona."' AND p.provincia = '".$provincia."'
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }

       public function tablaSucursalesPorTodo($zona,$provincia,$localidad){

        $db=BaseDeDatos::conectarBD();

       $sql= "SELECT i.nombre as nombre, s.domicilio as domicilio, l.localidad as localidad, p.provincia as provincia, s.telefono as telefono
                FROM Sucursales as s
                INNER JOIN Integrantes as i on s.idIntegrantes = i.idIntegrantes
                INNER JOIN Localidades as l on s.idLocalidades = l.idLocalidades
                INNER JOIN Provincias as p on s.idProvincias = p.idProvincias
                INNER JOIN Zonas as z on s.idZonas = z.idZonas
                WHERE  z.zona = '".$zona."' AND p.provincia = '".$provincia."' AND l.localidad = '".$localidad."'
                ORDER BY l.localidad asc";

        $result=mysqli_query($db, $sql);

        return $result;
    }
    
  
    }


    