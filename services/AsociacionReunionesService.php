<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/AsociacionReunionesDAO.php");

class AsociacionReunionesService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerInformacionReuniones($param_DbConfig)
	{
		self::initialize();
		$AsociacionReunionesDAO = new AsociacionReunionesDAO();
		return $AsociacionReunionesDAO->ObtenerInformacionReuniones($param_DbConfig);
	}

	public static function ObtenerInformacionAsociacionReuniones($param_DbConfig, $param_reunible_id, $param_reunible_type)
	{
		self::initialize();
		$AsociacionReunionesDAO = new AsociacionReunionesDAO();
		return $AsociacionReunionesDAO->ObtenerInformacionAsociacionReuniones($param_DbConfig, $param_reunible_id, $param_reunible_type);
	}

	public static function AgregarAsociacionReunion($param_DbConfig, $param_reunion_id, $param_reunible_id, $param_reunible_type, $param_asociacion_horario, $param_usuario_id)
	{
		self::initialize();
		$AsociacionReunionesDAO = new AsociacionReunionesDAO();
		return $AsociacionReunionesDAO->AgregarAsociacionReunion($param_DbConfig, $param_reunion_id, $param_reunible_id, $param_reunible_type, $param_asociacion_horario, $param_usuario_id);
	}

	public static function ActualizarAsociacionReunion($param_DbConfig, $param_asociacion_horario, $param_asociacion_reunion_id) 
	{
		self::initialize();
		$AsociacionReunionesDAO = new AsociacionReunionesDAO();
		return $AsociacionReunionesDAO->ActualizarAsociacionReunion($param_DbConfig, $param_asociacion_horario, $param_asociacion_reunion_id);
	}

	public static function ManejoDeEstadoAsociacionReunion($param_DbConfig, $param_asociacion_estatus, $param_asociacion_reunion_id) 
	{
		self::initialize();
		$AsociacionReunionesDAO = new AsociacionReunionesDAO();
		return $AsociacionReunionesDAO->ManejoDeEstadoAsociacionReunion($param_DbConfig, $param_asociacion_estatus, $param_asociacion_reunion_id);
	}		
}
?>