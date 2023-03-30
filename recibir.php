<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body>
    <div class="reci">
        <?php
        require_once('conexion.php');
        require_once('funciones.php');

        $muestra1   = $_POST["muestra1"];
        $muestra2   = $_POST["muestra2"];
        $muestra3   = $_POST["muestra3"];
        $muestra4   = $_POST["muestra4"];



        if (!isset($_POST['id'])) {
            $query = "INSERT INTO datos(muestra1, muestra2, muestra3, muestra4) values($muestra1, $muestra2, $muestra3, $muestra4)";
            // die();
        } else {
            $query = "UPDATE datos SET muestra1 = {$muestra1}, muestra2 = {$muestra2}, muestra3 = {$muestra3}, muestra4 = {$muestra4} WHERE id = {$_POST['id']}";
        }
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $muestras = [$_POST['muestra1'], $_POST['muestra2'], $_POST['muestra3'], $_POST['muestra4']];

        $promedio = promedio($muestras);
        $maximo = max($muestras);
        $minimo = min($muestras);

        $evaluar = evaluar($promedio);
        $riesgoMax = evaluar($maximo);
        $riesgoMin = evaluar($minimo);

        echo "el promedio del nivel de calidad de agua es: " . "<b>$promedio</b>" . " y su nivel de riesgo es: " . "<b>$evaluar</b>";
        echo "<br><br>";
        echo "el nivelde riesgo de calidad mas alto es: " . "<b>$maximo</b>" . " y su nivel de riesgo es: " . "<b>$riesgoMax</b>";
        echo "<br><br>";
        echo "el nivelde riesgo de calidad mas bajo es: " . "<b>$minimo</b>" . " y su nivel de riesgo es: " . "<b>$riesgoMin</b>";
        echo "<br>";
        ?>
    </div>

    <br><br>
    <div class="res">
        <a href="index.php">regresar</a>
    </div>
</body>

</html>