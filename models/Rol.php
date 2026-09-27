<?php
// models/Rol.php
require_once __DIR__ . '/../config/connection.php';

class Rol {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    public function obtenerTodos() {
        $stmt = $this->db->query("SELECT * FROM roles ORDER BY nombre ASC");
        return $stmt->fetchAll();
    }
}