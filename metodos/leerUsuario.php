<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../conexion/Conexion.php';
require_once '../models/usuariosmodelo.php';


class UsuariosLeer{

    public function mostrarUsuarios(){

        $conexion = new Conexion();
        $db = $conexion->ConexionBd();
         
        $usuario = new Usuarios($db);
        
        $usuario->id = (isset($_GET['ID']) && $_GET['ID']) ? $_GET['ID'] : '0';
        
        $resultado = $usuario->leerUsuario();
        
        if($resultado->num_rows > 0){    
            $data=array();
            $data["usuarios"]=array(); 
            while ($datos = $resultado->fetch_assoc()) { 	
                extract($datos); 
                $datosUsuarios=array($datos); 
               array_push($data["usuarios"], $datosUsuarios);
            }    
            http_response_code(200);     
            echo json_encode($data);
        }else{     
            http_response_code(404);     
            echo json_encode(
                array("message" => "El usuario no existe.")
            );
        } 
        
    }
}

$ob = new UsuariosLeer();
$ob->mostrarUsuarios();
