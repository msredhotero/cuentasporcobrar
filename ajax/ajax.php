<?php

include ('../includes/funcionesUsuarios.php');
include ('../includes/funciones.php');
include ('../includes/funcionesHTML.php');
include ('../includes/funcionesClientes.php');
include ('../includes/funcionesEmpresas.php');
include ('../includes/funcionesFacturas.php');

$serviciosUsuarios  = new ServiciosUsuarios();
$serviciosFunciones = new Servicios();
$serviciosHTML		= new ServiciosHTML();
$serviciosClientes 	= new ServiciosClientes();
$serviciosEmpresas	= new ServiciosEmpresas();
$serviciosFacturas	= new ServiciosFacturas();

$accion = $_POST['accion'];


switch ($accion) {
    case 'login':
        enviarMail($serviciosUsuarios);
        break;
	case 'entrar':
		entrar($serviciosUsuarios);
		break;
	case 'insertarUsuario':
        insertarUsuario($serviciosUsuarios);
        break;
	case 'modificarUsuario':
        modificarUsuario($serviciosUsuarios);
        break;
	case 'registrar':
		registrar($serviciosUsuarios);
        break;

/* PARA Clientes */
case 'insertarClientes': 
insertarClientes($serviciosClientes); 
break; 
case 'modificarClientes': 
modificarClientes($serviciosClientes); 
break; 
case 'eliminarClientes': 
eliminarClientes($serviciosClientes); 
break; 

/* Fin */

/* PARA Empresas */
case 'insertarEmpresas': 
insertarEmpresas($serviciosEmpresas); 
break; 
case 'modificarEmpresas': 
modificarEmpresas($serviciosEmpresas); 
break; 
case 'eliminarEmpresas': 
eliminarEmpresas($serviciosEmpresas); 
break; 

/* Fin */

/* PARA Facturas */
case 'insertarFacturas':
insertarFacturas($serviciosFacturas);
break;
case 'modificarFacturas':
modificarFacturas($serviciosFacturas);
break;
case 'eliminarFacturas':
eliminarFacturas($serviciosFacturas);
break;

/* Fin */

}

//////////////////////////Traer datos */////////////////////////////////////////////////////////////

