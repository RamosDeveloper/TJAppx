<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/SeccionesDAO.php");

class SeccionesService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}

	public static function ObtenerInformacionSecciones($param_DbConfig, $param_congregacion_id)
	{
		self::initialize();
		$SeccionesDAO = new SeccionesDAO();
		return $SeccionesDAO->ObtenerInformacionSecciones($param_DbConfig, $param_congregacion_id);
	}

	public static function AgregarSeccion($param_DbConfig, $param_congregacion_id, $param_nombre_seccion, $param_usuario_id)
	{
		self::initialize();
		$SeccionesDAO = new SeccionesDAO();
		return $SeccionesDAO->AgregarSeccion($param_DbConfig, $param_congregacion_id, $param_nombre_seccion, $param_usuario_id);
	}

	public static function ActualizarSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_nombre_seccion, $param_usuario_id) 
	{
		self::initialize();
		$SeccionesDAO = new SeccionesDAO();
		return $SeccionesDAO->ActualizarSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_nombre_seccion, $param_usuario_id);
	}

	public static function ManejoDeEstadoSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_estatus_seccion, $param_usuario_id) 
	{
		self::initialize();
		$SeccionesDAO = new SeccionesDAO();
		return $SeccionesDAO->ManejoDeEstadoSeccion($param_DbConfig, $param_congregacion_id, $param_seccion_id, $param_estatus_seccion, $param_usuario_id);
	}		
}
?>