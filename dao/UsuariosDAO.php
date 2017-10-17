<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/entities/UsuarioView.php");

class UsuariosDAO
{
	public $sql;
	public $params;

	public function __construct() { 
		$this->sql = "CALL SP_Usuarios( :param_opcion , :param_usuario_id , :param_usuario , :param_contrasena , :param_nombres , :param_apellido_paterno , :param_apellido_materno , :param_correo , :param_estatus , :param_tipo_usuario_id );";

		$this->params = array(
			"param_opcion" => "",
			"param_usuario_id" => 0,
			"param_usuario" => "NULL",
			"param_contrasena" => "NULL",
			"param_nombres" => "NULL",
			"param_apellido_paterno" => "NULL",
			"param_apellido_materno" => "NULL",
			"param_correo" => "NULL",
			"param_estatus" => "0",
			"param_tipo_usuario_id" => 0
		);		
	}

	public function ObtenerUsuarios($param_DbConfig)
	{
		$ArrUsuarios = array();
		try {

			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);	

			$this->params["param_opcion"] = "ObtenerUsuarios";

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
				$UsuarioView->TieneDispositivoAsociado = $result["tiene_dispositivo_asociado"];
				array_push($ArrUsuarios, $UsuarioView);
			}				
		} catch (PDOException $ex) {}
		return json_encode($ArrUsuarios);		
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
				$UsuarioView->TieneDispositivoAsociado = $result["tiene_dispositivo_asociado"];
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
			$UsuarioView->TieneDispositivoAsociado = $result[0]["tiene_dispositivo_asociado"];
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
			$UsuarioView->TieneDispositivoAsociado = $result[0]["tiene_dispositivo_asociado"];
		} catch (PDOException $ex) {}
		return json_encode($UsuarioView);
	}

	public function CrearUsuario($param_DbConfig, $param_usuario, $param_contrasena, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id )
	{
		$ResultadoCrearUsuario = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "CrearUsuario";
			$this->params["param_usuario"] = $param_usuario;
			$this->params["param_contrasena"] = $param_contrasena;
			$this->params["param_nombres"] = $param_nombres;
			$this->params["param_apellido_paterno"] = $param_apellido_paterno;
			$this->params["param_apellido_materno"] = $param_apellido_materno;
			$this->params["param_correo"] = $param_correo;
			$this->params["param_tipo_usuario_id"] = $param_tipo_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ResultadoCrearUsuario->Valid = $result[0]["valid"];
			$ResultadoCrearUsuario->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ResultadoCrearUsuario->Valid = 0;
			$ResultadoCrearUsuario->Mensaje = $ex->getMessage();
		}

		return json_encode( $ResultadoCrearUsuario );
	}	

	public function UpdateUsuario($param_DbConfig, $param_usuario_id, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id)
	{
		$ResultadoUpdateUsuario = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "UpdateUsuario";
			$this->params["param_nombres"] = $param_nombres;
			$this->params["param_apellido_paterno"] = $param_apellido_paterno;
			$this->params["param_apellido_materno"] = $param_apellido_materno;
			$this->params["param_correo"] = $param_correo;
			$this->params["param_tipo_usuario_id"] = $param_tipo_usuario_id;
			$this->params["param_usuario_id"] = $param_usuario_id;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ResultadoUpdateUsuario->Valid = $result[0]["valid"];
			$ResultadoUpdateUsuario->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ResultadoUpdateUsuario->Valid = 0;
			$ResultadoUpdateUsuario->Mensaje = $ex->getMessage();
		}

		return json_encode( $ResultadoUpdateUsuario );
	}

	public function CambiarContrasena($param_DbConfig, $param_usuario_id, $param_contrasena) 
	{
		$ResultadoCambiarContrasena = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "CambiarContrasena";
			$this->params["param_usuario_id"] = $param_usuario_id;
			$this->params["param_contrasena"] = $param_contrasena;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ResultadoCambiarContrasena->Valid = $result[0]["valid"];
			$ResultadoCambiarContrasena->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ResultadoCambiarContrasena->Valid = 0;
			$ResultadoCambiarContrasena->Mensaje = $ex->getMessage();
		}

		return json_encode( $ResultadoCambiarContrasena );
	}

	public function ManejoDeEstatusUsuario($param_DbConfig, $param_usuario_id, $param_estatus)
	{
		$ResultadoManejoDeEstatusUsuario = new stdClass();

		try {
			$pdo = new PDO(
				"mysql:host={$param_DbConfig["host"]};dbname={$param_DbConfig["dbname"]}",
				$param_DbConfig["user"],
				$param_DbConfig["password"]
			);	
			
			$stmt = $pdo->prepare($this->sql);

			$this->params["param_opcion"] = "ManejoDeEstatusUsuario";
			$this->params["param_usuario_id"] = $param_usuario_id;
			$this->params["param_estatus"] = $param_estatus;

			$stmt->execute($this->params);

			$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$ResultadoManejoDeEstatusUsuario->Valid = $result[0]["valid"];
			$ResultadoManejoDeEstatusUsuario->Mensaje = $result[0]["mensaje"];
		} catch(PDOException $ex) {
			$ResultadoManejoDeEstatusUsuario->Valid = 0;
			$ResultadoManejoDeEstatusUsuario->Mensaje = $ex->getMessage();
		}

		return json_encode( $ResultadoManejoDeEstatusUsuario );		
	}
}

?>