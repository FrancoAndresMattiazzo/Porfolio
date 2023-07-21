<?php include 'header.php'; ?>

<?php if($_POST){#si hay envío de datos, los inserto en la base de datos  

    $nombre = $_POST['nombre'];

    #creo una instancia(objeto) de la clase de conexión
    $conexion = new conexion();
    $sql = "INSERT INTO `tecnologias` (`nombre`) VALUES ('$nombre')";
    $id_trabajo = $conexion->ejecutar($sql);

    header("Location: tecnologias.php");
    die();

}

#si nos envían por url, GET 
if($_GET){

    #además de borrar de la base , tenemos que borrar la foto de la carpeta imágenes
    if(isset($_GET['borrar'])){
        $id = $_GET['borrar'];
        $conexion = new conexion();

        #borramos el registro de la base 
        $sql = "DELETE FROM `tecnologias` WHERE `tecnologias`.`id` = $id";
        $id_trabajo = $conexion->ejecutar($sql);

        header("Location: tecnologias.php");
        die();
    }

    if(isset($_GET['modificar'])){
        $id = $_GET['modificar'];
        header("Location: modificar_tecnologia.php?modificar=$id");
        die();
    }
} 

#vamos a consultar para llenar la tabla 
$conexion = new conexion();
$tecnologias = $conexion->consultar("SELECT * FROM `tecnologias`");
?> 

<br>
<!--ya tenemos un container en el header que cierra en el footer-->

<div class="row d-flex justify-content-center mb-5">
    <div class="col-md-10 col-sm-12">
        <div class="card bg-secondary">
            <div class="card-header">
                Datos de tecnolgia
            </div>
            <div class="card-body">
                <form action="tecnologias.php" method="post">
                    <div>
                        <label for="nombre">Nombre de la tecnologia</label>
                        <input required class="form-control" type="text" name="nombre" id="nombre">
                    </div>       
                    <br>
                    <input class="btn btn-success" type="submit" value="Agregar Tecnologia">
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
                        <th>Nombre</th>
                        <th>Eliminar</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php #leemos trabajos uno por uno
                    foreach($tecnologias as $tecnologia){ ?>
                    
                    <tr>
                        <td><?php echo $tecnologia['nombre']; ?></td>
                        <td><a name="eliminar" id="eliminar" class="btn btn-danger" href="?borrar=<?php echo $tecnologia['id']; ?>">Eliminar</a></td>
                        <td><a name="modificar" id="modificar" class="btn btn-warning" href="?modificar=<?php echo $tecnologia['id']; ?>">Modificar</a></td>
                    </tr>

                    <?php #cerramos la llave del foreach
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
   
<?php include 'footer.php'; ?>
