<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/Congregacion.php");

class CongregacionesDAO
{
	public $sql;
	public $params;	

	public function __construct() { 
		$this->sql = "CALL SP_Congregaciones( :param_opcion , :param_congregacion_id , :param_nombre_congregacion , :param_estatus_congregacion , :param_usuario_id  );";

		$this->params = array(
			"param_opcion" => "",
			"param_congregacion_id" => 0,
			"param_nombre_congregacion" => "NULL",
			"param_estatus_congregacion" => "0",
			"param_usuario_id" => 0				
		);		
	}

	public function ObtenerInformacionCongregaciones($param_DbConfig) 
	{
		$ArrCongregaciones = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionCongregaciones";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$Congregacion = new Congregacion();
				$Congregacion->Id = $result["id"];
				$Congregacion->Nombre = $result["nombre"];
				$Congregacion->UsuarioId = $result["usuario_id"];
				$Congregacion->FechaCreacion = $result["fecha_creacion"];
				$Congregacion->Estatus = $result["estatus"];
				array_push($ArrCongregaciones, $Congregacion);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrCongregaciones);
	}

	public function ObtenerCongregacionesActivas($param_DbConfig) 
	{
		$ArrCongregaciones = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerCongregacionesActivas";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$Congregacion = new Congregacion();
				$Congregacion->Id = $result["id"];
				$Congregacion->Nombre = $result["nombre"];
				$Congregacion->UsuarioId = $result["usuario_id"];
				$Congregacion->FechaCreacion = $result["fecha_creacion"];
				$Congregacion->Estatus = $result["estatus"];
				array_push($ArrCongregaciones, $Congregacion);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrCongregaciones);
	}
	
	public function AgregarCongregacion($param_DbConfig,$param_nombre_congregacion, $param_usuario_id) 
	{
		$AgregarCongregacion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "AgregarCongregacion";
			$this->params["param_nombre_congregacion"] = $param_nombre_congregacion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$AgregarCongregacion->Valid = $result[0]["valid"];
			$AgregarCongregacion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$AgregarCongregacion->Valid = 0;
			$AgregarCongregacion->Mensaje = $ex->getMessage();
		}

		return json_encode( $AgregarCongregacion );
	}	

	public function ActualizarCongregacion($param_DbConfig, $param_congregacion_id, $param_nombre_congregacion, $param_usuario_id) 
	{
		$ActualizarCongregacion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ActualizarCongregacion";
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_nombre_congregacion"] = $param_nombre_congregacion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ActualizarCongregacion->Valid = $result[0]["valid"];
			$ActualizarCongregacion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ActualizarCongregacion->Valid = 0;
			$ActualizarCongregacion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ActualizarCongregacion );
	}		

	public function ManejoDeEstadoCongregacion($param_DbConfig, $param_congregacion_id, $param_estatus_congregacion, $param_usuario_id) 
	{
		$ManejoDeEstadoCongregacion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ManejoDeEstadoCongregacion";
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_estatus_congregacion"] = $param_estatus_congregacion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ManejoDeEstadoCongregacion->Valid = $result[0]["valid"];
			$ManejoDeEstadoCongregacion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ManejoDeEstadoCongregacion->Valid = 0;
			$ManejoDeEstadoCongregacion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ManejoDeEstadoCongregacion );
	}			
}

?>