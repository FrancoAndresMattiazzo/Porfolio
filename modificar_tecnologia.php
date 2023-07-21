<?php include 'header.php';

if ($_GET) {
    if (isset($_GET['modificar'])) {
        $id = $_GET['modificar'];
        $_SESSION['id_trabajo'] = $id;

        # Consulta para llenar la tabla con los datos del trabajo
        $conexion = new conexion();
        $tecnologia = $conexion->consultar("SELECT * FROM `tecnologias` WHERE id = $id");
    }
}

if ($_POST) {
    $id = $_SESSION['id_tecnologia'];

    $nombre = $_POST['nombre'];

    // Actualizar datos en la base de datos
    $conexion = new conexion();
    $sql = "UPDATE `tecnologias` SET `nombre` = '$nombre' WHERE `tecnologias`.`id` = $id";
    $id_tecnologia = $conexion->ejecutar($sql);

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
        window.location.href = 'tecnologias.php';
      });
    </script>";
}
?>

<?php #leemos trabajos uno por uno
foreach($tecnologia as $fila) { ?>
    <div class="row d-flex justify-content-center mt-4 mb-5">
        <div class="col-md-10 col-sm-12">
            <div class="card" style="background-color:#CDB3A6;">
                <div class="card-header">
                    Datos del Trabajo
                </div>
                <div class="card-body">
                    <form action="#" method="post">
                        <div>
                            <label for="nombre">Nombre de la tecnololgia</label>
                            <input required class="form-control" type="text" name="nombre" id="nombre" value="<?php echo $fila['nombre']; ?>">
                        </div>
                        <br>
                        <div>
                            <input class="btn btn-warning" type="submit" value="Modificar Tecnologia">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php include 'footer.php'; ?>