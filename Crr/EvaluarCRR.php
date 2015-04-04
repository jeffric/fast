<?php 
session_start();
ob_start();
include_once "../funciones.php";
$c_funciones = new Funciones();

$strUsuario=$_SESSION["Usuario"];
$strTipoUsuario=$_SESSION["TipoUsuario"];

$idUsuario = $c_funciones->getIdUsuario($strUsuario);

?>
<!DOCTYPE html>
<html>
<?php echo $c_funciones->getHeaderNivel2("Evaluar CRR", 
	'  <style>
	.panel-content {
		padding: 1em;
	}
</style>'); ?>
<body>
	<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Evaluaci&oacute;n CRR"); ?>
		<div role="main" class="ui-content">			
			<div class="ui-body ui-body-a ui-corner-all">
				<table border="1" cellpadding="2" data-mode="reflow" style="border:solid 1px;border-collapse: collapse;padding: 0;width: 100%;display: table;color: #333;text-shadow: 0 1px 0 #f3f3f3;border-color:orange">
					<tbody>
						<tr>
							<td colspan="2">Foco</td>
							<td colspan="2">Rating</td>
							<td colspan="4">Descripci&oacute;n del contexto</td>
							<td colspan="2">Opci&oacute;n</td>
							<td>Rating</td>
						</tr>

						<!-- tabla 1 Social y politica -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Social &amp; Pol&iacute;tica</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que son estables y libres de desordenes pol&iacute;ticos, econ&oacute;micos y civiles. Hay insignificante violencia religiosa, de sectores, racial/tribu y pol&iacute;tica. 
								</label>
							</td>
							<td colspan="2" id="tb1_td0">
								<div class="ui-radio ui-mini"  id="tb1_td0">								
									<input type="radio" name="rdbReco" class="" id="rdbTb1_1" value="0.15" selec="tb1_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que son generalmente estables, pero pueden haber tiempos de inestabilidad pol&iacute;tica & econ&oacute;mica y desorden civil. Pueden haber instancias aisladas de violencia religiosa, de sectores, racial/tribu y pol&iacute;tica. 
								</label>
							</td>
							<td colspan="2" id="tb1_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0.30"  selec="tb1_td1">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses y provincias que experimentan inestabilidad pol&iacute;tica & econ&oacute;mica y desorden civil; hay debilidades significativas en los sistemas y capacidades de Gobierno. Puede haber  un numero de incidentes que involucren violencia religiosa, de sector, racial/tribu y pol&iacute;tica y la situaci&oacute;n puede ser muy vol&aacute;til. 
								</label>
							</td>
							<td colspan="2"  id="tb1_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0.45" selec="tb1_td2">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Pa&iacute;ses o provincias que experimentan inestabilidad pol&iacute;tica & econ&oacute;mica  y desorden civil regularmente. Los sistemas pol&iacute;ticos est&aacute;n inherentemente inestables y pueden colapsar en cualquier momento. Incidentes involucrando violencia religiosa, de sector, racial/tribu, pol&iacute;tica y extremismo son comunes y en algunas ocasiones pueden ser blancos los extranjeros. 
								</label>
							</td>
							<td colspan="2" id="tb1_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0.60" selec="tb1_td3">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Pa&iacute;s o provincias que son estados fallidos; instituciones pol&iacute;ticas & econ&oacute;micas han colapsado. La violencia por religi&oacute;n, de sector, racial y pol&iacute;tica esta por todos lados y afecta todos los niveles de la sociedad y tiene como blanco directo a extranjeros.  
								</label>
							</td>
							<td colspan="2" id="tb1_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0.75" selec="tb1_td4">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb1Exp" id="txtTb1Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating1">
									0.15
								</label>
							</td>
						</tr>
						
						<!-- tabla 2 Crimen y seguridad-->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Crimen &amp; Seguridad</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Hay bajos niveles de crimen violento, pero puede haber niveles variantes de cr&iacute;menes menores en &aacute;reas urbanas o &aacute;reas aisladas. Fuerzas de seguridad local son profesionales, previenen & detectan efectivamente el crimen, y son generalmente libres  de corrupci&oacute;n.
								</label>
							</td>
							<td colspan="2"  id="tb2_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco1" class="" id="rdbCortar" value="0.15" selec="tb2_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Hay bajos niveles de violencia, pero hay cr&iacute;menes menores expandidos en ares especificas. Hay grupos de crimen organizados presentes, pero generalmente est&aacute;n controladas por las autoridades. Las fuerzas de seguridad local son profesionales, pero pueden haber bajos niveles de corrupci&oacute;n.   
								</label>
							</td>
							<td colspan="2" id="tb2_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco1" class="" id="rdbCortar" selec="tb2_td1" value="0.30">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Hay altos niveles de cr&iacute;menes violentos que  hacen impacto en extranjeros y la poblaci&oacute;n local.
									Los grupos de crimen organizados son muy activos y controlan un n&uacute;mero de &aacute;reas urbanas. Los fuerzas de seguridad local son eneralmente inadecuadas and puede sufrir de corrupci&oacute;n sistem&aacute;tico. 
								</label>
							</td>
							<td colspan="2" id="tb2_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco1" class="" id="rdbCortar" selec="tb2_td2" value="0.45">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay muy altos niveles de cr&iacute;menes violentos que tienen impacto en extranjeros y en la poblaci&oacute;n local. Grupos del crimen organizado son muy fuertes y pueden operar libremente. Las fuerzas de seguridad local son inadecuadas y hay abusos regulares del proceso legal debido a la corrupci&oacute;n. 
								</label>
							</td>
							<td colspan="2" id="tb2_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco1" class="" id="rdbCortar" selec="tb2_td3" value="0.60">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Hay niveles extremos de crimen violento que tiene impacto en extranjeros y en la poblaci&oacute;n local.
									Grupos de crimen organizado son particularmente fuertes y est&aacute;n en conflicto abierto con fuerzas del gobierno por control. Las fuerzas de seguridad local son m&iacute;nimas o no-existentes y el gobierno no tiene control de la ley & el orden. 

								</label>
							</td>
							<td colspan="2" id="tb2_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco1" class="" id="rdbCortar" selec="tb2_td4" value="0.75">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb2Exp" id="txtTb2Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating2">
									0.15
								</label>
							</td>
						</tr>

						<!-- tabla 3 Conflicto -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Conflicto</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									No hay conflicto armado actual y hay muy poco riesgo de cualquier conflicto futuro. 
								</label>
							</td>
							<td colspan="2" id="tb3_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco2" class="" id="rdbReco2" value="0.15" selec="tb3_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									No hay conflicto armado actual y un bajo riesgo de conflictos futuros. 
								</label>
							</td>
							<td colspan="2" id="tb3_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco2" class="" id="rdbReco2" selec="tb3_td1" value="0.30">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Puede haber disputas o un bajo nivel de insurgencia operando en el pa&iacute;s, hay un riesgo significativo de que el conflicto incremente. Puede haber una amenaza indirecta al personal de ONG de conflictos localizados.
								</label>
							</td>
							<td colspan="2" id="tb3_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco2" class="" id="rdbReco2" selec="tb3_td2" value="0.45">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Un conflicto  interno  localizado o de frontera a frontero puede estar en progreso. Puede haber guerrilla o grupos insurgentes en control de &aacute;reas especificas del pa&iacute;s. Estos grupos son una seria amenaza para la estabilidad del pa&iacute;s. Algunos actores en el conflicto pueden ver a las ONGI’s como blancos leg&iacute;timos. 
								</label>
							</td>
							<td colspan="2" id="tb3_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco2" selec="tb3_td3" id="rdbCortar" value="0.60">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									El pa&iacute;s o &aacute;rea esta en estado o Guerra. La guerrilla y grupos insurgentes est&aacute;n en control de &aacute;reas significativas del pa&iacute;s y estos grupos son una seria amenaza para la estabilidad del pa&iacute;s. El conflicto no discrimina y la amenaza a ONGI’s es critica.

								</label>
							</td>
							<td colspan="2" id="tb3_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco2" selec="tb3_td4" id="rdbCortar" value="0.75">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb3Exp" id="txtTb3Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating3">
									0.15
								</label>
							</td>
						</tr>

						<!-- tabla 4 Terrorismo -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.2</b></div>								
								<div>Terrorismo</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									La actividad de grupos terroristas (o simpatizantes) es insignificante. 
								</label>
							</td>
							<td colspan="2" id="tb4_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco3" class="" id="rdbReco2" value="0.20" selec="tb4_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Puede haber grupos terroristas presentes, pero tienen capacidades operacionales limitadas y los actos de terrorismo son extremadamente raros. 
								</label>
							</td>
							<td colspan="2" id="tb4_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco3" class="" id="rdbReco2" selec="tb4_td1" value="0.40">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Puede haber grupos terroristas con capacidades de operaci&oacute;n significativas y el pa&iacute;s esta propenso a  que ocurran actos de terrorismo espor&aacute;dicos. 
								</label>
							</td>
							<td colspan="2" id="tb4_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco3" class="" id="rdbReco2" selec="tb4_td2" value="0.60">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay grupos terroristas presentes con Fuertes capacidades & alcance operacional; hay una seria amenaza al gobierno y a blancos internacionales. 
								</label>
							</td>
							<td colspan="2" id="tb4_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco3" class="" id="rdbCortar" selec="tb4_td3" value="0.80">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Los grupos terroristas son muy activos con capacidades significativas & alcance operacional; hay una extrema amenaza para el gobierno y blancos internacionales. 

								</label>
							</td>
							<td colspan="2" id="tb4_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco3" class="" id="rdbCortar" selec="tb4_td4" value="1">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb4Exp" id="txtTb4Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating4">
									0.20
								</label>
							</td>
						</tr>						

						<!-- tabla 5 Secuestro  -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.15</b></div>								
								<div>Secuestro</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Hay poco, o ning&uacute;n, riesgo de secuestro o  toma de rehenes. El panorama es estable.  
								</label>
							</td>
							<td colspan="2" id="tb5_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco4" class="" id="rdbReco2" value="0.15" selec="tb5_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Hay bajo riesgo de secuestro y toma de rehenes. 
								</label>
							</td>
							<td colspan="2" id="tb5_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco4" class="" id="rdbReco2" selec="tb5_td1" value="0.30">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Hay un riesgo significativo de secuestro o toma de rehenes en ciertas &aacute;reas. 
								</label>
							</td>
							<td colspan="2" id="tb5_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco4" class="" id="rdbReco2" selec="tb5_td2" value="0.45">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Hay un alto riesgo de secuestro o toma de rehenes en todo el pa&iacute;s y las fuerzas de seguridad pueden ser c&oacute;mplices, o estar directamente involucrados.  
								</label>
							</td>
							<td colspan="2" id="tb5_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco4" class="" id="rdbCortar" selec="tb5_td3" value="0.60">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Hay un serio riesgo de secuestro o toma de rehenes en todo el pa&iacute;s y las fuerzas de seguridad pueden ser c&oacute;mplices o estar directamente involucradas. 
								</label>
							</td>
							<td colspan="2" id="tb5_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco4" class="" id="rdbCortar" selec="tb5_td4" value="0.75">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb5Exp" id="txtTb5Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating5">
									0.15
								</label>
							</td>
						</tr>

						<!-- tabla 6 Espacio Humanitario  -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.10</b></div>								
								<div>Espacio Humanitario</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Organizaciones humanitarias pueden operar libremente y entregan una gran gama de programas con apoyo del gobierno y libre de restricciones impuestas por otros actores. 
								</label>
							</td>
							<td colspan="2" id="tb6_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco5" class="" id="rdbReco2" value="0.10" selec="tb6_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Organizaciones humanitarias generalmente pueden operar libremente y entregar una gran gama de programas con algunas restricciones del gobierno u otros actores. 
								</label>
							</td>
							<td colspan="2" id="tb6_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco5" class="" id="rdbReco2" selec="tb6_td1" value="0.20">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Las organizaciones humanitarias est&aacute;n restringidas en algunas &aacute;reas de operaci&oacute;n y puede haber Resistencia a su presencia de secciones de la comunidad. El gobierno u otros actores claves pueden obstruir la operaci&oacute;n de ONGI’s de ciertos pa&iacute;ses.    
								</label>
							</td>
							<td colspan="2" id="tb6_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco5" class="" id="rdbReco2" selec="tb6_td2" value="0.30">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Las operaciones humanitarias est&aacute;n severamente restringidas  y hay hostilidad abierta a la presencia de ONGI’s. Puede haber un blanco directo hacia las ONGI’s por grupos militantes. El gobierno u otros actores pueden obstruir activamente las operaciones de ONGI’s y amenazar con expulsi&oacute;n. 
								</label>
							</td>
							<td colspan="2" id="tb6_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco5" class="" id="rdbCortar" selec="tb6_td3" value="0.40">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Las organizaciones humanitarias  no pueden operar seguramente en el ambiente y las operaciones son generalmente insostenibles.  Hay un blanco directo hacia las ONGI’s por actores en el contexto. El gobierno u otros actores son hostiles para la ONGI’s y las han expulsados de &aacute;reas operacionales. 
								</label>
							</td>
							<td colspan="2" id="tb6_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco5" class="" id="rdbCortar" selec="tb6_td4" value="0.50">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb6Exp" id="txtTb6Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTbRating6">
									0.10
								</label>
							</td>
						</tr>

						<!-- tabla 7 Infraestructura -->

						<tr>
							<td colspan="2" rowspan="5" >
								<div><b>0.10</b></div>								
								<div>Infraestructura</div>
							</td>
							<td colspan="2">1</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son de muy altos est&aacute;ndares y raramente interrumpidos. 
								</label>
							</td>
							<td colspan="2" id="tb7_td0">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco6" class="" id="rdbReco2" value="0.10" selec="tb7_td0" checked="checked">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">2</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son de buenos est&aacute;ndares y raramente interrumpidos.
								</label>
							</td>
							<td colspan="2" id="tb7_td1">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco6" class="" id="rdbReco2" selec="tb7_td1" value="0.20">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">3</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y los servicios esenciales son interrumpidos regularmente y tienen est&aacute;ndares de seguridad cuestionables.   
								</label>
							</td>
							<td colspan="2" id="tb7_td2">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco6" class="" id="rdbReco2" selec="tb7_td2" value="0.30">
								</div>
							</td>
							<td></td>
						</tr>						
						<tr>
							<td colspan="2">4</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y servicios esenciales  son muy pobres; interrupci&oacute;n y fallo es muy com&uacute;n.  
								</label>
							</td>
							<td colspan="2" id="tb7_td3">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco6" class="" selec="tb7_td3" id="rdbCortar" value="0.40">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="2">5</td>
							<td colspan="4">
								<label>
									Transporte, comunicaci&oacute;n, salud y servicios esenciales son severamente degradados o inexistentes.
								</label>
							</td>
							<td colspan="2" id="tb7_td4">
								<div class="ui-radio ui-mini">								
									<input type="radio" name="rdbReco6" class="" selec="tb7_td4" id="rdbCortar" value="0.50">
								</div>
							</td>
							<td></td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									Explicaci&oacute;n de indicadores
								</label>
							</td>
							<td colspan="6">
								<textarea name="txtTb7Exp" id="txtTb7Exp" cols="30" rows="10"></textarea>
							</td>
							<td>
								<label id="lblTb1Rating7">
									0.10
								</label>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<label>
									
								</label>
							</td>							
							<td colspan="5" style="background-color:orange; text-align:center; color:#e1e1e1;">
								<label>
									Calificaci&oacute;n de Riesgo del contexto basado en la herramienta/gu&iacute;a de OCS
								</label>
							</td>
							<td></td>
							<td>
								<label id="lblTbRatingFinal">
									1
								</label>
							</td>
						</tr>
						<tr>
							<td colspan="11">
								<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
									<input type="button" id="btnEvaluar" data-theme="a" name="btnEvaluar" onclick="evaluarCRR();" value="Evaluar" class="ui-btn-hidden" aria-disabled="false"/>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<?php 
			//0: pais, 1: evento, 2: punto de evaluacion
			echo '<input type="hidden" id="hdTipoObjeto" name="hdTipoObjeto" value="' . $_POST["TipoObjeto"] . '">'; 
			if($_POST["TipoObjeto"] == "0"){
					//pais
				echo '<input type="hidden" id="hdPais" name="hdPais" value="' . $_POST["Pais"] . '">'; 
				echo '<input type="hidden" id="hdNPais" name="hdPais" value="' . $_POST["NPais"] . '">'; 
			}else if($_POST["TipoObjeto"] == "1"){
					//evento
				echo '<input type="hidden" id="hdEvento" name="hdEvento" value="' . $_POST["Evento"] . '">';
				echo '<input type="hidden" id="hdNEvento" name="hdEvento" value="' . $_POST["NEvento"] . '">';
			}else{
				echo '<input type="hidden" id="hdPunto" name="hdPunto" value="' . $_POST["Punto"] . '">';
				echo '<input type="hidden" id="hdNPunto" name="hdPunto" value="' . $_POST["NPunto"] . '">';
			}	

			echo '<input type="hidden" id="hdFecha" name="hdTipoObjeto" value="' . $_POST["Fecha"] . '">'; 
			echo '<input type="hidden" id="hdElaborado" name="hdTipoObjeto" value="' . $_POST["ElaboradoPor"] . '">'; 

			?>
		</div>
		<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>
		<?php echo $c_funciones->getFooterNivel2(); ?>	
	</div>
	<script type="text/javascript">	

		$("input[name=rdbReco]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating1").text(valor);
		});

		$("input[name=rdbReco1]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating2").text(valor);
		});

		$("input[name=rdbReco2]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating3").text(valor);
		});

		$("input[name=rdbReco3]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating4").text(valor);
		});

		$("input[name=rdbReco4]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating5").text(valor);
		});

		$("input[name=rdbReco5]").change(function(){
			var valor = $(this).val();
			$("#lblTbRating6").text(valor);
		});

		$("input[name=rdbReco6]").change(function(){
			var valor = $(this).val();
			$("#lblTb1Rating7").text(valor);
		});

		$("input[type=radio]").change(function(){
				//parseFloat(yourString).toFixed(2)
				var r1 = $("#lblTbRating1").text().trim();
				var r2 = $("#lblTbRating2").text().trim();
				var r3 = $("#lblTbRating3").text().trim();
				var r4 = $("#lblTbRating4").text().trim();
				var r5 = $("#lblTbRating5").text().trim();
				var r6 = $("#lblTbRating6").text().trim();
				var r7 = $("#lblTb1Rating7").text().trim();
				res = parseFloat(parseFloat(r1) + parseFloat(r2) + parseFloat(r3) + parseFloat(r4) + parseFloat(r5) + parseFloat(r6) + parseFloat(r7)).toFixed(2);
				$("#lblTbRatingFinal").text(res.toString());
			});

		function evaluarCRR(){

			/*Valores*/
			var v1 = $("#lblTbRating1").text().trim();
			var v2 = $("#lblTbRating2").text().trim();
			var v3 = $("#lblTbRating3").text().trim();
			var v4 = $("#lblTbRating4").text().trim();
			var v5 = $("#lblTbRating5").text().trim();
			var v6 = $("#lblTbRating6").text().trim();
			var v7 = $("#lblTb1Rating7").text().trim();
			var vTotal = $("#lblTbRatingFinal").text().trim();

			/*Explicaciones*/
			var e1 = $("#txtTb1Exp").val();
			var e2 = $("#txtTb2Exp").val();
			var e3 = $("#txtTb3Exp").val();
			var e4 = $("#txtTb4Exp").val();
			var e5 = $("#txtTb5Exp").val();
			var e6 = $("#txtTb6Exp").val();
			var e7 = $("#txtTb7Exp").val();

			/*Filas Seleccionadas*/
			var f1 = $("input[name=rdbReco]:checked").attr("selec");
			var f2 = $("input[name=rdbReco1]:checked").attr("selec");
			var f3 = $("input[name=rdbReco2]:checked").attr("selec");
			var f4 = $("input[name=rdbReco3]:checked").attr("selec");
			var f5 = $("input[name=rdbReco4]:checked").attr("selec");
			var f6 = $("input[name=rdbReco5]:checked").attr("selec");
			var f7 = $("input[name=rdbReco6]:checked").attr("selec");

			
			var tipoObjeto = $("#hdTipoObjeto").val();
			var Fecha = $("#hdFecha").val();
			var ElaboradoPor = $("#hdElaborado").val();

			var idPais = "";
			var idEvento = "";
			var idPunto = "";

			var NPais = "";
			var NEvento = "";
			var NPunto = "";

			//0: pais, 1: evento, 2: punto de evaluacion
			if(tipoObjeto == "0"){
				//pais
				idPais = $("#hdPais").val();
				NPais = $("#hdNPais").val();
			}else if(tipoObjeto == "1"){
				//evento
				idEvento = $("#hdEvento").val();
				NEvento = $("#hdNEvento").val();
			}else{
				//punto
				idPunto = $("#hdPunto").val();
				NPunto = $("#hdNPunto").val();
			}


			$.ajax({
				type: "POST",
				url: "../funcionesAjax.php",
				data: {        					
					nombreMetodo: "ReporteCRR",
					PjxTipoObjeto: tipoObjeto,
					PjxFecha: Fecha,
					PjxElaboradoPor: ElaboradoPor,
					PjxIdPais: idPais,
					PjxIdEvento: idEvento,
					PjxIdPunto: idPunto,
					PjxPais: NPais,
					PjxEvento: NEvento,
					PjxPunto: NPunto,
					PjxTot1: v1,
					PjxTot2: v2,
					PjxTot3: v3,
					PjxTot4: v4,
					PjxTot5: v5,
					PjxTot6: v6,
					PjxTot7: v7,
					PjxTot: vTotal,
					PjxExp1: e1,
					PjxExp2: e2,
					PjxExp3: e3,
					PjxExp4: e4,
					PjxExp5: e5,
					PjxExp6: e6,
					PjxExp7: e7,
					PxjFila1: f1,
					PxjFila2: f2,
					PxjFila3: f3,
					PxjFila4: f4,
					PxjFila5: f5,
					PxjFila6: f6,
					PxjFila7: f7
				},
				beforeSend: function () {
					//$("#modalCargando").modal("show");                       
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					try {
						var dat = parseInt(datos);
						alert(datos);

						window.location = "ReporteCRR.php?idRepo=" + datos;
					}
					catch(err) {
						window.location = "ReporteCRR.php?idRepo=0";
					}
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide"); 
					alert(error);
				}
			});
}
</script>
</body>
</html>