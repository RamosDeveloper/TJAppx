<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/DispositivosPermitidosDAO.php");

class DispositivosPermitidosService
{	
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerInformacionDispositivos($param_DbConfig)	
	{
		self::initialize();
		$DispositivosPermitidosDAO = new DispositivosPermitidosDAO();
		return $DispositivosPermitidosDAO->ObtenerInformacionDispositivos($param_DbConfig);
	}

	public static function RegistrarDispositivo($param_DbConfig, $param_dispositivo_serial, $param_dispositivo_os_version, $param_nombre_del_solicitante)
	{
		self::initialize();
		$DispositivosPermitidosDAO = new DispositivosPermitidosDAO();
		return $DispositivosPermitidosDAO->RegistrarDispositivo($param_DbConfig, $param_dispositivo_serial, $param_dispositivo_os_version, $param_nombre_del_solicitante);
	}

	public static function AprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_usuario_dispositivo_id, $param_dispositivo_id)
	{
		self::initialize();
		$DispositivosPermitidosDAO = new DispositivosPermitidosDAO();
		return $DispositivosPermitidosDAO->AprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_usuario_dispositivo_id, $param_dispositivo_id);
	}

	public static function DesaprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_dispositivo_id)
	{
		self::initialize();
		$DispositivosPermitidosDAO = new DispositivosPermitidosDAO();
		return $DispositivosPermitidosDAO->DesaprobarDispositivo($param_DbConfig, $param_usuario_modificador_id, $param_dispositivo_id);
	}
}
?>