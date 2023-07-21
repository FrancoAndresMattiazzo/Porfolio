<?php include 'header.php'; ?>

<?php if ($_POST) {
    $nombre = $_POST['nombre'];
    $ano = $_POST['ano'];
    $institucion = $_POST['institucion'];
    $archivo_temporal = $_FILES['certificado']['tmp_name'];
    $fecha = new DateTime();
    if ($_FILES['certificado']['error'] === UPLOAD_ERR_NO_FILE) {
        $certificado = ''; // Asigna un valor vacío
    } else {
        $certificado = $_FILES['certificado']['name'];
        $archivo_temporal = $_FILES['certificado']['tmp_name'];
        $fecha = new DateTime();
        $certificado = $fecha->getTimestamp()."_".$certificado;
        move_uploaded_file($archivo_temporal, "archivos_estudios/".$certificado);
    }

    // Insertar datos en la base de datos
    $conexion = new conexion();
    $sql = "INSERT INTO `estudios` (`nombre`, `ano`, `institucion`, `certificado`) VALUES ('$nombre', '$ano', '$institucion', '$certificado')";
    $id_estudio = $conexion->ejecutar($sql);

    header("Location: estudios.php");
    die();
}

#si nos envían por url, GET 
if($_GET){

    #además de borrar de la base , tenemos que borrar la foto de la carpeta imágenes
    if(isset($_GET['borrar'])){
        $id = $_GET['borrar'];
        $conexion = new conexion();

        #borramos el registro de la base 
        $sql = "DELETE FROM `estudios` WHERE `estudios`.`id` = $id";
        $id_estudio = $conexion->ejecutar($sql);

        header("Location: estudios.php");
        die();
    }

    if(isset($_GET['modificar'])){
        $id = $_GET['modificar'];
        header("Location: modificar_estudio.php?modificar=$id");
        die();
    }
} 

#vamos a consultar para llenar la tabla 
$conexion = new conexion();
$estudios = $conexion->consultar("SELECT * FROM `estudios`");
?> 

<br>
<!--ya tenemos un container en el header que cierra en el footer-->

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
                        <input required class="form-control" type="text" name="nombre" id="nombre">
                    </div>

                    <div>
                        <label for="ano">Año del Estudio</label>
                        <input required class="form-control" type="datetime-local" name="ano" id="ano">
                    </div>

                    <div>
                        <label for="institucion">Institución</label>
                        <input required class="form-control" type="text" name="institucion" id="institucion">
                    </div>

                    <div>
                        <label for="certificado">Certificado</label>
                        <input class="form-control" type="file" name="certificado" id="certificado">
                    </div>

                    <br>
                    <div>
                        <input class="btn btn-success" type="submit" value="Agregar Estudio">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="bg-secondary">
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-md-10 col-sm-6">
            <table class="table tabla__galeria bg-secondary">
                <thead>
                    <tr>
                        <th>Nombre del Estudio</th>
                        <th>Año</th>
                        <th>Institución</th>
                        <th>Link al Certificado</th>
                        <th>Eliminar</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #leemos estudios uno por uno
                    foreach($estudios as $estudio){ ?>
                    
                    <tr>
                        <td><?php echo $estudio['nombre']; ?></td>
                        <td><?php echo $estudio['ano']; ?></td>
                        <td><?php echo $estudio['institucion']; ?></td>
                        <td><?php echo $estudio['certificado']; ?></td>
                        <td><a name="eliminar" id="eliminar" class="btn btn-danger" href="?borrar=<?php echo $estudio['id']; ?>">Eliminar</a></td>
                        <td><a name="modificar" id="modificar" class="btn btn-warning" href="?modificar=<?php echo $estudio['id']; ?>">Modificar</a></td>
                    </tr>

                    <?php #cerramos la llave del foreach
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
   
<?php include 'footer.php'; ?>
