<?php
    class Contacto{
        var $id;
        var $nombres;
        var $telefono;
        var $correo;

        function alta(){
            include_once("Conexion.php");
            $con= new Conexion();
            $conn=$con->conectar();
            $query="insert into contacto(nombres,telefono,correo)
                values ('$this->nombres','$this->telefono','$this->correo');";
            $stmt=$conn->prepare($query);
            return $stmt->execute();    
        }

        function listar(){
            include_once("Conexion.php");
            $con=new Conexion();
            $conn=$con->conectar();
            $query= "SELECT * from contacto";
            $stmt=$conn->prepare($query);
            $stmt->execute(); $todo=null; $i=0;
            while($data=$stmt->fetch(PDO::FETCH_ASSOC)){
                $contactos=new Contacto();
                $contactos->id=$data["id"];
                $contactos->nombres=$data["nombres"];
                $contactos->correo=$data["correo"];
                $contactos->telefono=$data["telefono"];
                $todo[$i]=$contactos;
                $i;
                $i++;
        }
        return $todo;
    }

    function eliminar(){
        include_once("Conexion.php");
        $con=new Conexion();
        $conn=$con->conectar();
        $query= "Delete from contacto where id='$this->id'";
        $stmt=$conn->prepare($query);
        return $stmt->execute();
    }

    function modificar(){
        include_once("Conexion.php");
        $con=new Conexion();
        $conn=$con->conectar();
        $querybusc="Select * from contacto WHERE id='$this->id'";
        $stmt=$conn->prepare($querybusc);
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        if($result==0){
            return false;
        }
        $query= "UPDATE contacto SET nombres='$this->nombres',telefono= '$this->telefono',correo='$this->correo' Where id='$this->id'";
        $stmt=$conn->prepare($query);
        return $stmt->execute();


    }
}

?>