<?php
    $nombres=$_POST["txtNombres"];
    $tel = $_POST["txtTel"];
    $correo=$_POST["txtCorreo"];
    include_once("Contacto.php");
    $contacto= new Contacto();
    $contacto->nombres=$nombres;
    $contacto->telefono=$tel;
    $contacto->correo=$correo;
    
    if($contacto->alta()>0){
        echo"Contacto Guardado";
    }else{
        echo "Error";
    }
?>