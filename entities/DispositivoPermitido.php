<?php
class DispositivoPermitido
{
	public $Id;
	public $Serial;
	public $OsVersion;
	public $NombreDelSolicitante;
	public $FechaCreacion;
	public $FechaModificacion;	
	public $UsuarioModificadorId;
	public $UsuarioDispositivoId;
	public $Permitido;

	public function __construct()
	{
		$this->Id = 0;
		$this->Serial = null;
		$this->OsVersion = null;
		$this->NombreDelSolicitante = null;
		$this->FechaCreacion = null;
		$this->FechaModificacion = null;
		$this->UsuarioModificadorId = 0;
		$this->UsuarioDispositivoId = 0;
		$this->Permitido = '0';
	}
}
?>