<?php
// config/connection.php

// 1. Si existe el archivo .env en local, cargamos sus valores en $_ENV
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $envVars = parse_ini_file($envFile);
    if ($envVars !== false) {
        foreach ($envVars as $key => $value) {
            $_ENV[$key] = $value;
        }
    }
}

class Conexion {
    public static function conectar() {
        // En local lee de $_ENV (cargado desde el .env); en Railway lee directo del entorno con getenv()
        $host = $_ENV['MYSQLHOST'] ?? getenv('MYSQLHOST') ?: 'localhost';
        $port = $_ENV['MYSQLPORT'] ?? getenv('MYSQLPORT') ?: '3306';
        $db   = $_ENV['MYSQLDATABASE'] ?? getenv('MYSQLDATABASE') ?: 'railway';
        $user = $_ENV['MYSQLUSER'] ?? getenv('MYSQLUSER') ?: 'root';
        $pass = $_ENV['MYSQLPASSWORD'] ?? getenv('MYSQLPASSWORD') ?: '';

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
            return $pdo;
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
}