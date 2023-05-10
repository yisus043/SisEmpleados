<?php

//importar la ruta del phpexcel
require 'importador/Classes/PHPExcel.php';
require 'conexion2.php';
$archivos = 'files/platilla.xlsx';

//cargar nuestra hoja de excel
$excel = PHPExcel_IOFactory::load($archivos);

//carga la hoja de calculo que queremos
$excel -> setActiveSheetIndex(0);

//Obtener el numero de la fila de nuestro archivo excel
$numerofila = $excel -> setActiveSheet(0)->getHighestRow();


for($i=1; $i <= $numerofila; $i++ )
{

$idproducto =  $excel -> getActiveSheet() -> getCell('A'.$i) -> getCalculatedValue();
$producto = $excel -> getActiveSheet() -> getCell ('B'. $i) -> getCalculatedValue();
$Consulta = "INSERT INTO asistencia (area, nombre) VALUE ('$area', '$nombre',)";
$resultado =  $mysqli->query($Consulta);

}

?>
