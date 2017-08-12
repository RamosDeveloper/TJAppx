<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/CerberusService.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/UsuariosService.php");

if( isset( $_POST["Parametros"] ) ) {
	$ParametrosJSON = json_decode( $_POST["Parametros"] );
}else {
	if( isset($_GET["Parametros"]) ) {
		$ParametrosJSON = json_decode( $_GET["Parametros"] );
	}else {
		$ParametrosJSON = null;
	}
}

if( $ParametrosJSON != null ) {
	switch ( trim( $ParametrosJSON->opcion ) ) {
		case "LocalLogin":
				$ResultadoLocalLogin = CerberusService::LocalLogin( $DbConfig , $ParametrosJSON->usuario , MD5( $ParametrosJSON->contrasena ) );	
				$ResultadoLocalLoginJSON = json_decode($ResultadoLocalLogin);
				if( $ResultadoLocalLoginJSON->Valid == "1" || $ResultadoLocalLoginJSON->Valid == 1 ) {
					$ResultadoUsuarioView = UsuariosService::ObtenerVistaUsuarioPorUsuario( $DbConfig , $ParametrosJSON->usuario);
					$ResultadoUsuarioViewJSON = json_decode($ResultadoUsuarioView);
					session_start();
					$_SESSION["UsuarioId"] = $ResultadoUsuarioViewJSON->UsuarioId;
					$_SESSION["Usuario"] = $ResultadoUsuarioViewJSON->Usuario;
					$_SESSION["Nombres"] = $ResultadoUsuarioViewJSON->Nombres;
					$_SESSION["ApellidoPaterno"] = $ResultadoUsuarioViewJSON->ApellidoPaterno;
					$_SESSION["ApellidoMaterno"] = $ResultadoUsuarioViewJSON->ApellidoMaterno;
					$_SESSION["Correo"] = $ResultadoUsuarioViewJSON->Correo;
					$_SESSION["TipoUsuarioDescripcion"] = $ResultadoUsuarioViewJSON->TipoUsuarioDescripcion;
				}
				echo $ResultadoLocalLogin;
			break;

		case 'KillSession':
			session_start();
			session_unset();
			session_destroy();
			$ResultadoKillSession = new stdClass();
			$ResultadoKillSession->Valid = 1;
			$ResultadoKillSession->Mensaje = "Session cerrada.";
			echo json_encode($ResultadoKillSession);
			break;
	}	
}
?>