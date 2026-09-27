<?php
// models/User.php
require_once __DIR__ . '/../config/connection.php';

class Usuario {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    // Listar todos los usuarios incluyendo el nombre del rol
    public function obtenerTodos() {
        $sql = "SELECT u.*, r.nombre AS rol_nombre 
                FROM usuarios u 
                INNER JOIN roles r ON u.rol_id = r.id 
                ORDER BY u.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }

    // Obtener un único usuario por su ID
    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Guardar nuevo usuario
    public function crear($nombre, $apellido, $nickname, $email, $rol_id) {
        $sql = "INSERT INTO usuarios (nombre, apellido, nickname, email, rol_id) 
                VALUES (:nombre, :apellido, :nickname, :email, :rol_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nombre'   => $nombre,
            ':apellido' => $apellido,
            ':nickname' => $nickname,
            ':email'    => $email,
            ':rol_id'   => $rol_id
        ]);
    }

    // Actualizar usuario existente
    public function actualizar($id, $nombre, $apellido, $nickname, $email, $rol_id) {
        $sql = "UPDATE usuarios 
                SET nombre = :nombre, apellido = :apellido, nickname = :nickname, email = :email, rol_id = :rol_id 
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'       => $id,
            ':nombre'   => $nombre,
            ':apellido' => $apellido,
            ':nickname' => $nickname,
            ':email'    => $email,
            ':rol_id'   => $rol_id
        ]);
    }

    // Eliminar usuario
    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}