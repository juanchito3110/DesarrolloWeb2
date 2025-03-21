<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php?error=2");
    exit;
}

// Verificar si el usuario tiene permisos de administrador
if($_SESSION['tipo_usuario'] !== 'administrador') {
    header("Location: panel.php");
    exit;
}

// Obtener datos del contacto si se proporciona un ID
$contacto_datos = null;
if(isset($_GET['id']) && !empty($_GET['id'])) {
    include_once("Contacto.php");
    $contacto = new Contacto();
    $contacto->id = $_GET['id'];
    
    // Aquí necesitaríamos una función para obtener un contacto por ID
    // Como no existe en el código original, tendríamos que agregarla a la clase Contacto
    // Por ahora, dejamos los campos vacíos
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        h2 {
            color: #333;
        }
        form {
            max-width: 500px;
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-volver {
            background-color: #333;
            color: white;
            padding: 8px 15px;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h2>Modificar Contacto</h2>
    
    <form action="modificar.php" method="post">
        <div class="form-group">
            <label for="txtID">ID:</label>
            <input type="number" id="txtID" name="txtID" required 
                   value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
        </div>
        
        <div class="form-group">
            <label for="txtNombres">Nombres:</label>
            <input type="text" id="txtNombres" name="txtNombres" required>
        </div>
        
        <div class="form-group">
            <label for="txtTel">Teléfono:</label>
            <input type="text" id="txtTel" name="txtTel" required>
        </div>
        
        <div class="form-group">
            <label for="txtCorreo">Correo:</label>
            <input type="email" id="txtCorreo" name="txtCorreo" required>
        </div>
        
        <input type="submit" value="Modificar">
    </form>
    
    <a href="panel.php" class="btn-volver">Volver al Panel</a>
</body>
</html>