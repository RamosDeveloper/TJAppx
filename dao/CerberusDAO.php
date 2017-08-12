<?php

class CerberusDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Cerberus( :param_opcion , :param_usuario , :param_contrasena  );";
		
		$this->params = array(
			"param_opcion" => "",
			"param_usuario" => "NULL",
			"param_contrasena" => "NULL"
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
}
?>