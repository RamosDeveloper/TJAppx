<?php
require_once("/var/www/vhosts/m-isoftware.mx/httpdocs/TJAppx/dao/AsistenciaDAO.php");

class AsistenciaService 
{
	private function __construct() { }
	private static $initialized = false;

	private static function initialize()
	{
	    if (self::$initialized)
	        return;
	    self::$initialized = true;
	}


	public static function ObtenerInformacionAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id)
	{
		self::initialize();
		$AsistenciaDAO = new AsistenciaDAO();
		return $AsistenciaDAO->ObtenerInformacionAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id);
	}

	public static function ObtenerInformacionAsistenciaTop14($param_DbConfig, $param_congregacion_id)
	{
		self::initialize();
		$AsistenciaDAO = new AsistenciaDAO();
		return $AsistenciaDAO->ObtenerInformacionAsistenciaTop14($param_DbConfig, $param_congregacion_id);
	}

	public static function CapturarAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id, $param_numero_asistentes, $param_usuario_id, $param_fecha_captura)
	{
		self::initialize();
		$AsistenciaDAO = new AsistenciaDAO();
		return $AsistenciaDAO->CapturarAsistencia($param_DbConfig, $param_reunion_id, $param_congregacion_id, $param_seccion_id, $param_numero_asistentes, $param_usuario_id, $param_fecha_captura);
	}

	public static function EliminarAsistencia($param_DbConfig, $param_asistencia_id)
	{
		self::initialize();
		$AsistenciaDAO = new AsistenciaDAO();
		return $AsistenciaDAO->EliminarAsistencia($param_DbConfig, $param_asistencia_id);
	}	
	
}
?>