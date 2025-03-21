<?php
class Conexion{
    function conectar(){
        try {
            // En macOS con Docker, a veces funciona mejor usar TCP/IP explícitamente
            $host = '127.0.0.1'; // Usar IP literal en lugar de localhost
            $port = '3306';
            $dbname = 'agendadb';
            $username = 'root';
            $password = '1234';
            
            $dsn = "mysql:host={$host};port={$port};dbname={$dbname}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 5, // Agregar un timeout explícito
                PDO::ATTR_PERSISTENT => false
            ];
            
            $PDO = new PDO($dsn, $username, $password, $options);
            return $PDO;
        } catch(PDOException $e) {
            // Mostrar mensaje detallado para diagnóstico
            echo "Error de conexión PDO: " . $e->getMessage() . "<br>";
            echo "DSN utilizado: mysql:host=127.0.0.1;port=3306;dbname=agendadb<br>";
            exit;
        }
    }
}
?>