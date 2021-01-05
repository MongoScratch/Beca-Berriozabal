<?php

include 'conection.php';
include '../utils/mcrypt.php';


    $username = SED::encryption($_POST["usuario"]);
    $password = SED::encryption($_POST["password"]);
    foreach($conn->query('SELECT * from Users') as $fila);
    if($fila[1] == $username && $fila[2] == $password){
        session_start();
        $_SESSION["usuario"] = $username;
        header("Location: ../");
    }else{
        header("Location: ./index.php");
    }

?>