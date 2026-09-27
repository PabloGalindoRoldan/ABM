<?php
// config/conexion.php

class Conexion
{
    public static function conectar()
    {
        $host = getenv('MYSQLHOST') ?: $_ENV['MYSQLHOST'] ?? '127.0.0.1';
        $port = getenv('MYSQLPORT') ?: $_ENV['MYSQLPORT'] ?? '3306';
        $db = getenv('MYSQLDATABASE') ?: $_ENV['MYSQLDATABASE'] ?? 'railway';
        $user = getenv('MYSQLUSER') ?: $_ENV['MYSQLUSER'] ?? 'root';
        $pass = getenv('MYSQLPASSWORD') ?: $_ENV['MYSQLPASSWORD'] ?? '';

        if (empty($host) || $host === 'localhost') {
            $host = '127.0.0.1';
        }

        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

        // Lógica de reintentos para manejar el "cold start" de Railway
        $maxIntentos = 3;
        $intento = 0;

        while ($intento < $maxIntentos) {
            try {
                $pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);
                return $pdo; // Conexión exitosa
            } catch (PDOException $e) {
                $intento++;
                if ($intento >= $maxIntentos) {
                    die("Error de conexión a la base de datos (tras varios intentos): " . $e->getMessage());
                }
                // Espera 2 segundos para darle tiempo a Railway a despertar la BDD
                sleep(2);
            }
        }
    }
}