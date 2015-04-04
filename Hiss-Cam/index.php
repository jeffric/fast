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
<?php echo $c_funciones->getHeaderNivel2("Reporte Hiss-Cam", 
	'  <style>
	.panel-content {
		padding: 1em;
	}
</style>'); ?>
<body>
	<div data-role="page" id="page">
		<?php $c_funciones->getHeaderPageNivel2("FAST Reporte Hiss-Cam"); ?>
		<div role="main" class="ui-content">			
			<div id="Reporte" style="overflow-x: scroll;" class="ui-body ui-body-a ui-corner-all">

				<div style="text-align: center;">
					<h1 style="font-size: 4em; color: #4C4C4C;" >Evaluación <span style="color: orange;">Hiss-Cam</span> </h1>
				</div>
				<table id="tablaGeneral"  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
					<thead></thead>
					<tbody>
						<!-- encabezado de la evaluacion -->
						<tr>
							<table data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
								<thead></thead>
								<tbody>
									<tr>
										<th class="cabeceraNormal">Nombre y Departamento</th>
										<td>
											<textarea rows="4" cols="30" id="txtNombreYDepto" value="" name="txtNombreYDepto"></textarea>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Fecha del reporte</th>
										<td>
											<input type="date" name="txtFechaCreacion" id="txtFechaCreacion" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"/>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Tema</th>
										<td>
											<textarea rows="4" cols="30" id="txtTema" class="negrita" value="" name="txtNombreYDepto"></textarea>							
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">País/Región</th>
										<td>
											<textarea rows="4" cols="30" id="txtPaisRegion" value="" name="txtNombreYDepto"></textarea>
										</td>
									</tr>
									<tr>
										<th class="cabeceraNormal">Ejercito/Otro actor</th>
										<td>
											<textarea rows="4" cols="30" id="txtEjercito" value="" name="txtNombreYDepto"></textarea>							
										</td>
									</tr>
									<tr>
										<th class="subCabecera">Status quo</th>
										<td>
											<textarea rows="4" cols="30" id="txtStatusQuo" value="" name="txtNombreYDepto"></textarea>							
										</td>
									</tr>
									<tr>
										<th class="subCabecera">Cambio propuesto</th>
										<td>
											<textarea rows="4" cols="30" id="txtCambioPropuesto" value="" name="txtNombreYDepto"></textarea>							
										</td>
									</tr>
									<tr >
										<th class="cabeceraNormal">Resumen especifico</th>
										<td>
											<textarea rows="8" cols="30" id="txtResumenEspecifico" value="" name="txtNombreYDepto"></textarea>							
										</td>
									</tr>
								</tbody>
							</table>
							<br><br>
						</tr>
						<!-- parte hiss -->
						<tr>
							<table style=" width: 100%"  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
								<thead class="cabeceraNormal">
									<td colspan="2">Principio</td>
									<td>Respuesta</td>
									<td>S/N</td>
								</thead>
								<tbody>
									<!-- Humanitaria imperativa -->
									<tr>
										<td style="width:5%;"><h1 style="font-size: 7em; color:orange;">H</h1></td>
										<td style="width:35%">
											<p>											
												<div style="text-align: left;">
													<h3>umanitaria Imperativa</h3>
													Es esta acción:<br>
													>	¿Solamente ocurre en orden de adelantar la imperativa humanitaria para proveer 
													ayuda a esos en necesidad, de acuerdo con los más altos estándares de entrega de ayuda?  
												</div>
											</p>
										</td>
										<td style="width:35%">
											<textarea rows="13" style="width:100%;" id="txtRespuestaH" value="" name="txtRespuestaH"></textarea>
										</td>
										<td style="width:25%">
											<label><input type="checkbox" id="chkH" name="chkH"/> Sí/No</label>
											<br>
											<label><input type="checkbox" id="chkH_bandera" name="chkH_bandera"/><img src="data:image/jpeg;base64,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" alt="bandera"/></label>
										</td>
									</tr>
									<!-- Imparcialidad e independencia -->
									<tr>
										<td><h1 style="font-size: 7em; color:orange;">I</h1></td>
										<td>
											<p>
												<div style="text-align: left;">
													<h3>mparcialidad e Independencia</h3>								
													Está esta acción asegurando que:
													<br>> 	¿No discriminamos en base a género, raza, etnicidad, religión, nacionalidad, afiliación política estatus social?
													<br>>	¿Nuestro alivio es guiado por una evaluación de necesidades?
													<br>>	¿prioridad es  dada a los casos más urgentes de angustia?
												</div>
											</p>
										</td>
										<td>
											<textarea  id="txtRespuestaI0" value="" name="txtRespuestaI0"></textarea>
										</td>
										<td>
											<label><input type="checkbox" id="chkI0" name="chkI0"/> Sí/No</label>
											<br>
											<label><input type="checkbox" id="chkI0_bandera" name="chkI0_bandera"/>
												<img src="../img/flag.jpg" alt="bandera"/></label>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<p>											
													<div style="text-align: left;">
														>	¿Somos neutrales en la provisión de ayuda (particularmente en el contexto de emergencias complejas)?
													</div>
												</p>
											</td>
											<td>
												<textarea id="txtRespuestaI1" value="" name="txtRespuestaI1"></textarea>
											</td>
											<td>
												<label><input type="checkbox" id="chkI1" name="chkI1"/>Sí/No</label>	
												<br>									
												<label><input type="checkbox" id="chkI1_bandera" name="chkI1_bandera"/>
													<img src="../img/flag.jpg" alt="bandera"/></label>
												</td>
											</tr>
											<tr>
												<td></td>
												<td>
													<p>											
														<div style="text-align:left;">
															Está esta acción asegurando que: <br>
															>	¿nuestro compromiso es hacia la imperativa humanitaria y no a la 
															agenda de gobiernos, grupos políticos, o fuerzas militares?
														</div>
													</p>
												</td>
												<td>
													<textarea  id="txtRespuestaI2" value="" name="txtRespuestaI2"></textarea>
												</td>
												<td>
													<label><input type="checkbox" id="chkI2" name="chkI2"/>Sí/No</label>
													<label><input type="checkbox" id="chkI2_bandera" name="chkI2_bandera"/>
														<img src="../img/flag.jpg" alt="bandera"/></label>										
													</td>
												</tr>
												<tr>
													<td></td>
													<td>
														<p>											
															<div style="text-align:left;">
																>	¿nosotros no actuamos de una manera que entrega nuestra habilidad de advocar? 
															</div>
														</p>
													</td>
													<td>
														<textarea id="txtRespuestaI3" value="" name="txtRespuestaI3"></textarea>
													</td>
													<td>
														<label><input type="checkbox" id="chkI3" name="chkI3"/>Sí/No</label>
														<label><input type="checkbox" id="chkI3_bandera" name="chkI3_bandera"/>
															<img src="../img/flag.jpg" alt="bandera"/></label>
														</td>
													</tr>
													<tr>
														<td></td>
														<td>
															<p>											
																<div style="text-align:left;">
																	>	¿nosotros no ponemos en peligro la libertad de movimiento del personal humanitario?
																</div>
															</p>
														</td>
														<td>
															<textarea id="txtRespuestaI4" value="" name="txtRespuestaI4"></textarea>
														</td>
														<td>
															<label><input type="checkbox" id="chkI4" name="chkI4"/>Sí/No</label>
															<label><input type="checkbox" id="chkI4_bandera" name="chkI4_bandera"/>
																<img src="../img/flag.jpg" alt="bandera"/></label>
															</td>
														</tr>
														<tr>
															<td></td>
															<td>
																<p>											
																	<div style="text-align: left;">
																		>	¿tenemos la libertad de conducir evaluaciones independientes?
																	</div>
																</p>
															</td>
															<td>
																<textarea id="txtRespuestaI5" value="" name="txtRespuestaI5"></textarea>
															</td>
															<td>
																<label><input type="checkbox" id="chkI5" name="chkI5"/>Sí/No</label>
																<label><input type="checkbox" id="chkI5_bandera" name="chkI5_bandera"/>
																	<img src="../img/flag.jpg" alt="bandera"/></label>
																</td>
															</tr>
															<tr>
																<td></td>
																<td>
																	<p>											
																		<div style="text-align: left;">
																			>	¿tenemos la libertad de seleccionar el personal?
																		</div>
																	</p>
																</td>
																<td>
																	<textarea id="txtRespuestaI6" value="" name="txtRespuestaI6"></textarea>
																</td>
																<td>
																	<label><input type="checkbox" id="chkI6" name="chkI6"/>Sí/No</label>
																	<label><input type="checkbox" id="chkI6_bandera" name="chkI6_bandera"/>
																		<img src="../img/flag.jpg" alt="bandera"/></label>
																	</td>
																</tr>
																<tr>
																	<td></td>
																	<td>
																		<p>											
																			<div style="text-align: left;">
																				>	¿tenemos la libertad de identificar beneficiarios en base a necesidades? 
																			</div>
																		</p>
																	</td>
																	<td>
																		<textarea id="txtRespuestaI7" value="" name="txtRespuestaI7"></textarea>
																	</td>
																	<td>
																		<label><input type="checkbox" id="chkI7" name="chkI7"/>Sí/No</label>
																		<label><input type="checkbox" id="chkI7_bandera" name="chkI7_bandera"/>
																			<img src="../img/flag.jpg" alt="bandera"/></label>
																		</td>
																	</tr>
																	<tr>
																		<td></td>
																		<td>
																			<p>											
																				<div style="text-align: left;">
																					>	¿tenemos un flujo de información libre entre las agencias humanitarias?
																				</div>
																			</p>
																		</td>
																		<td>
																			<textarea id="txtRespuestaI8" value="" name="txtRespuestaI8"></textarea>
																		</td>
																		<td>
																			<label><input type="checkbox" id="chkI8" name="chkI8"/>Sí/No</label>
																			<label><input type="checkbox" id="chkI8_bandera" name="chkI8_bandera"/>
																				<img src="../img/flag.jpg" alt="bandera"/></label>
																			</td>
																		</tr>
																		<!-- Seguridad y proteccion -->
																		<tr>
																			<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
																			<td>
																				<p>
																					<div style="text-align: left;">
																						<h3>eguridad y Protección</h3>								
																						Mediante una rápida evaluación de "No hacer daño" del contexto, está esta acción garantizando que podamos prevenir a lo mejor de nuestra capacidad cualquier tipo de consecuencias no deseadas para: <br> 
																						>	¿la seguridad de nuestro personal?<br>
																						>	¿la seguridad de nuestros compañeros locales?<br>
																						>	¿la seguridad de nuestros beneficiarios?<br>
																						>	¿la seguridad de nuestras agencias?<br>
																						>	¿el fomento de conflicto?
																					</div>
																				</p>
																			</td>
																			<td>
																				<textarea id="txtRespuestaS1" value="" name="txtRespuestaS1"></textarea>
																			</td>
																			<td>
																				<label><input type="checkbox" id="chkS1" name="chkS1"/>Sí/No</label>
																				<label><input type="checkbox" id="chkS1_bandera" name="chkS1_bandera"/>
																					<img src="../img/flag.jpg" alt="bandera"/></label>
																				</td>
																			</tr>
																			<tr>
																				<td><h1 style="font-size: 7em; color:orange;">S</h1></td>
																				<td>
																					<p>
																						<div style="text-align: left;">
																							<h3>ostenibilidad</h3>								
																							Es esta acción: <br>
																							>	¿tomando en cuenta una perspectiva de plazo más largo que la inmediata?
																						</div>
																					</p>
																				</td>
																				<td>
																					<textarea id="txtRespuestaS2_0" value="" name="txtRespuestaS2_0"></textarea>
																				</td>
																				<td>
																					<label><input type="checkbox" id="chkS2_0" name="chkS2_0"/>Sí/No</label>
																					<label><input type="checkbox" id="chkS2_0_bandera" name="chkS2_0_bandera"/>
																						<img src="../img/flag.jpg" alt="bandera"/></label>
																					</td>
																				</tr>
																				<tr>
																					<td></td>
																					<td>
																						<p>
																							<div style="text-align: left;">
																								>	¿alineada estratégicamente con el trabajo de VM en la asistencia de comunidades para vencer la pobreza e injusticia?
																							</div>
																						</p>
																					</td>
																					<td>
																						<textarea id="txtRespuestaS2_1" value="" name="txtRespuestaS2_1"></textarea>
																					</td>
																					<td>
																						<label><input type="checkbox" id="chkS2_1" name="chkS2_1"/>Sí/No</label>
																						<label><input type="checkbox" id="chkS2_1_bandera" name="chkS2_1_bandera"/>
																							<img src="../img/flag.jpg" alt="bandera"/></label>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</tr>

																		<!-- parte cam -->
																		<tr>
																			<table style=" width: 100%"  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
																				<thead class="cabeceraNormal">
																					<td colspan="2">Proceso</td>
																					<td>Respuesta</td>
																					<td>S/N</td>
																				</thead>
																				<tbody>
																					<tr>
																						<td style="width: 5%;"><h1 style="font-size: 7em; color:orange;">C</h1></td>
																						<td style="width: 35%;">
																							<p>
																								<div style="text-align: left;">
																									<h3>onvincente propósito</h3>								
																									Es esta acción:<br>
																									>	¿en busca de un propósito importante o convincente? (consideraciones económicas en y de ellos mismos nunca debe constituir esto)
																									<br>>	¿en busca de un resultado deseado especifico?
																									<br>>	¿alineado con las miras estratégicas de VM (incluyendo global, regional, nacional)?
																								</div>
																							</p>
																						</td>
																						<td style="width: 35%;">
																							<textarea id="txtRespuestaC" value="" name="txtRespuestaC"></textarea>
																						</td>
																						<td style="width: 25%;">
																							<label><input type="checkbox" id="chkC" name="chkC"/> Sí/No</label>
																						</td>
																					</tr>
																					<tr>
																						<td><h1 style="font-size: 7em; color:orange;">A</h1></td>
																						<td>
																							<p>											
																								<div style="text-align: left;">
																									<h3>propiado, adaptado & adecuadamente informado</h3>								
																									Es esta acción: <br>
																									>	¿apropiado para su propósito (ej. razonable y por evidencia conectado a la mira anterior)?  
																									<br>>	¿adaptado al contexto?
																									<br>>	¿adecuadamente informado por medio de evidencia tal como análisis y evaluaciones de contexto existentes y cualquier información nueva disponible?
																								</div>
																							</p>
																						</td>
																						<td>
																							<textarea  id="txtRespuestaA" value="" name="txtRespuestaA"></textarea>
																						</td>
																						<td>
																							<label><input type="checkbox" id="chkA" name="chkA"/> Sí/No</label>
																						</td>
																					</tr>
																					<tr>
																						<td><h1 style="font-size: 7em; color:orange;">M</h1></td>
																						<td>
																							<p>
																								<div style="text-align: left;">
																									<h3>inimo impacto negativo</h3>								
																									Es esta acción: <br>
																									>	¿el último recurso en obtener la meta (ej. todos los otros medios han sido agotados)?
																									<br>>	el menos impactante:<br>
																									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	¿en la inmediata y largo plazo?<br>
																									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;o	¿en accionistas (comunidades, iguales de industria y VM)?
																								</div>
																							</p>
																						</td>
																						<td>
																							<textarea id="txtRespuestaM" value="" name="txtRespuestaM"></textarea>
																						</td>
																						<td>
																							<label><input type="checkbox" id="chkM" name="chkM"/>Sí/No</label>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</tr>

																		<!-- parte de recomendacion -->
																		<tr>
																			<table width="100%" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
																				<thead>
																					<th colspan="2"  class="cabeceraNormal">
																						<div class="ui-radio ui-mini">
																							<label for="rdbCortar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cortar</label>
																							<input type="radio" name="rdbReco" class="" id="rdbCortar" value="0" checked="checked">
																						</div>
																						<div class="ui-radio ui-mini">
																							<label for="rdbCoexistir" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Coexistir</label>
																							<input type="radio" name="rdbReco" class="" id="rdbCoexistir" value="1">
																						</div>
																						<div class="ui-radio ui-mini">
																							<label for="rdbCoordinar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Coordinar</label>
																							<input type="radio" name="rdbReco" class="" id="rdbCoordinar" value="2">
																						</div>
																						<div class="ui-radio ui-mini">
																							<label for="rdbCooperar" class="ui-btn ui-corner-all ui-btn-inherit ui-btn-icon-left ui-radio-on ui-first-child" >Cooperar</label>
																							<input type="radio" name="rdbReco" class="" id="rdbCooperar" value="3">
																						</div>
																						<p>Elija una de estas cuatro palabras que mejor describa el nivel de compromiso propuesto</p>
																					</th>
																				</thead>
																				<tbody>
																					<tr>									
																						<td style="width:20%">
																							<h3><b>Recomendación</b></h3>
																						</td>
																						<td>
																							<textarea rows="10" cols="30" id="txtRecomendacion" value="" name="txtRecomendacion"></textarea>
																						</td>									
																					</tr>
																				</tbody>
																			</table>
																		</tr>							

																		<!-- parte decision final y base -->
																		<tr>
																			<table style="width:100%;" border  data-mode="reflow" style="border:solid 1px;" class="ui-responsive table-stroke ui-table ui-table-">
																				<thead class="cabeceraNormal">
																					<th colspan="2">									
																						<h3>Decisión final y base</h3>
																					</th>
																				</thead>
																				<tbody>
																					<tr>									
																						<td style="width: 35%;">
																							<b>Nombre y departamento</b>
																						</td>
																						<td>
																							<textarea rows="10" cols="30" id="txtNombreyDepaFinal" value="" name="txtNombreyDepaFinal"></textarea>
																						</td>									
																					</tr>
																					<tr>									
																						<td>
																							<b>Fecha de recibo</b>
																						</td>
																						<td>
																							<input type="date" name="txtFechaRecibo" id="txtFechaRecibo" value="" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"/>
																						</td>									
																					</tr>
																					<tr>									
																						<td>
																							<b>
																								>	¿Acuerdo con evaluación?<br>
																								>	¿Áreas de desacuerdo?<br>
																								>	¿El proceso se mueve hacia adelante?<br>
																								>	¿Qué grupos han sido alertadas?<br>
																							</b>
																						</td>
																						<td>
																							<textarea rows="10" cols="30" id="txtDecisionFinalUltima" value="" name="txtDecisionFinalUltima"></textarea>
																						</td>									
																					</tr>
																					<tr>									
																						<td>
																							<b>
																								Aprobado por
																							</b>
																						</td>
																						<td>
																							<textarea rows="10" cols="30" id="txtAprobadoPor" value="" name="txtAprobadoPor"></textarea>
																						</td>									
																					</tr>

																				</tbody>
																			</table>
																		</tr>
																		<tr>
																			<td>
																				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
																					<input type="button" id="btnEvaluar" data-theme="a" name="btnEvaluar" onclick="getEvalJsonObject();" value="Evaluar" class="ui-btn-hidden" aria-disabled="false"/>
																				</div>
																			</td>
																		</tr>
																	</tbody>			
																</table>

															</div>
														</div>
														<?php echo $c_funciones->getMenuNivel2($strTipoUsuario); ?>			
														<?php echo $c_funciones->getFooterNivel2(); ?>																
														</div>

												</body>
												<script>
													function getEvalJsonObject(){
			//= $("#").val();
			var strNombreYDepto = $("#txtNombreYDepto").val();
			var strFechaReporte = $("#txtFechaCreacion").val();
			var strTema = $("#txtTema").val();
			var strPaisRegion = $("#txtPaisRegion").val();
			var strEjercitoOtro = $("#txtEjercito").val();
			var strStatusQuo = $("#txtStatusQuo").val();
			var strCambioPropuesto = $("#txtCambioPropuesto").val();
			var strResumenEspecifico = $("#txtResumenEspecifico").val();
			//nomenclatura: H: letra a evaluar, # numero de fila o pregunta, R: respuesta, SN: si/ no, B: bandera
			var strH1R = $("#txtRespuestaH").val();
			
			var strH1SN;
			if($('#chkH').is(':checked')){
				strH1SN = 1;
			}else{
				strH1SN = 0;
			}
			
			var strH1B;
			if($('#chkH_bandera').is(':checked')){
				strH1B = 1;
			}else{
				strH1B = 0;
			}


			var strI0R = $("#txtRespuestaI0").val();
			var strI0SN;
			if($('#chkI0').is(':checked')){
				strI0SN = 1;
			}else{
				strI0SN = 0;
			}
			
			var strI0B;
			if($('#chkI0_bandera').is(':checked')){
				strI0B = 1;
			}else{
				strI0B = 0;
			}


			var strI1R = $("#txtRespuestaI1").val();
			var strI1SN;
			if($('#chkI1').is(':checked')){
				strI1SN = 1;
			}else{
				strI1SN = 0;
			}
			
			var strI1B;
			if($('#chkI1_bandera').is(':checked')){
				strI1B = 1;
			}else{
				strI1B = 0;
			}


			var strI2R = $("#txtRespuestaI2").val();
			var strI2SN;
			if($('#chkI2').is(':checked')){
				strI2SN = 1;
			}else{
				strI2SN = 0;
			}
			
			var strI2B;
			if($('#chkI2_bandera').is(':checked')){
				strI2B = 1;
			}else{
				strI2B = 0;
			}


			var strI3R = $("#txtRespuestaI3").val();
			var strI3SN;
			if($('#chkI3').is(':checked')){
				strI3SN = 1;
			}else{
				strI3SN = 0;
			}
			
			var strI3B;
			if($('#chkI3_bandera').is(':checked')){
				strI3B = 1;
			}else{
				strI3B = 0;
			}


			var strI4R = $("#txtRespuestaI4").val();
			var strI4SN;
			if($('#chkI4').is(':checked')){
				strI4SN = 1;
			}else{
				strI4SN = 0;
			}
			
			var strI4B;
			if($('#chkI4_bandera').is(':checked')){
				strI4B = 1;
			}else{
				strI4B = 0;
			}


			var strI5R = $("#txtRespuestaI5").val();
			var strI5SN;
			if($('#chkI5').is(':checked')){
				strI5SN = 1;
			}else{
				strI5SN = 0;
			}
			
			var strI5B;
			if($('#chkI5_bandera').is(':checked')){
				strI5B = 1;
			}else{
				strI5B = 0;
			}


			var strI6R = $("#txtRespuestaI6").val();
			var strI6SN;
			if($('#chkI6').is(':checked')){
				strI6SN = 1;
			}else{
				strI6SN = 0;
			}
			
			var strI6B;
			if($('#chkI6_bandera').is(':checked')){
				strI6B = 1;
			}else{
				strI6B = 0;
			}


			var strI7R = $("#txtRespuestaI7").val();
			var strI7SN;
			if($('#chkI7').is(':checked')){
				strI7SN = 1;
			}else{
				strI7SN = 0;
			}
			
			var strI7B;
			if($('#chkI7_bandera').is(':checked')){
				strI7B = 1;
			}else{
				strI7B = 0;
			}


			var strI8R = $("#txtRespuestaI8").val();
			var strI8SN;
			if($('#chkI8').is(':checked')){
				strI8SN = 1;
			}else{
				strI8SN = 0;
			}
			
			var strI8B;
			if($('#chkI8_bandera').is(':checked')){
				strI8B = 1;
			}else{
				strI8B = 0;
			}


			var strS0_1R = $("#txtRespuestaS1").val();
			var strS0_1SN;
			if($('#chkS1').is(':checked')){
				strS0_1SN = 1;
			}else{
				strS0_1SN = 0;
			}
			
			var strS0_1B;
			if($('#chkS1_bandera').is(':checked')){
				strS0_1B = 1;
			}else{
				strS0_1B = 0;
			}



			var strS2_0R = $("#txtRespuestaS2_0").val();
			var strS2_0SN;
			if($('#chkS2_0').is(':checked')){
				strS2_0SN = 1;
			}else{
				strS2_0SN = 0;
			}
			
			var strS2_0B;
			if($('#chkS2_0_bandera').is(':checked')){
				strS2_0B = 1;
			}else{
				strS2_0B = 0;
			}


			var strS2_1R = $("#txtRespuestaS2_1").val();
			var strS2_1SN;
			if($('#chkS2_1').is(':checked')){
				strS2_1SN = 1;
			}else{
				strS2_1SN = 0;
			}
			
			var strS2_1B;
			if($('#chkS2_1_bandera').is(':checked')){
				strS2_1B = 1;
			}else{
				strS2_1B = 0;
			}



			var strCR = $("#txtRespuestaC").val();
			var strCSN;
			if($('#chkC').is(':checked')){
				strCSN = 1;
			}else{
				strCSN = 0;
			}
			

			var strAR = $("#txtRespuestaA").val();
			var strASN;
			if($('#chkA').is(':checked')){
				strASN = 1;
			}else{
				strASN = 0;
			}


			var strMR = $("#txtRespuestaM").val();
			var strMSN;
			if($('#chkM').is(':checked')){
				strMSN = 1;
			}else{
				strMSN = 0;
			}


			var strCompromiso = "";
			if($('#rdbCortar').is(':checked')){
				strCompromiso = "Cortar";
			}else if($('#rdbCoexistir').is(':checked')){
				strCompromiso = "Coexistir";
			}else if($('#rdbCoordinar').is(':checked')){
				strCompromiso = "Coordinar";
			}else{
				strCompromiso = "Cooperar";
			}

			var strRecomendacion = $("#txtRecomendacion").val();
			var strNombreyDepaFinal = $("#txtNombreyDepaFinal").val();
			var strFechaRecibo = $("#txtFechaRecibo").val();
			var strDecisionFinalUltima = $("#txtDecisionFinalUltima").val();
			var strAprobadoPor = $("#txtAprobadoPor").val();

			$.ajax({
				type: "POST",
				url: "../funcionesAjax.php",
				data: {                   
					nombreMetodo: "ReporteHissCam",
					nombreDepto: strNombreYDepto,
					FechaReporte: strFechaReporte,
					Tema: strTema,
					PaisRegion: strPaisRegion,
					EjercitoOtro: strEjercitoOtro,
					StatusQuo: strStatusQuo,
					CambioProp: strCambioPropuesto,
					ResumenEspec: strResumenEspecifico,
					RespH1: strH1R,
					SiNoH1: strH1SN,
					BanderaH1: strH1B,
					RespI0: strI0R,
					SiNoI0: strI0SN,
					BanderaI0: strI0B,
					RespI1: strI1R,
					SiNoI1: strI1SN,
					BanderaI1: strI1B,
					RespI2: strI2R,
					SiNoI2: strI2SN,
					BanderaI2: strI2B,
					RespI3: strI3R,
					SiNoI3: strI3SN,
					BanderaI3: strI3B,
					RespI4: strI4R,
					SiNoI4: strI4SN,
					BanderaI4: strI4B,
					RespI5: strI5R,
					SiNoI5: strI5SN,
					BanderaI5: strI5B,
					RespI6: strI6R,
					SiNoI6: strI6SN,
					BanderaI6: strI6B,
					RespI7: strI7R,
					SiNoI7: strI7SN,
					BanderaI7: strI7B,
					RespI8: strI8R,
					SiNoI8: strI8SN,
					BanderaI8: strI8B,
					RespS0_1: strS0_1R,
					SiNoS0_1: strS0_1SN,
					BanderaS0_1: strS0_1B,
					RespS2_0: strS2_0R,
					SiNoS2_0: strS2_0SN,
					BanderaS2_0: strS2_0B,
					RespS2_1: strS2_1R,
					SiNoS2_1: strS2_1SN,
					BanderaS2_1: strS2_1B,
					RespC: strCR,
					SiNoC: strCSN,
					RespA: strAR,
					SiNoA:strASN,					
					RespM: strMR,
					SiNoM: strMSN,
					Compromiso: strCompromiso,
					Recomendacion: strRecomendacion,
					NombreDepaFinal: strNombreyDepaFinal,
					FechaRecibo: strFechaRecibo,
					DecisionFinal: strDecisionFinalUltima,
					AprobadoPor: strAprobadoPor
				},
				beforeSend: function () {
					//$("#modalCargando").modal("show");                       
				},
				success: function (datos) {
					//$("#modalCargando").modal("hide");
					if(isNumber(datos)){

						alert(datos);
						window.location = "reporteHiss-Cam.php?idRepo=" + datos;

					}else{

						window.location = "reporteHiss-Cam.php?idRepo=0";
					}					
				},
				error: function (objeto, error, objeto2) {
					//$("#modalCargando").modal("hide"); 
					alert(error);
				}
			});
			
		}

		function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}
	</script>
	</html>