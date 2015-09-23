<?php

date_default_timezone_set('America/Panama');

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');


$serviciosUsuarios  = new ServiciosUsuarios();
$servicios			= new Servicios();

$fecha = date('Y-m-d');


$resPeliculas = $servicios->TraerTodasPeliculas();

$resPrecios = $servicios->TraerCine();

$resVigencia = $servicios->traerVigencias();

if (mysql_num_rows($resVigencia)>0) {
	$vigencias = mysql_result($resVigencia,0,1);	
} else {
	$vigencias = '';	
}

/*
header('Content-type: image/jpeg');

$imagen = new Imagick('../imagenes/CINE-03.jpg');


$imagen->thumbnailImage(1920, 1080);

echo $imagen;
*/


// Load the stamp and the photo to apply the watermark to

header('Content-Type: image/jpeg');


$destino = imagecreatefromjpeg('../imagenes/CINE-03.jpg');
$contenedor = imagecreatetruecolor(imagesx($destino), imagesy($destino));
 
 




//ver el tamaño de la original
// Copiar
imagecopy($contenedor, $destino, 0, 0, 0, 0, imagesx($destino), imagesy($destino));


////////////////////////////inicio las fuentes y los colores de las fuentes///////////
$fuente = imageloadfont('dincondensed.gdf');
$fuente2 = imageloadfont('dincondensed2.gdf');
$fuente_chica = imageloadfont('dincondensed3.gdf');
$color_texto = imagecolorallocate($contenedor, 39, 36, 37);
$color_texto_blanco = imagecolorallocate($contenedor, 255, 255, 255);
$color_texto_verde = imagecolorallocate($contenedor, 24, 147, 0);
/////////////////////////////////////////////////////////////////////////////////////




/////////// Marco la fecha de emision /////////////////////////////////////
imagestring($contenedor, $fuente, 700, 30, $vigencias, $color_texto);
//////////////////////////////////////////////////////////////////////////

$i = 0;
$x = 455;
$y = 328;

//ancho de la letra es 12 el maximo es de 14 = 12 * 14 = 168, arranca en 302
function devolverXcategoria($categoria) {
	$distancia = 14 - strlen($categoria);
	if ($distancia < 0) {
		return 302;	
	} else {
		return (($distancia/2)*12) + 302;	
	}
}


//ancho de la letra es 12 el maximo es de 18 = 12 * 14 = 216, arranca en 275
function devolverXpelicula($pelicula) {
	$distancia = 18 - strlen($pelicula);
	if ($distancia < 0) {
		return 302;	
	} else {
		return (($distancia/2)*12) + 275;	
	}
}


while ($row = mysql_fetch_array($resPeliculas)) {
	
	if ($i < 4) {
		$desplazarX = $i*455;
		$desplazarY = 0; 	
	} else {
		if ($i == 4) {
			$i =0;	
		}
		$desplazarX = $i*455;
		$desplazarY = 328;
	}
	
	
/////////////////////para la imagen ///////////////////////////////////////////////////////////////////////////	

///$row['imagen']
$im_origen = imagecreatefromjpeg($row['imagen']);
$ancho = imagesx($im_origen);
$alto = imagesy($im_origen);
 

$im_destino = imagecreatetruecolor(206, 296);
imagecopyresampled($im_destino, $im_origen, 0, 0, 0, 0,206, 296, $ancho, $alto);
$origen = $im_destino;
imagecopy($contenedor, $origen, 64+$desplazarX,213+$desplazarY, 0, 0, imagesx($origen), imagesy($origen));
/////////////////////////////////////////////////////////////	/////////////////////////////////////////////////
	
	
	
	
	
	
	
	
	imagestring($contenedor, $fuente, 290+$desplazarX, 205+$desplazarY, 'Numero de Sala:'.$row['sala'], $color_texto);
	
	imagestring($contenedor, $fuente, devolverXcategoria($row['categoria'])+$desplazarX, 228+$desplazarY, $row['categoria'], $color_texto);
	
	
	imagestring($contenedor, $fuente, devolverXpelicula($row['titulo'])+$desplazarX, 280+$desplazarY, $row['titulo'], $color_texto_blanco);
	// opcion para el segundo renglon: 

	imagestring($contenedor, $fuente, devolverXpelicula($row['titulo2'])+$desplazarX, 305+$desplazarY, $row['titulo2'], $color_texto_blanco);

	$resH = $servicios->TraerTurnosPeliculasPorId($row['idpelicula']);
	
	$j =0;
	while ($rowH = mysql_fetch_array($resH)) {
		$j = $j+1;
		switch ($j) {
			case 1:
				imagestring($contenedor, $fuente2, 342+$desplazarX, 354+$desplazarY, $rowH['horario'], ($rowH['finde'] == 'No' ? $color_texto_blanco : $color_texto_verde));
				break;
			case 2:
				imagestring($contenedor, $fuente2, 342+$desplazarX, 392+$desplazarY,  $rowH['horario'], ($rowH['finde'] == 'No' ? $color_texto_blanco : $color_texto_verde));
				break;
			case 3:
				imagestring($contenedor, $fuente2, 342+$desplazarX, 430+$desplazarY,  $rowH['horario'], ($rowH['finde'] == 'No' ? $color_texto_blanco : $color_texto_verde));
				break;
			case 4:
				imagestring($contenedor, $fuente2, 342+$desplazarX, 466+$desplazarY,  $rowH['horario'], ($rowH['finde'] == 'No' ? $color_texto_blanco : $color_texto_verde));		
				break;
		}
	}
	
	switch ($j) {
		case 1:
			imagestring($contenedor, $fuente2, 355+$desplazarX, 392+$desplazarY, '--:--', $color_texto_blanco);
			imagestring($contenedor, $fuente2, 355+$desplazarX, 430+$desplazarY, '--:--', $color_texto_blanco);
			imagestring($contenedor, $fuente2, 355+$desplazarX, 466+$desplazarY, '--:--', $color_texto_blanco);
			break;
		case 2:
			imagestring($contenedor, $fuente2, 355+$desplazarX, 430+$desplazarY, '--:--', $color_texto_blanco);
			imagestring($contenedor, $fuente2, 355+$desplazarX, 466+$desplazarY, '--:--', $color_texto_blanco);
			break;
		case 3:
			imagestring($contenedor, $fuente2, 355+$desplazarX, 466+$desplazarY,  '--:--', $color_texto_blanco);
			break;
	}
	
	$i = $i+1;
}




