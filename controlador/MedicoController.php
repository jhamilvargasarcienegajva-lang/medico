<?php
require_once __DIR__ . '/../modelo/Medico.php';
require_once __DIR__ . '/../modelo/MedicoDao.php';

class MedicoController {
    private $dao;

    public function __construct() {
        $this->dao = new MedicoDao();
    }

    public function listar() {
        return $this->dao->listar();
    }

    public function guardar($medico) {
        $this->dao->guardar($medico);
    }

    public function obtenerPorId($id) {
        return $this->dao->obtenerPorId($id);
    }

    public function actualizar($medico) {
        $this->dao->actualizar($medico);
    }

    public function eliminar($id) {
        $this->dao->eliminar($id);
    }
}
?>
