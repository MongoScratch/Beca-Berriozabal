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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ti-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <!-- Datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.css">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- SBAdmin2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <title>Inicio | Empleo Temporal</title>
</head>
<body>
  <?php include './config/cnx.php';
  include 'navbar.php';
  $sql = 'SELECT * FROM Registros';
  $result = mysqli_query($mysqli, $sql);
  $count =0;
  
  $sql = 'SELECT COUNT(*) AS total FROM Registros';
  $numCountRow = mysqli_query($mysqli, $sql);
  $getCountRows = mysqli_fetch_object($numCountRow);
  ?>
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Listado Solcitudes Recibidas (<?php echo $getCountRows->total;  ?>)</h6>
            <a class="btn btn-sm btn-outline-primary" href="estadisticas.php">Ver Estadisticas</a>
          </div>
          <div class="card-body">
          <!-- Start Body -->
            <table id="tableEntregadas" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                    <th width="25px">ID</th>
                    <th>Nombre</th>
                    <th>Colonia</th>
                    <th>Celular</th>
                    <th width="70px">Genero</th>
                    <th width="140px">Nivel Academico</th>
                    <th width="35px"></th>
                  </tr>
              </thead>
              <tbody>
                <?php while($row = mysqli_fetch_array($result)): $count++;?>
                  <tr>
                    <td><?php echo $count; ?></td>
                    <td><?php echo $row[1] ?></td>
                    <td><?php echo $row[3] ?></td>
                    <td><?php echo $row[5] ?></td>
                    <td><?php echo $row[7] ?></td>
                    <td class="text-center"><?php echo $row[8] ?></td>
                    <td class="text-center "><a href="" data-toggle="modal" data-target="#modal<?php echo $row[0];?>" class="fas fa-eye"></a></td>
                  </tr>


                  <!-- Modal -->
                  <div class="modal fade" id="modal<?php echo $row[0];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-light text-dark">
                          <h5 class="modal-title" id="exampleModalLabel"><?php echo $row[1]; ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-sm-6">
                              <span><b>Domicilio:</b> <?php echo $row[2]; ?></span>
                            </div><br><br>
                            <div class="col-sm-6">
                              <span><b>Colonia:</b> <?php echo $row[3]; ?></span>
                            </div><br><br>
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <span><b>Teléfono Casa:</b> <?php echo $row[4]; ?></span>
                            </div><br><br>
                            <div class="col-sm-6">
                              <span><b>Celular:</b> <?php echo $row[5]; ?></span>
                            </div><br><br>
                          </div>

                          <div class="row">
                            <div class="col-sm-6">
                              <span><b>Curp:</b> <?php echo $row[6]; ?></span>
                            </div><br><br>
                            <div class="col-sm-6">
                              <span><b>Género:</b> <?php echo $row[7]; ?></span>
                            </div><br><br>
                            <div class="col-sm-6">
                              <span><b>Nivel Académico:</b> <?php echo $row[8]; ?></span>
                            </div><br><br>
                            <div class="col-sm-6">
                              <span><b>Razon De Solicitud:</b><?php echo $row[9]; ?></span>
                            </div><br><br>
                          </div>
                          <br>
                          <div class="row">
                            <h6>Documentos</h6>
                            
                            <div class="col-sm-12 d-flex justify-content-between">
                              <b>INE</b>
                              <a target="_blank" href="https://empleotemporal.coacalco.gob.mx/files/<?php echo $row[6] . '/ine' . substr($row[10], 3);?>"><img src="assets/images/icon.png" class="img-fluid" width="20px"></a>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-between">
                              <b>CURP</b>
                              <a target="_blank" href="https://empleotemporal.coacalco.gob.mx/files/<?php echo $row[6] . '/curp' . substr($row[11], 4); ?>"><img src="assets/images/icon.png" class="img-fluid" width="20px"></a>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-between">
                              <b>Comprobante de domicilio</b>
                              <a target="_blank" href="https://empleotemporal.coacalco.gob.mx/files/<?php echo $row[6] . '/comprobante_domicilio' . substr($row[12], 21); ?>"><img src="assets/images/icon.png" class="img-fluid" width="20px"></a>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-between">
                              <b>Comprobante de estudios</b>
                              <a target="_blank" href="https://empleotemporal.coacalco.gob.mx/files/<?php echo $row[6] . '/comprobante_estudios' . substr($row[13], 20);?>"><img src="assets/images/icon.png" class="img-fluid" width="20px"></a>
                            </div>
                          </div>

                          
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>


                <?php endwhile; mysqli_close($mysqli); ?>
              </tbody>
            </table>

            <!-- End Body -->
          </div>
        </div>
      </div>

    <script>
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
          event.preventDefault();
          $(this).ekkoLightbox();
        });
        $(document).ready(function() {
        var table = $('#tableEntregadas').DataTable({
          "language": {
            "lengthMenu": "Mostrando _MENU_ Registros Por Pagina",
            "zeroRecords": "Ninguna coincidencia",
            "info": "Mostrando Pagina _PAGE_ De _PAGES_",
            "infoEmpty": "No disponible",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar: ",
            "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
              "previous": "Anterior"
            },
            "loadingRecords": "Cargando...",
          }
        });
    })
    </script>
</body>
</html>