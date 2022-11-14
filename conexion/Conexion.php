<?php
class Conexion{
	
	private $servidor;
    private $usuario;
    private $password;
    private $bd; 

    public function __construct(){
        $this->servidor = "localhost";
        $this->usuario = "root";
        $this->password = "";
        $this->bd = "querys"; 
    }
    
    public function ConexionBd(){		
		$conn = new mysqli($this->servidor, $this->usuario, $this->password, $this->bd);
		if($conn->connect_error){
			die("Error al conectarse con la base de datos: " . $conn->connect_error);
		} else {
			return $conn;
		}
    }
}
