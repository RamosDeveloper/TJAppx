<?php
session_start();
if ( !isset( $_SESSION["Usuario"] ) ) {
	header( 'Location: error.php?error=403&rand=' . rand( 1 , 1000 ) , true , 303 );
}
$_modulo = ( isset( $_GET["modulo"] ) ) ? trim( $_GET["modulo"] ) : "SM"; # SM = sin modulo
?>
<!DOCTYPE html>
<html>
<head>
	<title>TJAppx - Main</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.red-blue.min.css" />
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/flexboxgrid/6.3.1/flexboxgrid.min.css">
	<link rel="stylesheet" href="../css/sweetalert.css">	
	<link rel="stylesheet" href="../css/main.css">
</head>
<body style="height: 100%;">
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
	  <header class="mdl-layout__header">
	    <div class="mdl-layout__header-row">
	      <!-- Title -->
	      <span class="mdl-layout-title">TjAppx</span>
	      <!-- Add spacer, to align navigation to the right -->
	      <div class="mdl-layout-spacer"></div>
	      <h4 id="h4Modulo">&nbsp;</h4>
	      <div class="mdl-layout-spacer"></div>
	      <!-- Navigation. We hide it in small screens. -->
	      <nav class="mdl-navigation mdl-layout--large-screen-only">
	        <span id="spanUsuarioLogueado" data-usuarioid="<?php echo $_SESSION["UsuarioId"]; ?>"><?php echo "{$_SESSION["Nombres"]} {$_SESSION["ApellidoPaterno"]} {$_SESSION["ApellidoMaterno"]}"; ?></span>
			<!-- Right aligned menu below button -->
			<button id="demo-menu-lower-right" class="mdl-button mdl-js-button mdl-button--icon">
			  	<i class="material-icons">account_box</i>
			</button>
			<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="demo-menu-lower-right">
			  <li id="btnCerrarSession" class="mdl-menu__item">Cerrar session</li>
			</ul>
	      </nav>
	    </div>
	  </header>
	  <div class="mdl-layout__drawer">
	    <span class="mdl-layout-title">TjAppx</span>
	    <nav class="mdl-navigation">
	      <?php if( isset( $_SESSION["TipoUsuarioDescripcion"] ) && $_SESSION["TipoUsuarioDescripcion"] == "Administrador" ): ?>
	      	<a class="mdl-navigation__link btnsDesplegarModulos" href="" data-modulo="congregaciones"><i class="material-icons md-48">group_work</i>&nbsp;Congregaciones</a>
	      	<a class="mdl-navigation__link btnsDesplegarModulos" href="" data-modulo="dispositivos_permitidos"><i class="material-icons md-48">phonelink_setup</i>&nbsp;Dispositivos</a>
	      <?php endif; ?>
	      <a class="mdl-navigation__link btnsDesplegarModulos" href="" data-modulo="asistencia"><i class="material-icons md-48">today</i>&nbsp;Asistencia</a>
	    </nav>
	  </div>
	  <main class="mdl-layout__content">
	    <div class="page-content">
	    	<?php if( $_modulo != "SM" ): ?>
	    		<?php include("{$_modulo}.php"); ?>
	    	<?php endif; ?>
	    </div>
	  </main>
	</div>
	<dialog id="dlgLoader" class="mdl-dialog">
		<div id="p2" class="mdl-progress mdl-js-progress mdl-progress__indeterminate"></div>		
	</dialog>	
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
	<script src="../js/sweetalert.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
	<script src="../js/main.js"></script>	
	<?php if( $_modulo != "SM" ): ?>
		<script src="../js/<?php echo $_modulo; ?>.js"></script>
	<?php endif; ?>	
</body>
</html>