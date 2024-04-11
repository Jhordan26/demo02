<!doctype html>
<html lang="es">
  <head>
    <title>Pagina Principal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      h1 {
        font-weight: bold;
      }
      .card-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
      }

      .card {
        box-shadow: 0px 3px 15px rgba(0, 0, 0, 0.2);
      }
    </style>

  </head>

  <body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom box-shadow">
      <h5 class="my-0 mr-md-auto font-weight-normal ml-3"><img src="index2.png" style="width: 30px; position: absolute;"> <span style="position: relative; left: 35px;">Index</span></h5>
      <nav class="my-2 my-md-0 mr-md-3 navbar">
        <a class="p-2 text-dark" href="#">Registrar</a>
        <a class="p-2 text-dark" href="#">Actualizar</a>
        <a class="p-2 text-dark mr-3" href="#">Eliminar</a>
      </nav>
    </div>

    <div class="container px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4 text-info">Registrando datos with Railway</h1>
      <p class="lead">PostgreSQL + PHP</p>
    </div>

    <div class="container">
      <div class="card">
        <div class="card-body">
          <form autocomplete="off" action="index-post.php" method="post" id="registrationForm">
            <div class="row">
              <div class="col-sm-4 col-4">
                <div class="form-group">
                  <label>Nro Documento</label>
                  <input type="text" name="doc" maxlength="8" class="form-control" required>
                </div>
              </div>
              <div class="col-sm-4 col-4">
                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" name="nom" class="form-control">
                </div>
              </div>
              <div class="col-sm-4 col-4">
                <div class="form-group">
                  <label>Apellidos</label>
                  <input type="text" name="ape" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 col-4">
                <div class="form-group">
                  <label>Direccion</label>
                  <input type="text" name="dir" class="form-control">
                </div>
              </div>
              <div class="col-sm-4 col-4">
                <div class="form-group">
                  <label>Celular</label>
                  <input type="text" name="cel" class="form-control">
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-info float-right" value="Registrar">
          </form>
        </div>
      </div>

      <!-- Modal de confirmación -->
      <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="confirmationModalLabel">Registro Exitoso</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              El usuario ha sido registrado con éxito.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Tabla para mostrar los datos de las personas -->
      <div class="card mt-5">
        <div class="card-body">
          <h2 class="card-title text-center mb-4 text-info">Lista de Personas Registradas</h2>
          <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead class="table-info">
                <tr>
                  <th>Nro Documento</th>
                  <th>Nombre</th>
                  <th>Apellidos</th>
                  <th>Dirección</th>
                  <th>Celular</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include("conexion.php");
                $con = conexion();
                $sql = "SELECT * FROM persona";

                // Ejecutar la consulta
                $resultado = pg_query($con, $sql);
                if ($resultado) {
                  // Recorrer los resultados y mostrar cada fila en la tabla
                  while ($fila = pg_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $fila['documento'] . "</td>";
                    echo "<td>" . $fila['nombre'] . "</td>";
                    echo "<td>" . $fila['apellido'] . "</td>";
                    echo "<td>" . $fila['direccion'] . "</td>";
                    echo "<td>" . $fila['celular'] . "</td>";
                    echo "</tr>";
                  }
                } else {
                  echo "<tr><td colspan='5'>Error al ejecutar la consulta SQL: " . pg_last_error($con) . "</td></tr>";
                }

                // Cerrar la conexión
                pg_close($con);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <footer class="pt-4 text-center">
      <div class="row">
        <div class="col-12 col-md">
          <img class="mb-2" src="https://www.svgrepo.com/show/508391/uncle.svg" alt="" width="24" height="24">
          <small class="d-block mb-3 text-muted">&copy; 2023-1</small>
        </div>
      </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function() {
        $('#registrationForm').submit(function(e) {
          // Verifica si los campos requeridos están vacíos
          var requiredFields = $('input[required]');
          var isValid = true;
          
          requiredFields.each(function() {
            if ($(this).val().trim() === '') {
              isValid = false;
              $(this).addClass('is-invalid'); 
            } else {
              $(this).removeClass('is-invalid'); 
            }
          });
          
         
          if (!isValid) {
            e.preventDefault();
            return false;
          } else {
            // Muestra el modal de confirmación si todo está correcto
            $('#confirmationModal').modal('show');
          }
        });
      });
    </script>

  </body>
</html>