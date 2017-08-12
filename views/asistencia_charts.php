<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="row">
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
										<div id="dpFechaContainer" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
											<input type="date" id="dpFecha" name="dpFecha" class="mdl-textfield__input" required="required" value="<?php echo date('Y-m-d'); ?>">
											<label class="mdl-textfield__label" for="dpFecha">Fecha:</label>
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
								<div class="col-md-12">
									<div class="box">&nbsp;</div>
								</div>																
							</div>								
							<div class="row">
								<div class="col-md-1">
									<div class="box">&nbsp;</div>
								</div>	
								<div class="col-md-4">
									<div class="box">&nbsp;</div>
								</div>																
								<div class="col-md-2">
									<div class="box">&nbsp;</div>
								</div>																
								<div class="col-md-3">
									<div class="box">
										<button id="btnGraficar" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">GRAFICAR</button>										
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
				<div class="col-md-9 asistencia-list-container">
					<div class="box">	
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
								<div class="box" style="height: 450px;">
									<canvas id="myChart"></canvas>	
								</div>
							</div>	
							<div class="col-md-1">
								<div class="box">&nbsp;</div>
							</div>													
						</div>									
					</div>
				</div>								
			</div>
		</div>
	</div>
</div>