var
	$btnAprobarDispositivo = $("#btnAprobarDispositivo"),
	$btnResetDispositivosPermitidosAction = $("#btnResetDispositivosPermitidosAction"),
	$cboUsuarios = $("#cboUsuarios"),
	$cboUsuariosContainer = $("#cboUsuariosContainer"),
	$listViewDispositivosPermitidos = $("#listViewDispositivosPermitidos"),
	BaseUsuariosUrl = "../controllers/UsuariosController.php",
	BaseDispositivosPermitidosUrl = "../controllers/DispositivosPermitidosController.php";


SetModuloTitle( "Configuracion de acceso de dispositivos" );		

ObtenerUsuariosActivos();


function ObtenerUsuariosActivos() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerUsuariosActivos"
		},
		mUrl = BaseUsuariosUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillCboUsuarios(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillCboUsuarios(UsuariosActivosJSON) {
	var tmpHtml = '',
		indice = 0,
		total = UsuariosActivosJSON.length;

	$cboUsuarios.empty();
	tmpHtml = '<option value="0">Selecciona un usuario:</opcion>'; 
	if( total > 0 ) {
		if( UsuariosActivosJSON[0].UsuarioId > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				tmpHtml += '<option value="' + UsuariosActivosJSON[indice].UsuarioId + '">' + UsuariosActivosJSON[indice].Usuario + '</option>';
			}
		}
	}
	$cboUsuarios.html(tmpHtml);
	$cboUsuarios.focus();
	$cboUsuariosContainer.addClass("is-dirty");		
}