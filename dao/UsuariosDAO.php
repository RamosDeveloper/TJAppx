<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/UsuarioView.php");

class UsuariosDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Usuarios( :param_opcion , :param_usuario_id , :param_usuario );";

		$this->params = array(
			"param_opcion" => "",
			"param_usuario_id" => 0,
			"param_usuario" => "NULL"
		);		
	}

	public function ObtenerUsuariosActivos($param_DbConfig)
	{
		$ArrUsuariosActivos = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerUsuariosActivos";

			$stmt->execute($this->params);
			while( $result = $stmt->fetch( PDO::FETCH_ASSOC ) ) {
				$UsuarioView = new UsuarioView();
				$UsuarioView->UsuarioId = $result["usuario_id"];
				$UsuarioView->Usuario = $result["usuario"];
				$UsuarioView->Contrasena = $result["contrasena"];
				$UsuarioView->Nombres = $result["nombres"];
				$UsuarioView->ApellidoPaterno = $result["apellido_paterno"];
				$UsuarioView->ApellidoMaterno = $result["apellido_materno"];
				$UsuarioView->Correo = $result["correo"];
				$UsuarioView->Estatus = $result["estatus"];
				$UsuarioView->FechaCreacion = $result["fecha_creacion"];
				$UsuarioView->TipoUsuarioId = $result["tipo_usuario_id"];
				$UsuarioView->TipoUsuarioDescripcion = $result["tipo_usuario_descripcion"];
				array_push($ArrUsuariosActivos, $UsuarioView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrUsuariosActivos);		
	}

	public function ObtenerVistaUsuarioPorUsuario($param_DbConfig,$param_usuario) 
	{
		$UsuarioView = new UsuarioView();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ObtenerVistaUsuarioPorUsuario";
			$this->params["param_usuario"] = $param_usuario;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);					
			$UsuarioView->UsuarioId = $result[0]["usuario_id"];
			$UsuarioView->Usuario = $result[0]["usuario"];
			$UsuarioView->Contrasena = $result[0]["contrasena"];
			$UsuarioView->Nombres = $result[0]["nombres"];
			$UsuarioView->ApellidoPaterno = $result[0]["apellido_paterno"];
			$UsuarioView->ApellidoMaterno = $result[0]["apellido_materno"];
			$UsuarioView->Correo = $result[0]["correo"];
			$UsuarioView->Estatus = $result[0]["estatus"];
			$UsuarioView->FechaCreacion = $result[0]["fecha_creacion"];
			$UsuarioView->TipoUsuarioId = $result[0]["tipo_usuario_id"];
			$UsuarioView->TipoUsuarioDescripcion = trim($result[0]["tipo_usuario_descripcion"]);
		} catch (PDOException $ex) {}
		return json_encode($UsuarioView);
	}

	public function ObtenerVistaUsuarioPorId($param_DbConfig,$param_usuario_id) 
	{
		$UsuarioView = new UsuarioView();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ObtenerVistaUsuarioPorId";
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);					
			$UsuarioView->UsuarioId = $result[0]["usuario_id"];
			$UsuarioView->Usuario = $result[0]["usuario"];
			$UsuarioView->Contrasena = $result[0]["contrasena"];
			$UsuarioView->Nombres = $result[0]["nombres"];
			$UsuarioView->ApellidoPaterno = $result[0]["apellido_paterno"];
			$UsuarioView->ApellidoMaterno = $result[0]["apellido_materno"];
			$UsuarioView->Correo = $result[0]["correo"];
			$UsuarioView->Estatus = $result[0]["estatus"];
			$UsuarioView->FechaCreacion = $result[0]["fecha_creacion"];
			$UsuarioView->TipoUsuarioId = $result[0]["tipo_usuario_id"];
			$UsuarioView->TipoUsuarioDescripcion = trim($result[0]["tipo_usuario_descripcion"]);
		} catch (PDOException $ex) {}
		return json_encode($UsuarioView);
	}	
}

?>