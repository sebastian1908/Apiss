<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once '../Conexion/Conexion.php';
require_once '../models/usuariosmodelo.php';
 
class EliminarUser{

    public function eliminaUsuario(){
        $conexion = new Conexion();
        $db = $conexion->ConexionBd();
         
        $usuario = new Usuarios($db);
         
        $data = json_decode(file_get_contents("php://input"));
        
        if(!empty($data->id)) {
            $usuario->id = $data->id;
            if($usuario->eliminarUsuario()){    
                http_response_code(200); 
                echo json_encode(array("message" => "Usuario eliminado con exito."));
            } else {    
                http_response_code(503);   
                echo json_encode(array("message" => "No se pudo eliminar el usuario."));
            }
        } else {
            http_response_code(400);    
            echo json_encode(array("message" => "El usuario no existe."));
        }
        
    }
}

$ob = new EliminarUser();
$ob->eliminaUsuario();
