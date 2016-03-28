<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosSociosEmpresas {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


/* PARA SociosEmpresas */

function insertarSociosEmpresas($refsocio,$refempresa) { 
$sql = "insert into dbsociosempresas(iddbsocioempresa,refsocio,refempresa) 
values ('',".$refsocio.",".$refempresa.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarSociosEmpresas($id,$refsocio,$refempresa) { 
$sql = "update dbsociosempresas 
set 
refsocio = ".$refsocio.",refempresa = ".$refempresa." 
where iddbsocioempresa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarSociosEmpresas($id) { 
$sql = "delete from dbsociosempresas where iddbsocioempresa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSociosEmpresas() { 
$sql = "select iddbsocioempresa,refsocio,refempresa from dbsociosempresas order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerSociosEmpresasPorId($id) { 
$sql = "select iddbsocioempresa,refsocio,refempresa from dbsociosempresas where iddbsocioempresa =".$id; 
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