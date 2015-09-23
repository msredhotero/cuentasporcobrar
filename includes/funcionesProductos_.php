<?php


date_default_timezone_set('America/Buenos_Aires');

class ServiciosProductos {

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}


/* negocio para los archivos */

function borrarDirecctorio($dir) {
	array_map('unlink', glob($dir."/*.*"));	
	
}

function borrarArchivo($id,$archivo) {
	$sql	=	"delete from pifotos where idfoto =".$id;
	
	$res =  unlink("./../archivos/".$archivo);
	if ($res)
	{
		$this->query($sql,0);	
	}
	return $res;
}

function TraerArchivo($id) {
	$sql	=	"select carpeta,archivo,concat(carpeta,'/',archivo) as nombrecompleto from dbarchivosclientes where idarchivos =".$id;
	return	mysql_result($this->query($sql,0),0,2);
}


function existeArchivo($idProducto,$nombre,$type) {
	$sql		=	"select * from pifotos where refproducto =".$idProducto." and imagen = '".$nombre."' and type = '".$type."'";
	$resultado  =   $this->query($sql,0);
           
           if(mysql_num_rows($resultado)>0){

               return mysql_result($resultado,0,0);

           }

           return 0;	
}

function subirArchivo($file,$idProducto) {
	$dir_destino = '../archivos/'.$idProducto.'/';
	$imagen_subida = $dir_destino . utf8_decode(str_replace(' ','',basename($_FILES[$file]['name'])));
	
	$noentrar = '../imagenes/index.php';
	$nuevo_noentrar = '../archivos/'.$idProducto.'/'.'index.php';
	
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
					
					if ($this->existeArchivo($idProducto,$archivo,$tipoarchivo) == 0) {
						$sql	=	"insert into pifotos(idfoto,refproducto,imagen,type) values ('',".$idProducto.",'".str_replace(' ','',$archivo)."','".$tipoarchivo."')";
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

/* fin archivos */



/* logica de negocio para los productos */


function traerProductos() {
	$sql = "select
				p.idproducto,
					p.producto,
					p.preciounit,
					p.precioventa,
					p.peso,
					concat('archivos/',p.idproducto,'/',f.imagen) as imagen,
					p.reftipoproducto,
					p.observacion,
					tp.tipoproducto
					from		cv_productos p

					inner
					join		cv_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1
					
					left
					join		pifotos f
					on			p.idproducto = f.refproducto
					
					order by p.fechacrea";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function traerProductosPorId($id) {
	$sql = "select
				p.idproducto,
					p.producto,
					p.preciounit,
					p.precioventa,
					p.peso,
					concat('archivos/',p.idproducto,'/',f.imagen) as imagen,
					p.reftipoproducto,
					p.observacion,
					tp.tipoproducto
					from		cv_productos p

					inner
					join		cv_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1
					
					left
					join		pifotos f
					on			p.idproducto = f.refproducto
					where		p.idproducto = ".$id."
					order by p.fechacrea";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}

function traerProductosPorCategoria($idCat) {
	$sql = "select
				p.idproducto,
					p.producto,
					p.preciounit,
					p.precioventa,
					p.peso,
					concat('archivos/',p.idproducto,'/',f.imagen) as imagen,
					p.reftipoproducto,
					p.observacion,
					tp.tipoproducto
					from		cv_productos p

					inner
					join		cv_tipoproducto tp
					on			p.reftipoproducto = tp.idtipoproducto and tp.activo = 1
					
					left
					join		pifotos f
					on			p.idproducto = f.refproducto
					where		tp.idtipoproducto = ".$idCat."
					order by p.fechacrea";
	$res = $this->query($sql,0) or die ('Hubo un error');
	return $res;
}




function insertarProducto($producto, $precio_unit, $precio_venta, $peso, $imagen, $mime, $reftipoproducto, $observacion) {
	$sql = "INSERT INTO cv_productos
						(idproducto,
						producto,
						preciounit,
						precioventa,
						peso,
						imagen,
						reftipoproducto,
						mime,
						observacion,
						fechacrea)
					VALUES
						('',
							'".utf8_decode(trim($producto))."',
							'".$precio_unit."',
							'".$precio_venta."',
							'".$peso."',
							'',
							'".$reftipoproducto."',
							'',
							'".$observacion."',
							'".date('Y-m-d')."')";
	$res = $this->query($sql,1);
	
	if ($res == false) {
		return 'Error al insertar datos';
	} else {
		return $res;
	}					
}


function modificarProducto($id, $producto, $precio_unit, $precio_venta, $peso, $imagen, $mime, $reftipoproducto, $observacion) {
	$sql = "UPDATE cv_productos
					SET
						producto = '".utf8_decode(trim($producto))."',
						preciounit = '".$precio_unit."',
						precioventa = '".$precio_venta."',
						peso = '".$peso."',
						imagen = '',
						reftipoproducto = '".$reftipoproducto."',
						mime = '',
						observacion = '".$observacion."'

						where idproducto = ".$id;
	$res = $this->query($sql,0);
	
	if ($res == false) {
		return 'Error al modificar datos';
	} else {
		return $id;
	}				
}

function eliminarProducto($id) {
	$sql = "delete from cv_productos where idproducto = ".$id;
	$res = $this->query($sql,0);
	
	if ($res == false) {
		return 'Error al eliminar datos';
	} else {
		return '';
	}
}


/* fin */



Function query($sql,$accion) {
		
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();	
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
        

		
		$conex = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		mysql_select_db($database);
		/*
		$result = mysql_query($sql,$conex);
		if ($accion && $result) {
			$result = mysql_insert_id();
		}
		mysql_close($conex);
		return $result;
		*/
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