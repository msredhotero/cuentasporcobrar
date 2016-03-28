<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosTipoSocios {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


/* PARA TipoSocios */

function insertarTipoSocios($tiposocio,$activo) { 
$sql = "insert into tbtiposocios(idtiposocio,tiposocio,activo) 
values ('','".utf8_decode($tiposocio)."',".$activo.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarTipoSocios($id,$tiposocio,$activo) { 
$sql = "update tbtiposocios 
set 
tiposocio = '".utf8_decode($tiposocio)."',activo = ".$activo." 
where idtiposocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarTipoSocios($id) { 
$sql = "delete from tbtiposocios where idtiposocio =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoSocios() { 
$sql = "select idtiposocio,tiposocio,activo from tbtiposocios order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerTipoSociosPorId($id) { 
$sql = "select idtiposocio,tiposocio,activo from tbtiposocios where idtiposocio =".$id; 
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