<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/DispositivosPermitidosService.php");

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

		case "ObtenerInformacionDispositivos":
				$ResultadoInformacionDispositivos = DispositivosPermitidosService::ObtenerInformacionDispositivos($DbConfig);
				echo $ResultadoInformacionDispositivos;
			break;

		case "RegistrarDispositivo":
				$ResultadoRegistrarDispositivo = DispositivosPermitidosService::RegistrarDispositivo($DbConfig, $ParametrosJSON->DispositivoSerial, $ParametrosJSON->OsVersion, $ParametrosJSON->NombreDelSolicitante);
				echo $ResultadoRegistrarDispositivo;
			break;			

		case "AprobarDispositivo":
				$ResultadoAprobarDispositivo = DispositivosPermitidosService::AprobarDispositivo($DbConfig, $ParametrosJSON->UsuarioModificadorID, $ParametrosJSON->UsuarioDispositivoID, $ParametrosJSON->DispositivoID);
				echo $ResultadoAprobarDispositivo;
			break;

		case "DesaprobarDispositivo":
				$ResultadoEliminarAsistencia = DispositivosPermitidosService::DesaprobarDispositivo($DbConfig, $ParametrosJSON->UsuarioModificadorID, $ParametrosJSON->DispositivoID);
				echo $ResultadoEliminarAsistencia;
			break;						
			
	}	
}
?>