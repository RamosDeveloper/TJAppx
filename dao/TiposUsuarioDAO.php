<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/TipoUsuario.php");

class TiposUsuarioDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_TiposDeUsuario( :param_opcion );";

		$this->params = array(
			"param_opcion" => ""
		);		
	}

	public function ObtenerTiposDeUsuario($param_DbConfig)
	{
		$ArrTiposUsuario = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerTiposDeUsuario";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$TipoUsuario = new TipoUsuario();
				$TipoUsuario->Id = $result["id"];
				$TipoUsuario->Descripcion = $result["descripcion"];
				array_push($ArrTiposUsuario, $TipoUsuario);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrTiposUsuario);		
	}
}

?>