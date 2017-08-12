<?php

class AsociacionReunionView
{
	public $AsociacionReunionId;
	public $AsociacionReunionHorario;
	public $AsociacionReunionEstatus;
	public $ReunibleId;
	public $ReunibleType;
	public $ReunionId;
	public $ReunionNombre;
	public $ReunionEstatus;

	public function __construct()
	{
		$this->AsociacionReunionId = 0;
		$this->AsociacionReunionHorario = null;
		$this->AsociacionReunionEstatus = null;
		$this->ReunibleId = 0;
		$this->ReunibleType = null;
		$this->ReunionId = 0;
		$this->ReunionNombre = null;
		$this->ReunionEstatus = 0;
	}
}

?>