<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosSocios {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


///**********  PARA SUBIR ARCHIVOS  ***********************//////////////////////////
	function borrarDirecctorio($dir) {
		array_map('unlink', glob($dir."/*.*"));	
	
	}
	
	function borrarArchivo($id,$archivo) {
		$sql	=	"delete from dbfotos where idfoto =".$id;
		
		$res =  unlink("./../archivos/".$archivo);
		if ($res)
		{
			$this->query($sql,0);	
		}
		return $res;
	}
	
	
	function existeArchivo($idSocio,$nombre,$type) {
		$sql		=	"select * from dbfotos where refsocio =".$idSocio." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysql_num_rows($resultado)>0){
	
				   return mysql_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}


	function subirArchivo($file,$carpeta,$idSocio) {
		$dir_destino = '../archivos/'.$carpeta.'/'.$idSocio.'/';
		$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idSocio.'/'.'index.php';
		
		if (!file_exists($dir_destino)) {
			mkdir($dir_destino, 0777);
		}
		
		 
		if(!is_writable($dir_destino)){
			
			echo "no tiene permisos";
			
		}	else	{
			if ($_FILES[$file]['tmp_name'] != '') {
				if(is_uploaded_file($_FILES[$file]['tmp_name'])){
					/*echo "Archivo ". $_FILES['foto']['name'] ." subido con éxtio.\n";
					echo "Mostrar contenido\n";
					echo $imagen_subida;*/
					if (move_uploaded_file($_FILES[$file]['tmp_name'], $imagen_subida)) {
						
						$archivo = utf8_decode($_FILES[$file]["name"]);
						$tipoarchivo = $_FILES[$file]["type"];
						
						if ($this->existeArchivo($idSocio,$archivo,$tipoarchivo) == 0) {
							$sql	=	"insert into dbfotos(idfoto,refsocio,imagen,type) values ('',".$idSocio.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
							$this->query($sql,1);
						}
						echo "";
						
						copy($noentrar, $nuevo_noentrar);
		
					} else {
						echo "Posible ataque de carga de archivos!\n";
					}
				}else{
					echo "Posible ataque del archivo subido: ";
					echo "nombre del archivo '". $_FILES[$file]['tmp_name'] . "'.";
				}
			}
		}	
	}


	
	function TraerFotosNoticias($idSocio) {
		$sql    =   "select 'galeria',s.idsocio,f.imagen,f.idfoto,f.type
							from dbsocios s
							
							inner
							join dbfotos f
							on	s.idsocio = f.refsocio

							where s.idsocio = ".$idSocio;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',s.idsocio,'/',f.imagen) as archivo
							from dbsocios s
							
							inner
							join dbfotos f
							on	s.idsocio = f.refsocio

							where f.idfoto =".$id;
		$resImg		=	$this->query($sql,0);
		
		$res 		=	$this->borrarArchivo($id,mysql_result($resImg,0,0));
		
		if ($res == false) {
			return 'Error al eliminar datos';
		} else {
			return '';
		}
	}

/* fin archivos */

/* PARA Socios */

function existeSocio($ife) {
	$sql = "select * from dbsocios where ife = '".$ife."'";
	$res = $this->query($sql,0); 
	
	if (mysql_num_rows($res)>0) {
		return 1;	
	}
	return 0;
}

function insertarSocios($reftiposocio,$ife,$nombre,$domicilio,$curp,$rfc) { 
$sql = "insert into dbsocios(idsocio,reftiposocio,nombre,ife,domicilio,curp,rfc) 
values ('',".$reftiposocio.",'".utf8_decode($nombre)."','".$ife."','".utf8_decode($domicilio)."','".utf8_decode($curp)."','".utf8_decode($rfc)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarSocios($id,$reftiposocio,$ife,$nombre,$domicilio,$curp,$rfc) { 
$sql = "update dbsocios 
set 
reftiposocio = ".$reftiposocio.",ife = '".$ife."',nombre = '".utf8_decode($nombre)."',domicilio = '".utf8_decode($domicilio)."',curp = '".utf8_decode($curp)."',rfc = '".utf8_decode($rfc)."' 
where idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarSocios($id) { 
$sql = "delete from dbsocios where idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSocios() { 
$sql = "select s.idsocio, s.ife, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		where ts.activo = 1
		order by 3"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSociosPorId($id) { 
$sql = "select s.idsocio, s.reftiposocio, s.ife, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio 
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		where s.idsocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
}

function traerSociosPorEmpresa($idempresa) { 
$sql = "select s.idsocio,s.ife, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		inner join dbsociosempresas se on se.refsocio = s.idsocio
		inner join dbempresas e on se.refempresa = e.idempresa
		where ts.activo = 1 and e.idempresa = ".$idempresa."
		order by 3"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSociosPorNombreEmpresa($empresa) { 
$sql = "select s.idsocio,s.ife, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio, e.razonsocial ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		inner join dbsociosempresas se on se.refsocio = s.idsocio
		inner join dbempresas e on se.refempresa = e.idempresa
		where ts.activo = 1 and e.razonsocial like '%".$empresa."%'
		order by 3"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerSociosPorNombre($socio) { 
$sql = "select s.idsocio,s.ife, s.nombre, s.domicilio, s.curp, s.rfc, ts.tiposocio, e.razonsocial ,s.reftiposocio
		from dbsocios s 
		inner join tbtiposocios ts on ts.idtiposocio = s.reftiposocio
		inner join dbsociosempresas se on se.refsocio = s.idsocio
		inner join dbempresas e on se.refempresa = e.idempresa
		where ts.activo = 1 and s.nombre like '%".$socio."%'
		order by 3"; 
$res = $this->query($sql,0); 
return $res; 
} 
 

/* Fin */

function query($sql,$accion) {
		
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		
		        $error = 0;
		mysql_query("BEGIN");
		$result=mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		if(!$result){
			$error=1;
		}
		if($error==1){
			mysql_query("ROLLBACK");
			return false;
		}
		 else{
			mysql_query("COMMIT");
			return $result;
		}
		
	}

}

?>