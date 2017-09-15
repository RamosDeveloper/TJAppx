<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/CongregacionesService.php");

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
		case "ObtenerInformacionCongregaciones":
				$ResultadoInformacionCongregaciones = CongregacionesService::ObtenerInformacionCongregaciones($DbConfig);
				echo $ResultadoInformacionCongregaciones;
			break;

		case "ObtenerCongregacionesActivas":
				$ResultadoCongregacionesActivas = CongregacionesService::ObtenerCongregacionesActivas($DbConfig);
				echo $ResultadoCongregacionesActivas;
			break;			
			
		case "AgregarCongregacion":
			$ResultadoAgregarCongregacion = CongregacionesService::AgregarCongregacion($DbConfig,$ParametrosJSON->NombreCongregacion, $ParametrosJSON->UsuarioID);
			echo $ResultadoAgregarCongregacion;
			break;

		case "ActualizarCongregacion":
			$ResultadoActualizarCongregacion = CongregacionesService::ActualizarCongregacion($DbConfig, $ParametrosJSON->CongregacionID, $ParametrosJSON->NombreCongregacion, $ParametrosJSON->UsuarioID);
			echo $ResultadoActualizarCongregacion;			
			break;

		case "ManejoDeEstadoCongregacion":
			$ResultadoManejoDeEstadoCongregacion = CongregacionesService::ManejoDeEstadoCongregacion($DbConfig, $ParametrosJSON->CongregacionID, $ParametrosJSON->Estatus, $ParametrosJSON->UsuarioID);
			echo $ResultadoManejoDeEstadoCongregacion;			
			break;			
	}	
}
?>