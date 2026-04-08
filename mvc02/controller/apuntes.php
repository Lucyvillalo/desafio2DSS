<?php 

require_once 'model/apuntes.php';

class apuntesController{
	public $page_title;
	public $view;
        public $noteObj;

	public function __construct() {
		$this->view = 'listar_apuntes';
		$this->page_title = '';
		$this->noteObj = new Apuntes();
	}

	/* List all notes */
	public function listar(){
		$this->page_title = 'Mis Apuntes';
		return $this->noteObj->obtenerApuntes();
	}

	/* Load note for edit */
	public function editar($id = null){
		$this->page_title = 'Editar Apunte';
		$this->view = 'editar_apunte';
		/* Id can from get param or method param */
		if(isset($_GET["id"])) $id = $_GET["id"];
		return $this->noteObj->ObtenerApuntePorId($id);
	}

	/* Create or update note */
	public function guardar(){
		$this->view = 'editar_apunte';
		$this->page_title = 'Editar Apunte';
		$id = $this->noteObj->guardar($_POST);
		$result = $this->noteObj->ObtenerApuntePorId($id);
		$_GET["response"] = true;
		return $result;
	}

	/* Confirm to delete */
	public function confirmarBorrado(){
		$this->page_title = 'Borrar Apunte';
		$this->view = 'confirmar_borrar_apunte';
		return $this->noteObj->ObtenerApuntePorId($_GET["id"]);
	}

	/* Delete */
	public function borrar(){
		$this->page_title = 'Listado de Apuntes';
		$this->view = 'borrar_apunte';
		return $this->noteObj->BorrarApuntePorId($_POST["id"]);
	}

}

?>