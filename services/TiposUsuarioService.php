<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/TiposUsuarioDAO.php");

class TiposUsuarioService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerTiposDeUsuario($param_DbConfig)
	{
		self::initialize();
		$TiposUsuarioDAO = new TiposUsuarioDAO();
		return $TiposUsuarioDAO->ObtenerTiposDeUsuario($param_DbConfig);
	}
}
?>