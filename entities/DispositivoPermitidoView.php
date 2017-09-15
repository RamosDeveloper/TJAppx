<?php
class DispositivoPermitidoView
{
	public $DispositivoId;
	public $DispositivoSerial;
	public $OsVersion;
	public $NombreDelSolicitante;
	public $FechaCreacion;
	public $FechaModificacion;	
	public $UsuarioDispositivoId;
	public $UsuarioDispositivo;
	public $UsuarioModificadorId;
	public $UsuarioModificador;
	public $Permitido;

	public function __construct()
	{
		$this->DispositivoId = 0;
		$this->DispositivoSerial = null;
		$this->OsVersion = null;
		$this->NombreDelSolicitante = null;
		$this->FechaCreacion = null;
		$this->FechaModificacion = null;
		$this->UsuarioDispositivoId = 0;
		$this->UsuarioDispositivo = 0;
		$this->UsuarioModificadorId = 0;
		$this->UsuarioModificador = null;
		$this->Permitido = '0';
	}
}
?>