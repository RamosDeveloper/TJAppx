<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/AsociacionReunionesService.php");

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
		case "ObtenerInformacionReuniones":
				$ResultadoInformacionReuniones = AsociacionReunionesService::ObtenerInformacionReuniones($DbConfig);
				echo $ResultadoInformacionReuniones;
			break;

		case "ObtenerInformacionAsociacionReuniones":
				$ResultadoInformacionAsociacionReuniones = AsociacionReunionesService::ObtenerInformacionAsociacionReuniones($DbConfig, $ParametrosJSON->ReunibleID, $ParametrosJSON->ReunibleType);
				echo $ResultadoInformacionAsociacionReuniones;
			break;

		case "ObtenerAsociacionReunionesActivas":
				$ResultadoAsociacionReunionesActivas = AsociacionReunionesService::ObtenerAsociacionReunionesActivas($DbConfig, $ParametrosJSON->ReunibleID, $ParametrosJSON->ReunibleType);
				echo $ResultadoAsociacionReunionesActivas;
			break;			
			
		case "AgregarAsociacionReunion":
			$ResultadoAgregarAsociacionReunion = AsociacionReunionesService::AgregarAsociacionReunion($DbConfig, $ParametrosJSON->ReunionID, $ParametrosJSON->ReunibleID, $ParametrosJSON->ReunibleType, $ParametrosJSON->AsociacionHorario, $ParametrosJSON->UsuarioID);
			echo $ResultadoAgregarAsociacionReunion;
			break;

		case "ActualizarAsociacionReunion":
			$ResultadoActualizarAsociacionReunion = AsociacionReunionesService::ActualizarAsociacionReunion($DbConfig, $ParametrosJSON->AsociacionHorario, $ParametrosJSON->AsociacionReunionID);
			echo $ResultadoActualizarAsociacionReunion;			
			break;

		case "ManejoDeEstadoAsociacionReunion":
			$ResultadoManejoDeEstadoAsociacionReunion = AsociacionReunionesService::ManejoDeEstadoAsociacionReunion($DbConfig, $ParametrosJSON->AsociacionEstatus, $ParametrosJSON->AsociacionReunionID);
			echo $ResultadoManejoDeEstadoAsociacionReunion;			
			break;			
	}	
}
?>