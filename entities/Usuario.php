<?php 

class Usuario
{
	public $Id;
	public $Usuario;
	public $Contrasena;
	public $Nombres;
	public $ApellidoPaterno;
	public $ApellidoMaterno;
	public $Correo;
	public $Estatus;
	public $FechaCreacion;
	public $TipoUsuarioId;

	public function __construct()
	{
		$this->Id = 0;
		$this->Usuario = null;
		$this->Contrasena = null;
		$this->Nombres = null;
		$this->ApellidoPaterno = null;
		$this->ApellidoMaterno = null;
		$this->Correo = null;
		$this->Estatus = null;
		$this->FechaCreacion = null;
		$this->TipoUsuarioId = 0;
	}
}

?>