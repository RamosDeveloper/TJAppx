<!DOCTYPE html>
<html>
<head>
	<title>TJAppx</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-blue.min.css" />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css">
	<link rel="stylesheet" href="css/sweetalert.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body style="height: 100%;">
	<div style="height: 100%;" class="row center-md middle-md">
		<div class="col-md-12">
			<div class="box">			
				<div class="row">
					<div class="col-md-4">
						<div class="box">&nbsp;</div>
					</div>
					<div class="col-md-4">			
						<div class="box login-card">				
							<form action="#">
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<h1>TjAppx&nbsp;<i class="material-icons">apps</i></h1>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" id="txtUsuario" required>
												<label class="mdl-textfield__label" for="txtUsuario">Usuario:</label>
											</div>								
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="password" id="pswContrasena" required>
												<label class="mdl-textfield__label" for="pswContrasena">Contrasena:</label>
											</div>								
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="box">
											<button id="btnLogin" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored"><i class="material-icons">https</i>&nbsp;Login</button>								
										</div>
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
							</form>				
						</div>
					</div>
					<div class="col-md-4">
						<div class="box">&nbsp;</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<dialog id="dlgLoader" class="mdl-dialog">
		<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>		
	</dialog>	
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="js/sweetalert.min.js"></script>
	<script src="js/login.js"></script>
</body>
</html>