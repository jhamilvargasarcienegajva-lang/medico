<?php
require_once __DIR__ . '/../config/database.php';

class MedicoDao {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->conectar();
    }

    public function listar() {
        $sql = "SELECT * FROM medicos ORDER BY id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    public function guardar($medico) {
        $sql = "INSERT INTO medicos (nombres, apellidos, especialidad, telefono, foto) VALUES (:nombres, :apellidos, :especialidad, :telefono, :foto)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nombres' => $medico->nombres,
            ':apellidos' => $medico->apellidos,
            ':especialidad' => $medico->especialidad,
            ':telefono' => $medico->telefono,
            ':foto' => $medico->foto,
        ]);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM medicos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    public function actualizar($medico) {
        $sql = "UPDATE medicos SET nombres = :nombres, apellidos = :apellidos, especialidad = :especialidad, telefono = :telefono, foto = :foto WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nombres' => $medico->nombres,
            ':apellidos' => $medico->apellidos,
            ':especialidad' => $medico->especialidad,
            ':telefono' => $medico->telefono,
            ':foto' => $medico->foto,
            ':id' => $medico->id,
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM medicos WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
?>