//////////////////// listas de precios /////////////////////////////////////

if (mysql_num_rows($resPrecios)>0) {
	imagestring($contenedor, $fuente_chica, 1030, 955, utf8_decode('Niños B/.').mysql_result($resPrecios,0,1), $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1024, 987, 'Adultos B/.'.mysql_result($resPrecios,0,2), $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1191, 955, utf8_decode('Niños B/.').mysql_result($resPrecios,0,3), $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1191, 987, 'Adultos B/.'.mysql_result($resPrecios,0,4), $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1366, 955, 'Sala Regular B/.'.mysql_result($resPrecios,0,5), $color_texto_blanco);
	imagestring($contenedor, $fuente_chica, 1366, 987, 'Sala 3D B/.'.mysql_result($resPrecios,0,6), $color_texto_blanco);
} else {
	imagestring($contenedor, $fuente_chica, 1028, 955, utf8_decode('Niños B/. '), $color_texto_blanco);
	imagestring($contenedor, $fuente_chica, 1028, 987, 'Adultos B/. ', $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1191, 955, utf8_decode('Niños B/. '), $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1191, 987, 'Adultos B/. ', $color_texto_blanco);
	
	imagestring($contenedor, $fuente_chica, 1366, 955, 'Sala Regular B/. ', $color_texto_blanco);
	imagestring($contenedor, $fuente_chica, 1366, 987, 'Sala 3D B/. ', $color_texto_blanco);
}

///////////////////////////////////////////////////////////////////////////








/*
imagestring($contenedor, $fuente, 290, 205, 'Numero de Sala:1', $color_texto);

imagestring($contenedor, $fuente, 329, 228, 'Categoria', $color_texto);

//ancho de la letra es 12 el maximo es de 18 = 12 * 14 = 216, arranca en 275
imagestring($contenedor, $fuente, 311, 280, 'Transformers', $color_texto_blanco);
// opcion para el segundo renglon: imagestring($contenedor, $fuente, 275, 305, 'Transformersmmmmmm', $color_texto_blanco);

imagestring($contenedor, $fuente2, 335, 354, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 392, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 430, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 466, '08:00 am', $color_texto_blanco);



imagestring($contenedor, $fuente2, 335, 354+328, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 392+328, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 430+328, '08:00 am', $color_texto_blanco);
imagestring($contenedor, $fuente2, 335, 466+328, '08:00 am', $color_texto_blanco);


imagestring($contenedor, $fuente, 290+455, 205, 'Numero de Sala:1', $color_texto);

imagestring($contenedor, $fuente, 329+455, 228, 'Categoria', $color_texto);

imagestring($contenedor, $fuente, 290+455+455, 205, 'Numero de Sala:1', $color_texto);

imagestring($contenedor, $fuente, 329+455+455, 228, 'Categoria', $color_texto);

imagestring($contenedor, $fuente, 290+455+455+455, 205, 'Numero de Sala:1', $color_texto);

imagestring($contenedor, $fuente, 329+455+455+455, 228, 'Categoria', $color_texto);
*/
 
 

// Imprimir y liberar memoria

imagejpeg($contenedor);
 
imagedestroy($destino);
imagedestroy($origen);
imagedestroy($contenedor);





?>