<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/Seccion.php");

class SeccionesDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Secciones( :param_opcion , :param_congregacion_id , :param_seccion_id, :param_nombre_seccion , :param_estatus_seccion , :param_usuario_id  );";

		$this->params = array(
			"param_opcion" => "",
			"param_congregacion_id" => 0,
			"param_seccion_id" => 0,
			"param_nombre_seccion" => "NULL",
			"param_estatus_seccion" => "0",
			"param_usuario_id" => 0				
		);		
	}

	public function ObtenerInformacionSecciones($param_DbConfig, $param_congregacion_id) 
	{
		$ArrSecciones = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionSecciones";
			$this->params["param_congregacion_id"] = $param_congregacion_id;

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$Seccion = new Seccion();
				$Seccion->Id = $result["id"];
				$Seccion->Nombre = $result["nombre"];
				$Seccion->CongregacionId = $result["congregacion_id"];
				$Seccion->UsuarioId = $result["usuario_id"];
				$Seccion->FechaCreacion = $result["fecha_creacion"];
				$Seccion->Estatus = $result["estatus"];
				array_push($ArrSecciones, $Seccion);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrSecciones);
	}

	public function AgregarSeccion($param_DbConfig, $param_congregacion_id, $param_nombre_seccion, $param_usuario_id) 
	{
		$AgregarSeccion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "AgregarSeccion";
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_nombre_seccion"] = $param_nombre_seccion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$AgregarSeccion->Valid = $result[0]["valid"];
			$AgregarSeccion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$AgregarSeccion->Valid = 0;
			$AgregarSeccion->Mensaje = $ex->getMessage();
		}

		return json_encode( $AgregarSeccion );
	}	

	public function ActualizarSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_nombre_seccion, $param_usuario_id) 
	{
		$ActualizarSeccion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ActualizarSeccion";
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_seccion_id"] = $param_seccion_id;
			$this->params["param_nombre_seccion"] = $param_nombre_seccion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ActualizarSeccion->Valid = $result[0]["valid"];
			$ActualizarSeccion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ActualizarSeccion->Valid = 0;
			$ActualizarSeccion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ActualizarSeccion );
	}		

	public function ManejoDeEstadoSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_estatus_seccion, $param_usuario_id) 
	{
		$ManejoDeEstadoSeccion = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ManejoDeEstadoSeccion";
			$this->params["param_congregacion_id"] = $param_congregacion_id;
			$this->params["param_seccion_id"] = $param_seccion_id;
			$this->params["param_estatus_seccion"] = $param_estatus_seccion;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ManejoDeEstadoSeccion->Valid = $result[0]["valid"];
			$ManejoDeEstadoSeccion->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ManejoDeEstadoSeccion->Valid = 0;
			$ManejoDeEstadoSeccion->Mensaje = $ex->getMessage();
		}

		return json_encode( $ManejoDeEstadoSeccion );
	}			
}

?>