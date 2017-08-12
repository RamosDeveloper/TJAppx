<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/AsistenciaGraficasService.php");

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

		case "ObtenerAsistenciaGraficaMes":
				$ArrNumeroSemanas = AsistenciaGraficasService::ObtenerNumeroSemanas($DbConfig, $ParametrosJSON->FechaCaptura);
				echo $ArrNumeroSemanas;
			break;

	}	
}
?>