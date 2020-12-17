<?php

$errors         = array();
$data           = array();


if (empty($_POST['nombre']))
    $errors['nombre'] = 'Name is required.';

if (empty($_POST['apellidoM']))
    $errors['apellidoM'] = 'apellidoM is required.';

if (empty($_POST['apellidoP']))
    $errors['apellidoP'] = 'ApellidoP is required.';

if (empty($_POST['nacimiento']))
    $errors['nacimiento'] = 'Nacimiento is required.';
    
if (empty($_POST['email']))
    $errors['email'] = 'Email is required.';

if (empty($_POST['direccion']))
    $errors['direccion'] = 'direccion is required.';

if (empty($_POST['tel_casa']))
    $errors['tel_casa'] = 'tel_casa is required.';

if (empty($_POST['tel_movil']))
    $errors['tel_movil'] = 'tel_movil is required.';
    

    
if (! empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
}

// return all our data to an AJAX call
echo json_encode($data);


