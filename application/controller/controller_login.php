<?php
	include 'application/model/model_usuario.php';
	
class Controller_Login extends Controller{
  
   //funcion que ejecuta por defecto 
    function index(){
        $this->view->generateSt('login_view.php');
    }

    function validarlogin(){

        $usuario = new Model_Usuario();
        $nombreUsuario = $_POST['nombreUsuario'];
        $clave = md5($_POST['clave']);
		$rol =  $usuario->validarlogin($nombreUsuario,$clave);
		$_SESSION['rol'] = $rol;
		switch ($rol){
			case "Administrador":
				$_SESSION["login"]="sessionAdmin";
				$idUsuario = $usuario->buscarIdUsuario($nombreUsuario);
				$_SESSION['idUsuario'] = $idUsuario;
				$this->view->generateSt('listaClientesHome.php', $idUsuario);
				break;
			case "Operador":
				$_SESSION["login"]="sessionOperador";
				$idUsuario = $usuario->buscarIdUsuario($nombreUsuario);
				$_SESSION['idUsuario'] = $idUsuario;
				$this->view->generateSt('listaClientesHome.php', $idUsuario);
				break;
			case "Operador2":
				$_SESSION["login"]="sessionOperador2";
				header("location: /delivery/index");
				break;
		}
    }

    function cerrarsesion(){
		session_destroy();
    	header("location:/");
    }

	}
	function error(){
		$this->view->generateSt('usuario_error_view.php');
	}

?>