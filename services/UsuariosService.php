<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/UsuariosDAO.php");

class UsuariosService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerUsuarios($param_DbConfig)
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ObtenerUsuarios($param_DbConfig);
	}

	public static function ObtenerUsuariosActivos($param_DbConfig)
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ObtenerUsuariosActivos($param_DbConfig);
	}

	public static function ObtenerVistaUsuarioPorUsuario($param_DbConfig,$param_usuario) 
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ObtenerVistaUsuarioPorUsuario($param_DbConfig,$param_usuario);
	}	

	public static function ObtenerVistaUsuarioPorId($param_DbConfig,$param_usuario_id) 
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ObtenerVistaUsuarioPorId($param_DbConfig,$param_usuario_id);
	}

	public static function CrearUsuario($param_DbConfig, $param_usuario, $param_contrasena, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id )
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->CrearUsuario($param_DbConfig, $param_usuario, $param_contrasena, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id );
	}

	public static function UpdateUsuario($param_DbConfig, $param_usuario_id, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id)
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->UpdateUsuario($param_DbConfig, $param_usuario_id, $param_nombres, $param_apellido_paterno, $param_apellido_materno, $param_correo, $param_tipo_usuario_id);
	}

	public static function CambiarContrasena($param_DbConfig, $param_usuario_id, $param_contrasena) 
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->CambiarContrasena($param_DbConfig, $param_usuario_id, $param_contrasena);
	}

	public static function ManejoDeEstatusUsuario($param_DbConfig, $param_usuario_id, $param_estatus)
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ManejoDeEstatusUsuario($param_DbConfig, $param_usuario_id, $param_estatus);
	}
}
?>