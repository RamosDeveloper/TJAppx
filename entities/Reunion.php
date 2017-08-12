<?php

class Reunion
{
	public $Id;
	public $Nombre;
	public $UsuarioId;
	public $FechaCreacion;
	public $Estatus;

	public function __construct()
	{
		$this->Id = 0;
		$this->Nombre = null;
		$this->UsuarioId = 0;
		$this->FechaCreacion = null;
		$this->Estatus = null;
	}
}

?>