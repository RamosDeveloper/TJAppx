<?php

class CerberusDAO
{
	public $sql;
	public $params;

	public function __construct() 
	{ 
		$this->sql = "CALL SP_Cerberus( :param_opcion , :param_usuario , :param_contrasena, :param_dispositivo_serial  );";
		
		$this->params = array(
			"param_opcion" => "",
			"param_usuario" => "NULL",
			"param_contrasena" => "NULL",
			"param_dispositivo_serial" => "NULL"
		);
	}
	
	public function LocalLogin($param_DbConfig,$param_usuario, $param_contrasena) 
	{
		$LocalLogin = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "LocalLogin";
			$this->params["param_usuario"] = $param_usuario;
			$this->params["param_contrasena"] = $param_contrasena;
			
			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$LocalLogin->Valid = $result[0]["valid"];
			$LocalLogin->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$LocalLogin->Valid = 0;
			$LocalLogin->Mensaje = $ex->getMessage();
		}

		return json_encode( $LocalLogin );
	}

	public function DispositivoLogin($param_DbConfig, $param_dispositivo_serial) 
	{
		$DispositivoLogin = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "DispositivoLogin";
			$this->params["param_dispositivo_serial"] = $param_dispositivo_serial;
			
			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$DispositivoLogin->Valid = $result[0]["valid"];
			$DispositivoLogin->Mensaje = trim( $result[0]["mensaje"] );
			$DispositivoLogin->UsuarioDispositivoID = (int)$result[0]["usuario_dispositivo_id"];
			$DispositivoLogin->UsuarioDispositivo = trim( $result[0]["usuario_dispositivo"] );
		} catch(PDOException $ex) {
			$DispositivoLogin->Valid = 0;
			$DispositivoLogin->Mensaje = $ex->getMessage();
			$DispositivoLogin->UsuarioDispositivoID = 0;
			$DispositivoLogin->UsuarioDispositivo = "";
		}

		return json_encode( $DispositivoLogin );		
	}	
}
?>