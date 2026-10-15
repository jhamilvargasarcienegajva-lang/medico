<?php
class Database {
    private $host = "localhost";
    private $db = "hospital_db";
    private $user = "root";
    private $pass = "";

    public function conectar() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8";

        try {
            return new PDO($dsn, $this->user, $this->pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
