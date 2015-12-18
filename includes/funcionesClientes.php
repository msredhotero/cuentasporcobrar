<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosClientes {

/* PARA Clientes */

function insertarClientes($razonsocial,$rfc,$direccion,$email,$telefono,$celular) { 
$sql = "insert into dbclientes(idcliente,razonsocial,rfc,direccion,email,telefono,celular) 
values ('','".utf8_decode($razonsocial)."','".utf8_decode($rfc)."','".utf8_decode($direccion)."','".utf8_decode($email)."','".utf8_decode($telefono)."','".utf8_decode($celular)."')"; 
$res = $this->query($sql,1); 
return $res; 
} 


function modificarClientes($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular) { 
$sql = "update dbclientes 
set 
razonsocial = '".utf8_decode($razonsocial)."',rfc = '".utf8_decode($rfc)."',direccion = '".utf8_decode($direccion)."',email = '".utf8_decode($email)."',telefono = '".utf8_decode($telefono)."',celular = '".utf8_decode($celular)."' 
where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function eliminarClientes($id) { 
$sql = "delete from dbclientes where idcliente =".$id; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientes() { 
$sql = "select c.idcliente, c.razonsocial, c.rfc, c.direccion, c.email, c.telefono, c.celular 
		from dbclientes c order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 

function traerClientesPorEmpresa($idEmpresa) {
$sql = "select c.idcliente, c.razonsocial, c.rfc, c.direccion, c.email, c.telefono, c.celular 
		from dbclientes c 
		inner join dbempresaclientes ec on ec.refcliente = c.idcliente
		inner join dbempresas e on ec.refempresa = e.idempresa
		where e.idempresa = ".$idEmpresa." 
		order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerClientesPorId($id) { 
$sql = "select idcliente,razonsocial,rfc,direccion,email,telefono,celular from dbclientes where idcliente =".$id; 
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