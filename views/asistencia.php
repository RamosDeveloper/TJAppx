<form id="frmAsistencia">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="row">
					<div class="col-md-9 asistencia-list-container">
						<div class="box">
							<table style="width: 100%;" class="mdl-data-table mdl-js-data-table">
								<thead>
									<tr>
										<th class="mdl-data-table__cell--non-numeric">CONGREGACION</th>
										<th class="mdl-data-table__cell--non-numeric">SECCION</th>
										<th class="mdl-data-table__cell--non-numeric">REUNION</th>
										<th class="mdl-data-table__cell--non-numeric">FECHA</th>
										<th>ASISTENCIA</th>
										<th>&nbsp;</th>
									</tr>
								</thead>
								<tbody id="tbAsistenciaBody">													
								</tbody>
							</table>				
						</div>
					</div>				
					<div class="col-md-3">
						<div class="box">
							<div class="mdl-shadow--2dp asistencia-action-card">
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>								
									<div class="col-md-10">
										<div class="box">
											<div id="dpFechaCapturaContainer" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input type="date" id="dpFechaCaptura" name="dpFechaCaptura" class="mdl-textfield__input" required="required" value="<?php echo date('Y-m-d'); ?>">
												<label class="mdl-textfield__label" for="dpFechaCaptura">Fecha captura:</label>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>	
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>								
									<div class="col-md-10">
										<div class="box">
											<div id="cboReunionesContainer" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<select id="cboReuniones" name="cboReuniones" class="mdl-textfield__input" required="required"></select>
												<label class="mdl-textfield__label" for="cboReuniones">Reunion:</label>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>								
									<div class="col-md-10">
										<div class="box">
											<div id="cboCongregacionesContainer" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<select id="cboCongregaciones" name="cboCongregaciones" class="mdl-textfield__input" required="required"></select>
												<label class="mdl-textfield__label" for="cboCongregaciones">Congregacion:</label>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>								
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>								
									<div class="col-md-10">
										<div class="box">
											<div id="cboSeccionesContainer" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<select id="cboSecciones" name="cboSecciones" class="mdl-textfield__input" required="required"></select>
												<label class="mdl-textfield__label" for="cboSecciones">Seccion:</label>
											</div>
										</div>
									</div>
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																									
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>							
									<div class="col-md-10">
										<div class="box">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="number" id="txtAsistencia" required="">
												<label class="mdl-textfield__label" for="txtAsistencia">Asistencia:</label>
											</div>										
										</div>
									</div>	
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																							
								</div>	
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>								
								<div class="row">
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>	
									<div class="col-md-4">
										<div class="box">
											<button id="btnGoToAsistenciaCharts" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"><i class="material-icons">insert_chart</i>CHARTS</button>
										</div>
									</div>																
									<div class="col-md-2">
										<div class="box">&nbsp;</div>
									</div>																
									<div class="col-md-3">
										<div class="box">
											<button id="btnCapturarAsistencia" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">CAPTURAR</button>										
										</div>
									</div>	
									<div class="col-md-2">
										<div class="box">&nbsp;</div>
									</div>																							
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>								
								<div class="row">
									<div class="col-md-12">
										<div class="box">&nbsp;</div>
									</div>																
								</div>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>