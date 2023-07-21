<?php include 'conexion.php'; ?>
<?php $conexion = new conexion();
 $sql = "SELECT * FROM `proyectos`";
 $datos = $conexion->consultar($sql);
 $proyectos= $conexion->consultar("SELECT * FROM `proyectos`");
 $tecnologias= $conexion->consultar("SELECT * FROM `tecnologias`");
 $estudios = $conexion->consultar("SELECT * FROM `estudios` ORDER BY `ano` DESC");
 $trabajos = $conexion->consultar("SELECT * FROM `trabajos` ORDER BY `fecha_inicio` DESC");
 ?>
   <!DOCTYPE html>
   <html lang="es">
   <head>
       <meta charset="UTF-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
       <title>Portafolio</title>
     
       <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comforter+Brush&family=Fjalla+One&display=swap" rel="stylesheet">  
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
       <link rel="stylesheet" href="./css/style.css">
        <style>
            body{
                width: 100%;
                overflow: visible;
                background-color:black !important;
                color: white !important;
                position: relative;
                
            }

            @media screen and (max-width: 768px) {
            .display-3 {
                font-size: 1rem !important;
            }
            
            .lead {
                font-size: 1rem !important;
            }
            }

            @media screen and (max-width: 576px) {
            .display-3 {
                font-size: 3rem !important;
            }
            
            .lead {
                font-size: 1.5rem !important;
            }
            }

            .avatar {
                width: 400px;
                height: 400px;
                box-sizing: border-box;
                border: 5px #28a745 solid;
                border-radius: 50%;
                overflow: hidden;
                box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
                transform: translatey(0px);
                animation: float 6s ease-in-out infinite;
            }
            .avatar img {
                width: 100%;
                height: auto;
            }

            @keyframes float {
                0% {
                    box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
                    transform: translatey(0px);
                }
                50% {
                    box-shadow: 0 25px 15px 0px rgba(0,0,0,0.2);
                    transform: translatey(-20px);
                }
                100% {
                    box-shadow: 0 5px 15px 0px rgba(0,0,0,0.6);
                    transform: translatey(0px);
                }
            }

            .custom-input::placeholder {
                color: #28a745;
            }

            
         
         
        </style>
   </head>
   <body data-bs-spy="scroll" data-bs-target="#navbar-example">
        <header>
        <?php include 'header-public.php' ?>
        </header>
        <main class="scrollspy">
            <section class="container pt-5 text-center" id="inicio">
                <div class="tit-5 container">
                <h1 class="tit mt-5">
                    <span id="linea1" class="linea">Hola!</span><br>
                    <span id="linea2" class="linea">Soy Franco Mattiazzo</span>
                </h1>
                    <p class="tit-2 lead animate__animated animate__backInUp text-success">Desarrollador Web</p>
                </div>
            </section>
            <section class="container pb-5 pt-5 animate__animated animate__backInDown d-flex justify-content-center align-items-center">
                <div class="avatar text-center">
                <img src="./img/photo.jpeg" alt="Franco Mattiazzo" width="400" height="400" class="border rounded-circle">
                </div>
            </section>
            <section class="container pb-5 pt-5 animate__animated animate__backInDown" id="sobremi">
                <div class="row">
                    <div class="text-center col-8 m-auto"><h2>Sobre mi</h2></div>
                    <div class="col-md-8 col-sm-10 m-auto">
                        <p class="pt-4">Soy un apasionado de la informática desde una edad temprana. Estoy acostumbrado a trabajar bajo presión, asumir responsabilidades y liderar equipos. Siempre busco nuevos desafíos y me entusiasma aprender y crecer en la industria de la tecnología. Estoy comprometido con la excelencia y ansioso por hacer una diferencia en el mundo digital.</p>
                        
                    </div>
                </div>
                
                
                
                    
                <div class="col-12"><hr class="tit-3 my-4"></div>
            </section>
            <section class="container pb-5" id="idiomas">
                <div class="text-center pb-3"><h2>Idiomas</h2></div>
                <div class="text-center border border-success rounded-4 bg-nav2 pt-2 mt-4">
                    <h3 class="pt-4 pb-4 text-light">Ingles:    <span class="btn btn-primary">B2</span></h3>
                    
                </div>
                <div>
                    <hr class="tit-3 my-4">
                </div>
            </section>
            <section class="container pb-5" id="estudios">
                <div class="text-center pb-2"><h2>Estudios</h2></div>
                <div class="text-center pt-2">
                    <ul>
                        <?php
                        foreach ($estudios as $estudio) {
                            echo "<li class='bg-nav2 pt-2 mt-3 mb-2 pb-1 border border-success rounded-4'>";
                            echo "<h3 class='text-light'>" . $estudio['nombre'] . "</h3>";
                            echo "<p class='text-light'>Año Finalizacion: " . date('m-Y', strtotime($estudio['ano'])) . "</p>";
                            echo "<p class='text-light'>Institución: " . $estudio['institucion'] . "</p>";
                            if (!empty($estudio['certificado'])) {
                            echo "<p><a href='" . $estudio['certificado'] . "' download class='btn btn-outline-primary'>Descargar Certificado</a></p>";
                            }
                            echo "</li>";
                        }
                        ?>
                    </ul>
                    <hr class="tit-3 my-4">
                </div>
            
            </section>
            <section class="container pb-5" id="experiencia">
                <div class="text-center pb-2"><h2>Experiencia laboral</h2></div>
                <div>
                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-12 g-4 pt-2 mt-3">
                    <?php foreach ($trabajos as $trabajo) { ?>
                        <div class="col animate__animated animate__fadeInUp">
                            <div class="card bg-nav2 text-white text-center border border-success rounded-4">
                                <div class="card-body">
                                    <h3 class="card-title"><?php echo $trabajo['nombre_empresa']; ?></h3>
                                    <p class="card-text text-light">Puesto: <?php echo $trabajo['puesto']; ?></p>
                                    <p class="card-text text-light"><?php echo date('m/Y', strtotime($trabajo['fecha_inicio'])); ?> - <?php echo date('m/Y', strtotime($trabajo['fecha_final'])); ?></p>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <?php
                                        $tecnologias_seleccionadas = explode(",", $trabajo['tecnologia_id']);
                                        foreach ($tecnologias as $tecnologia) {
                                            if (in_array($tecnologia['id'], $tecnologias_seleccionadas)) {
                                                switch ($tecnologia['nombre']) {
                                                    case 'PHP':
                                                        $clase = 'btn btn-warning text-dark';
                                                        break;
                                                    case 'Javascript':
                                                        $clase = 'btn btn-primary';
                                                        break;
                                                    case 'HTML5':
                                                        $clase = 'btn btn-info';
                                                        break;
                                                    case 'CSS':
                                                        $clase = 'btn btn-secondary';
                                                        break;
                                                    case 'Python':
                                                        $clase = 'btn btn-success';
                                                        break;
                                                    case 'Flask':
                                                        $clase = 'btn btn-danger';
                                                        break;
                                                    case 'C#':
                                                        $clase = 'btn btn-dark';
                                                        break;
                                                    case '.NET CORE':
                                                        $clase = 'btn btn-secondary';
                                                        break;
                                                    case 'Typescript':
                                                        $clase = 'btn btn-primary';
                                                        break;
                                                    case 'Angular':
                                                        $clase = 'btn btn-danger';
                                                        break;
                                                    case 'Vue':
                                                        $clase = 'btn btn-success';
                                                        break;
                                                    case 'Docker':
                                                        $clase = 'btn btn-info';
                                                        break;
                                                    case 'AWS':
                                                        $clase = 'btn btn-success';
                                                        break;
                                                    case 'Jest':
                                                        $clase = 'btn btn-primary';
                                                        break;
                                                    case 'Postman':
                                                        $clase = 'btn btn-warning';
                                                        break;
                                                    case 'CDK':
                                                        $clase = 'btn btn-secondary';
                                                        break;
                                                    case 'Jenkins':
                                                        $clase = 'btn btn-danger';
                                                        break;
                                                }
                                                echo '<p class="' . $clase . ' me-3 pointer-events-none">' . $tecnologia['nombre'] . '</p>';
                                            }
                                            
                                        }
                                        ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
    </div>
    <hr class="tit-3 my-4">
                </div>                
            </section>
            <section class="container pb-5" id="proyectos">
            
                <h2 class="text-white text-center">Proyectos</h2>

                <div class="row row-cols-1 row-cols-md-3 g-4 pt-2 mt-3">
                    <?php foreach ($proyectos as $proyecto) { ?>
                        <?php
                        $tecnologias_seleccionadas = explode(",", $proyecto['tecnologia_id']);
                        ?>
                        <div class="col animate__animated animate__fadeInBottomLeft">
                            <div class="card border border-success rounded-4 border-3 shadow w-100 min-height-400 bg-nav2" style="min-height: 570px;">
                                <a>
                                    <img class="card-img-top" width="100" height="300" src="imagenes/<?php echo $proyecto['imagen']; ?>" alt="">
                                </a>
                                <div class="card-body">
                                    <div class="container-fluid justify-content-between">
                                    <?php foreach ($tecnologias as $tecnologia) {
                                                $clase = '';
                                                foreach ($tecnologias_seleccionadas as $tecnologia_seleccionada){
                                                    $tecnologias_seleccionadas = array_map('trim', $tecnologias_seleccionadas);
                                                    $tecnologia_seleccionada = intval($tecnologia_seleccionada);
                                                    if (intval($tecnologia['id']) === $tecnologia_seleccionada) {
                                                    switch ($tecnologia['nombre']) {
                                                        case 'PHP':
                                                            $clase = 'btn btn-warning text-dark';
                                                            break;
                                                        case 'Javascript':
                                                            $clase = 'btn btn-primary';
                                                            break;
                                                        case 'HTML5':
                                                            $clase = 'btn btn-info';
                                                            break;
                                                        case 'CSS':
                                                            $clase = 'btn btn-secondary';
                                                            break;
                                                        case 'Python':
                                                            $clase = 'btn btn-success';
                                                            break;
                                                        case 'Flask':
                                                            $clase = 'btn btn-danger';
                                                            break;
                                                        case 'C#':
                                                            $clase = 'btn btn-dark';
                                                            break;
                                                        case '.NET CORE':
                                                            $clase = 'btn btn-secondary';
                                                            break;
                                                        case 'Typescript':
                                                            $clase = 'btn btn-primary';
                                                            break;
                                                        case 'Angular':
                                                            $clase = 'btn btn-danger';
                                                            break;
                                                        case 'Vue':
                                                            $clase = 'btn btn-success';
                                                            break;
                                                        case 'Docker':
                                                            $clase = 'btn btn-info';
                                                            break;
                                                        case 'AWS':
                                                            $clase = 'btn btn-success';
                                                            break;
                                                        case 'Jest':
                                                            $clase = 'btn btn-primary';
                                                            break;
                                                        case 'Postman':
                                                            $clase = 'btn btn-warning';
                                                            break;
                                                        case 'CDK':
                                                            $clase = 'btn btn-secondary';
                                                            break;
                                                        case 'Jenkins':
                                                            $clase = 'btn btn-danger';
                                                            break;
                                                    }
                                                    echo '<p class="' . $clase . ' me-3 pointer-events-none">' . $tecnologia['nombre'] . '</p>';
                                                }
                                                
                                            }} ?>
                                        </div>
                                    <h5 class="card-title text-light">
                                        <?php echo $proyecto['nombre']; ?>
                                    </h5>
                                    <p class="card-text text-success">
                                        <?php echo $proyecto['descripcion']; ?>
                                    </p>
                                    <?php if (!empty($proyecto['Github'])) : ?>
                                        <a href="<?php echo $proyecto['Github']; ?>" target="_blank" class="button-hover"><img src="img/png-transparent-github-git-hub-logo-icon-thumbnail.png" width="50" height="50" alt="link github"></a>
                                    <?php endif; ?>

                                    <?php if (!empty($proyecto['url'])) : ?>
                                        <a href="<?php echo $proyecto['url']; ?>" target="_blank" class="btn btn-outline-success">Visitar</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div>
                    <hr class="tit-3 my-4">
                </div>

            </section>

            <section id="contacto" class="container text-center mt-5">
                <header>
                    <h2>Contactame</h2>
                </header>

                <div class="container d-flex justify-content-center mb-5 border border-success rounded-4 bg-nav2 pt-5 mt-4">
                    <div class="border-3 col-8"  >
                        <form action="enviar.php" method='post' >
                                <div class="mb-3">
                                    <input type="text" class="form-control bg-nav2 text-success custom-input" id="name" placeholder="Nombre" required>
                                    <br>
                                    <input type="email" class="form-control bg-nav2 text-success custom-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                                    <br>
                                    <div id="emailHelp" class="form-text text-white-50">Nunca compartiremos su correo electrónico con nadie más.</div>
                                </div>
                                <div class="mb-3">
                                
                                    <input type="text" class="form-control bg-nav2 text-success custom-input" id="motivo" placeholder="Motivo" required>
                                    <br>
                                    <textarea class="form-control bg-nav2 text-success custom-input" name="contenido" id="contenido" cols="10" rows="5" placeholder="Mensaje" required></textarea>
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-light"> Enviar Mail </button>
                                </div>
                                <div class="pt-4 text-success">
                                    <h5>Tambien puedes contactarme por:</h5>
                                </div>
                                <div>
                                    <a href="https://github.com/FrancoAndresMattiazzo"Target="_blank" class="button-hover"><img src="img/png-transparent-github-git-hub-logo-icon-thumbnail.png" width="70" height="70" alt="link github"></a>
                                    <a href="https://www.linkedin.com/in/franco-andres-mattiazzo-135822185/"Target="_blank" class="pe-2 button-hover"><img src="img/linkedin.svg" width="50" height="50" alt="link github"></a>
                                    <a  id='WSP'  href="" Target="_blank"class="button-hover"><img src="img/logo-whatsapp.svg" alt="Logo Whatsapp" width="50" height="50"></a>
                                </div>
                                
                                
                        </form>
                    </div>
                </div>
            </section>
            <section id="cv" class="container text-center pb-5">
                <h2>Descargar CV</h2>
                <p class="text-success">Aquí puedes descargar mi CV en formato PDF.</p>
                <a href="ruta/al/archivo/cv.pdf" download class="btn btn-outline-primary">Descargar CV</a>
            </section>
        </main>
    <footer>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Diseñado por Franco A. Mattiazzo</a>
            </li>
            
        </ul>
    </footer>
 <script src="envio.js"></script>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script>
  var scrollSpy = new bootstrap.ScrollSpy(document.body, {
  target: '#navbar-example'
})
</script>
 <!--<script src="envio.js"></script>-->
</body>
</html>