<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión
include_once("Conexion.php");

// Verificar si se enviaron datos de login
if(isset($_POST['usuario']) && isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $recordar = isset($_POST['recordar']) ? true : false;
    
    // Conectar a la base de datos
    $conexion = new Conexion();
    $conn = $conexion->conectar();
    
    // Consultar usuario
    $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    
    if($usuario_data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Verificar contraseña
        if($password == $usuario_data['password']) {
            // Login exitoso, guardar datos en sesión
            $_SESSION['usuario_id'] = $usuario_data['id'];
            $_SESSION['usuario_nombre'] = $usuario_data['usuario'];
            $_SESSION['tipo_usuario'] = $usuario_data['tipo_usuario'];
            $_SESSION['autenticado'] = true;
            
            // Actualizar último acceso
            $query_update = "UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :id";
            $stmt_update = $conn->prepare($query_update);
            $stmt_update->bindParam(':id', $usuario_data['id']);
            $stmt_update->execute();
            
            // Si seleccionó "recordar usuario", crear cookie
            if($recordar) {
                // Cookie expira en 30 días
                setcookie('usuario_recordado', $usuario, time() + (86400 * 30), '/');
            }
            
            // Redireccionar al panel principal
            header("Location: panel.php");
            exit;
        } else {
            // Contraseña incorrecta
            header("Location: login.html?error=1");
            exit;
        }
    } else {
        // Usuario no encontrado
        header("Location: login.html?error=1");
        exit;
    }
} else {
    // No se enviaron datos
    header("Location: login.hmtl");
    exit;
}
?>