<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/CerberusDAO.php");

class CerberusService
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function LocalLogin($param_DbConfig,$param_usuario, $param_contrasena) 
	{
		self::initialize();
		$CerberusDAO = new CerberusDAO();
		return $CerberusDAO->LocalLogin($param_DbConfig,$param_usuario, $param_contrasena);
	}
}
?>