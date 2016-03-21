<?php

/**
 * @Usuarios clase en donde se accede a la base de datos
 * @ABM consultas sobre las tablas de usuarios y usarios-clientes
 */

date_default_timezone_set('America/Buenos_Aires');

class ServiciosEmpresas {

/* PARA Empresas */

function insertarEmpresas($razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa,$notaria,$notario,$giro,$socia_a,$socio_b,$administrador,$comisario,$apoderado,$rpp,$plataforma,$usuario,$contrasenia,$contraseniaemail,$cuenta) { 
$sql = "insert into dbempresas(idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa,notaria,notario,giro,socia_a,socio_b,administrador,comisario,apoderado,rpp,plataforma,usuario,contrasenia,contraseniaemail,cuenta) 
values ('','".utf8_decode($razonsocial)."','".utf8_decode($rfc)."','".utf8_decode($direccion)."','".utf8_decode($email)."','".utf8_decode($telefono)."','".utf8_decode($celular)."','".utf8_decode($objetoempresa)."','".utf8_decode($notaria)."','".utf8_decode($notario)."','".utf8_decode($giro)."','".utf8_decode($socia_a)."','".utf8_decode($socio_b)."','".utf8_decode($administrador)."','".utf8_decode($comisario)."','".utf8_decode($apoderado)."','".utf8_decode($rpp)."','".utf8_decode($plataforma)."','".utf8_decode($usuario)."','".utf8_decode($contrasenia)."','".utf8_decode($contraseniaemail)."','".utf8_decode($cuenta)."')";
$res = $this->query($sql,1); 
return $res; 
} 


function modificarEmpresas($id,$razonsocial,$rfc,$direccion,$email,$telefono,$celular,$objetoempresa,$notaria,$notario,$giro,$socia_a,$socio_b,$administrador,$comisario,$apoderado,$rpp,$plataforma,$usuario,$contrasenia,$contraseniaemail,$cuenta) { 
$sql = "update dbempresas 
set 
razonsocial = '".utf8_decode($razonsocial)."',rfc = '".utf8_decode($rfc)."',direccion = '".utf8_decode($direccion)."',email = '".utf8_decode($email)."',telefono = '".utf8_decode($telefono)."',celular = '".utf8_decode($celular)."',objetoempresa = '".utf8_decode($objetoempresa)."',notaria = '".utf8_decode($notaria)."',notario = '".utf8_decode($notario)."',giro = '".utf8_decode($giro)."',socia_a = '".utf8_decode($socia_a)."',socio_b = '".utf8_decode($socio_b)."',administrador = '".utf8_decode($administrador)."',comisario = '".utf8_decode($comisario)."',apoderado = '".utf8_decode($apoderado)."',rpp = '".utf8_decode($rpp)."',plataforma = '".utf8_decode($plataforma)."',usuario = '".utf8_decode($usuario)."',contrasenia = '".utf8_decode($contrasenia)."' ,contraseniaemail = '".utf8_decode($contraseniaemail)."' ,cuenta = '".utf8_decode($cuenta)."' 
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
$sql = "select idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa,notaria,notario,giro,socia_a,socio_b,administrador,comisario,apoderado,rpp,plataforma,usuario,contrasenia,contraseniaemail,cuenta from dbempresas order by 2"; 
$res = $this->query($sql,0); 
return $res; 
} 


function traerEmpresasPorId($id) { 
$sql = "select idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa,notaria,notario,giro,socia_a,socio_b,administrador,comisario,apoderado,rpp,plataforma,usuario,contrasenia,contraseniaemail,cuenta from dbempresas where idempresa =".$id; 
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