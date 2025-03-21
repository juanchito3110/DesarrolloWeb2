<?php
/**
 * Funciones de utilidad para el sistema de autenticación
 */

/**
 * Verifica si el usuario está autenticado, redirecciona si no lo está
 */
function verificarAutenticacion() {
    if (!isset($_SESSION)) {
        session_start();
    }
    
    if (!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
        header("Location: login.html?error=2");
        exit;
    }
    
    return true;
}

/**
 * Verifica si el usuario tiene permisos de administrador
 */
function verificarAdmin() {
    verificarAutenticacion();
    
    if ($_SESSION['tipo_usuario'] !== 'administrador') {
        header("Location: panel.php");
        exit;
    }
    
    return true;
}

/**
 * Crea una contraseña hasheada
 */
function crearHash($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Función para crear un nuevo usuario
 */
function crearUsuario($usuario, $password, $tipo) {
    include_once("Conexion.php");
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    
    // Hash de la contraseña
    $password_hash = crearHash($password);
    
    // Insertar usuario
    $query = "INSERT INTO usuarios (usuario, password, tipo_usuario) VALUES (:usuario, :password, :tipo)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':tipo', $tipo);
    
    return $stmt->execute();
}
?>