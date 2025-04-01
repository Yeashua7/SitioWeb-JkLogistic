<?php
require_once 'config.php';

class Database {
    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
                DB_USER,
                DB_PASS
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    public function insertContact($nombre, $email, $telefono, $mensaje) {
        try {
            $sql = "INSERT INTO contactos (nombre, email, telefono, mensaje, fecha_creacion) 
                    VALUES (:nombre, :email, :telefono, :mensaje, NOW())";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':telefono' => $telefono,
                ':mensaje' => $mensaje
            ]);
            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>