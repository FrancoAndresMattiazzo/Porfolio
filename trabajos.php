<?php include 'header.php'; ?>

<?php if($_POST){#si hay envío de datos, los inserto en la base de datos  

    $nombre_empresa = $_POST['nombre_empresa'];
    $puesto = $_POST['puesto'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_final = $_POST['fecha_final'];

    if (isset($_POST['tecnologias'])) {
        $tecnologias_seleccionadas = $_POST['tecnologias'];
        $tecnologia_id = implode(",", $tecnologias_seleccionadas);
    } else {
        $tecnologia_id = "";
    }

    #creo una instancia(objeto) de la clase de conexión
    $conexion = new conexion();
    $sql = "INSERT INTO `trabajos` (`nombre_empresa`, `puesto`, `fecha_inicio`, `fecha_final`, `tecnologia_id`) VALUES ('$nombre_empresa', '$puesto', '$fecha_inicio', '$fecha_final', '$tecnologia_id')";
    $id_trabajo = $conexion->ejecutar($sql);

    header("Location: trabajos.php");
    die();

}

#si nos envían por url, GET 
if($_GET){

    #además de borrar de la base , tenemos que borrar la foto de la carpeta imágenes
    if(isset($_GET['borrar'])){
        $id = $_GET['borrar'];
        $conexion = new conexion();

        #borramos el registro de la base 
        $sql = "DELETE FROM `trabajos` WHERE `trabajos`.`id` = $id";
        $id_trabajo = $conexion->ejecutar($sql);

        header("Location: trabajos.php");
        die();
    }

    if(isset($_GET['modificar'])){
        $id = $_GET['modificar'];
        header("Location: modificar_trabajo.php?modificar=$id");
        die();
    }
} 

#vamos a consultar para llenar la tabla 
$conexion = new conexion();
$trabajos = $conexion->consultar("SELECT * FROM `trabajos`");
$tecnologias = $conexion->consultar("SELECT * FROM tecnologias");
?> 

<br>
<!--ya tenemos un container en el header que cierra en el footer-->

<div class="row d-flex justify-content-center mb-5">
    <div class="col-md-10 col-sm-12">
        <div class="card bg-secondary">
            <div class="card-header">
                Datos del Trabajo
            </div>
            <div class="card-body">
                <form action="trabajos.php" method="post">
                    <div>
                        <label for="nombre_empresa">Nombre de la Empresa</label>
                        <input required class="form-control" type="text" name="nombre_empresa" id="nombre_empresa">
                    </div>
                    
                    <div>
                        <label for="puesto">Puesto</label>
                        <input required class="form-control" type="text" name="puesto" id="puesto">
                    </div>
                    
                    <div>
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input required class="form-control" type="datetime-local" name="fecha_inicio" id="fecha_inicio">
                    </div>
                    
                    <div>
                        <label for="fecha_final">Fecha Final</label>
                        <input required class="form-control" type="datetime-local" name="fecha_final" id="fecha_final">
                    </div>
                    
                    <div>
                        <br>
                        <label for="tecnologias_utilizadas">Tecnologías Utilizadas</label><br>
                        <?php foreach ($tecnologias as $tecnologia) { ?>
                            <label>
                                <input type="checkbox" name="tecnologias[]" value="<?php echo $tecnologia['id']; ?>"><?php echo $tecnologia['nombre']; ?>
                            </label><br>
                        <?php } ?>
                    </div>
                    
                    <br>
                    <input class="btn btn-success" type="submit" value="Agregar Trabajo">
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
                        <th>Nombre de la Empresa</th>
                        <th>Puesto</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha Final</th>
                        <th>Eliminar</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #leemos trabajos uno por uno
                    foreach($trabajos as $trabajo){ ?>
                    
                    <tr>
                        <td><?php echo $trabajo['nombre_empresa']; ?></td>
                        <td><?php echo $trabajo['puesto']; ?></td>
                        <td><?php echo $trabajo['fecha_inicio']; ?></td>
                        <td><?php echo $trabajo['fecha_final']; ?></td>
                        <td><a name="eliminar" id="eliminar" class="btn btn-danger" href="?borrar=<?php echo $trabajo['id']; ?>">Eliminar</a></td>
                        <td><a name="modificar" id="modificar" class="btn btn-warning" href="?modificar=<?php echo $trabajo['id']; ?>">Modificar</a></td>
                    </tr>

                    <?php #cerramos la llave del foreach
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
   
<?php include 'footer.php'; ?>
