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
			$UsuarioView->TipoUsuarioDescripcion = $result[0]["tipo_usuario_descripcion"];
		} catch (PDOException $ex) {}
		return json_encode($UsuarioView);
	}
}

?>