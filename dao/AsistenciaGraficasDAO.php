<?php

class AsistenciaGraficasDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Asistencia_Graficas( :param_opcion , :param_reunion_id , :param_congregacion_id , :param_seccion_id , :param_fecha_captura , :param_semana );";

		$this->params = array(
			"param_opcion" => "",
			"param_reunion_id" => 0,
			"param_congregacion_id" => 0,
			"param_seccion_id" => 0,
			"param_fecha_captura" => "",	
			"param_semana" => 0
		);
	}
	

	public function ObtenerNumeroSemanas($param_DbConfig, $param_fecha_captura) 
	{
		$ArrNumeroSemanas = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerNumeroSemanas";
			$this->params["param_fecha_captura"] = $param_fecha_captura;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				array_push($ArrNumeroSemanas, $result["semana"]);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrNumeroSemanas);
	}

}

?>