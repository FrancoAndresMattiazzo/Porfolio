<?php include 'header.php';

if ($_GET) {
    if (isset($_GET['modificar'])) {
        $id = $_GET['modificar'];
        $_SESSION['id_trabajo'] = $id;

        # Consulta para llenar la tabla con los datos del trabajo
        $conexion = new conexion();
        $trabajo = $conexion->consultar("SELECT * FROM `trabajos` WHERE id = $id");
        $tecnologias_seleccionadas = explode(",", $trabajo[0]['tecnologia_id']);
        $tecnologias = $conexion->consultar("SELECT * FROM tecnologias");
    }
}

if ($_POST) {
    $id = $_SESSION['id_trabajo'];

    $nombre_empresa = $_POST['nombre_empresa'];
    $puesto = $_POST['puesto'];
    $fecha_inicio_date = $_POST['fecha_inicio_date'];
    $fecha_inicio_time = $_POST['fecha_inicio_time'];
    $fecha_final_date = $_POST['fecha_final_date'];
    $fecha_final_time = $_POST['fecha_final_time'];
    $tecnologias_utilizadas = $_POST['tecnologias_utilizadas'];

    // Combinar fechas y horas
    $fecha_inicio = $fecha_inicio_date . " " . $fecha_inicio_time;
    $fecha_final = $fecha_final_date . " " . $fecha_final_time;

    if (isset($_POST['tecnologias'])) {
        $tecnologias_seleccionadas = $_POST['tecnologias'];
        $tecnologia_id = implode(",", $tecnologias_seleccionadas);
    } else {
        $tecnologia_id = "";
    }

    // Actualizar datos en la base de datos
    $conexion = new conexion();
    $sql = "UPDATE `trabajos` SET `nombre_empresa` = '$nombre_empresa', `puesto` = '$puesto', `fecha_inicio` = '$fecha_inicio', `fecha_final` = '$fecha_final', `tecnologia_id` = '$tecnologia_id' WHERE `trabajos`.`id` = $id";
    $id_trabajo = $conexion->ejecutar($sql);

    // Mostrar mensaje de confirmación
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
        window.location.href = 'trabajos.php';
      });
    </script>";
}
?>

<?php #leemos trabajos uno por uno
foreach($trabajo as $fila) { ?>
    <div class="row d-flex justify-content-center mt-4 mb-5">
        <div class="col-md-10 col-sm-12">
            <div class="card" style="background-color:#CDB3A6;">
                <div class="card-header">
                    Datos del Trabajo
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div>
                            <label for="nombre_empresa">Nombre de la Empresa</label>
                            <input required class="form-control" type="text" name="nombre_empresa" id="nombre_empresa" value="<?php echo $fila['nombre_empresa']; ?>">
                        </div>

                        <div>
                            <label for="puesto">Puesto</label>
                            <input required class="form-control" type="text" name="puesto" id="puesto" value="<?php echo $fila['puesto']; ?>">
                        </div>

                        <div>
                            <label for="fecha_inicio_date">Fecha de Inicio (Fecha)</label>
                            <input required class="form-control" type="date" name="fecha_inicio_date" id="fecha_inicio_date" value="<?php echo date('Y-m-d', strtotime($fila['fecha_inicio'])); ?>">
                        </div>

                        <div>
                            <label for="fecha_inicio_time">Fecha de Inicio (Hora)</label>
                            <input required class="form-control" type="time" name="fecha_inicio_time" id="fecha_inicio_time" value="<?php echo date('H:i', strtotime($fila['fecha_inicio'])); ?>">
                        </div>

                        <div>
                            <label for="fecha_final_date">Fecha Final (Fecha)</label>
                            <input required class="form-control" type="date" name="fecha_final_date" id="fecha_final_date" value="<?php echo date('Y-m-d', strtotime($fila['fecha_final'])); ?>">
                        </div>

                        <div>
                            <label for="fecha_final_time">Fecha Final (Hora)</label>
                            <input required class="form-control" type="time" name="fecha_final_time" id="fecha_final_time" value="<?php echo date('H:i', strtotime($fila['fecha_final'])); ?>">
                        </div>

                        <div>
                                <?php foreach ($tecnologias as $tecnologia) { ?>
                                    <label>
                                        <input type="checkbox" name="tecnologias[]" value="<?php echo $tecnologia['id']; ?>" <?php if (in_array($tecnologia['id'], $tecnologias_seleccionadas)) echo 'checked'; ?>>
                                        <?php echo $tecnologia['nombre']; ?>
                                    </label><br>
                                <?php } ?>
                            </div>

                        <br>
                        <div>
                            <input class="btn btn-warning" type="submit" value="Modificar Trabajo">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>
