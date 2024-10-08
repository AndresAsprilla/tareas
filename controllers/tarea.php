<?php 

require_once 'models/tarea.php';

class tareaController{
	public $page_title;
	public $view;

	public function __construct() {
		$this->view = 'listado_tareas';
		$this->page_title = '';
		$this->tareaObj = new Tarea();
	}

	public function listTareas(){
		$this->page_title = 'Listado de tareas';
		return $this->tareaObj->getTareas();
	}

	public function editTarea($id = null){
		$this->page_title = 'Editar tarea';
		$this->view = 'editar_tarea';
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->tareaObj->getTareaById($id);
	}

	public function createTarea(){

		try {
			$this->view = 'editar_tarea';
			$this->page_title = 'Editar tarea';
			$id = $this->tareaObj->newTarea($_POST);
			$result = $this->tareaObj->getTareaById($id);
			$_GET["response"] = true;
			return $result;
		} catch (Exception $e) {
			$_GET["response"] = false;
			$_GET["error_message"] = $e->getMessage();
			return [];
		}

	}

	public function confirmDelete(){
		$this->page_title = 'Eliminar tarea';
		$this->view = 'confirm_delete';
		return $this->tareaObj->getTareaById($_GET["id"]);
	}

	public function delete(){
		$this->page_title = 'Listado de tareas';
		$this->view = 'delete_tarea';
		return $this->tareaObj->deleteTarea($_POST["id"]);
	}

    public function complete(){
		$this->page_title = 'Completar tarea';
		$this->view = 'complete_tarea';
		return $this->tareaObj->completeTarea($_GET["id"]);
	}

}

?>