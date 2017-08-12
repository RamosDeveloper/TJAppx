<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/CongregacionesDAO.php");

class CongregacionesService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerInformacionCongregaciones($param_DbConfig) 
	{
		self::initialize();
		$CongregacionesDAO = new CongregacionesDAO();
		return $CongregacionesDAO->ObtenerInformacionCongregaciones($param_DbConfig);
	}

	public static function AgregarCongregacion($param_DbConfig,$param_nombre_congregacion, $param_usuario_id)
	{
		self::initialize();
		$CongregacionesDAO = new CongregacionesDAO();
		return $CongregacionesDAO->AgregarCongregacion($param_DbConfig,$param_nombre_congregacion, $param_usuario_id);
	}

	public static function ActualizarCongregacion($param_DbConfig, $param_congregacion_id, $param_nombre_congregacion, $param_usuario_id) 
	{
		self::initialize();
		$CongregacionesDAO = new CongregacionesDAO();
		return $CongregacionesDAO->ActualizarCongregacion($param_DbConfig, $param_congregacion_id, $param_nombre_congregacion, $param_usuario_id);
	}

	public static function ManejoDeEstadoCongregacion($param_DbConfig, $param_congregacion_id, $param_estatus_congregacion, $param_usuario_id) 
	{
		self::initialize();
		$CongregacionesDAO = new CongregacionesDAO();
		return $CongregacionesDAO->ManejoDeEstadoCongregacion($param_DbConfig, $param_congregacion_id, $param_estatus_congregacion, $param_usuario_id);
	}		
}
?>