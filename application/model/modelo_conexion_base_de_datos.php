<?php

	class BaseDeDatos extends Model{
		static function  conectarBD(){
			$server="localhost";
			$usuario="root";
			$clave="";
			$baseDeDatos="GmDb";

			$conexion=mysqli_connect($server, $usuario, $clave, $baseDeDatos) or die("Error al conectar a la base de datos");

			if ($conexion) {
				
			}

			return $conexion;
		}
		
		
	}