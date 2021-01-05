<?php

session_start();
if (empty($_SESSION["usuario"])) {
  header("Location: login/");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <title>Tablero | Empleo Temporal</title>
</head>
<body>
<?php  
include 'config/cnx.php';
include 'navbar.php';
$sql = 'SELECT * FROM Datos';
$result = mysqli_query($mysqli, $sql);
$count =0;

$getCountRows = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos'));
$totalPreescolar = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "preescolar"'));
$totalPrimaria = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "primaria"'));
$totalSecundaria = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "secundaria"'));
$totalBachillerato = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "bachillerato"'));
$totalLicenciatura = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "licenciatura"'));
$totalMaestria = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "maestria"'));
$totalPostgrado = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "postgrado"'));
$totalIdiomas = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "pidiomas"'));
$totalOtros = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE nivel_estudios = "Postgrado"'));


$totalHombres = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE Genero = "masculino"'));
$totalMujeres = mysqli_fetch_object(mysqli_query($mysqli, 'SELECT COUNT(*) AS total FROM Datos WHERE Genero = "femenino"'));
?>

<div class="invisible" hidden>
    <input type="text" id="totalRegisters" value="<?php echo $getCountRows->total;?>">
    <input type="text" id="primaria" value="<?php echo $totalPrimaria->total; ?>">
    <input type="text" id="secundaria" value="<?php echo $totalSecundaria->total; ?>">
    <input type="text" id="preparatoria" value="<?php echo $totalPreparatoria->total; ?>">
    <input type="text" id="universidad" value="<?php echo $totalUniversidad->total; ?>">
    <input type="text" id="postgrado" value="<?php echo $totalPostgrado->total; ?>">
    <input type="text" id="doctorado" value="<?php echo $totalDoctorado->total; ?>">
    
    
    <input type="text" id="mujeres" value="<?php echo $totalMujeres->total; ?>">
    <input type="text" id="hombres" value="<?php echo $totalHombres->total; ?>">
</div>

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Estadisticas de los solicitantes</h6>
        <a class="btn btn-sm btn-outline-primary" href="./">Ver Recibidos <li class="fas fa-table"></li></a>
      </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="col-md-6 mb-4">
                    <canvas id="doughnutChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>


    
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script>

let dataTotal = $("#totalRegisters").val();
let dataPrimaria = $("#primaria").val();
let dataSecundaria = $("#secundaria").val();
let dataPreparatoria = $("#preparatoria").val();
let dataUniversidad = $("#universidad").val();
let dataPostgrado = $("#postgrado").val();
let dataDoctorado = $("#doctorado").val();

let dataHombres = $("#hombres").val();
let dataMujeres = $("#mujeres").val();


/* Chart Est */
var ctxBar = document.getElementById('barChart').getContext('2d');
var barChart = new Chart(ctxBar, {
    type: 'horizontalBar',
    data: {
        labels: ['Primaria', 'Secundaria', 'Preparatoria', 'Universidad', 'Postgrado', 'Doctorado'],
        datasets: [{
            label: '# Postulados a un empleo temporal',
            data: [
                dataPrimaria, 
                dataSecundaria, 
                dataPreparatoria, 
                dataUniversidad, 
                dataPostgrado,
                dataDoctorado
            ],
            backgroundColor: [
                'rgba(255, 206, 86)',
                'rgba(54, 162, 235)',
                'rgba(255, 99, 132)',
                'rgba(75, 192, 192)',
                'rgba(255, 159, 64)',
                'rgba(153, 102, 255)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
			position: 'bottom',
		},
    }
});


/* Chart Gender */
var ctxDoughnut = document.getElementById('doughnutChart').getContext('2d');
var doughnutChart = new Chart(ctxDoughnut, {
    type: 'doughnut',
    data: {
        labels: ['Mujeres', 'Hombres'],
        datasets: [{
            label: '# Postulados a un empleo temporal',
            data: [
                dataHombres, 
                dataMujeres
            ],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        legend: {
			position: 'bottom',
		},
    }
});

/* Chart Colonias */

var ctxHorizontalBar = document.getElementById('horizontalBarChart').getContext('2d');
ctxHorizontalBar.height = 200;
var horizontalBarChart = new Chart(ctxHorizontalBar, {
    type: 'horizontalBar',
    data: {
        labels: ['Primaria', 'Secundaria', 'Preparatoria', 'Universidad', 'Postgrado', 'Doctorado'],
        datasets: [{
            label: '# Postulados a un empleo temporal',
            data: [
                dataPrimaria, 
                dataSecundaria, 
                dataPreparatoria, 
                dataUniversidad, 
                dataPostgrado,
                dataDoctorado
            ],
            backgroundColor: [
                'rgba(255, 206, 86)',
                'rgba(54, 162, 235)',
                'rgba(255, 99, 132)',
                'rgba(75, 192, 192)',
                'rgba(255, 159, 64)',
                'rgba(153, 102, 255)'
            ],
        }]
    },
    options: {
        legend: {
			position: 'bottom',
		},
    }
});
</script>
</body>
</html>