<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/SeccionesService.php");

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
		case "ObtenerInformacionSecciones":
				$ResultadoInformacionSecciones = SeccionesService::ObtenerInformacionSecciones( $DbConfig , $ParametrosJSON->CongregacionID );
				echo $ResultadoInformacionSecciones;
			break;
			
		case "AgregarSeccion":
			$ResultadoAgregarSeccion = SeccionesService::AgregarSeccion( $DbConfig , $ParametrosJSON->CongregacionID , $ParametrosJSON->NombreSeccion , $ParametrosJSON->UsuarioID );
			echo $ResultadoAgregarSeccion;
			break;

		case "ActualizarSeccion":
			$ResultadoActualizarSeccion = SeccionesService::ActualizarSeccion( $DbConfig , $ParametrosJSON->CongregacionID , $ParametrosJSON->SeccionID , $ParametrosJSON->NombreSeccion , $ParametrosJSON->UsuarioID );
			echo $ResultadoActualizarSeccion;			
			break;

		case "ManejoDeEstadoSeccion":
			$ResultadoManejoDeEstadoSeccion = SeccionesService::ManejoDeEstadoSeccion($DbConfig, $ParametrosJSON->CongregacionID, $ParametrosJSON->SeccionID , $ParametrosJSON->Estatus, $ParametrosJSON->UsuarioID);
			echo $ResultadoManejoDeEstadoSeccion;			
			break;			
	}	
}
?>