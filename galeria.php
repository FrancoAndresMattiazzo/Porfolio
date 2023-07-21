<?php include 'header.php'; ?>

<?php
if ($_POST) {
    $nombre_proyecto = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $url = $_POST['url'];
    $github = $_POST['github'];
    $imagen = $_FILES['archivo']['name'];
    $imagen_temporal = $_FILES['archivo']['tmp_name'];
    $fecha = new DateTime();
    $imagen = $fecha->getTimestamp() . "_" . $imagen;
    move_uploaded_file($imagen_temporal, "imagenes/" . $imagen);

    if (isset($_POST['tecnologias'])) {
        $tecnologias_seleccionadas = $_POST['tecnologias'];
        $tecnologia_id = implode(",", $tecnologias_seleccionadas);
    } else {
        $tecnologia_id = "";
    }

    $conexion = new conexion();
    $sql = "INSERT INTO `proyectos` (`id`, `nombre`, `imagen`, `descripcion`, `Github`, `url`,  `tecnologia_id`) VALUES (NULL, '$nombre_proyecto', '$imagen', '$descripcion', '$github', '$url', '$tecnologia_id')";
    $id_proyecto = $conexion->ejecutar($sql);

    header("Location: galeria.php");
    die();
}

if ($_GET) {

    #ademas de borrar de la base , tenemos que borrar la foto de la carpeta imagenes
    if(isset($_GET['borrar'])){
        $id = $_GET['borrar'];
        $conexion = new conexion();

        #recuperamos la imagen de la base antes de borrar 
        $imagen = $conexion->consultar("select imagen FROM  `proyectos` where id=".$id);
        #la borramos de la carpeta 
        unlink("imagenes/".$imagen[0]['imagen']);

        #borramos el registro de la base 
        $sql ="DELETE FROM `proyectos` WHERE `proyectos`.`id` =".$id; 
        $id_proyecto = $conexion->ejecutar($sql);
        #para que no intente borrar muchas veces
        header("Location:galeria.php");
        die();
    }

    if(isset($_GET['modificar'])){
        $id = $_GET['modificar'];
        header("Location:modificar.php?modificar=".$id);
        die();
    }
} 

#vamos a consultar para llenar la tabla 
$conexion = new conexion();
$proyectos = $conexion->consultar("SELECT * FROM `proyectos`");
$tecnologias = $conexion->consultar("SELECT * FROM tecnologias");
?> 

<br>
<!--ya tenemos un container en el header que cierra en el footer-->

<div class="row d-flex justify-content-center mb-5">
    <div class="col-md-10 col-sm-12">
        <div class="card bg-secondary">
            <div class="card-header">
                Datos del Proyecto
            </div>
            <div class="card-body">
                <!--para recepcionar archivos uso enctype-->
                <form action="galeria.php" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nombre">Nombre del Proyecto</label>
                        <input required class="form-control" type="text" name="nombre" id="nombre">
                    </div>

                    <div>
                        <label for="archivo">Imagen del Proyecto</label>
                        <input required class="form-control" type="file" name ="archivo" id="archivo">
                    </div>
                    <br>
                    <div>
                        <label for="descripcion">Indique Descripción del Proyecto</label>
                        <textarea required class="form-control" name="descripcion" id="descripcion" cols="30" rows="4"></textarea>
                    </div>
                    <div>
                        <label for="github">Indique link de repositorio si lo subió</label>
                        <input class="form-control" type="text" name="github" id="github">
                    </div>
                    <div>
                        <label for="url">Indique la url si esta desplegado</label>
                        <input class="form-control" type="text" name="url" id="url">
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
                    <div>
                        <br>
                        <input class="btn btn-success" type="submit" value="Enviar Proyecto">
                    </div>
                </form>
            </div> <!--cierra el body-->
        </div><!--cierra el card-->
    </div><!--cierra el col-->
</div><!--cierra el row-->
<div class="bg-secondary">
    <div class="row d-flex justify-content-center mb-5">
        <div class="col-md-10 col-sm-6">
            <table class="table tabla__galeria bg-secondary">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>GitHub</th>
                        <th>Eliminar</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proyectos as $proyecto){ ?>
                        <tr>
                            <td><?php echo $proyecto['nombre'];?></td>
                            <td><img width="200" src="imagenes/<?php echo $proyecto['imagen'];?>" alt=""></td>
                            <td class="texto"><?php echo $proyecto['descripcion'];?></td>
                            <td class="texto">
                                <?php if (!empty($proyecto['Github'])) : ?>
                                    <a href="<?php echo $proyecto['Github']; ?>" target="_blank"><?php echo $proyecto['Github']; ?></a>
                                <?php else : ?>
                                    Proyecto sin repositorio
                                <?php endif; ?>
                            </td>
                            <td><a name="eliminar" id="eliminar" class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'];?>">Eliminar</a></td>
                            <td><a name="modificar" id="modificar" class="btn btn-warning" href="?modificar=<?php echo $proyecto['id'];?>">Modificar</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <h2 class="card-title text-dark card__mobile">Listado de proyectos ingresados:</h2>
            <?php foreach($proyectos as $proyecto){ ?>
                <div class="col card__mobile  mb-4">
                    <div class="card border border-3 shadow w-100">
                        <h3 class="card-title text-dark"><?php echo $proyecto['nombre'];?></h3>
                        <a>
                            <img class="card-img-top" width="200" src="imagenes/<?php echo $proyecto['imagen'];?>" alt="">
                        </a>
                        <div class="card-body">
                            <p class="card-text text-dark"><?php echo $proyecto['descripcion'];?></p>
                            <a name="eliminar" id="eliminar" class="btn btn-danger" href="?borrar=<?php echo $proyecto['id'];?>">Eliminar</a>
                            <a name="modificar" id="modificar" class="btn btn-warning" href="?modificar=<?php echo $proyecto['id'];?>">Modificar</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div><!--cierra el col-->  
    </div>
</div>

<?php include 'footer.php'; ?>
