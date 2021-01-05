<?php
require '../configs/connection.php';
require 'content.php';

$nombre = strip_tags(trim($_POST['nombre']));
$apellidoP = strip_tags(trim($_POST['apellidoP']));
$apellidoM = strip_tags(trim($_POST['apellidoM']));
$nacimiento = strip_tags($_POST['nacimiento']);
$email = strip_tags(trim($_POST['email']));
$direccion = strip_tags(trim($_POST['direccion']));
$tel_casa = strip_tags(trim($_POST['tel_casa']));
$tel_movil = strip_tags(trim($_POST['tel_movil']));

$nivel_estudios = strip_tags(trim($_POST['provincia']));
$beca = strip_tags(trim($_POST['pueblo']));


$result = mysqli_query($mysqli, "SELECT COUNT(*) AS count FROM Datos WHERE email = '$email'"); 
$row = mysqli_fetch_assoc($result); 
$count = $row['count'];

if($count>0){
    $msg = 1;
}else{
    $sql = "INSERT INTO Datos (nombre, apellido_p, apellido_m, nacimiento, email, direccion, tel_casa, tel_movil, nivel_estudios, beca_solicitada) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$nacimiento', '$email', '$direccion', '$tel_casa', '$tel_movil', '$nivel_estudios', '$beca')";
    if(mysqli_query($mysqli, $sql)){
        $to = "cuentamega2451@gmail.com"; 
        $from = 'bienestarsocial@coacalco.gob.mx'; 
        $fromName = "Bienestar Social";
        $subject = 'Notificación de Coacalco';  
        $headers = "De: $fromName"." <".$from.">"; 
        $semi_rand = md5(time());  
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
        $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
        "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  

        $message .= "--{$mime_boundary}--"; 
        $returnpath = "-f" . $from; 
        //Envvio de email
        if(@mail($to, $subject, $message, $headers, $returnpath)){
            $msg = 2;
        }else{
            $msg = 3;
        }
    }
}

header("location: ./?msg=$msg")

?>


