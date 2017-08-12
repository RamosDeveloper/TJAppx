<?php

class Asistencia
{
	public $Id;
	public $ReunionId;
	public $CongregacionId;
	public $SeccionId;
	public $NumeroAsistentes;
	public $UsuarioId;
	public $FechaCaptura;

	public function __construct()
	{
		$this->Id = 0;
		$this->ReunionId = 0;
		$this->CongregacionId = 0;
		$this->SeccionId = 0;
		$this->NumeroAsistentes = 0;
		$this->UsuarioId = 0;
		$this->FechaCaptura = null;
	}
}

?>