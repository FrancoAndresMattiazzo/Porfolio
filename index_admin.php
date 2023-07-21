<?php include 'header.php';?>
<?php $conexion = new conexion();# es un objeto de tipo conexion,
      $proyectos= $conexion->consultar("SELECT * FROM `proyectos`");
      $estudios = $conexion->consultar("SELECT * FROM `estudios`");
      $trabajos = $conexion->consultar("SELECT * FROM `trabajos`"); 
      $tecnologias= $conexion->consultar("SELECT * FROM `tecnologias`");?>
      

<div class="p-5 bg-light">
    <div class="container">
        <h1 class="display-3">Administrador de Portfolio Personal</h1>
        <p class="lead">Proyectos Cargados en base de datos</p>
        <hr class="my-2">
        <p class="lead" style="font-size:1.5rem;"><a href="./index.php" target="_blank"> Acceder al portfolio</a><br><br>
         En admin podra:  <br> Dar de alta un nuevo proyecto <br> Dar de baja un proyecto <br> Modificar un proyecto <br>
        Cualquier duda <a href="mailto:francomattiazzo1@gmail.com">Click para enviar email</a></p>
       
    </div>
</div>
<div class ="container bg-secondary pb-5">
  <h3>Proyectos</h3>
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php #leemos proyectos 1 por 1
        foreach($proyectos as $proyecto){ ?>
            <div class="col">
                <div class="card border border-3 shadow">
                    <img class="card-img-top" style="object-fit:cover;" src="imagenes/<?php echo $proyecto['imagen'];?>" alt="" width="300">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $proyecto['nombre'];?></h5>
                        <p class="card-text"><?php echo $proyecto['descripcion'];?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class ="container bg-secondary pb-5">
    <h3>Estudios</h3>
    <div class="table-responsive bg-white" style="margin-top: 1rem;">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">año</th>
                  <th scope="col">institucion</th>
                  <th scope="col">certificado</th>
                </tr>
              </thead>
              <tbody>
              <?php #leemos proyectos 1 por 1
        foreach($estudios as $estudio){ ?>
        <tr>
            <td><?php echo $estudio['nombre'];?></td>
            <td><?php echo $estudio['ano'];?></td>
            <td><?php echo $estudio['institucion'];?></td>
            <td><?php echo $estudio['certificado'];?></td>
        </tr>
            </div>
        <?php } ?>
              </tbody>
            </table>
          </div>
    </div>
</div>
<div class ="container bg-secondary pb-5">
    <h3>Trabajos</h3>
    <div class="table-responsive bg-white" style="margin-top: 1rem;">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Puesto</th>
                  <th scope="col">fecha inicio</th>
                  <th scope="col">fecha final</th>
                  <th scope="col">Tecnologias utilizadas</th>
                </tr>
              </thead>
              <tbody>
              <?php #leemos proyectos 1 por 1
        foreach($trabajos as $trabajo){ ?>
        <tr>
            <td><?php echo $trabajo['nombre_empresa'];?></td>
            <td><?php echo $trabajo['puesto'];?></td>
            <td><?php echo $trabajo['fecha_inicio'];?></td>
            <td><?php echo $trabajo['fecha_final'];?></td>
            <td>
                <?php
                $tecnologias_seleccionadas = explode(",", $trabajo['tecnologia_id']);
                $tecnologias_nombres = array(); // Creamos un array para almacenar los nombres de tecnologías

                foreach ($tecnologias as $tecnologia) {
                    if (in_array($tecnologia['id'], $tecnologias_seleccionadas)) {
                        $tecnologias_nombres[] = $tecnologia['nombre']; // Agregamos el nombre de la tecnología al array
                    }
                }

                // Unimos los nombres de tecnologías con una coma (',')
                echo implode(', ', $tecnologias_nombres);
                ?>
            </td>
        </tr>
            </div>
        <?php } ?>
              </tbody>
            </table>
          </div>
    </div>
</div>
<?php include 'footer.php'; ?>
