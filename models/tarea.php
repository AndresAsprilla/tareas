<?php

class Tarea
{

	private $table = 'registro_tareas';
	private $conection;

	public function __construct() {}

	public function getConection()
	{
		$DataBaseObj = new DataBase();
		$this->conection = $DataBaseObj->conection;
	}

	public function getTareas()
	{
		$this->getConection();
		$sql = "SELECT * FROM " . $this->table;
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function getTareaById($id)
	{
		if (is_null($id)) return false;
		$this->getConection();
		$sql = "SELECT * FROM " . $this->table . " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetch();
	}

	public function newTarea($param)
	{
		$this->getConection();


		if (empty($param["titulo"])) {
			throw new Exception("El título no puede estar vacío");
		}
		
		if (empty($param["descripcion"])) {
			throw new Exception("La descripción no puede estar vacía");
		}
	
		$titulo = $param["titulo"];
		$descripcion = $param["descripcion"];

		$titulo = $descripcion = "";
		$estado = 1;
		$exists = false;
		if (isset($param["id"]) and $param["id"] != '') {
			$tareaActual = $this->getTareaById($param["id"]);
			if (isset($tareaActual["id"])) {
				$exists = true;

				$id = $param["id"];
				$titulo = $tareaActual["titulo"];
				$descripcion = $tareaActual["descripcion"];
				$estado = $tareaActual["estado"];
			}
		}


		//if (isset($param["titulo"])) $titulo = $param["titulo"];
		//if (isset($param["descripcion"])) $descripcion = $param["descripcion"];


		if ($exists) {
			$sql = "UPDATE " . $this->table . " SET titulo=?, descripcion=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$titulo, $descripcion, $id]);
		} else {
			try {
				// Validación de campos vacíos
				if (empty($param["titulo"])) {
					throw new Exception("El título no puede estar vacío");
				}
		
				if (empty($param["descripcion"])) {
					throw new Exception("La descripción no puede estar vacía");
				}
		
				$titulo = $param["titulo"];
				$descripcion = $param["descripcion"];
		
				$sql = "INSERT INTO " . $this->table . " (titulo, descripcion, estado) values(?, ?, ?)";
				$stmt = $this->conection->prepare($sql);
				$stmt->execute([$titulo, $descripcion, 1]);
		
				return $this->conection->lastInsertId();
			} catch (PDOException $e) {
				throw new Exception("Error al guardar en la base de datos: " . $e->getMessage());
			}
		}

		return $id;
	}

	public function deleteTarea($id)
	{
		$this->getConection();
		$sql = "DELETE FROM " . $this->table . " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		return $stmt->execute([$id]);
	}

	public function completeTarea($id)
	{
		$this->getConection();

		$exists = false;

		if (isset($id) and $id != '') {
			$tareaActual = $this->getTareaById($id);
			if (isset($tareaActual["id"])) {
				$exists = true;
			} else {
				$id = 0;
			}
		}

		if ($exists) {
			$sql = "UPDATE " . $this->table . " SET estado=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([2, $id]);
		}

		return $id;
	}
}
