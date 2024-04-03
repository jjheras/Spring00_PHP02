<?php
    include "function.php";
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="formularioLab" content="width=device-width, initial-scale=1.0">
    <title>Formulario lab0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/CSS.css" rel ="stylesheet">
    <script src="js/js.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center text-center">
        <h1>Información de usuarios</h1>
            <div class="col-md-6">
                <form class="row g-3" method="POST" action="index.php">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="col-md-4">
                        <label for="apellido" class="form-label">Apellido: </label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="col-md-4">
                        <label for="edad" class="form-label">Edad: </label>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Cuentanos como eres: </label>
                        <textarea type="text" class="form-control" id="descripcion" name="descripcion" required></textarea>
                    </div>
                    <div class="col-12">
                        <input class="btn btn-primary" type="submit" value="Enviar">
                    </div>
                </form>
            </div>
        </div>
    </div> 
    <div class="m-b-30 container border border-4">
        <div class="row justify-content-center text-center">
            <div class="col-md-4">
                <div class="square" id="square1">
                    <h3>Edad mínima</h3>
                    <h2><?php if(isset ($menor_edad)) echo round($menor_edad); ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="square" id="square2">
                    <h3>Edad media</h3>
                    <h2><?php if(isset ($media_edades)) echo round($media_edades); ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="square" id="square3">
                    <h3>Edad máxima</h3>
                    <h2><?php if(isset ($mayor_edad)) echo round($mayor_edad); ?></h2>
                </div> 
            </div>
        </div>
    </div>
    <div class="m-b-30 container border border-4">
        <div class="row justify-content-center text-center">
            <div>
                <h2>Diagrama de participantes</h2>
            </div>
            <div>
                <h3>Hasta 25 años</h3>
                <div class="progress">
                    <?php $porcentaje_hasta_25 = isset($porcentaje_hasta_25) ? $porcentaje_hasta_25 : 0; ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $porcentaje_hasta_25 ?>%;" aria-valuenow="<?php echo $porcentaje_hasta_25 ?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($porcentaje_hasta_25) ?>%</div>
                </div>
            </div>
            <div>
                <h3>De 25 a 50 años</h3>
                <div class="progress">
                    <?php $porcentaje_entre_25_50 = isset($porcentaje_entre_25_50) ? $porcentaje_entre_25_50 : 0; ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $porcentaje_entre_25_50 ?>%;" aria-valuenow="<?php echo $porcentaje_entre_25_50 ?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($porcentaje_entre_25_50) ?>%</div>
                </div>
            </div>
            <div>
                <h3>Desde 50 años</h3>
                <div class="progress">
                    <?php $porcentaje_desde_50 = isset($porcentaje_desde_50) ? $porcentaje_desde_50 : 0; ?>
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo $porcentaje_desde_50 ?>%;" aria-valuenow="<?php echo $porcentaje_desde_50 ?>" aria-valuemin="0" aria-valuemax="100"><?php echo round($porcentaje_desde_50) ?>%</div>
                </div>
            </div>  
        </div>
    </div>
    <div class="m-b-30 container border border-4">
    <div class="row justify-content-center text-center">
        <div>
            <h2>Información de participantes</h2>
        </div>
        <?php if(!empty($infoParticipantes)):?>
        <?php for($i=0;$i<count($infoParticipantes);$i++ ):?>
        <div class="accordion">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapse_<?php echo $i ?>" aria-expanded="false" aria-controls="collapse_<?php echo $i ?>">
                        <?php echo $infoParticipantes[$i]['nombre']; ?>
                        </button>
                    </h5>
                </div>
                <div id="collapse_<?php echo $i ?>" class="collapse" aria-labelledby="heading_<?php echo $i ?>" data-parent="#accordion">
                    <div class="card-body">
                        <?php echo $infoParticipantes[$i]['descripcion']; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endfor; ?>
        <?php endif; ?>
    </div>   
</body>
</html>