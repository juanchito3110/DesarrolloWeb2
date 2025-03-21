<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.html?error=2");
    exit;
}

// Obtener datos del usuario
$usuario = $_SESSION['usuario_nombre'];
$tipo_usuario = $_SESSION['tipo_usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Sistema de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #333;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .usuario-info {
            display: flex;
            align-items: center;
        }
        .tipo-usuario {
            background-color: <?php echo $tipo_usuario == 'administrador' ? '#e74c3c' : '#3498db'; ?>;
            padding: 5px 10px;
            border-radius: 3px;
            margin-left: 10px;
            font-size: 12px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin: 0;
        }
        .menu {
            margin-top: 20px;
        }
        .menu-opciones {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .opcion {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .opcion h3 {
            margin-top: 0;
        }
        .opcion a {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }
        .opcion a:hover {
            background-color: #2980b9;
        }
        .logout {
            color: white;
            text-decoration: none;
        }
        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Gestión de Contactos</h1>
        <div class="usuario-info">
            <span>Bienvenido, <?php echo htmlspecialchars($usuario); ?></span>
            <span class="tipo-usuario"><?php echo ucfirst($tipo_usuario); ?></span>
            <span style="margin-left: 20px;"><a href="logout.php" class="logout">Cerrar Sesión</a></span>
        </div>
    </div>
    
    <div class="container">
        <h2>Panel de Control</h2>
        
        <div class="menu-opciones">
            <div class="opcion">
                <h3>Lista de Contactos</h3>
                <p>Ver todos los contactos registrados en el sistema.</p>
                <a href="lista-contacto.php">Ver Contactos</a>
            </div>
            
            <div class="opcion">
                <h3>Agregar Contacto</h3>
                <p>Registrar un nuevo contacto en el sistema.</p>
                <a href="alto.html">Agregar</a>
            </div>
            
            <?php if($tipo_usuario == 'administrador'): ?>
            <div class="opcion">
                <h3>Modificar Contacto</h3>
                <p>Actualizar información de contactos existentes.</p>
                <a href="Modificar_V.php">Modificar</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>