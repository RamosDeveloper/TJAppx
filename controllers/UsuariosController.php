<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
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
		case "BeginSession":
			$ResultadoUsuarioView = UsuariosService::ObtenerVistaUsuarioPorUsuario( $DbConfig , $ParametrosJSON->usuario );
			$ResultadoUsuarioViewJSON = json_decode($ResultadoUsuarioView);
			session_start();
			$_SESSION["UsuarioId"] = $ResultadoUsuarioViewJSON->UsuarioId;
			$_SESSION["Usuario"] = $ResultadoUsuarioViewJSON->Usuario;
			$_SESSION["Nombres"] = $ResultadoUsuarioViewJSON->Nombres;
			$_SESSION["ApellidoPaterno"] = $ResultadoUsuarioViewJSON->ApellidoPaterno;
			$_SESSION["ApellidoMaterno"] = $ResultadoUsuarioViewJSON->ApellidoMaterno;
			$_SESSION["Correo"] = $ResultadoUsuarioViewJSON->Correo;
			$_SESSION["TipoUsuarioDescripcion"] = $ResultadoUsuarioViewJSON->TipoUsuarioDescripcion;
			$ResultadoBeginSession = new stdClass();
			$ResultadoBeginSession->Valid = 1;
			$ResultadoBeginSession->Mensaje = "Session cerrada.";
			echo json_encode($ResultadoBeginSession);			
			break;

		case "ObtenerUsuariosActivos":
			$ResultadoUsuariosActivos = UsuariosService::ObtenerUsuariosActivos($DbConfig);
			echo $ResultadoUsuariosActivos;
			break;

		case "ObtenerVistaUsuarioPorUsuario":
			$ResultadoUsuarioView = UsuariosService::ObtenerVistaUsuarioPorUsuario( $DbConfig , $ParametrosJSON->usuario );
			echo $ResultadoUsuarioView;
			break;

		case "ObtenerVistaUsuarioPorId":
			$ResultadoUsuarioView = UsuariosService::ObtenerVistaUsuarioPorId( $DbConfig , $ParametrosJSON->UsuarioID );
			echo $ResultadoUsuarioView;
			break;
	}	
}
?>