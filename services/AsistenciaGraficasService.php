<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/AsistenciaGraficasDAO.php");

class AsistenciaGraficasService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}


	public static function ObtenerNumeroSemanas($param_DbConfig, $param_fecha_captura)
	{
		self::initialize();
		$AsistenciaGraficasDAO = new AsistenciaGraficasDAO();
		return $AsistenciaGraficasDAO->ObtenerNumeroSemanas($param_DbConfig, $param_fecha_captura);
	}
	
}
?>