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

// Procesar la eliminación
include_once("Contacto.php");
$contacto = new Contacto();
$contacto->id = $_POST["id"];

if($contacto->eliminar() > 0) {
    echo "<div style='text-align:center; padding:20px; background-color:#dff0d8; color:#3c763d; margin:20px;'>
            <h3>Contacto Eliminado Correctamente</h3>
            <p><a href='lista-contacto.php'>Volver a la Lista</a></p>
          </div>";
} else {
    echo "<div style='text-align:center; padding:20px; background-color:#f2dede; color:#a94442; margin:20px;'>
            <h3>Error al Eliminar Contacto</h3>
            <p><a href='lista-contacto.php'>Volver a la Lista</a></p>
          </div>";
}
?>