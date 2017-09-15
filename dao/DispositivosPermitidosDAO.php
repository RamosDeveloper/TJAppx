<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/DispositivoPermitido.php");
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/DispositivoPermitidoView.php");

class DispositivosPermitidosDAO
{
	public $sql;
	public $params;

	public function __construct()
	{
		$this->sql = "CALL SP_Dispositivos_Permitidos( :param_opcion , :param_dispositivo_id , :param_dispositivo_serial , :param_dispositivo_os_version , :param_nombre_del_solicitante , :param_usuario_dispositivo_id , :param_usuario_modificador_id );";

		$this->params = array(
			"param_opcion" => "",
			"param_dispositivo_id" => 0,
			"param_dispositivo_serial" => 0,
			"param_dispositivo_os_version" => "",
			"param_nombre_del_solicitante" => "",
			"param_usuario_dispositivo_id" => 0,
			"param_usuario_modificador_id" => 0	
		);		
	}

	public function ObtenerInformacionDispositivos($param_DbConfig)
	{
		$ArrDispositivosPermitidosView = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerInformacionDispositivos";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$DispositivoPermitidoView = new DispositivoPermitidoView();
				$DispositivoPermitidoView->DispositivoID = $result["dispositivo_id"];
				$DispositivoPermitidoView->DispositivoSerial = $result["dispositivo_serial"];
				$DispositivoPermitidoView->OsVersion = $result["os_version"];
				$DispositivoPermitidoView->NombreDelSolicitante = $result["nombre_del_solicitante"];
				$DispositivoPermitidoView->FechaCreacion = $result["fecha_creacion"];
				$DispositivoPermitidoView->FechaModificacion = $result["fecha_modificacion"];
				$DispositivoPermitidoView->UsuarioDispositivoID = $result["usuario_dispositivo_id"];
				$DispositivoPermitidoView->UsuarioDispositivo = $result["usuario_dispositivo"];
				$DispositivoPermitidoView->UsuarioModificadorID = $result["usuario_modificador_id"];
				$DispositivoPermitidoView->UsuarioModificador = $result["usuario_modificador"];
				$DispositivoPermitidoView->Permitido = $result["permitido"];
				array_push($ArrDispositivosPermitidosView, $DispositivoPermitidoView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrDispositivosPermitidosView);		
	}

	public function RegistrarDispositivo($param_DbConfig, $param_dispositivo_serial, $param_dispositivo_os_version, $param_nombre_del_solicitante)
	{
		$RegistrarDispositivo = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "RegistrarDispositivo";
			$this->params["param_dispositivo_serial"] = $param_dispositivo_serial;
			$this->params["param_dispositivo_os_version"] = $param_dispositivo_os_version;
			$this->params["param_nombre_del_solicitante"] = $param_nombre_del_solicitante;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$RegistrarDispositivo->Valid = $result[0]["valid"];
			$RegistrarDispositivo->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$RegistrarDispositivo->Valid = 0;
			$RegistrarDispositivo->Mensaje = $ex->getMessage();
		}

		return json_encode( $RegistrarDispositivo );		
	}

	public function AprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_usuario_dispositivo_id, $param_dispositivo_id)
	{
		$AprobarDispositivo = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "AprobarDispositivo";
			$this->params["param_usuario_modificador_id"] = $param_usuario_modificador_id;
			$this->params["param_usuario_dispositivo_id"] = $param_usuario_dispositivo_id;
			$this->params["param_dispositivo_id"] = $param_dispositivo_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$AprobarDispositivo->Valid = $result[0]["valid"];
			$AprobarDispositivo->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$AprobarDispositivo->Valid = 0;
			$AprobarDispositivo->Mensaje = $ex->getMessage();
		}

		return json_encode( $AprobarDispositivo );		
	}	

	public function DesaprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_dispositivo_id)
	{
		$DesaprobarDispositivo = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "DesaprobarDispositivo";
			$this->params["param_usuario_modificador_id"] = $param_usuario_modificador_id;
			$this->params["param_dispositivo_id"] = $param_dispositivo_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$DesaprobarDispositivo->Valid = $result[0]["valid"];
			$DesaprobarDispositivo->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$DesaprobarDispositivo->Valid = 0;
			$DesaprobarDispositivo->Mensaje = $ex->getMessage();
		}

		return json_encode( $DesaprobarDispositivo );		
	}		
}
?>