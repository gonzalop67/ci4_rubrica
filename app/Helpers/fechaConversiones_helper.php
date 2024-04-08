<?php
function fecha_corta($fecha)
{
    // Convertir el parámetro fecha al formato mmm aaaa
    // e.g. Si $fecha = '2004-12-12' retornará 'Dic 2004'
    
    $meses_abrev = array(0, "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");

    $fecha_array = explode("-", $fecha);

    return $meses_abrev[(int)$fecha_array[1]] . " " . $fecha_array[0];
}
