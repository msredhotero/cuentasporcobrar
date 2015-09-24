<?php

date_default_timezone_set('America/Buenos_Aires');


class ServiciosHTML {

function menu($usuario,$titulo,$rol,$empresa) {
	
	$sql = "select idmenu,url,icono, nombre, permiso from predio_menu where permiso like '%".$rol."%' order by orden";
	$res = $this->query($sql,0);
	
	$cadmenu = "";
	$cadhover= "";
	
	$cant = 1;
	while ($row = mysql_fetch_array($res)) {
		if ($titulo == $row['nombre']) {
			$nombre = $row['nombre'];
			$row['url'] = "index.php";	
		}
		
		if (strpos($row['permiso'],$rol) !== false) {
			if ($row['idmenu'] == 1) {
				$cadmenu = $cadmenu.'<li class="arriba"><div class="'.$row['icono'].'"></div><a href="'.$row['url'].'">'.$row['nombre'].'</a></li>';
				$cadhover = $cadhover.' <li class="arriba">
											<div class="'.$row['icono'].'2" id="tooltip'.$cant.'"></div>
											<div class="tooltip-dash">'.$row['nombre'].'</div>
										</li>';	
			} else {
				$cadmenu = $cadmenu.'<li><div class="'.$row['icono'].'"></div><a href="'.$row['url'].'">'.$row['nombre'].'</a></li>';
				$cadhover = $cadhover.'  <li>
											<div class="'.$row['icono'].'2" id="tooltip'.$cant.'"></div>
											<div class="tooltip-con">'.$row['nombre'].'</div>
										</li>';
			}
		}
		$cant+=1;
	}
	
	
	$menu = '
		<div style="background-color:#333; position:absolute; top:0;left:0; height:35px; width:100%; color:#FFF; padding-top:7px;" align="right">
			
			<ul class="list-inline">
				<li><span class="glyphicon glyphicon-user"></span> '.$usuario.'</li>
				<li style="color:#FC0;">'.$empresa.' <a href="../empresa/cambiarempresa.php"> Cambiar</a></li>    
			</ul>
		</div>
		 
		<div style="height:30px;">
		
		</div> 
	
		<div id="navigation" >
			
			
				<nav class="nav">
					<ul>
						'.$cadmenu.'
					</ul>
				</nav>
				
				
			 </div>

		</div>';
	
	return $menu;
	
}



function validacion($tabla) {
	$sql	=	"show columns from ".$tabla;
	$res 	=	$this->query($sql,0);
	
	$formJquery = '';
	$formValidador = '';
	
	$links = '$(".ver").click(function(event){
			url = "ver.php";
			$(location).attr("href",url);
	});//fin del boton eliminar
	
	$(".varborrar").click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			$("#idEliminar").val(usersid);
			$("#dialog2").dialog("open");
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton eliminar
	
	$(".varmodificar").click(function(event){
		  usersid =  $(this).attr("id");
		  if (!isNaN(usersid)) {
			url = "modificar.php?id=" + usersid;
			$(location).attr("href",url);
		  } else {
			alert("Error, vuelva a realizar la acción.");	
		  }
	});//fin del boton modificar';
	
	if ($res == false) {
		return 'Error al traer datos';
	} else {
		
		$jquery	=	'';
		$cuerpoValidacion = '';
		
		while ($row = mysql_fetch_array($res)) {
			if (($row[3] != 'PRI') && ($row[2] == 'NO')) {
				if (strpos($row[1],"decimal") !== false) {
					//debo validar que sea un numero
					
					$jquery	=	$jquery.'
					
					$("#'.$row[0].'").click(function(event) {
						$("#'.$row[0].'").removeClass("alert-danger");
						if ($(this).val() == "") {
							$("#'.$row[0].'").attr("value","");
							$("#'.$row[0].'").attr("placeholder","Ingrese el '.ucwords($row[0]).'...");
						}
					});
				
					$("#'.$row[0].'").change(function(event) {
						$("#'.$row[0].'").removeClass("alert-danger");
						$("#'.$row[0].'").attr("placeholder","Ingrese el '.ucwords($row[0]).'");
					});
					
					';
					
					$cuerpoValidacion = $cuerpoValidacion.'
					
						if ($("#'.$row[0].'").val() == "") {
							$error = "Es obligatorio el campo '.ucwords($row[0]).'.";
							$("#'.$row[0].'").addClass("alert-danger");
							$("#'.$row[0].'").attr("placeholder",$error);
						}
					
					';
					
					
				} else {
					if ($row[0] == "refroll") {
						$label = "Rol";
						$campo = $row[0];
						
						$jquery	=	$jquery.'
					
						$("#'.$campo.'").click(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							if ($(this).val() == "") {
								$("#'.$campo.'").attr("value","");
								$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'...");
							}
						});
					
						$("#'.$campo.'").change(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'");
						});
						
						';
						
						
						$cuerpoValidacion = $cuerpoValidacion.'
					
							if ($("#'.$campo.'").val() == "") {
								$error = "Es obligatorio el campo '.$label.'.";
								$("#'.$campo.'").addClass("alert-danger");
								$("#'.$campo.'").attr("placeholder",$error);
							}
						
						';
						
					} else {
						$label = ucwords($row[0]);
						$campo = $row[0];
						
						$jquery	=	$jquery.'
					
						$("#'.$campo.'").click(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							if ($(this).val() == "") {
								$("#'.$campo.'").attr("value","");
								$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'...");
							}
						});
					
						$("#'.$campo.'").change(function(event) {
							$("#'.$campo.'").removeClass("alert-danger");
							$("#'.$campo.'").attr("placeholder","Ingrese el '.$label.'");
						});
						
						';
						
						
						$cuerpoValidacion = $cuerpoValidacion.'
					
							if ($("#'.$campo.'").val() == "") {
								$error = "Es obligatorio el campo '.$label.'.";
								$("#'.$campo.'").addClass("alert-danger");
								$("#'.$campo.'").attr("placeholder",$error);
							}
						
						';
					}
					
					
				}
			}
		}
		
		$formJquery = $formJquery.$jquery;
		
		$formValidador = $formValidador.'
			function validador(){

					$error = "";
					'.$cuerpoValidacion.'
					return $error;
			}
		';
		
		return $links.$formJquery.$formValidador;
	}	
}


