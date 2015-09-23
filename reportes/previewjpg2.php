<?php

date_default_timezone_set('America/Panama');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');


$serviciosUsuarios  = new ServiciosUsuarios();
$servicios			= new Servicios();

$fecha = date('Y-m-d');


$resPeliculas = $servicios->TraerTodasPeliculas();


/*
header('Content-type: image/jpeg');

$imagen = new Imagick('../imagenes/CINE-03.jpg');


$imagen->thumbnailImage(1920, 1080);

echo $imagen;
*/


// Load the stamp and the photo to apply the watermark to

//ancho de la letra es 12 el maximo es de 14 = 12 * 14 = 168, arranca en 302
$im_origen = imagecreatefromjpeg('../imagenes/transformers.jpg');
$ancho = imagesx($im_origen);
$alto = imagesy($im_origen);
 
 
$im_destino = imagecreatetruecolor(206, 296);
imagecopyresampled($im_destino, $im_origen, 0, 0, 0, 0,206, 296, $ancho, $alto);


$origen = $im_destino;
$destino = imagecreatefromjpeg('../imagenes/CINE-03.jpg');
$contenedor = imagecreatetruecolor(imagesx($destino), imagesy($destino));
 
//ver el tamaño de la original
// Copiar
imagecopy($contenedor, $destino, 0, 0, 0, 0, imagesx($destino), imagesy($destino));
imagecopy($contenedor, $origen, 64,213, 0, 0, imagesx($origen), imagesy($origen));
 
// Imprimir y liberar memoria
header('Content-Type: image/jpeg');
imagejpeg($contenedor);
 
imagedestroy($destino);
imagedestroy($origen);
imagedestroy($contenedor);








// Output and free memory
header('Content-type: image/jpg');
imagejpeg($im_destino);

imagedestroy($im_destino);
?>