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
        function calculaedad($fechanacimiento){
            list($ano,$mes,$dia) = explode("-",$fechanacimiento);
            $ano_diferencia  = date("Y") - $ano;
            $mes_diferencia = date("m") - $mes;
            $dia_diferencia   = date("d") - $dia;
            if ($dia_diferencia < 0 || $mes_diferencia < 0)
              $ano_diferencia--;
            return $ano_diferencia;
        }

          
        require './tfpdf/tfpdf.php';
        
        $pdf=new tFPDF();
        $nombre = $nombre . " " . $apellidoP. " " . $apellidoM;
        $title=$nombre;
        //Primera página
        $pdf->AddPage();
        $pdf->Image('image.jpg','0','0','210','297','JPG'); 

        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->SetFont('DejaVu','',11);

        $pdf->SetFont('Arial', '', 15);
        $pdf->setTextColor(0, 0, 0);
        $pdf->SetXY(48.5, 128.13);
        $pdf->Cell(0, 0, $nombre);
        $pdf->SetXY(-57, 128.13);
        $pdf->Cell(0, 0, calculaedad($nacimiento));
        $pdf->SetXY(42, -155);
        $pdf->Cell(0, 0, $email);

        $pdf->SetXY(53, 156);
        $pdf->Cell(0, 0, $direccion);
        $pdf->SetXY(70, 199);
        $pdf->Cell(0, 0, $tel_movil);
        $pdf->SetXY(155, 199);
        $pdf->Cell(0, 0, $tel_casa);
        $pdf->SetXY(75, -85);
        $pdf->Cell(0, 0, $nivel_estudios);

        $pdf->SetXY(75, -62.5);
        $pdf->Cell(0, 0, $beca);
        $file = 'docs/' . $nombre .'.pdf';

        $pdf->Output($file, 'F');

        if(file_exists($file)){ 
            $to = $email; 
            require 'content.php';

            $mensaje = "Tu Pre-Regristo se envió con éxito.Encuentra los detalles de tu solicitud en la Constancia adjunta que te hemos enviado.";

            $from = 'bienestarsocial@coacalco.gob.mx'; 
            $fromName = 'Bienestar Social';
            $subject = 'Beca Felipe Berriozábal';  
            $headers = "De: $fromName"." <".$from.">"; 
                
            $semi_rand = md5(time());  
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
                
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
                
            $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n"."Content-Transfer-Encodig:7bit\n\n".$htmlContent."\n\n";

            $message .= "--{$mime_boundary}\n"; 
            $fp =    @fopen($file,"rb"); 
            $data =  @fread($fp,filesize($file)); 
        
            @fclose($fp); 
            $data = chunk_split(base64_encode($data)); 
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
            "Content-Description: ".basename($file)."\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
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
}

header("location: ./?msg=$msg")

?>


