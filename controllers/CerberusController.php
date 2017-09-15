<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/config/database.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/services/CerberusService.php");

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
				echo $ResultadoLocalLogin;
			break;

		case "DispositivoLogin":
			$ResultadoDispositivoLogin = CerberusService::DispositivoLogin( $DbConfig , $ParametrosJSON->DispositivoSerial );
			echo $ResultadoDispositivoLogin;
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