<?php
class Usuarios{   
    
    private $tableUsuario = "usuarios";      
    public $id;
    public $nombre;
    public $apellido;
    public $edad;
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function leerUsuario(){	
		if($this->id) {
			$query = $this->conn->prepare("SELECT * FROM ".$this->tableUsuario." WHERE ID = ?");
			$query->bind_param("i", $this->id);					
		} else {
			$query = $this->conn->prepare("SELECT * FROM ".$this->tableUsuario);		
		}		
		$query->execute();			
		$result = $query->get_result();		
		return $result;	
	}
	
	function crearUsuario(){
		
		$query = $this->conn->prepare("
			INSERT INTO ".$this->tableUsuario."(NOMBRE, APELLIDO, EDAD)
			VALUES(?,?,?)");
		
		$this->nombre = htmlspecialchars(strip_tags($this->nombre));
		$this->apellido = htmlspecialchars(strip_tags($this->apellido));
		$this->edad = htmlspecialchars(strip_tags($this->edad));

		$query->bind_param("ssi", $this->nombre, $this->apellido, $this->edad);
		
		if($query->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function actualizarUsuario(){
	 
		$query = $this->conn->prepare("
			UPDATE ".$this->tableUsuario." 
			SET NOMBRE= ?, APELLIDO = ?, EDAD = ?
			WHERE ID = ?");
	 
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->nombre = htmlspecialchars(strip_tags($this->nombre));
		$this->apellido = htmlspecialchars(strip_tags($this->apellido));
		$this->edad = htmlspecialchars(strip_tags($this->edad));
	 
		$query->bind_param("ssii", $this->nombre, $this->apellido, $this->edad, $this->id);
		
		if($query->execute()){
			return true;
		}
	 
		return false;
	}
	
	function eliminarUsuario(){
		
		$query = $this->conn->prepare("
			DELETE FROM ".$this->tableUsuario." 
			WHERE ID = ?");
			
		$this->id = htmlspecialchars(strip_tags($this->id));
	 
		$query->bind_param("i", $this->id);
	 
		if($query->execute()){
			return true;
		}
	 
		return false;		 
	}
}
