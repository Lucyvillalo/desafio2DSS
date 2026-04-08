<?php 

class Apuntes {

	private $table = 'apuntes';
	private $conection;

	public function __construct() {
		
	}

	/* Set conection */
	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	/* Get all notes */
	public function obtenerApuntes(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* Get note by id */
	public function ObtenerApuntePorId($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	/* Save note */
	public function Guardar($param){

		$this->getConection();

		/* Set default values */
		$titulo = $contenido = "";

		/* Check if exists */
		$exists = false;
		if(isset($param["id"]) and $param["id"] !=''){
			$actualNote = $this->ObtenerApuntePorId($param["id"]);
			if(isset($actualNote["id"])){
				$exists = true;	
				/* Actual values */
				$id = $param["id"];
				$titulo = $actualNote["titulo"];
				$contenido = $actualNote["contenido"];
			}
		}

		/* Received values */
		if(isset($param["titulo"])) $titulo = $param["titulo"];
		if(isset($param["contenido"])) $contenido = $param["contenido"];

		/* Database operations */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET titulo=?, contenido=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$titulo, $contenido, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (titulo, contenido) values(?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$titulo, $contenido]);
			$id = $this->conection->lastInsertId();
		}	

		return $id;	

	}

	/* Delete note by id */
	public function BorrarApuntePorId($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

}

?>