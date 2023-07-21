<?php include 'header.php';

if ($_GET) {
    if (isset($_GET['modificar'])) {
        $id = $_GET['modificar'];
        $_SESSION['id_estudio'] = $id;

        // Consulta para llenar la tabla con los datos del estudio
        $conexion = new conexion();
        $estudio = $conexion->consultar("SELECT * FROM `estudios` WHERE id = $id");
    }
}

if ($_POST) {
    $id = $_SESSION['id_estudio'];

    $nombre = $_POST['nombre'];
    $ano = $_POST['ano'];
    $institucion = $_POST['institucion'];
    $certificado = $_FILES['archivo']['name'];
    $archivo_temporal = $_FILES['archivo']['tmp_name'];
    $fecha = new DateTime();
    $certificado = $fecha->getTimestamp()."_".$certificado;
    move_uploaded_file($archivo_temporal, "archivos_estudios/".$certificado);

    // Verificar si se ha seleccionado un nuevo archivo
    if (!empty($archivo_temporal)) {
        // Eliminar archivo actual
        $conexion = new conexion();
        $estudio_actual = $conexion->consultar("SELECT certificado FROM `estudios` WHERE id = $id");
        $archivo_actual = $estudio_actual[0]['certificado'];
        unlink($archivo_actual);

        // Mover nuevo archivo al servidor
        $carpeta_destino = 'archivos_estudios/';
        $ruta_archivo = $carpeta_destino . $certificado;
        move_uploaded_file($archivo_temporal, $ruta_archivo);
    } else {
        // Mantener el archivo actual
        $conexion = new conexion();
        $estudio_actual = $conexion->consultar("SELECT certificado FROM `estudios` WHERE id = $id");
        $ruta_archivo = $estudio_actual[0]['certificado'];
    }

    // Actualizar datos en la base de datos
    $conexion = new conexion();
    $sql = "UPDATE `estudios` SET `nombre` = '$nombre', `ano` = '$ano', `institucion` = '$institucion', `certificado` = '$ruta_archivo' WHERE `estudios`.`id` = $id";
    $id_estudio = $conexion->ejecutar($sql);

    // Mostrar SweetAlert y redirigir a estudios.php
    echo "
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
    <script>
      swal({
        title: '¡Cambios guardados!',
        text: 'Los cambios se han guardado correctamente.',
        icon: 'success',
        buttons: {
          confirm: {
            text: 'OK',
            value: true,
            visible: true,
            className: 'btn btn-success',
            closeModal: true
          }
        }
      }).then(function() {
        window.location.href = 'estudios.php';
      });
    </script>";
}
?>

<?php // Leer estudios uno por uno
foreach ($estudio as $fila) { ?>
    <div class="row d-flex justify-content-center mt-4 mb-5">
        <div class="col-md-10 col-sm-12">
            <div class="card" style="background-color:#CDB3A6;">
                <div class="card-header">
                    Datos del Estudio
                </div>
                <div class="card-body">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div>
                            <label for="nombre">Nombre del Estudio</label>
                            <input required class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $fila['nombre']; ?>">
                        </div>

                        <div>
                            <label for="ano">Año del Estudio</label>
                            <input required class="form-control" type="datetime-local" name="ano" id="ano" value="<?php echo $fila['ano']; ?>">
                        </div>

                        <div>
                            <label for="institucion">Institución</label>
                            <input required class="form-control" type="text" name="institucion" id="institucion" value="<?php echo $fila['institucion']; ?>">
                        </div>

                        <div>
                            <label for="archivo">Archivo</label>
                            <input class="form-control" type="file" name="archivo" id="archivo">
                        </div>

                        <br>
                        <div>
                            <input class="btn btn-warning" type="submit" value="Modificar Estudio">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>
