<?php
$visible="";
if(isset($_GET['msg']) && !empty($_GET['msg'])){
    switch($_GET['msg']){
        case 1:
            $type = "warning";
            $msg = "El email ya esta registrado. Usa otro para realizar el registro.";
        break;
        case 2:
            $type = "success";
            $msg = "Los datos se enviaron correctamente";
        break;
        case 3:
            $type = "danger";
            $msg = "Hubo un error en la captura de datos, verifica haber ingresado todos los datos de forma correcta.";
        break;
        default:
            $visible = "hidden";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>


    <title>Dashboard | Becas Berriozabal</title>
</head>
<body>
<form method="POST"  class="container" action="action.php">
    <div class="row">
        <div class="col-sm-4 form-group mb-4">
            <label for="label1">Nombre: </label>
            <input class="form-control form-control-sm" type="text" id="label1" name="nombre" placeholder="Nombre completo" required>
        </div>
        <div class="col-sm-4 form-group mb-4">
            <label for="label3">Apellido Materno: </label>
            <input class="form-control form-control-sm" type="text" id="label3" name="apellidoP" placeholder="Nombre Materno" required>
        </div>
        <div class="col-sm-4 form-group mb-4">
            <label for="label2">Apellido Paterno: </label>
            <input class="form-control form-control-sm" type="text" id="label2" name="apellidoM" placeholder="Apellido Paterno" required>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 form-group mb-4">
            <label for="label4">Fecha De Nacimiento</label>
            <input type="date" class="form-control form-control-sm" id="label4" name="nacimiento" required>
        </div>
        <div class="col-sm-8 form-group mb-4">
            <label for="label5">Correo Electronico</label>
            <input type="email" class="form-control form-control-sm" id="label5" name="email" placeholder="user@example.com">
        </div>
        <div class="col-sm-12 form-group mb-4">
            <label for="label6">Domicilio</label>
            <input type="text" class="form-control form-control-sm" id="label6" name="direccion" placeholder="Calle - Nº Exterior / Nº Interior">
        </div>
        </div>
    <div class="row">
        <div class="col-sm-6 form-group mb-4">
            <label for="label7">Teléfono de casa</label>
            <input type="tel" class="form-control form-control-sm" id="label7" name="tel_casa">
        </div>
        <div class="col-sm-6 form-group mb-4">
            <label for="label8">Número de celular</label>
            <input type="tel" class="form-control form-control-sm" id="label8" name="tel_movil" placeholder="Numero a 10 digitos">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 form-group mb-4">
        <label for="provincia">Nivel de estudios</label>
            <select class="form-control form-control-sm" name="provincia" id="provincia" onchange="cargarPueblos();">
                <option value="">Nivel de estudios...</option>
            </select>            
        </div>
        <div class="col-sm-6 form-group mb-4">
        <label for="pueblo">Beca</label>
            <select class="form-control form-control-sm" name="pueblo" id="pueblo">
                <option value="">Seleccione una opción...</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="text-center mb-4"><input type="checkbox" required> Acepto el <a href="https://coacalco.gob.mx/aviso-de-privacidad">aviso de privacidad</a></div>
        <div class="text-center mb-4">
            <input type="submit" class="btn btn-primary">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php if(isset($_GET['msg']) && !empty($_GET['msg']) ): ?>
                <div class="alert alert-<?php echo $type; ?> alert-dismissible fade show" role="alert" <?php echo $visible; ?>>
                    <?php echo $msg; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</form>



<script>

function cargarProvincias() {
    var array = ['Preescolar', 'Primaria', 'Secundaria', 'Bachillerato', 'Licenciatura', 'Maestria', 'Postgrado', 'Idiomas', 'Otros'];
    //array.sort();
    addOptions("provincia", array);
}


//Función para agregar opciones a un <select>.
function addOptions(domElement, array) {
    var selector = document.getElementsByName(domElement)[0];
    for (provincia in array) {
        var opcion = document.createElement("option");
        opcion.text = array[provincia];
        // Añadimos un value a los option para hacer mas facil escoger los pueblos
        opcion.value = array[provincia].toLowerCase()
        selector.add(opcion);
    }
}



function cargarPueblos() {
    // Objeto de provincias con pueblos
    var listaPueblos = {
      preescolar: ["Corporativo Universitario México", "Comunidad Hispanoamericano", "Colegio Berriozábal", "Hanzel y Gretel", "Colegio villa de las Flores", "Colegio Benito Juárez", "Záma", "Nobel", "FADU", "Federico Froebel", "Colegio Indonesia", "Grupo Universitario Modelo", "Arcos Tepeyac"],
      primaria: ["Salta", "Comunidad Hispanoamericano", "Corporativo Universitario México", "Colegio Berriozábal", "Colegio Villa de las Flores", "Colegio Benito Juárez", "Záma", "Nobel", "FADU", "Colegio del Bosque", "Colegio Cumbres", "colegio Sor Juana Ines de la Cruz", "Colegio Indonesia", "Grupo Universitario Modelo", "Arcos Tepeyac"],
      secundaria: ["Universidad Lucerna", "Corporativo Universitario México", "Comunidad Hispanoamericano", "Universidad Europea", "Colegio Villa de las Flores", "CETI", "CIBERNET",  "FADU", "Záma", "Nobel", "Colegio Indonesia", "Grupo Universitario Modelo"],
      bachillerato: ["Universidad ICEL", "ETAC", "Corporativo Universitario México", "Centro de Estudios Moises Saenz", "Escuela de Tultitlán", "Universidad Ecatepec", "Universidad Lucerna", "Comunidad Hispanoamericano", "Universidad del Valle de Anáhuac", "Universidad Europea", "Latinoamericano Siglo XXI", "CEDCO", "Universidad CNCI", "Nobel", "IMEI", "ZAMA", "Colegio Cervantes Saavedra", "Universidad Tres Culturas", "Grupo Universidad Modelo", "Valladolid", "Epoca", "Centro de Educación Olista", "CITA", "CEUNI", "LYCEU", "UNIVERSO NET", "CIBERNET", "FADU"],
      licenciatura: ["Universidad ICEL", "UNITEC", "ETAC", "CLAUSTRO MEXICANO", "Corporativo Universitario México", "Escuela de Tultitlán", "Universidad Ecatepec", "Universidad Lucerna", "Universidad del Valle de Anáhuac", "Universidad europea", "Universidad CNCI", "Universidad de las Ciencias Penales", "Vayadolid", "Grupo Universitario Modelo", "IMEI", "Universidad Tres Culturas", "Instituto Mexicano de Educación Integral", "Epoca", "CITA", "CUNI", "Universo NET", "Cibernet", "FADU", "CEDCO"],
      maestria: ["Universidad Ecatepec", "UNITEC", "ETAC", "Universidad Lucerna", "Universidad Europea", "Universidad CNDI", "Corporativo Universitario México", "Universidad de Ciencias Penales", "CUNI"],
      postgrado: ["Universidad Ecatepec", "Claustro Mexicano", "Universidad de las Ciencias Panales", "Corporativo Universitario México"],
      idiomas: ["Harmon Hall", "Alianza Francesa", "Crambriedge Lexicon School", "LYCEUM", "Red Innovacion y Aprendizaje (computacion, empleabilidad, roboticas y emprendimiento)"],
      otros: ["Escuela Tecnica de Belleza", "CEDVA Coacalco Grastonomia-Estilismo", "LYCEUM-Capacitacion para el trabajo", "Universo NET-Cursos IES, EXACER-COLBACHy curso COMIPENS","CETI-Especialidad tecnica en contabilidad, administracion, puericultura e informatica","CONAMAT Cursos de Ingreso"]
    
    }
    
    var provincias = document.getElementById('provincia')
    var pueblos = document.getElementById('pueblo')
    var provinciaSeleccionada = provincias.value
    
    // Se limpian los pueblos
    pueblos.innerHTML = '<option value="">Seleccione una opción...</option>'
    
    if(provinciaSeleccionada !== ''){
      // Se seleccionan los pueblos y se ordenan
      provinciaSeleccionada = listaPueblos[provinciaSeleccionada]
      provinciaSeleccionada.sort()
    
      // Insertamos los pueblos
      provinciaSeleccionada.forEach(function(pueblo){
        let opcion = document.createElement('option')
        opcion.value = pueblo
        opcion.text = pueblo
        pueblos.add(opcion)
      });
    }
    
  }
  
 // Iniciar la carga de provincias solo para comprobar que funciona
cargarProvincias();

$(function() {
  $('body').find('input[type=submit]').each(function () {
        $(this).attr('disabled', 'disabled');
    });
});


</script>
</body>
</html>