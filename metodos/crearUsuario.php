<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
require_once '../Conexion/Conexion.php';
require_once '../models/usuariosmodelo.php';
 

class CrearUser{
    
    public function crearUsuario(){
        
        $conexion = new Conexion();
        $db = $conexion->ConexionBd();
        $usuario = new Usuarios($db);
        
        $data = json_decode(file_get_contents("php://input"));
        if(!empty($data->nombre) && !empty($data->apellido) && !empty($data->edad)){    
            
            $usuario->nombre = $data->nombre;
            $usuario->apellido = $data->apellido;
            $usuario->edad = $data->edad;
                if($usuario->crearUsuario()){         
                    http_response_code(201);         
                    echo json_encode(array("message" => "Usuario creado con exito."));
                }else{         
                    http_response_code(503);        
                    echo json_encode(array("message" => "No se puedo crear el usuario, algo fallo."));
            }
        }else{    
            http_response_code(400);    
            echo json_encode(array("message" => "No se pudo crear el usuario."));
        }

    }
}

$ob = new CrearUser();
$ob->crearUsuario();

