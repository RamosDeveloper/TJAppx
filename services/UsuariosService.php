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

	public static function ObtenerVistaUsuarioPorUsuario($param_DbConfig,$param_usuario) 
	{
		self::initialize();
		$UsuariosDAO = new UsuariosDAO();
		return $UsuariosDAO->ObtenerVistaUsuarioPorUsuario($param_DbConfig,$param_usuario);
	}	
}
?>