<?php
$Reunible = new stdClass();
$Reunible->Id = ( isset( $_GET["reunible_id"] ) ) ?  (int)$_GET["reunible_id"] : 0;
$Reunible->Type = ( isset( $_GET["reunible_type"] ) ) ?  $_GET["reunible_type"] : "NULL";
$Reunible->Nombre = ( isset( $_GET["reunible_nombre"] ) ) ?  $_GET["reunible_nombre"] : "NULL";
?>
<form id="frmAsociacionReuniones">
	<input type="hidden" id="hdReunibleData" name="hdReunibleData" value='<?php echo json_encode( $Reunible ); ?>'>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="row">
					<div class="col-md-9 asociacion-reunion-list-container">
						<div class="box">
							<ul id="listViewAsociacionReuniones" class="mdl-list"></ul>						
						</div>
					</div>				
					<div class="col-md-3">
						<div class="box">
							<div class="mdl-shadow--2dp asociacion-reunion-action-card">
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
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="txtAsociacionHorario" required="">
												<label class="mdl-textfield__label" for="txtAsociacionHorario">Horario de la reunion:</label>
											</div>										
										</div>
									</div>	
									<div class="col-md-1">
										<div class="box">&nbsp;</div>
									</div>																							
								</div>	
								<div class="row">
									<div class="col-md-2">
										<div class="box">&nbsp;</div>
									</div>	
									<div class="col-md-3">
										<div class="box">
											<button id="btnResetAsociacionReunionAction" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent noDisplay">CANCELAR</button>										
										</div>
									</div>																
									<div class="col-md-2">
										<div class="box">&nbsp;</div>
									</div>							
									<div class="col-md-3">
										<div class="box">
											<button id="btnGuardarAsociacionReunion" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">AGREGAR</button>										
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