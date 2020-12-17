<?php

$errors         = array();
$data           = array();


if (empty($_POST['nombre']))
    $errors['nombre'] = 'Name is required.';

if (empty($_POST['apellidoM']))
    $errors['apellidoM'] = 'apellidoM is required.';

if (empty($_POST['apellidoP']))
    $errors['apellidoP'] = 'Superhero alias is required.';

if (! empty($errors)) {
    $data['success'] = false;
    $data['errors']  = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success!';
}

// return all our data to an AJAX call
echo json_encode($data);


