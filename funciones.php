<?php
function promedio($muestras){
    return array_sum($muestras) / count($muestras);
}
function evaluar($riesgo){
    switch ($riesgo) {

        case $riesgo >0 && $riesgo <= 5:
            return 'SIN RIESGO';
            break;
        case $riesgo > 5 && $riesgo <= 14:
            return 'BAJO';
            break;
        case $riesgo > 14 && $riesgo <= 35:
            return 'MEDIO';
            break;
        case $riesgo > 35 && $riesgo <= 80:
            return 'ALTO';
            break;
        case $riesgo >80 && $riesgo <= 100:
            return 'INVIABLE SANITARIAMENTE';
            break;
        
        default:
            return 'no hay valores';
            break;
    }
}