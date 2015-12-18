<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosEmpresaBancos {



/* PARA EmpresaBancos */

function insertarEmpresaBancos($refempresa,$banco,$sucursal,$cuenta,$clave) { 
$sql = "insert into dbempresasbancos(idempresabanco,refempresa,banco,sucursal,cuenta,clave) 
values ('',".$refempresa.",'".utf8_decode($banco)."','".utf8_decode($sucursal)."','".utf8_decode($cuenta)."','".utf8_decode($clave)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEmpresaBancos($id,$refempresa,$banco,$sucursal,$cuenta,$clave) { 
$sql = "update dbempresasbancos 
set 
refempresa = ".$refempresa.",banco = '".utf8_decode($banco)."',sucursal = '".utf8_decode($sucursal)."',cuenta = '".utf8_decode($cuenta)."',clave = '".utf8_decode($clave)."' 
where idempresabanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEmpresaBancos($id) { 
$sql = "delete from dbempresasbancos where idempresabanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresaBancos() { 
$sql = "select idempresabanco,refempresa,banco,sucursal,cuenta,clave from dbempresasbancos order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresaBancosPorId($id) { 
$sql = "select idempresabanco,refempresa,banco,sucursal,cuenta,clave from dbempresasbancos where idempresabanco =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerEmpresaBancosPorEmpresa($idEmpresa) { 
$sql = "select eb.idempresabanco,e.razonsocial,eb.banco,eb.sucursal,eb.cuenta,eb.clave ,eb.refempresa
			from dbempresasbancos eb 
			inner join dbempresas e on eb.refempresa = e.idempresa 
			where e.idempresa = ".$idEmpresa."
			order by 1"; 
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