<?php
$Congregacion = new stdClass();
$Congregacion->Id = ( isset( $_GET["congregacion_id"] ) ) ?  (int)$_GET["congregacion_id"] : 0;
$Congregacion->Nombre = ( isset( $_GET["congregacion_nombre"] ) ) ?  $_GET["congregacion_nombre"] : "NULL";
?>
<form id="frmSecciones">
	<input type="hidden" id="hdCongregacionData" name="hdCongregacionData" value='<?php echo json_encode( $Congregacion ); ?>'>
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="row">
					<div class="col-md-9 seccion-list-container">
						<div class="box">
							<ul id="listViewSecciones" class="mdl-list"></ul>						
						</div>
					</div>				
					<div class="col-md-3">
						<div class="box">
							<div class="mdl-shadow--2dp seccion-action-card">
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
												<input class="mdl-textfield__input" type="text" id="txtNombreSeccion" required="">
												<label class="mdl-textfield__label" for="txtNombreSeccion">Nombre de la seccion:</label>
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
											<button id="btnResetSeccionAction" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent noDisplay">CANCELAR</button>										
										</div>
									</div>																
									<div class="col-md-2">
										<div class="box">&nbsp;</div>
									</div>							
									<div class="col-md-3">
										<div class="box">
											<button id="btnGuardarSeccion" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">AGREGAR</button>										
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