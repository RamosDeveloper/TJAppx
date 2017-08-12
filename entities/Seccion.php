<?php

class Seccion
{
	public $Id;
	public $Nombre;
	public $CongregacionId;
	public $UsuarioId;
	public $FechaCreacion;
	public $Estatus;

	public function __construct()
	{
		$this->Id = 0;
		$this->Nombre = null;
		$this->CongregacionId = 0;
		$this->UsuarioId = 0;
		$this->FechaCreacion = null;
		$this->Estatus = null;
	}
}

?>