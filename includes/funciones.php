<?php

/**
 * @author www.intercambiosvirtuales.org
 * @copyright 2013
 */
date_default_timezone_set('America/Buenos_Aires');

class Servicios {
	


	function camposTablaView($cabeceras,$datos,$cantidad) {
		$cadView = '';
		$cadRows = '';
		$classVer = '';
		switch ($cantidad) {
			case 99:
				$cantidad = 8;
				$classMod = 'varmodificar';
				$classEli = 'varborrar';
				$idresultados = "resultados";
				break;
			case 98:
				$cantidad = 3;
				$classMod = 'varmodificarpredio';
				$classEli = 'varborrarpredio';
				$idresultados = "resultadospredio";
				break;
			case 97:
				$cantidad = 3;
				$classMod = 'varmodificarprincipal';
				$classEli = 'varborrarprincipal';
				$idresultados = "resultadosprincipal";
				break;
			case 96:
				$cantidad = 6;
				$classMod = 'varmodificarsin';
				$classEli = 'varborrar';
				$classEliRel = 'varborrarrelacion';
				$classVer = 'varver';
				$idresultados = "resultadosprincipal";
				break;
			case 95:
				$cantidad = 7;
				$classMod = 'varmodificarsin';
				$classEli = 'varborrar';
				$classVer = 'varver';
				$classEliRel = 'varborrarrelacion';
				$idresultados = "resultadosprincipal";
				break;
			default:
				$classMod = 'varmodificar';
				$classEli = 'varborrar';
				$idresultados = "resultados";
		}
		/*if ($cantidad == 99) {
			$cantidad = 5;
			$classMod = 'varmodificargoleadores';
			$classEli = 'varborrargoleadores';
			$idresultados = "resultadosgoleadores";
		} else {
			$classMod = 'varmodificar';
			$classEli = 'varborrar';
			$idresultados = "resultados";
		}*/
		while ($row = mysql_fetch_array($datos)) {
			$cadsubRows = '';
			$cadRows = $cadRows.'
			
					<tr class="'.$row[0].'">
                        	';
			
			
			for ($i=1;$i<=$cantidad;$i++) {
				
				$cadsubRows = $cadsubRows.'<td><div style="height:60px;overflow:auto;">'.htmlspecialchars($row[$i],ENT_HTML5).'</div></td>';	
			}
			
			
			if ($classMod != '') { 
				if ($classVer != '') {
					$cadRows = $cadRows.'
									'.$cadsubRows.'
									<td>
										
										<div class="btn-group">
											<button class="btn btn-success" type="button">Acciones</button>
											
											<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
											</button>
											
											<ul class="dropdown-menu" role="menu">
											   
												<li>
												<a href="javascript:void(0)" class="'.$classMod.'" id="'.$row[0].'">Modificar</a>
												</li>
											
												<li>
												<a href="javascript:void(0)" class="'.$classEli.'" id="'.$row[0].'">Borrar</a>
												</li>
												
												<li>
												<a href="javascript:void(0)" class="'.$classEliRel.'" id="'.$row[0].'">Borrar Relación</a>
												</li>
												
												<li>
												<a href="javascript:void(0)" class="'.$classVer.'" id="'.$row[0].'">Ver</a>
												</li>
												
											</ul>
										</div>
									</td>
								</tr>
					';

				} else {
					$cadRows = $cadRows.'
									'.$cadsubRows.'
									<td>
										
										<div class="btn-group">
											<button class="btn btn-success" type="button">Acciones</button>
											
											<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
											<span class="caret"></span>
											<span class="sr-only">Toggle Dropdown</span>
											</button>
											
											<ul class="dropdown-menu" role="menu">
											   
												<li>
												<a href="javascript:void(0)" class="'.$classMod.'" id="'.$row[0].'">Modificar</a>
												</li>
											
												<li>
												<a href="javascript:void(0)" class="'.$classEli.'" id="'.$row[0].'">Borrar</a>
												</li>
												
											</ul>
										</div>
									</td>
								</tr>
					';
				}
			} else {
				$cadRows = $cadRows.'
								'.$cadsubRows.'
								<td>
									
									<div class="btn-group">
										<button class="btn btn-success" type="button">Acciones</button>
										
										<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
										</button>
										
										<ul class="dropdown-menu" role="menu">
										
											<li>
											<a href="javascript:void(0)" class="'.$classEli.'" id="'.$row[0].'">Borrar</a>
											</li>
											
										</ul>
									</div>
								</td>
							</tr>
				';
			}
		}
		
		$cadView = $cadView.'
			<table class="table table-striped table-responsive" id="example">
            	<thead>
                	<tr>
                    	'.$cabeceras.'
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="'.$idresultados.'">

                	'.$cadRows.'
                </tbody>
            </table>
			<div style="margin-bottom:85px; margin-right:60px;"></div>
		
		';	
		
		
		return $cadView;
	}
	
	
	
