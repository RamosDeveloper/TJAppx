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
				$ArrColor = array( "red", "blue" , "purple" , "orange" );
				$IndiceColor = 0;
				$ResultadoAsistenciaGraficaMes = new stdClass();
				$ResultadoAsistenciaGraficaMes->labels = array();
				$ResultadoAsistenciaGraficaMes->datasets = array();
				$ResultadoAsistenciaGraficaMes->Valid = "false";

				$ArrNumeroSemanas = json_decode( AsistenciaGraficasService::ObtenerNumeroSemanas($DbConfig, $ParametrosJSON->FechaCaptura) );
				
				if( $ArrNumeroSemanas[0] != "false" ) {
			
					$label = null;
					$backgroundColor = null;
					$ArrAsistenciaGraficasItems	= json_decode( AsistenciaGraficasService::ObtenerAsistenciaGraficaMes( $DbConfig, $ParametrosJSON->CongregacionID, $ParametrosJSON->FechaCaptura) );	
					$TotalAsistenciaGraficaItems = count( $ArrAsistenciaGraficasItems );
					$IndiceItem = 0;

					if( $ArrAsistenciaGraficasItems[0]->Semana != "false" ) {

						$ResultadoAsistenciaGraficaMes->Valid = "true";

						for( $Indice = 0 ; $Indice < count( $ArrNumeroSemanas ) ; $Indice++ ) {
							array_push($ResultadoAsistenciaGraficaMes->labels, trim( "Semana #" . $ArrNumeroSemanas[$Indice] ) );	
						}

						foreach( $ArrAsistenciaGraficasItems as $AsistenciaGraficaItem ) {
							$IndiceItem += 1;

							if( $label == null ) {
								$label = $AsistenciaGraficaItem->Concepto;
								$HashNumeroSemanas = InitHashNumeroSemanas( $ArrNumeroSemanas );
								$HashNumeroSemanas[ $AsistenciaGraficaItem->Semana ] = $AsistenciaGraficaItem->NumeroAsistentes; 
								$backgroundColor = $ArrColor[ $IndiceColor ];
								$IndiceColor += 1;
							}else {
								if( $label != $AsistenciaGraficaItem->Concepto ) {
									$Data = new stdClass();
									$Data->label = $label;
									$Data->data = GetDataFromHasNumeroSemanas( $HashNumeroSemanas );
									$Data->backgroundColor = $backgroundColor;
									array_push( $ResultadoAsistenciaGraficaMes->datasets , $Data );

									$label = $AsistenciaGraficaItem->Concepto;
									$HashNumeroSemanas = InitHashNumeroSemanas( $ArrNumeroSemanas );
									$backgroundColor = $ArrColor[ $IndiceColor ];
									$IndiceColor += 1;							
								}

								$HashNumeroSemanas[ $AsistenciaGraficaItem->Semana ] = $AsistenciaGraficaItem->NumeroAsistentes;

								if( $IndiceItem == $TotalAsistenciaGraficaItems ) {
									$Data = new stdClass();
									$Data->label = $label;
									$Data->data = GetDataFromHasNumeroSemanas( $HashNumeroSemanas );
									$Data->backgroundColor = $backgroundColor;
									array_push( $ResultadoAsistenciaGraficaMes->datasets , $Data );							
								}
							}
						}
					}
				}

				echo json_encode( $ResultadoAsistenciaGraficaMes );
			break;
	}	
}


function InitHashNumeroSemanas( $ParamArrNumeroSemanas ) {
	$LocalIndice = 0;
	$ArrResultado = array();

	for( $LocalIndice = 0 ; $LocalIndice < count( $ParamArrNumeroSemanas ) ; $LocalIndice++ ) {
		$ArrResultado[ $ParamArrNumeroSemanas[$LocalIndice] ] = 0;
	}

	return $ArrResultado;	
}

function GetDataFromHasNumeroSemanas( $ParamHashNumeroSemanas ) {
	$ArrResultado = array();

	foreach( $ParamHashNumeroSemanas as $key => $value ) {
		array_push( $ArrResultado , $value );
	}

	return $ArrResultado;		
}
?>