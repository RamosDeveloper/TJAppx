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

		case "ObtenerUsuarios":
			$ResultadoUsuarios = UsuariosService::ObtenerUsuarios($DbConfig);
			echo $ResultadoUsuarios;
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

		case "CrearUsuario":
			$ResultadoCrearUsuario = UsuariosService::CrearUsuario($DbConfig, $ParametrosJSON->usuario, MD5($ParametrosJSON->usuario), $ParametrosJSON->Nombres, $ParametrosJSON->ApellidoPaterno, $ParametrosJSON->ApellidoMaterno, $ParametrosJSON->Correo, $ParametrosJSON->TipoUsuarioID );
			echo $ResultadoCrearUsuario;
			break;

		case "UpdateUsuario":
			$ResultadoUpdateUsuario = UsuariosService::UpdateUsuario($DbConfig, $ParametrosJSON->UsuarioID, $ParametrosJSON->Nombres, $ParametrosJSON->ApellidoPaterno, $ParametrosJSON->ApellidoMaterno, $ParametrosJSON->Correo, $ParametrosJSON->TipoUsuarioID);
			echo $ResultadoUpdateUsuario;
			break;

		case "CambiarContrasena":
			$ResultadoCambiarContrasena = UsuariosService::CambiarContrasena($DbConfig, $ParametrosJSON->UsuarioID, MD5($ParametrosJSON->Contrasena));
			echo $ResultadoCambiarContrasena;
			break;

		case "ManejoDeEstatusUsuario":
			$ResultadoManejoDeEstatusUsuario = UsuariosService::ManejoDeEstatusUsuario($DbConfig, $ParametrosJSON->UsuarioID, $ParametrosJSON->Estatus);
			echo $ResultadoManejoDeEstatusUsuario;
			break;
	}	
}
?>