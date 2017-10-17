<?php 

class UsuarioView
{
	public $UsuarioId;
	public $Usuario;
	public $Contrasena;
	public $Nombres;
	public $ApellidoPaterno;
	public $ApellidoMaterno;
	public $Correo;
	public $Estatus;
	public $FechaCreacion;
	public $TipoUsuarioId;
	public $TipoUsuarioDescripcion;
	public $TieneDispositivoAsociado;

	public function __construct()
	{
		$this->UsuarioId = 0;
		$this->Usuario = null;
		$this->Contrasena = null;
		$this->Nombres = null;
		$this->ApellidoPaterno = null;
		$this->ApellidoMaterno = null;
		$this->Correo = null;
		$this->Estatus = null;
		$this->FechaCreacion = null;
		$this->TipoUsuarioId = 0;
		$this->TipoUsuarioDescripcion = null;
		$this->TieneDispositivoAsociado = 0;
	}
}

?>