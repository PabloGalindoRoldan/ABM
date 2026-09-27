<?php
// controllers/UserController.php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Rol.php';

class UserController {
    private $usuarioModel;
    private $rolModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
        $this->rolModel = new Rol();
    }

    // Mostrar el listado de usuarios (Read)
    public function index() {
        $usuarios = $this->usuarioModel->obtenerTodos();
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/users/list.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    // Mostrar el formulario para crear (Create)
    public function crear() {
        $roles = $this->rolModel->obtenerTodos();
        $usuario = null; // Indica que es un alta
        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/users/form.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    // Mostrar el formulario para editar (Update)
    public function editar() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php");
            exit;
        }

        $usuario = $this->usuarioModel->obtenerPorId($id);
        $roles = $this->rolModel->obtenerTodos();

        require_once __DIR__ . '/../views/layout/header.php';
        require_once __DIR__ . '/../views/users/form.php';
        require_once __DIR__ . '/../views/layout/footer.php';
    }

    // Procesar la información guardada (Alta o Edición)
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id       = $_POST['id'] ?? null;
            $nombre   = trim($_POST['nombre'] ?? '');
            $apellido = trim($_POST['apellido'] ?? '');
            $nickname = trim($_POST['nickname'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $rol_id   = $_POST['rol_id'] ?? null;

            if (!empty($nombre) && !empty($apellido) && !empty($nickname) && !empty($email) && !empty($rol_id)) {
                if ($id) {
                    $this->usuarioModel->actualizar($id, $nombre, $apellido, $nickname, $email, $rol_id);
                } else {
                    $this->usuarioModel->crear($nombre, $apellido, $nickname, $email, $rol_id);
                }
            }
        }
        header("Location: index.php");
        exit;
    }

    // Procesar la baja (Delete)
    public function eliminar() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->usuarioModel->eliminar($id);
        }
        header("Location: index.php");
        exit;
    }
}

if (!class_exists('UsuarioController')) {
    class_alias('UserController', 'UsuarioController');
}