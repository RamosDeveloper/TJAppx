<?php

class AsistenciaView
{
	public $AsistenciaId;
	public $ReunionId;
	public $ReunionNombre;
	public $CongregacionId;
	public $CongregacionNombre;
	public $SeccionId;
	public $SeccionNombre;
	public $NumeroAsistentes;
	public $FechaCaptura;

	public function __construct()
	{
		$this->AsistenciaId = 0;
		$this->ReunionId = 0;
		$this->ReunionNombre = null;
		$this->CongregacionId = 0;
		$this->CongregacionNombre = null;
		$this->SeccionId = 0;
		$this->SeccionNombre = null;
		$this->NumeroAsistentes = 0;
		$this->FechaCaptura = null;
	}
}

?>