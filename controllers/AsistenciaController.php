<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/AsistenciaService.php");

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

		case "ObtenerInformacionAsistencia":
				$ResultadoInformacionAsistencia = AsistenciaService::ObtenerInformacionAsistencia($DbConfig, $ParametrosJSON->ReunionID, $ParametrosJSON->CongregacionID, $ParametrosJSON->SeccionID);
				echo $ResultadoInformacionAsistencia;
			break;

		case "ObtenerInformacionAsistenciaTop14":
				$ResultadoInformacionAsistenciaTop14 = AsistenciaService::ObtenerInformacionAsistenciaTop14($DbConfig, $ParametrosJSON->CongregacionID);
				echo $ResultadoInformacionAsistenciaTop14;
			break;			

		case "CapturarAsistencia":
				$ResultadoCapturarAsistencia = AsistenciaService::CapturarAsistencia($DbConfig, $ParametrosJSON->ReunionID, $ParametrosJSON->CongregacionID, $ParametrosJSON->SeccionID, $ParametrosJSON->NumeroAsistentes, $ParametrosJSON->UsuarioID, $ParametrosJSON->FechaCaptura);
				echo $ResultadoCapturarAsistencia;
			break;

		case "EliminarAsistencia":
				$ResultadoEliminarAsistencia = AsistenciaService::EliminarAsistencia($DbConfig, $ParametrosJSON->AsistenciaID);
				echo $ResultadoEliminarAsistencia;
			break;						
			
	}	
}
?>