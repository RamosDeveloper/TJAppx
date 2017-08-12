<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/Asistencia.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/AsistenciaView.php");

class AsistenciaDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Asistencia( :param_opcion , :param_asistencia_id , :param_reunion_id, :param_congregacion_id , :param_seccion_id , :param_numero_asistentes, :param_usuario_id, :param_fecha_captura  );";

		$this->params = array(
			"param_opcion" => "",
			"param_asistencia_id" => 0,
			"param_reunion_id" => 0,
			"param_congregacion_id" => 0,
			"param_seccion_id" => 0,
			"param_numero_asistentes" => 0,
			"param_usuario_id" => 0,
			"param_fecha_captura" => ""		
		);
	}


	public function ObtenerInformacionAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id) 
	{
		$ArrAsistenciaView = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionAsistencia";
			$this->params["param_reunion_id"] = $param_reunion_id;
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_seccion_id"] = $param_seccion_id;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$AsistenciaView = new AsistenciaView();
				$AsistenciaView->AsistenciaId = $result["asistencia_id"];
				$AsistenciaView->ReunionId = $result["reunion_id"];
				$AsistenciaView->ReunionNombre = $result["reunion_nombre"];
				$AsistenciaView->CongregacionId = $result["congregacion_id"];
				$AsistenciaView->CongregacionNombre = $result["congregacion_nombre"];
				$AsistenciaView->SeccionId = $result["seccion_id"];
				$AsistenciaView->SeccionNombre = $result["seccion_nombre"];
				$AsistenciaView->NumeroAsistentes = $result["numero_asistentes"];
				$AsistenciaView->FechaCaptura = $result["fecha_captura"];
				array_push($ArrAsistenciaView, $AsistenciaView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrAsistenciaView);
	}

	public function ObtenerInformacionAsistenciaTop14($param_DbConfig, $param_congregacion_id) 
	{
		$ArrAsistenciaView = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionAsistenciaTop14";
			$this->params["param_congregacion_id"] = $param_congregacion_id;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$AsistenciaView = new AsistenciaView();
				$AsistenciaView->AsistenciaId = $result["asistencia_id"];
				$AsistenciaView->ReunionId = $result["reunion_id"];
				$AsistenciaView->ReunionNombre = $result["reunion_nombre"];
				$AsistenciaView->CongregacionId = $result["congregacion_id"];
				$AsistenciaView->CongregacionNombre = $result["congregacion_nombre"];
				$AsistenciaView->SeccionId = $result["seccion_id"];
				$AsistenciaView->SeccionNombre = $result["seccion_nombre"];
				$AsistenciaView->NumeroAsistentes = $result["numero_asistentes"];
				$AsistenciaView->FechaCaptura = $result["fecha_captura"];
				array_push($ArrAsistenciaView, $AsistenciaView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrAsistenciaView);
	}

	public function CapturarAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id, $param_numero_asistentes, $param_usuario_id, $param_fecha_captura) 
	{
		$CapturarAsistencia = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "CapturarAsistencia";
			$this->params["param_reunion_id"] = $param_reunion_id;
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_seccion_id"] = $param_seccion_id;
			$this->params["param_numero_asistentes"] = $param_numero_asistentes;
			$this->params["param_usuario_id"] = $param_usuario_id;
			$this->params["param_fecha_captura"] = $param_fecha_captura;


			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$CapturarAsistencia->Valid = $result[0]["valid"];
			$CapturarAsistencia->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$CapturarAsistencia->Valid = 0;
			$CapturarAsistencia->Mensaje = $ex->getMessage();
		}

		return json_encode( $CapturarAsistencia );
	}					

	public function EliminarAsistencia($param_DbConfig, $param_asistencia_id) 
	{
		$EliminarAsistencia = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "EliminarAsistencia";
			$this->params["param_asistencia_id"] = $param_asistencia_id;
			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$EliminarAsistencia->Valid = $result[0]["valid"];
			$EliminarAsistencia->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$EliminarAsistencia->Valid = 0;
			$EliminarAsistencia->Mensaje = $ex->getMessage();
		}

		return json_encode( $EliminarAsistencia );
	}

}

?>