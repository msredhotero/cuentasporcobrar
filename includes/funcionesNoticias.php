<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosNoticias {
	
	
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
	
	
	function existeArchivo($refinmueble,$nombre,$type) {
		$sql		=	"select * from dbfotos where refnoticia =".$refinmueble." and imagen = '".$nombre."' and type = '".$type."'";
		$resultado  =   $this->query($sql,0);
			   
			   if(mysql_num_rows($resultado)>0){
	
				   return mysql_result($resultado,0,0);
	
			   }
	
			   return 0;	
	}


	function subirArchivo($file,$carpeta,$idInmueble) {
		$dir_destino = '../archivos/'.$carpeta.'/'.$idInmueble.'/';
		$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
		
		$noentrar = '../imagenes/index.php';
		$nuevo_noentrar = '../archivos/'.$carpeta.'/'.$idInmueble.'/'.'index.php';
		
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
						
						if ($this->existeArchivo($idInmueble,$archivo,$tipoarchivo) == 0) {
							$sql	=	"insert into dbfotos(idfoto,refnoticia,imagen,type) values ('',".$idInmueble.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
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


	
	function TraerFotosNoticias($idNoticia) {
		$sql    =   "select 'galeria',i.idnoticia,f.imagen,f.idfoto
							from dbnoticias i
							
							inner
							join dbfotos f
							on	i.idnoticia = f.refnoticia

							where i.idnoticia = ".$idNoticia;
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	
	function eliminarFoto($id)
	{
		
		$sql		=	"select concat('galeria','/',i.idnoticia,'/',f.imagen) as archivo
							from dbnoticias i
							
							inner
							join dbfotos f
							on	i.idnoticia = f.refnoticia

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
/*
CREATE TABLE `dbfotos` (
  `idfoto` int(11) NOT NULL AUTO_INCREMENT,
  `refnoticia` int(11) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `principal` bit(1) DEFAULT NULL,
  PRIMARY KEY (`idfoto`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


*/

	function insertarNoticiasPrincipales($titulo,$noticiaprincipal,$fechacreacion) {
	$sql = "insert into dbnoticiaprincipal(idnoticiaprincipal,titulo,noticiaprincipal,fechacreacion)
	values ('','".utf8_decode($titulo)."','".utf8_decode($noticiaprincipal)."','".utf8_decode($fechacreacion)."')";
	$res = $this->query($sql,1);
	return $res;
	}
	
	
	function modificarNoticiasPrincipales($id,$titulo,$noticiaprincipal,$fechacreacion) {
	$sql = "update dbnoticiaprincipal
	set
	titulo = '".utf8_decode($titulo)."',noticiaprincipal = '".utf8_decode($noticiaprincipal)."',fechacreacion = '".utf8_decode($fechacreacion)."'
	where idnoticiaprincipal =".$id;
	$res = $this->query($sql,0);
	return $res;
	}
	
	
	function eliminarNoticiasPrincipales($id) {
	$sql = "delete from dbnoticiaprincipal where idnoticiaprincipal =".$id;
	$res = $this->query($sql,0);
	return $res;
	}
	
	function traerNoticiaPrincipal() {
		$sql = "select idnoticiaprincipal,titulo,noticiaprincipal,fechacreacion from dbnoticiaprincipal order by fechacreacion";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerUltimaNoticiaPrincipal() {
		$sql = "select * from dbnoticiaprincipal order by idnoticiaprincipal desc limit 1";
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function traerNoticiaPrincipalPorId($id) {
		$sql = "select * from dbnoticiaprincipal where idnoticiaprincipal =".$id;
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function insertarNoticiasPredio($titulo,$noticiapredio,$fechacreacion) {
$sql = "insert into dbnoticiapredio(idnoticiapredio,titulo,noticiapredio,fechacreacion)
values ('','".utf8_decode($titulo)."','".utf8_decode($noticiapredio)."','".utf8_decode($fechacreacion)."')";
$res = $this->query($sql,1);
return $res;
}


function modificarNoticiasPredio($id,$titulo,$noticiapredio,$fechacreacion) {
$sql = "update dbnoticiapredio
set
titulo = '".utf8_decode($titulo)."',noticiapredio = '".utf8_decode($noticiapredio)."',fechacreacion = '".utf8_decode($fechacreacion)."'
where idnoticiapredio =".$id;
$res = $this->query($sql,0);

return $res;
}


function eliminarNoticiasPredio($id) {
$sql = "delete from dbnoticiapredio where idnoticiapredio =".$id;
$res = $this->query($sql,0);
return $res;
} 


	function traerNoticiaPredio() {
		$sql = "select idnoticiapredio,titulo,noticiapredio,fechacreacion from dbnoticiapredio order by fechacreacion";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerUltimaNoticiaPredio() {
		$sql = "select * from dbnoticiapredio order by idnoticiapredio desc limit 1";
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function traerNoticiaPredioPorId($id) {
		$sql = "select * from dbnoticiapredio where idnoticiapredio =".$id;
		$res = $this->query($sql,0);
		return $res;
	}


function insertarNoticias($titulo,$parrafo,$fechacreacion,$galeria) {
$sql = "insert into dbnoticias(idnoticia,titulo,parrafo,fechacreacion,galeria)
values ('','".utf8_decode($titulo)."','".utf8_decode($parrafo)."','".utf8_decode($fechacreacion)."',".$galeria.")";
//return $sql;
$res = $this->query($sql,1);
return $res;
}


function modificarNoticias($id,$titulo,$parrafo,$fechacreacion,$galeria) {
$sql = "update dbnoticias
set
titulo = '".utf8_decode($titulo)."',parrafo = '".utf8_decode($parrafo)."',fechacreacion = '".utf8_decode($fechacreacion)."',galeria = ".$galeria."
where idnoticia =".$id;
$res = $this->query($sql,0);
return $res;
}


function eliminarNoticias($id) {
$sql = "delete from dbnoticias where idnoticia =".$id;
$res = $this->query($sql,0);
return $res;
} 

	function traerNoticias() {
		$sql = "select idnoticia,titulo,fechacreacion,parrafo, 
						(case when galeria = 1 then '1' else '0' end) as galeria
					from dbnoticias order by fechacreacion";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerUltimaNoticias() {
		$sql = "select idnoticia,titulo,fechacreacion,parrafo, 
						(case when galeria = 1 then '1' else '0' end) as galeria from dbnoticias order by fechacreacion desc limit 1";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerNoticiasMenos($idnoticia) {
		$sql = "select idnoticia,titulo,fechacreacion,parrafo, 
						(case when galeria = 1 then '1' else '0' end) as galeria from dbnoticias where idnoticia <> ".$idnoticia." order by fechacreacion desc";
		$res = $this->query($sql,0);
		return $res;
	}
	
	function traerPrimerImagenNoticiaPorId($idNoticia) {
		$sql    =   "select 'galeria',i.idnoticia,f.imagen,f.idfoto
							from dbnoticias i
							
							inner
							join dbfotos f
							on	i.idnoticia = f.refnoticia

							where i.idnoticia = ".$idNoticia." limit 1";
		$result =   $this->query($sql, 0);
		return $result;
	}
	
	function traerNoticiasMenosHasta($idnoticia, $hasta) {
		$sql = "select idnoticia,titulo,fechacreacion,parrafo, 
						(case when galeria = 1 then '1' else '0' end) as galeria from dbnoticias where idnoticia <> ".$idnoticia." order by fechacreacion desc limit 0,".$hasta;
		$res = $this->query($sql,0);
		return $res;
	}
	
	
	function traerNoticiasPorId($id) {
		$sql = "select idnoticia,titulo,fechacreacion,parrafo, 
						(case when galeria = 1 then '1' else '0' end) as galeria from dbnoticias where idnoticia =".$id;
		$res = $this->query($sql,0);
		return $res;
	}
	
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
		
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		
	}
	}

?>