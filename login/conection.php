<?php


$user = "hvjcommx_abel";
$password = "Keppler77862145";
try {
    $conn = new PDO('mysql:host=coacalco.gob.mx;dbname=hvjcommx_empleo_temporal', $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>