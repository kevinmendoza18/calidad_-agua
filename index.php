<?php
require_once('conexion.php');
require_once('funciones.php');


$query = "SELECT * FROM datos";
$result = mysqli_query($con, $query);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>calidad de agua</title>
</head>

<body>
    <header>
        <h1>Lector del nivel de la calidad del agua en el Departamento del Guaviare.</h1>
    </header>
    <hr>
    <p>
        En el año 2015, los líderes mundiales adoptaron un conjunto de objetivos globales para erradicar la pobreza,
        proteger el planeta y asegurar la prosperidad para todos como parte de una nueva agenda de desarrollo
        sostenible. Cada objetivo tiene metas específicas que deben alcanzarse en los próximos 15 años.<br><br>
        El departamento del Guaviare se ha comprometido con esta causa y por ello ha decidido adoptar estos retos,
        se lista uno de los principales relacionados con el agua potable:
        De aquí a 2030, se busca lograr el acceso universal y equitativo al agua potable a un precio asequible para
        todos.<br><br>
        Algunas ONGs se atribuyeron la tarea de poder diseñar un dispositivo para analizar la calidad del agua de
        poblaciones apartadas. Para comenzar, requieren que el dispositivo cuente con un lector de la calidad del
        agua. Después de la lectura, el dispositivo nos entrega el índice de riesgo de la calidad del agua, IRCA, y
        según
        este resultado debe indicar el nivel de riesgo.

    </p>
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Clasificación IRCA (%)</th>
                    <th>Nivel de riesgo</th>
                </tr>
            </thead>
            <tr>
                <td>(80 - 100)</td>
                <td>Inviable Sanitariamente</td>
            </tr>
            <tr>
                <td>(35 - 80)</td>
                <td>Alto</td>
            </tr>
            <tr>
                <td>(14 - 35)</td>
                <td>Medio</td>
            </tr>
            <tr>
                <td>(5 - 14)</td>
                <td>Bajo</td>
            </tr>
            <tr>
                <td>(0 - 5)</td>
                <td>Sin Riesgo</td>
            </tr>
        </table>
    </div>
    <section id="hero">
        <div class="container">
            <h2>Ingrese los datos de las muestras</h2>
            <form action="recibir.php" method="POST">
                <label for="muestra">Muestra 1</label>
                <input type="number" id="muestra" name="muestra1" placeholder="Ingrese el porcentaje IRCA">
                <br>
                <label for="muestra2">Muestra 2</label>
                <input type="number" id="muestra2" name="muestra2" placeholder="Ingrese el porcentaje IRCA">
                <br>
                <label for="muestra3">Muestra 3</label>
                <input type="number" id="muestra3" name="muestra3" placeholder="Ingrese el porcentaje IRCA">
                <br>
                <label for="muestra4">Muestra 4</label>
                <input type="number" id="muestra4" name="muestra4" placeholder="Ingrese el porcentaje IRCA">
                <br>
                <div class="button">
                    <button> Enviar</button>
                </div>
            </form>
        </div>
    </section>

    <section id="tabla2">
        <h3>Registro consolidado de muestras</h3>
        <table>
            <thead>
                <tr>
                    <td>Toma #</td>
                    <td>Fecha</td>
                    <td>Muestra 1</td>
                    <td>Muestra 2</td>
                    <td>Muestra 3</td>
                    <td>Muestra 4</td>
                    <td>Nivel promedio</td>
                    <td>Riesgo promedio</td>
                    <td colspan="2">Opciones</td>
                </tr>
            </thead>


            <tbody>
                <?php

                if (mysqli_num_rows($result) > 0) {

                    $pos      = 1;
                    $promedio = 0;
                    $etiquetas = [];
                    $datos    = [];


                    while ($data = mysqli_fetch_assoc($result)) {

                        $muestras = [$data['muestra1'], $data['muestra2'], $data['muestra3'], $data['muestra4']];
                        $promedio = promedio($muestras);
                        $riesgo = evaluar($data['muestra1'], $data['muestra2'], $data['muestra3'], $data['muestra4']);
                        $fecha_muestra = date_format(date_create($data['fecha_muestra']), 'd-m-y');


                ?>
                        <tr>
                            <td><?php echo $pos; ?></td>
                            <td><?php echo $fecha_muestra ?></td>
                            <td><?php echo $data['muestra1'] ?></td>
                            <td><?php echo $data['muestra2'] ?></td>
                            <td><?php echo $data['muestra3'] ?></td>
                            <td><?php echo $data['muestra4'] ?></td>
                            <td><?php echo $promedio ?></td>
                            <td><?php echo $riesgo ?></td>

                            <td><a href="editar.php?id=<?php echo $data['id']; ?>">editar</a></td>
                            <td><a href="eliminar.php?id=<?php echo $data['id']; ?>" value="">eliminar</a></td>
                        </tr>
                    <?php $pos++;
                    }
                } else { ?>
                    <tr>
                        <td colspan="9">no hay datos</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</body>

</html>