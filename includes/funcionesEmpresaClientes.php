<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosEmpresaClientes {

/* PARA EmpresaClientes */

function insertarEmpresaClientes($refempresa,$refcliente) { 
$sql = "insert into dbempresaclientes(idempresacliente,refempresa,refcliente) 
values ('',".$refempresa.",".$refcliente.")"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEmpresaClientes($id,$refempresa,$refcliente) { 
$sql = "update dbempresaclientes 
set 
refempresa = ".$refempresa.",refcliente = ".$refcliente." 
where idempresacliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarEmpresaClientes($id) { 
$sql = "delete from dbempresaclientes where idempresacliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresaClientes() { 
$sql = "select idempresacliente,refempresa,refcliente from dbempresaclientes order by 1"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresaClientesPorId($id) { 
$sql = "select idempresacliente,refempresa,refcliente from dbempresaclientes where idempresacliente =".$id; 
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