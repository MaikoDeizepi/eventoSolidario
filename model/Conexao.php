<?php

class Conexao {
    private static $conn = null;

    private function __construct() {} // Construtor privado para evitar instanciação direta

    public static function conectar() {
        if (self::$conn === null) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            try {
                self::$conn = new PDO("mysql:host=$servername;dbname=eventosolidario", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                error_log("Conexão falhou: " . $e->getMessage());
                return null; // Retorna null em caso de erro
            }
        }
        return self::$conn;
    }
}


?>