<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está autenticado
if(!isset($_SESSION['autenticado']) || $_SESSION['autenticado'] !== true) {
    header("Location: login.php?error=2");
    exit;
}

// Obtener tipo de usuario
$tipo_usuario = $_SESSION['tipo_usuario'];

// Incluir clase Contacto
include_once("Contacto.php");
$contacto = new Contacto();
$arr = $contacto->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Contactos</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .acciones {
            display: flex;
            gap: 5px;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            color: white;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
        }
        .btn-eliminar {
            background-color: #e74c3c;
        }
        .btn-editar {
            background-color: #3498db;
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
    <h2>Lista de Contactos</h2>
    
    <table>
        <tr>
            <th>ID</th>
            <th>Nombres</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <?php if($tipo_usuario == 'administrador'): ?>
            <th>Operaciones</th>
            <?php endif; ?>
        </tr>
        
        <?php if($arr != null): ?>
            <?php foreach($arr as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c->id); ?></td>
                    <td><?php echo htmlspecialchars($c->nombres); ?></td>
                    <td><?php echo htmlspecialchars($c->correo); ?></td>
                    <td><?php echo htmlspecialchars($c->telefono); ?></td>
                    
                    <?php if($tipo_usuario == 'administrador'): ?>
                    <td class="acciones">
                        <form action="eliminar.php" method="post">
                            <input type="hidden" value="<?php echo $c->id; ?>" name="id">
                            <button type="submit" class="btn btn-eliminar">Eliminar</button>
                        </form>
                        
                        <form action="Modificar_V.php" method="get">
                            <input type="hidden" value="<?php echo $c->id; ?>" name="id">
                            <button type="submit" class="btn btn-editar">Editar</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="<?php echo ($tipo_usuario == 'administrador') ? '5' : '4'; ?>" style="text-align: center;">No hay contactos registrados</td>
            </tr>
        <?php endif; ?>
    </table>
    
    <a href="panel.php" class="btn-volver">Volver al Panel</a>
</body>
</html>