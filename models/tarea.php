<?php 

class Tarea {

	private $table = 'registro_tareas';
	private $conection;

	public function __construct() {
		
	}

	public function getConection(){
		$dbObj = new Db();
		$this->conection = $dbObj->conection;
	}

	public function getTareas(){
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function getTareaById($id){
		if(is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	public function newTarea($param){
		$this->getConection();

		$titulo = $descripcion = "";
        $estado = 1;
		$exists = false;
		if(isset($param["id"]) and $param["id"] !=''){
			$tareaActual = $this->getTareaById($param["id"]);
			if(isset($tareaActual["id"])){
				$exists = true;	
				
				$id = $param["id"];
				$titulo = $tareaActual["titulo"];
				$descripcion = $tareaActual["descripcion"];
                $estado = $tareaActual["estado"];
			}
		}

		
		if(isset($param["titulo"])) $titulo = $param["titulo"];
		if(isset($param["descripcion"])) $descripcion = $param["descripcion"];


		if($exists){
			$sql = "UPDATE ".$this->table. " SET titulo=?, descripcion=?, estado=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$titulo, $descripcion, $estado, $id]);
		}else{
			$sql = "INSERT INTO ".$this->table. " (titulo, descripcion, estado) values(?, ?, ?)";
			$stmt = $this->conection->prepare($sql);
			$stmt->execute([$titulo, $descripcion, $estado]);
			$id = $this->conection->lastInsertId();
		}	

		return $id;	

	}

	public function deleteTarea($id){
		$this->getConection();
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

}

?>