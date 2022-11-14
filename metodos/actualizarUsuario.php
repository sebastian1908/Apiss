<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once '../Conexion/Conexion.php';
require_once '../models/usuariosmodelo.php';

class actualizaUser{
	
	public function actualizarUsuario(){
		$conexion = new Conexion();
		$db = $conexion->ConexionBd();
		
		$usuario = new Usuarios($db);
		
		$data = json_decode(file_get_contents("php://input"));

		if(!empty($data->id) && !empty($data->nombre) && !empty($data->apellido) && !empty($data->edad)){ 
			
			$usuario->id = $data->id; 
			$usuario->nombre = $data->nombre;
			$usuario->apellido = $data->apellido;
			$usuario->edad = $data->edad;
			
			if($usuario->actualizarUsuario()){     
				http_response_code(200);   
				echo json_encode(array("message" => "Usuario actualizado con exito."));
			}else{    
				http_response_code(503);     
				echo json_encode(array("message" => "Error al actualizar el usuario."));
			}
			
		} else {
			http_response_code(400);    
			echo json_encode(array("message" => "Datos incorrecto o el usuario no existe."));
		}

	}
}

$ob = new actualizaUser();
$ob->actualizarUsuario();