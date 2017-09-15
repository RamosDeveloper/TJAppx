<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/Reunion.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/AsociacionReunionView.php");

class AsociacionReunionesDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Reuniones( :param_opcion , :param_asociacion_reunion_id , :param_asociacion_horario, :param_asociacion_estatus , :param_reunible_id , :param_reunible_type, :param_reunion_id, :param_usuario_id  );";

		$this->params = array(
			"param_opcion" => "",
			"param_asociacion_reunion_id" => 0,
			"param_asociacion_horario" => 0,
			"param_asociacion_estatus" => "NULL",
			"param_reunible_id" => "0",
			"param_reunible_type" => 0,
			"param_reunion_id" => 0,
			"param_usuario_id" => 0			
		);
	}

	public function ObtenerInformacionReuniones($param_DbConfig) 
	{
		$ArrReuniones = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionReuniones";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$Reunion = new Reunion();
				$Reunion->Id = $result["id"];
				$Reunion->Nombre = $result["nombre"];
				$Reunion->UsuarioId = $result["usuario_id"];
				$Reunion->FechaCreacion = $result["fecha_creacion"];
				$Reunion->Estatus = $result["estatus"];
				array_push($ArrReuniones, $Reunion);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrReuniones);
	}

	public function ObtenerInformacionAsociacionReuniones($param_DbConfig, $param_reunible_id, $param_reunible_type) 
	{
		$ArrAsociacionReunionView = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionAsociacionReuniones";
			$this->params["param_reunible_id"] = $param_reunible_id;
			$this->params["param_reunible_type"] = $param_reunible_type;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$AsociacionReunionView = new AsociacionReunionView();
				$AsociacionReunionView->AsociacionReunionId = $result["asociacion_reunion_id"];
				$AsociacionReunionView->AsociacionReunionHorario = $result["asociacion_reunion_horario"];
				$AsociacionReunionView->AsociacionReunionEstatus = $result["asociacion_reunion_estatus"];
				$AsociacionReunionView->ReunibleId = $result["reunible_id"];
				$AsociacionReunionView->ReunibleType = $result["reunible_type"];
				$AsociacionReunionView->ReunionId = $result["reunion_id"];
				$AsociacionReunionView->ReunionNombre = $result["reunion_nombre"];
				$AsociacionReunionView->ReunionEstatus = $result["reunion_estatus"];
				array_push($ArrAsociacionReunionView, $AsociacionReunionView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrAsociacionReunionView);
	}

	public function ObtenerAsociacionReunionesActivas($param_DbConfig, $param_reunible_id, $param_reunible_type) 
	{
		$ArrAsociacionReunionView = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerAsociacionReunionesActivas";
			$this->params["param_reunible_id"] = $param_reunible_id;
			$this->params["param_reunible_type"] = $param_reunible_type;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$AsociacionReunionView = new AsociacionReunionView();
				$AsociacionReunionView->AsociacionReunionId = $result["asociacion_reunion_id"];
				$AsociacionReunionView->AsociacionReunionHorario = $result["asociacion_reunion_horario"];
				$AsociacionReunionView->AsociacionReunionEstatus = $result["asociacion_reunion_estatus"];
				$AsociacionReunionView->ReunibleId = $result["reunible_id"];
				$AsociacionReunionView->ReunibleType = $result["reunible_type"];
				$AsociacionReunionView->ReunionId = $result["reunion_id"];
				$AsociacionReunionView->ReunionNombre = $result["reunion_nombre"];
				$AsociacionReunionView->ReunionEstatus = $result["reunion_estatus"];
				array_push($ArrAsociacionReunionView, $AsociacionReunionView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrAsociacionReunionView);
	}

	public function AgregarAsociacionReunion($param_DbConfig, $param_reunion_id, $param_reunible_id, $param_reunible_type, $param_asociacion_horario, $param_usuario_id) 
	{
		$AgregarAsociacionReunion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "AgregarAsociacionReunion";
			$this->params["param_reunion_id"] = $param_reunion_id;
			$this->params["param_reunible_id"] = $param_reunible_id;
			$this->params["param_reunible_type"] = $param_reunible_type;
			$this->params["param_asociacion_horario"] = $param_asociacion_horario;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$AgregarAsociacionReunion->Valid = $result[0]["valid"];
			$AgregarAsociacionReunion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$AgregarAsociacionReunion->Valid = 0;
			$AgregarAsociacionReunion->Mensaje = $ex->getMessage();
		}

		return json_encode( $AgregarAsociacionReunion );
	}	

	public function ActualizarAsociacionReunion($param_DbConfig, $param_asociacion_horario, $param_asociacion_reunion_id) 
	{
		$ActualizarAsociacionReunion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ActualizarAsociacionReunion";
			$this->params["param_asociacion_horario"] = $param_asociacion_horario;
			$this->params["param_asociacion_reunion_id"] = $param_asociacion_reunion_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ActualizarAsociacionReunion->Valid = $result[0]["valid"];
			$ActualizarAsociacionReunion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ActualizarAsociacionReunion->Valid = 0;
			$ActualizarAsociacionReunion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ActualizarAsociacionReunion );
	}		

	public function ManejoDeEstadoAsociacionReunion($param_DbConfig, $param_asociacion_estatus, $param_asociacion_reunion_id) 
	{
		$ManejoDeEstadoAsociacionReunion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ManejoDeEstadoAsociacionReunion";
			$this->params["param_asociacion_estatus"] = $param_asociacion_estatus;
			$this->params["param_asociacion_reunion_id"] = $param_asociacion_reunion_id;
			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ManejoDeEstadoAsociacionReunion->Valid = $result[0]["valid"];
			$ManejoDeEstadoAsociacionReunion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ManejoDeEstadoAsociacionReunion->Valid = 0;
			$ManejoDeEstadoAsociacionReunion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ManejoDeEstadoAsociacionReunion );
	}			
}

?>