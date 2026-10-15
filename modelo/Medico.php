<?php
class Medico {
    public $id;
    public $nombres;
    public $apellidos;
    public $especialidad;
    public $telefono;
    public $foto;

    public function __construct($id = null, $nombres = "", $apellidos = "", $especialidad = "", $telefono = "", $foto = "") {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->especialidad = $especialidad;
        $this->telefono = $telefono;
        $this->foto = $foto;
    }
}
?>
