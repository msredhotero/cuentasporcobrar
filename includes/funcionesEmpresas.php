<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosEmpresas {

/* PARA Empresas */

function insertarEmpresas($razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa) { 
$sql = "insert into dbempresas(idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa) 
values ('','".utf8_decode($razonsocial)."','".utf8_decode($rfc)."','".utf8_decode($direccion)."','".utf8_decode($email)."','".utf8_decode($telefono)."','".utf8_decode($celular)."','".utf8_decode($objetoempresa)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEmpresas($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa) { 
$sql = "update dbempresas 
set 
razonsocial = '".utf8_decode($razonsocial)."',rfc = '".utf8_decode($rfc)."',direccion = '".utf8_decode($direccion)."',email = '".utf8_decode($email)."',telefono = '".utf8_decode($telefono)."',celular = '".utf8_decode($celular)."',objetoempresa = '".utf8_decode($objetoempresa)."' 
where idempresa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEmpresas($id) { 
$sql = "delete from dbempresas where idempresa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresas() { 
$sql = "select idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa from dbempresas order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresasPorId($id) { 
$sql = "select idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa from dbempresas where idempresa =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

	function cambiarEmpresa($idempresa) {
	
		session_start();
		
		$sqlEmpresa = "select razonsocial from dbempresas where idempresa =".$idempresa;
		$resEmpresa = $this->query($sqlEmpresa,0);
		
		$_SESSION['usua_idempresa'] = $idempresa;
		$_SESSION['usua_empresa'] = mysql_result($resEmpresa,0,0);
		
		return true;
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