<?php

	class BaseDeDatosSql extends Model{
		
		static function  conectarBDSql(){
		$serverName='desktop-ds8ovfp';
		$connectionInfo= array("Database"=>"GmDb","UID"=>"sa","PWD"=>"q1w2e3r4","CharacterSet"=>"UTF-8");
		$conn_sis= sqlsrv_connect($serverName, $connectionInfo);


//MUESTRA SI CONECTO O NO
		if($conn_sis){
			//echo "Conexion exitosa";
		} else{
			echo "Fallo concexion";
			die(print_r(sqlsrv_errors(), true));
		}

			return $conn_sis;
		}
		
		
	}