function footer() {
	echo "<!--comienzo del footer-->
<div id='footer'>
<div id='dentroFooter'>
<div align='center'>
<table width='800'>
<tr valign='top'>
<td align='left'>
<h4>Link's de interes</h4>
<ul>
<li><a href='http://www.grandt.clarin.com/'>Gran DT</a></li>
<li><a href='http://www.ole.com.ar/'>OLE</a></li>
<li><a href='http://www.foxsportsla.com/ar/'>Fox Sport</a></li>
<li><a href='http://www.afa.org.ar/'>AFA</a></li>
</ul>
</td>
<td align='left'>
<h4>Noticias</h4>
<ul>
<li><a href='http://www.eldia.com.ar/'>El Dia</a></li>
<li><a href='http://www.clarin.com/'>Clarin</a></li>
<li><a href='http://diariohoy.net/'>Hoy</a></li>
<li><a href='http://www.lanacion.com.ar/'>La Nación</a></li>
</ul>
</td>
<td align='left'>
<h4>Recursos</h4>
<ul>
<li><a href='http://www.hotmail.com/'>Hotmail</a></li>
<li><a href='http://ar.yahoo.com/'>Yahoo</a></li>
<li><a href='http://www.google.com.ar/'>Google</a></li>

</ul>
</td>
</tr>
</table>
</div>
</div>

   <div id='yo' align='center'>
   <br />
<p>© Copyright 2013 | ComplejoShowBol - La PLata, Buenos Aires. Diseño Web: Saupurein Marcos y Saupurein Javier .Tel:(0221)15-6184415</p>
</div>
</div><!--fin del footer-->";
}

function query($sql,$accion) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
/*		$hostname = "localhost";
		$database = "lacalder_diablo";
		$username = "lacalderadeldiab";
		$password = "caldera4415";
		*/
		
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