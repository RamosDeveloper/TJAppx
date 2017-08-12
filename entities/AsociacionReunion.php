<?php

class AsociacionReunion
{
	public $Id;
	public $ReunionId;
	public $ReunibleId;
	public $ReunibleType;
	public $Horario;
	public $UsuarioId;
	public $FechaCreacion;
	public $Estatus;

	public function __construct()
	{
		$this->Id = 0;
		$this->ReunionId = 0;
		$this->ReunibleId = 0;
		$this->ReunibleType = null;
		$this->Horario = null;
		$this->UsuarioId = 0;
		$this->FechaCreacion = null;
		$this->Estatus = null;
	}
}

?>