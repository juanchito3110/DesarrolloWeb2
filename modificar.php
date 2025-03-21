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

// Procesar la modificación
$id = $_POST["txtID"];
$nombres = $_POST["txtNombres"];
$tel = $_POST["txtTel"];
$correo = $_POST["txtCorreo"];

include("Contacto.php");
$contacto = new Contacto();
$contacto->id = $id;
$contacto->nombres = $nombres;
$contacto->telefono = $tel;
$contacto->correo = $correo;

if($contacto->modificar() == true) {
    echo "<div style='text-align:center; padding:20px; background-color:#dff0d8; color:#3c763d; margin:20px;'>
            <h3>Contacto Actualizado Correctamente</h3>
            <p><a href='panel.php'>Volver al Panel</a></p>
          </div>";
} else {
    echo "<div style='text-align:center; padding:20px; background-color:#f2dede; color:#a94442; margin:20px;'>
            <h3>Error al Actualizar Contacto</h3>
            <p>No se pudo actualizar el contacto. Puede que el ID no exista.</p>
            <p><a href='Modificar_V.php'>Intentar de nuevo</a> | <a href='panel.php'>Volver al Panel</a></p>
          </div>";
}
?>