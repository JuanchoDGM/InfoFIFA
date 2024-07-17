<?php

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    include("conexion.php");
    $errores = array();

    $nombre = (isset($_POST['nombre']))? $_POST[ 'nombre'] : null;
    $apellido = (isset($_POST['apellido']))? $_POST[ 'apellido'] : null;
    $email = (isset($_POST['email']))? $_POST[ 'email'] : null;
    $password = (isset($_POST['password']))? $_POST[ 'password'] : null;
    $confirmarPassword = (isset($_POST['confirmarPassword']))? $_POST[ 'confirmarPassword'] : null;


    if (empty($nombre)) {
        $errores['nombre'] = "Debe ingresar un nombre";
    }
    if (empty($apellido)) {
        $errores['apellido'] = "Debe ingresar un apellido";
    }

    if (empty($email)) {
        $errores['email'] = "Debe ingresar un email";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "Debe ingresar un email valido";
    }

    if (empty($password)) {
        $errores['password'] = "La contraseña es obligatoria";
    }
    if (empty($confirmarPassword)){
        $errores['confirmarPassword'] = "Debe confirmar la contraseña";
    }
    elseif ($password != $confirmarPassword){
        $errores['confirmarPassword'] = "Las contraseñas no coinciden";
    }

    foreach ($errores as $error) {
        echo "<br>".$error."<br>";
        
    }

    if (empty($errores)) {
        try{
            $pdo = new PDO('mysql:host='.$direccionservidor.';dbname='.$baseDatos,$usuario,$contrasena);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $nuevoPassword = password_hash($password, PASSWORD_DEFAULT);

    
            $sql = "INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `password`) VALUES (NULL, :nombre, :apellido, :email, :password);";
    
            $resultado = $pdo->prepare($sql);
            $resultado->execute(array(
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':email' => $email,
                ':password' => $nuevoPassword,
            ));
            header("Location:login.html");
        }
        catch (PDOException $e) {
            echo "Error de conexión".$e->getMessage();
        }
    }
    else {
        echo "<br><a href='registro.html'>Regresar al registro</a>";
    }
    
}
?>