	function camposTabla($accion,$tabla,$lblcambio,$lblreemplazo,$refdescripcion,$refCampo) {
		$sql	=	"show columns from ".$tabla;
		$res 	=	$this->query($sql,0);
		
		$camposEscondido = "";
		/* Analizar para despues */
		/*if (count($refencias) > 0) {
			$j = 0;

			foreach ($refencias as $reftablas) {
				$sqlTablas = "select id".$reftablas.", ".$refdescripcion[$j]." from ".$reftablas." order by ".$refdescripcion[$j];
				$resultadoRef[$j][0] = $this->query($sqlTablas,0);
				$resultadoRef[$j][1] = $refcampos[$j];
			}
		}*/
		
		
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				
				$i = 0;
				foreach ($lblcambio as $cambio) {
					if ($row[0] == $cambio) {
						$label = $lblreemplazo[$i];
						$i = 0;
						break;
					} else {
						$label = $row[0];
					}
					$i = $i + 1;
				}
				
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$label.'" class="control-label" style="text-align:left">'.ucwords($label).'</label>
							<div class="input-group col-md-12">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" id="'.strtolower($row[0]).'" name="'.strtolower($row[0]).'" value="0" required>
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						';
					} else {
						if ( in_array($row[0],$refCampo) ) {
							
							$campo = strtolower($row[0]);
							
							$option = $refdescripcion[array_search($row[0], $refCampo)];
							/*
							$i = 0;
							foreach ($lblcambio as $cambio) {
								if ($row[0] == $cambio) {
									$label = $lblreemplazo[$i];
									$i = 0;
									break 2;
								} else {
									$label = $row[0];
								}
								$i = $i + 1;
							}*/
							
							$form	=	$form.'
							
							<div class="form-group col-md-6">
								<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
								<div class="input-group col-md-12">
									<select class="form-control" id="'.strtolower($campo).'" name="'.strtolower($campo).'">
										';
							
							$form	=	$form.$option;
							
							$form	=	$form.'		</select>
								</div>
							</div>
							
							';
							
						} else {
							
							if (strpos($row[1],"bit") !== false) {
								$label = ucwords($label);
								$campo = strtolower($row[0]);
								
								$form	=	$form.'
								
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12 fontcheck">
										<input type="checkbox" class="form-control" id="'.$campo.'" name="'.$campo.'" style="width:50px;" required> <p>Si/No</p>
									</div>
								</div>
								
								';
								
								
							} else {
								
								if (strpos($row[1],"date") !== false) {
									$label = ucwords($label);
									$campo = strtolower($row[0]);
									/*
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="'.$campo.'" data-link-format="yyyy-mm-dd">
											<input class="form-control" size="50" type="text" value="" readonly>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<input type="hidden" name="'.$campo.'" id="'.$campo.'" value="" />
									</div>
									
									';
									*/
									
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-6">
											<input class="form-control" type="text" name="'.$campo.'" id="'.$campo.'" value="Date"/>
										</div>
										
									</div>
									
									';
									
								} else {
									
									if (strpos($row[1],"time") !== false) {
										$label = ucwords($label);
										$campo = strtolower($row[0]);
										
										$form	=	$form.'
										
										<div class="form-group col-md-6">
											<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
											<div class="input-group bootstrap-timepicker col-md-6">
												<input id="timepicker2" name="'.$campo.'" class="form-control">
												<span class="input-group-addon">
<span class="glyphicon glyphicon-time"></span>
</span>
											</div>
											
										</div>
										
										';
										
									} else {
										if ($row[1] == 'MEDIUMTEXT') {
											$label = ucwords($label);
											$campo = strtolower($row[0]);
											
											$form	=	$form.'
											
											<div class="form-group col-md-12">
												<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
												<div class="input-group col-md-12">
													<textarea name="'.$campo.'" id="'.$campo.'" rows="200" cols="160">
														Ingrese la noticia.
													</textarea>
													
													
												</div>
												
											</div>
											
											';
											
										} else {
											
											if ((integer)(str_replace('varchar(','',$row[1])) > 200) {
												$label = ucwords($label);
												$campo = strtolower($row[0]);
												
												$form	=	$form.'
												
												<div class="form-group col-md-6">
													<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
													<div class="input-group col-md-12">
														<textarea type="text" rows="10" cols="6" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required></textarea>
													</div>
													
												</div>
												
												';
												
												} else {
												$label = ucwords($label);
												$campo = strtolower($row[0]);
												
												$form	=	$form.'
												
												<div class="form-group col-md-6">
													<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
													<div class="input-group col-md-12">
														<input type="text" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
													</div>
												</div>
												
												';
											}
										}
									}
								}
							}
						}
						
						
					}
				} else {
	
					$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}



	////////////////////////////////////////////////////////////////////////////////////////////////////////////




	function camposTablaModificar($id,$lblid,$accion,$tabla,$lblcambio,$lblreemplazo,$refdescripcion,$refCampo) {
		
		switch ($tabla) {
			case 'dbtorneos':
				
				break;

			default:
				$sqlMod = "select * from ".$tabla." where ".$lblid." = ".$id;
				$resMod = $this->query($sqlMod,0);
		}
		/*if ($tabla == 'dbtorneos') {
			$resMod = $this->TraerIdTorneos($id);
		} else {
			$sqlMod = "select * from ".$tabla." where ".$lblid." = ".$id;
			$resMod = $this->query($sqlMod,0);
		}*/
		$sql	=	"show columns from ".$tabla;
		$res 	=	$this->query($sql,0);
		
		$camposEscondido = "";
		/* Analizar para despues */
		/*if (count($refencias) > 0) {
			$j = 0;

			foreach ($refencias as $reftablas) {
				$sqlTablas = "select id".$reftablas.", ".$refdescripcion[$j]." from ".$reftablas." order by ".$refdescripcion[$j];
				$resultadoRef[$j][0] = $this->query($sqlTablas,0);
				$resultadoRef[$j][1] = $refcampos[$j];
			}
		}*/
		
		
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				
				$i = 0;
				foreach ($lblcambio as $cambio) {
					if ($row[0] == $cambio) {
						$label = $lblreemplazo[$i];
						$i = 0;
						break;
					} else {
						$label = $row[0];
					}
					$i = $i + 1;
				}
				
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$label.'" class="control-label" style="text-align:left">'.ucwords($label).'</label>
							<div class="input-group col-md-12">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" id="'.strtolower($row[0]).'" name="'.strtolower($row[0]).'" value="'.mysql_result($resMod,0,$row[0]).'" required>
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						';
					} else {
						if ( in_array($row[0],$refCampo) ) {
							
							$campo = strtolower($row[0]);
							
							$option = $refdescripcion[array_search($row[0], $refCampo)];
							/*
							$i = 0;
							foreach ($lblcambio as $cambio) {
								if ($row[0] == $cambio) {
									$label = $lblreemplazo[$i];
									$i = 0;
									break 2;
								} else {
									$label = $row[0];
								}
								$i = $i + 1;
							}*/
							
							$form	=	$form.'
							
							<div class="form-group col-md-6">
								<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
								<div class="input-group col-md-12">
									<select class="form-control" id="'.strtolower($campo).'" name="'.strtolower($campo).'">
										';
							
							$form	=	$form.$option;
							
							$form	=	$form.'		</select>
								</div>
							</div>
							
							';
							
						} else {
							
							if (strpos($row[1],"bit") !== false) {
								$label = ucwords($label);
								$campo = strtolower($row[0]);
								
								$activo = '';
								if (mysql_result($resMod,0,$row[0])==1){
									$activo = 'checked';
								}
								
								$form	=	$form.'
								
								<div class="form-group col-md-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12 fontcheck">
										<input type="checkbox" '.$activo.' class="form-control" id="'.$campo.'" name="'.$campo.'" style="width:50px;" required> <p>Si/No</p>
									</div>
								</div>
								
								';
								
								
							} else {
								
								if (strpos($row[1],"date") !== false) {
									$label = ucwords($label);
									$campo = strtolower($row[0]);
									/*
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="'.$campo.'" data-link-format="yyyy-mm-dd">
											<input class="form-control" value="'.mysql_result($resMod,0,$row[0]).'" size="50" type="text" value="" readonly>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<input type="hidden" name="'.$campo.'" id="'.$campo.'" value="'.mysql_result($resMod,0,$row[0]).'" />
									</div>
									
									';
									*/
									
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-6">
											<input class="form-control" type="text" name="'.$campo.'" id="'.$campo.'" value="Date"/>
										</div>
										
									</div>
									
									';
									
								} else {
									
									if (strpos($row[1],"time") !== false) {
										$label = ucwords($label);
										$campo = strtolower($row[0]);
										
										$form	=	$form.'
										
										<div class="form-group col-md-6">
											<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
											<div class="input-group bootstrap-timepicker col-md-6">
												<input id="timepicker2" value="'.mysql_result($resMod,0,$row[0]).'" name="'.$campo.'" class="form-control">
												<span class="input-group-addon">
<span class="glyphicon glyphicon-time"></span>
</span>
											</div>
											
										</div>
										
										';
										
									} else {
										if ((integer)(str_replace('varchar(','',$row[1])) > 200) {
											$label = ucwords($label);
											$campo = strtolower($row[0]);
											
											$form	=	$form.'
											
											<div class="form-group col-md-6">
												<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
												<div class="input-group col-md-12">
													<textarea type="text" rows="10" cols="6" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>'.htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5).'</textarea>
												</div>
												
											</div>
											
											';
											
										} else {
											
											if ($row[1] == 'MEDIUMTEXT') {
											$label = ucwords($label);
											$campo = strtolower($row[0]);
											
											$form	=	$form.'
											
											<div class="form-group col-md-12">
												<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
												<div class="input-group col-md-12">
													<textarea name="'.$campo.'" id="'.$campo.'" rows="200" cols="160">
														Ingrese la noticia.
													</textarea>
													
													
												</div>
												
											</div>
											
											';
											
											} else {
												$label = ucwords($label);
												$campo = strtolower($row[0]);
												
												$form	=	$form.'
												
												<div class="form-group col-md-6">
													<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
													<div class="input-group col-md-12">
														<input type="text" value="'.htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5).'" class="form-control" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
													</div>
												</div>
												
												';
											}
										}
									}
								}
							}
						}
						
						
					}
				} else {
	
					$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>'.'<input type="hidden" id="id" name="id" value="'.$id.'"/>';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}
	
	
	
	function camposTablaVer($id,$lblid,$tabla,$lblcambio,$lblreemplazo,$refdescripcion,$refCampo) {
		
		switch ($tabla) {
			case 'dbtorneos':
				
				break;

			default:
				$sqlMod = "select * from ".$tabla." where ".$lblid." = ".$id;
				$resMod = $this->query($sqlMod,0);
		}
		/*if ($tabla == 'dbtorneos') {
			$resMod = $this->TraerIdTorneos($id);
		} else {
			$sqlMod = "select * from ".$tabla." where ".$lblid." = ".$id;
			$resMod = $this->query($sqlMod,0);
		}*/
		$sql	=	"show columns from ".$tabla;
		$res 	=	$this->query($sql,0);
		
		$camposEscondido = "";
		/* Analizar para despues */
		/*if (count($refencias) > 0) {
			$j = 0;

			foreach ($refencias as $reftablas) {
				$sqlTablas = "select id".$reftablas.", ".$refdescripcion[$j]." from ".$reftablas." order by ".$refdescripcion[$j];
				$resultadoRef[$j][0] = $this->query($sqlTablas,0);
				$resultadoRef[$j][1] = $refcampos[$j];
			}
		}*/
		
		
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				
				$i = 0;
				foreach ($lblcambio as $cambio) {
					if ($row[0] == $cambio) {
						$label = $lblreemplazo[$i];
						$i = 0;
						break;
					} else {
						$label = $row[0];
					}
					$i = $i + 1;
				}
				
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6 col-xs-6">
							<label for="'.$label.'" class="control-label" style="text-align:left">'.ucwords($label).'</label>
							<div class="input-group col-md-12">
								
								<p>'.mysql_result($resMod,0,$row[0]).'</p>
								
							</div>
						</div>
						
						';
					} else {
						if ( in_array($row[0],$refCampo) ) {
							
							$campo = strtolower($row[0]);
							
							$option = $refdescripcion[array_search($row[0], $refCampo)];
							/*
							$i = 0;
							foreach ($lblcambio as $cambio) {
								if ($row[0] == $cambio) {
									$label = $lblreemplazo[$i];
									$i = 0;
									break 2;
								} else {
									$label = $row[0];
								}
								$i = $i + 1;
							}*/
							
							$form	=	$form.'
							
							<div class="form-group col-md-6 col-xs-6">
								<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
								<div class="input-group col-md-12">
									<p>
										';
							
							$form	=	$form.$option;
							
							$form	=	$form.'		</p>
								</div>
							</div>
							
							';
							
						} else {
							
							if (strpos($row[1],"bit") !== false) {
								$label = ucwords($label);
								$campo = strtolower($row[0]);
								
								$activo = '';
								if (mysql_result($resMod,0,$row[0])==1){
									$activo = 'Si';
								} else {
									$activo = 'No';
								}
								
								$form	=	$form.'
								
								<div class="form-group col-md-6 col-xs-6">
									<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
									<div class="input-group col-md-12">
										<p>'.$activo.'</p>
									</div>
								</div>
								
								';
								
								
							} else {
								
								if (strpos($row[1],"date") !== false) {
									$label = ucwords($label);
									$campo = strtolower($row[0]);
									/*
									$form	=	$form.'
									
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group date form_date col-md-6" data-date="" data-date-format="dd MM yyyy" data-link-field="'.$campo.'" data-link-format="yyyy-mm-dd">
											<input class="form-control" value="'.mysql_result($resMod,0,$row[0]).'" size="50" type="text" value="" readonly>
											<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
										</div>
										<input type="hidden" name="'.$campo.'" id="'.$campo.'" value="'.mysql_result($resMod,0,$row[0]).'" />
									</div>
									
									';
									*/
									
									$form	=	$form.'
									
									<div class="form-group col-md-6 col-xs-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-6">
											<p>'.mysql_result($resMod,0,$row[0]).'</p>
										</div>
										
									</div>
									
									';
									
								} else {
									
									if (strpos($row[1],"time") !== false) {
										$label = ucwords($label);
										$campo = strtolower($row[0]);
										
										$form	=	$form.'
										
										<div class="form-group col-md-6 col-xs-6">
											<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
											<div class="input-group bootstrap-timepicker col-md-6">
												<p>'.mysql_result($resMod,0,$row[0]).'</p>
											</div>
											
										</div>
										
										';
										
									} else {
										if ((integer)(str_replace('varchar(','',$row[1])) > 200) {
											$label = ucwords($label);
											$campo = strtolower($row[0]);
											
											$form	=	$form.'
											
											<div class="form-group col-md-6 col-xs-6">
												<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
												<div class="input-group col-md-12">
													<p>'.(htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5) == '' ? ".............." : htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5)).'</p>
												</div>
												
											</div>
											
											';
											
										} else {
											
											if ($row[1] == 'MEDIUMTEXT') {
											$label = ucwords($label);
											$campo = strtolower($row[0]);
											
											$form	=	$form.'
											
											<div class="form-group col-md-12 col-xs-12">
												<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
												<div class="input-group col-md-12 col-xs-12">
													<p>'.(htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5) == '' ? ".............." : htmlspecialchars(mysql_result($resMod,0,$row[0]),ENT_HTML5)).'</p>
													
													
												</div>
												
											</div>
											
											';
											
											} else {
												$label = ucwords($label);
												$campo = strtolower($row[0]);
												
												$form	=	$form.'
												
												<div class="form-group col-md-6 col-xs-6">
													<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
													<div class="input-group col-md-12">
														<p>'.(utf8_encode(mysql_result($resMod,0,$row[0])) == '' ? ".............." : utf8_encode(mysql_result($resMod,0,$row[0]))).'</p>
													</div>
												</div>
												
												';
											}
										}
									}
								}
							}
						}
						
						
					}
				} else {
	
					$camposEscondido = '';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}
	




	function camposTablaMod($accion,$id) {
		
		$resTipoVenta = $this->traerUsuariosPorId($id);
		
		$sql	=	"show columns from se_usuarios";
		$res 	=	$this->query($sql,0);
		if ($res == false) {
			return 'Error al traer datos';
		} else {
			
			$form	=	'';
			
			while ($row = mysql_fetch_array($res)) {
				if ($row[3] != 'PRI') {
					if (strpos($row[1],"decimal") !== false) {
						$form	=	$form.'
						
						<div class="form-group col-md-6">
							<label for="'.$row[0].'" class="control-label" style="text-align:left">'.ucwords($row[0]).'</label>
							<div class="input-group col-md-12">
								<span class="input-group-addon">$</span>
								<input type="text" class="form-control" id="'.$row[0].'" name="'.$row[0].'" value="'.mysql_result($resTipoVenta,0,$row[0]).'" required>
								<span class="input-group-addon">.00</span>
							</div>
						</div>
						
						';
					} else {
						
						$formTabla = "";
						$formReferencia = "";
						switch ($row[0]) {
							case "refroll":
								$label = "Rol";
								$campo = $row[0];
								
								$formTabla = '
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
													
											<select class="form-control" id="'.$campo.'" name="'.$campo.'">
												';
												if (mysql_result($resTipoVenta,0,$campo) == 'SuperAdmin') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin" selected>SuperAdmin</option>
														<option value="Administrador">Administrador</option>
														<option value="Empleado">Empleado</option>
													';
												}
												if (mysql_result($resTipoVenta,0,$campo) == 'Administrador') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin">SuperAdmin</option>
														<option value="Administrador" selected>Administrador</option>
														<option value="Empleado">Empleado</option>
													';
												}
												if (mysql_result($resTipoVenta,0,$campo) == 'Empleado') {
													$formTabla = $formTabla.'
														<option value="SuperAdmin">SuperAdmin</option>
														<option value="Administrador">Administrador</option>
														<option value="Empleado" selected>Empleado</option>
													';
												}
												
								$formTabla = $formTabla.'</select>
										</div>
									</div>
									
									';
								
								break;
							case "refvalores":
								$label = "Aplica Sobre";
								$campo = $row[0];
								
								$sqlRef = "select idvalor,descripcion from lcdd_valores";
								$resRef = $this->query($sqlRef,0);
								
								$formRefDivUno = '<div class="form-group col-md-6">
											<label for="'.$row[0].'" class="control-label" style="text-align:left">'.$label.'</label>
											<div class="input-group col-md-12">
												<select class="form-control" id="'.$campo.'" name="'.$campo.'" >';
								$formRefDivDos = "</select></div></div>";
								$formOption = "";
								
								while ($rowRef = mysql_fetch_array($resRef)) {
									if (mysql_result($resTipoVenta,0,$campo) == $rowRef[0]) {
										$formOption = $formOption."<option value='".$rowRef[0]."' selected>".$rowRef[1]."</option>";
									} else {
										$formOption = $formOption."<option value='".$rowRef[0]."'>".$rowRef[1]."</option>";
									}
								}
								
								$formReferencia = $formRefDivUno.$formOption.$formRefDivDos;
								
								break;
							default:
								$label = ucwords($row[0]);
								$campo = $row[0];
								
								$formTabla = '
									<div class="form-group col-md-6">
										<label for="'.$campo.'" class="control-label" style="text-align:left">'.$label.'</label>
										<div class="input-group col-md-12">
											<input type="text" class="form-control" value="'.utf8_encode(mysql_result($resTipoVenta,0,$campo)).'" id="'.$campo.'" name="'.$campo.'" placeholder="Ingrese el '.$label.'..." required>
										</div>
									</div>
									
									';
									
								break;
							}
						
						
						
						$form	=	$form.$formReferencia.$formTabla;
					}
				} else {
					$camposEscondido = '<input type="hidden" id="id" name="id" value="'.$id.'"/>';
					$camposEscondido = $camposEscondido.'<input type="hidden" id="accion" name="accion" value="'.$accion.'"/>';	
				}
			}
			
			$formulario = $form."<br><br>".$camposEscondido;
			
			return $formulario;
		}	
	}
	
	function traerEmpresasPorId($id) { 
	$sql = "select idempresa,razonsocial,rfc,direccion,email,telefono,celular,objetoempresa,notaria,notario,giro,socia_a,socio_b,administrador,comisario,apoderado,rpp,plataforma,usuario,contrasenia,contraseniaemail,cuenta from dbempresas where idempresa =".$id; 
	$res = $this->query($sql,0); 
	return $res; 
	} 

	function dashBoard($id,$resBancos) {
		$resEmpresa = $this->traerEmpresasPorId($id);
		$formulario = '';
		
		$formulario .= '
					<table class="table table-bordered table-responsive table-striped">
        	<tbody>
            	<tr>
                	<th colspan="3" style="text-align:center; width:50%;">RAZON SOCIAL</th>
                    <th colspan="3" style="text-align:center;">RFC</th>
					
                </tr>
            	<tr>
                	<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"razonsocial"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(mysql_result($resEmpresa,0,"rfc")).'</td>
                </tr>
				
				<tr>
            		<th colspan="6" style="text-align:center;">DOMICILIO</th>
            	</tr>
				
				<tr>
            		<td colspan="6">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"direccion"),ENT_HTML5)).'</td>
            	</tr>
            	<tr>
                	<th colspan="3" style="text-align:center;">CORREO ELECTRONICO</th>
                    <th colspan="3" style="text-align:center;">CONTRASEÑA</th>
                </tr>
				
				<tr>
					<td colspan="3">'.htmlspecialchars((mysql_result($resEmpresa,0,"email")),ENT_HTML5).'</td>
                    <td colspan="3">'.htmlspecialchars((mysql_result($resEmpresa,0,"contraseniaemail")),ENT_HTML5).'</td>
				</tr>
                
                <tr>
            		<th colspan="3" style="text-align:center;">TELEFONO</th>
					<th colspan="3" style="text-align:center;">CELULAR</th>
            		
            	</tr>
                
				<tr>
					<td colspan="3">'.strtoupper(mysql_result($resEmpresa,0,"telefono")).'</td>
					<td colspan="3">'.strtoupper(mysql_result($resEmpresa,0,"celular")).'</td>
				</tr>
                
            
           		<tr>
                	<th colspan="3" style="text-align:center;">NOTARIA</th>
                    <th colspan="3" style="text-align:center;">NOTARIO</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"notaria"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"notario"),ENT_HTML5)).'</td>
				</tr>
				
				<tr>
                	<th colspan="3" style="text-align:center;">SOCIO A</th>
                    <th colspan="3" style="text-align:center;">SOCIO B</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"socia_a"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"socio_b"),ENT_HTML5)).'</td>
				</tr>
				
				
				<tr>
                	<th colspan="3" style="text-align:center;">COMISARIO</th>
                    <th colspan="3" style="text-align:center;">APODERADO</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"comisario"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"apoderado"),ENT_HTML5)).'</td>
				</tr>
				
				<tr>
                	<th colspan="3" style="text-align:center;">ADMINISTRADOR</th>
                    <th colspan="3" style="text-align:center;">RPP</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"administrador"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"rpp"),ENT_HTML5)).'</td>
				</tr>
				
				
				<tr>
                	<th colspan="3" style="text-align:center;">PLATAFORMA</th>
                    <th colspan="3" style="text-align:center;">CUENTA</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"plataforma"),ENT_HTML5)).'</td>
                    <td colspan="3">'.htmlspecialchars(mysql_result($resEmpresa,0,"cuenta"),ENT_HTML5).'</td>
				</tr>
				
				
				<tr>
                	<th colspan="3" style="text-align:center;">USUARIO</th>
                    <th colspan="3" style="text-align:center;">CONTRASEÑA</th>
                </tr>
				
				<tr>
					<td colspan="3">'.htmlspecialchars((mysql_result($resEmpresa,0,"usuario")),ENT_HTML5).'</td>
                    <td colspan="3">'.htmlspecialchars((mysql_result($resEmpresa,0,"contrasenia")),ENT_HTML5).'</td>
				</tr>
				
				
				<tr>
                	<th colspan="3" style="text-align:center;">GIRO</th>
                    <th colspan="3" style="text-align:center;">OBJETO</th>
                </tr>
				
				<tr>
					<td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"giro"),ENT_HTML5)).'</td>
                    <td colspan="3">'.strtoupper(htmlspecialchars(mysql_result($resEmpresa,0,"objetoempresa"),ENT_HTML5)).'</td>
				</tr>';
				/*
            while ($row = mysql_fetch_array($resBancos)) {
            	$formulario	.= '<tr>
                	<th>BANCO/SUCURSAL</th>
                    <td align="center">'.$row["banco"]."/".$row["sucursal"].'</td>
                    <th>CUENTA</th>
                    <td align="center">'.$row["cuenta"].'</td>
                    <th>CLABE</th>
                    <td align="center">'.$row["clave"].'</td>
                </tr>';
            }*/
		$formulario	.= '
            </tbody>
        
        </table>
		
		';
		
		return $formulario;
	}

	function TraerUsuario($nombre,$pass) {
		
		require_once 'appconfig.php';

		$appconfig	= new appconfig();
		$datos		= $appconfig->conexion();
		$hostname	= $datos['hostname'];
		$database	= $datos['database'];
		$username	= $datos['username'];
		$password	= $datos['password'];
		
		
		$conn = mysql_connect($hostname,$username,$password) or die ("no se puede conectar".mysql_error());
		
		$db = mysql_select_db($database);
	 
	 	
	 
		$error = 0;		
		
		
		
		$sqlusu = "select * from dbusuarios where usuario = '".$nombre."'";
		
		$respusu = mysql_query($sqlusu,$conn) or die (mysql_error(1));;
		
		$filas = mysql_num_rows($respusu);
		
		if ($filas > 0) {
			$sqlpass = "select * from dbusuarios where Pass = '".$pass."' and idusuario = ".mysql_result($respusu,0,0);
		    //echo $sqlpass;
		    $error = 1;
		    
			$resppass = mysql_query($sqlpass,$conn) or die (mysql_error(1));;
			
			$filas2 = mysql_num_rows($resppass);
			
			if ($filas2 > 0) {
				$error = 1;
				
				$_SESSION['sg_usuario'] = $nombre;
				$_SESSION['sg_pass'] = $pass;
				
				} else {
				$error = 0;
				}
			
			}
			else
			
			{
				$error = 0;	
			}
			
	    mysql_close($conn);
	
		return $error;
		
	}
	
	Function TraerTipoDoc() {
		$sql = "select * from tbtipodoc";
		return $this-> query($sql,0);
	}
	
	
	
	function activarTabla($tabla,$id,$campo,$todos)
	{
		if ($todos == true) {
		$sql = "update ".$tabla." set activo = false";
		$this-> query($sql,0);
		}
		
		$sql = "";
		$sql = "update ".$tabla." set activo = true where ".$campo." = ".$id;
		$this-> query($sql,0);
	}
	
	function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
		$file = $path.$filename;
		$file_size = filesize($file);
		$handle = fopen($file, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$content = chunk_split(base64_encode($content));
		$uid = md5(uniqid(time()));
		$name = basename($file);
		$header = "From: ".$from_name." <".$from_mail.">\r\n";
		$header .= "Reply-To: ".$replyto."\r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
		$header .= "This is a multi-part message in MIME format.\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
		$header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
		$header .= $message."\r\n\r\n";
		$header .= "--".$uid."\r\n";
		$header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
		$header .= "Content-Transfer-Encoding: base64\r\n";
		$header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
		$header .= $content."\r\n\r\n";
		$header .= "--".$uid."--";
		if (mail($mailto, $subject, "", $header)) {
			echo "mail send ... OK"; // or use booleans here
		} else {
			echo "mail send ... ERROR!";
		}
	}
	
	
	function form_mail($sPara, $sAsunto, $sTexto, $sDe, $datos)
	{
		$bHayFicheros = 0;
		$sCabeceraTexto = "";
		$sAdjuntos = "";
		 
		if ($sDe)$sCabeceras = "From:".$sDe."\n";
		else $sCabeceras = "";
		$sCabeceras .= "MIME-version: 1.0\n";
		

		 
		//foreach ($_FILES as $vAdjunto)
		while ($row = mysql_fetch_array($datos))
		{

			$bHayFicheros = 1;
			$sCabeceras .= "Content-type: multipart/mixed;";
			$sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";
			 
			$sCabeceraTexto = "----_Separador-de-mensajes_--\n";
			$sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
			$sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";
			 
			$sTexto = $sCabeceraTexto.$sTexto;


			$sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
			$sAdjuntos .= "Content-type: ".$row["type"].";name=\"".$row[2]."\"\n";;
			$sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
			$sAdjuntos .= "Content-disposition: attachment;filename=\"".$row[2]."\"\n\n";
			 //$_SERVER['DOCUMENT_ROOT'].
			$oFichero = fopen( '../archivos/'.$row[0].'/'.$row[1].'/'.utf8_encode($row[2]) , 'r');
			$sContenido = fread($oFichero, filesize('../archivos/'.$row[0].'/'.$row[1].'/'.utf8_encode($row[2])));
			$sAdjuntos .= chunk_split(base64_encode($sContenido));
			fclose($oFichero);


		}
		 
		if ($bHayFicheros)
		$sTexto .= $sAdjuntos."\n\n----_Separador-de-mensajes_----\n";
		return(mail($sPara, $sAsunto, $sTexto, $sCabeceras));
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
		mysql_query("SET NAMES 'utf8'");
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