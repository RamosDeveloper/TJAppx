<?php

class AsistenciaGraficaItem
{
	public $ReunionNombre;
	public $CongregacionNombre;
	public $SeccionNombre;
	public $Semana;
	public $Concepto;
	public $NumeroAsistentes;

	public function __construct()
	{
		$this->ReunionNombre = null;
		$this->CongregacionNombre = null;
		$this->SeccionNombre = null;
		$this->Semana = 0;
		$this->Concepto = null;
		$this->NumeroAsistentes = 0;
	}
}

?>