/* PARA Clientes */
function insertarClientes($serviciosClientes) { 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$res = $serviciosClientes->insertarClientes($razonsocial,$rfc,$direccion,$email,$telefono,$celular); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	
} 
} 
function modificarClientes($serviciosClientes) { 
$id = $_POST['id']; 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$res = $serviciosClientes->modificarClientes($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarClientes($serviciosClientes) { 
$id = $_POST['id']; 
$res = $serviciosClientes->eliminarClientes($id); 
echo $res; 
} 

/* Fin */


/* PARA Empresas */
function insertarEmpresas($serviciosEmpresas) { 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$objetoempresa = $_POST['objetoempresa']; 
$res = $serviciosEmpresas->insertarEmpresas($razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa); 
if ((integer)$res > 0) { 
echo ''; 
} else { 
echo 'Huvo un error al insertar datos';	
} 
} 
function modificarEmpresas($serviciosEmpresas) { 
$id = $_POST['id']; 
$razonsocial = $_POST['razonsocial']; 
$rfc = $_POST['rfc']; 
$direccion = $_POST['direccion']; 
$email = $_POST['email']; 
$telefono = $_POST['telefono']; 
$celular = $_POST['celular']; 
$objetoempresa = $_POST['objetoempresa']; 
$res = $serviciosEmpresas->modificarEmpresas($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa); 
if ($res == true) { 
echo ''; 
} else { 
echo 'Huvo un error al modificar datos'; 
} 
} 
function eliminarEmpresas($serviciosEmpresas) { 
$id = $_POST['id']; 
$res = $serviciosEmpresas->eliminarEmpresas($id); 
echo $res; 
} 

/* Fin */


/* PARA Facturas */
function insertarFacturas($serviciosFacturas) {
$nrofactura = $_POST['nrofactura'];
$fecha = $_POST['fecha'];
$refcliente = $_POST['refcliente'];
$concepto = $_POST['concepto'];
$importebruto = $_POST['importebruto'];
$iva = $_POST['iva'];
$total = $_POST['total'];
$refempresa = $_POST['refempresa'];
$res = $serviciosFacturas->insertarFacturas($nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa);
if ((integer)$res > 0) {
echo '';
} else {
echo 'Huvo un error al insertar datos ';
}
}
function modificarFacturas($serviciosFacturas) {
$id = $_POST['id'];
$nrofactura = $_POST['nrofactura'];
$fecha = $_POST['fecha'];
$refcliente = $_POST['refcliente'];
$concepto = $_POST['concepto'];
$importebruto = $_POST['importebruto'];
$iva = $_POST['iva'];
$total = $_POST['total'];
$refempresa = $_POST['refempresa'];
$res = $serviciosFacturas->modificarFacturas($id,$nrofactura,$fecha,$refcliente,$concepto,$importebruto,$iva,$total,$refempresa);
if ($res == true) {
echo '';
} else {
echo 'Huvo un error al modificar datos';
}
}
function eliminarFacturas($serviciosFacturas) {
$id = $_POST['id'];
$res = $serviciosFacturas->eliminarFacturas($id);
echo $res;
}

/* Fin */ 

////////////////////////// FIN DE TRAER DATOS ////////////////////////////////////////////////////////////

//////////////////////////  BASICO  /////////////////////////////////////////////////////////////////////////

function toArray($query)
{
    $res = array();
    while ($row = @mysql_fetch_array($query)) {
        $res[] = $row;
    }
    return $res;
}


function entrar($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	echo $serviciosUsuarios->loginUsuario($email,$pass);
}


function registrar($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	$res = $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
	if ((integer)$res > 0) {
		echo '';	
	} else {
		echo $res;	
	}
}


function insertarUsuario($serviciosUsuarios) {
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->insertarUsuario($apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function modificarUsuario($serviciosUsuarios) {
	$id					=	$_POST['id'];
	$apellido			=	$_POST['apellido'];
	$password			=	$_POST['password'];
	$refroll			=	2;
	$email				=	$_POST['email'];
	$nombre				=	$_POST['nombre'];
	$telefono			=	'';
	$direccion			=	$_POST['direccion'];
	$imagen				=	'';
	$mime				=	'';
	$carpeta			=	'';
	$intentoserroneos	=	0;
	echo $serviciosUsuarios->modificarUsuario($id,$apellido,$password,$refroll,$email,$nombre,$telefono,$direccion,$imagen,$mime,$carpeta,$intentoserroneos);
}


function enviarMail($serviciosUsuarios) {
	$email		=	$_POST['email'];
	$pass		=	$_POST['pass'];
	
	echo $serviciosUsuarios->login($email,$pass);
}


function devolverImagen($nroInput) {
	
	if( $_FILES['archivo'.$nroInput]['name'] != null && $_FILES['archivo'.$nroInput]['size'] > 0 ){
	// Nivel de errores
	  error_reporting(E_ALL);
	  $altura = 100;
	  // Constantes
	  # Altura de el thumbnail en píxeles
	  //define("ALTURA", 100);
	  # Nombre del archivo temporal del thumbnail
	  //define("NAMETHUMB", "/tmp/thumbtemp"); //Esto en servidores Linux, en Windows podría ser:
	  //define("NAMETHUMB", "c:/windows/temp/thumbtemp"); //y te olvidas de los problemas de permisos
	  $NAMETHUMB = "c:/windows/temp/thumbtemp";
	  # Servidor de base de datos
	  //define("DBHOST", "localhost");
	  # nombre de la base de datos
	  //define("DBNAME", "portalinmobiliario");
	  # Usuario de base de datos
	  //define("DBUSER", "root");
	  # Password de base de datos
	  //define("DBPASSWORD", "");
	  // Mime types permitidos
	  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
	  // Variables de la foto
	  $name = $_FILES["archivo".$nroInput]["name"];
	  $type = $_FILES["archivo".$nroInput]["type"];
	  $tmp_name = $_FILES["archivo".$nroInput]["tmp_name"];
	  $size = $_FILES["archivo".$nroInput]["size"];
	  // Verificamos si el archivo es una imagen válida
	  if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen válida");
	  // Creando el thumbnail
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  $img = imagecreatefromjpeg($tmp_name);
		  break;
		case $mimetypes[2]:
		  $img = imagecreatefromgif($tmp_name);
		  break;
		case $mimetypes[3]:
		  $img = imagecreatefrompng($tmp_name);
		  break;
	  }
	  
	  $datos = getimagesize($tmp_name);
	  
	  $ratio = ($datos[1]/$altura);
	  $ancho = round($datos[0]/$ratio);
	  $thumb = imagecreatetruecolor($ancho, $altura);
	  imagecopyresized($thumb, $img, 0, 0, 0, 0, $ancho, $altura, $datos[0], $datos[1]);
	  switch($type) {
		case $mimetypes[0]:
		case $mimetypes[1]:
		  imagejpeg($thumb, $NAMETHUMB);
			  break;
		case $mimetypes[2]:
		  imagegif($thumb, $NAMETHUMB);
		  break;
		case $mimetypes[3]:
		  imagepng($thumb, $NAMETHUMB);
		  break;
	  }
	  // Extrae los contenidos de las fotos
	  # contenido de la foto original
	  $fp = fopen($tmp_name, "rb");
	  $tfoto = fread($fp, filesize($tmp_name));
	  $tfoto = addslashes($tfoto);
	  fclose($fp);
	  # contenido del thumbnail
	  $fp = fopen($NAMETHUMB, "rb");
	  $tthumb = fread($fp, filesize($NAMETHUMB));
	  $tthumb = addslashes($tthumb);
	  fclose($fp);
	  // Borra archivos temporales si es que existen
	  //@unlink($tmp_name);
	  //@unlink(NAMETHUMB);
	} else {
		$tfoto = '';
		$type = '';
	}
	$tfoto = utf8_decode($tfoto);
	return array('tfoto' => $tfoto, 'type' => $type);	
}


?>