var
	$btnAction = $("#btnAction"),
	$btnResetDispositivosPermitidosAction = $("#btnResetDispositivosPermitidosAction"),
	$cboUsuarios = $("#cboUsuarios"),
	$cboUsuariosContainer = $("#cboUsuariosContainer"),
	$listViewDispositivosPermitidos = $("#listViewDispositivosPermitidos"),
	BaseUsuariosUrl = "../controllers/UsuariosController.php",
	BaseDispositivosPermitidosUrl = "../controllers/DispositivosPermitidosController.php",
	CacheDispositivo = {
		ID : 0,
		Serial : null,
		OsVersion : null,
		NombreDelSolicitante : null,		
		OwnerID : 0,
		Owner : null,
		Permitido : 0
	};


SetModuloTitle( "Configuracion de acceso de dispositivos" );		

ObtenerUsuariosActivos();

$btnAction.click(function(evt) {
	var $This = $(this);
	evt.preventDefault();
	
	if( $This.text() == "APROBAR" ) {
		if( $cboUsuarios.val() == 0 || $cboUsuarios.val() == "0" ) {
			swal( "Notificacion TJAppx" , "Se necesita asociar el dispositivo a un usuario." , "error" );			
		}else {
			UpdateDispositivo();
		}
	}else {
		UpdateDispositivo();	
	}
});

$btnResetDispositivosPermitidosAction.click(function(evt) {
	evt.preventDefault();
	ResetAction();
});


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

	ObtenerInformacionDispositivos();	
}

function ObtenerInformacionDispositivos() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionDispositivos"
		},
		mUrl = BaseDispositivosPermitidosUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			DisplayListadoDispositivos(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function DisplayListadoDispositivos( DispositivosJSON ) {
	var tmpHtml = '',
		indice = 0,
		icono = "",
		iconoColor = "",
		ownerBy = '',
		total = DispositivosJSON.length;

	$listViewDispositivosPermitidos.empty();
	if( total > 0 ) {
		if( DispositivosJSON[0].DispositivoID > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				icono = ( DispositivosJSON[indice].Permitido == 1 || DispositivosJSON[indice].Permitido == "1" ) ? "highlight_off" : "check_circle";
				iconoColor = ( DispositivosJSON[indice].Permitido == 1 || DispositivosJSON[indice].Permitido == "1" ) ? "redColor" : "greenColor";
				ownerBy = ( DispositivosJSON[indice].Permitido == 1 || DispositivosJSON[indice].Permitido == "1" ) ? '<span class=""><strong>Dispositivo asociado a</strong>: ' + DispositivosJSON[indice].UsuarioDispositivo + '</span>' : '<span class="redColor"><strong>NO APROBADO</strong></span>';

				tmpHtml += '<li id="item_' + DispositivosJSON[indice].DispositivoID + '" class="view_' + DispositivosJSON[indice].DispositivoID + ' mdl-list__item mdl-list__item--two-line"  data-dispositivoid="' + DispositivosJSON[indice].DispositivoID + '" data-dispositivoserial="' + DispositivosJSON[indice].DispositivoSerial + '" data-osversion="' + DispositivosJSON[indice].OsVersion + '" data-nombredelsolicitante="' + DispositivosJSON[indice].NombreDelSolicitante + '" data-fechacreacion="' + DispositivosJSON[indice].FechaCreacion + '" data-ownerid="' + DispositivosJSON[indice].UsuarioDispositivoID + '" data-owner="' + DispositivosJSON[indice].UsuarioDispositivo + '" data-permitido="' + DispositivosJSON[indice].Permitido + '">';
				tmpHtml += '	<span class="mdl-list__item-primary-content">';
				tmpHtml += '		<i class="material-icons mdl-list__item-avatar">phonelink_setup</i>';
				tmpHtml += '		<span>';
				tmpHtml += '			<strong>Serial</strong>: ' + DispositivosJSON[indice].DispositivoSerial + '&nbsp;'
				tmpHtml += '			<strong>Os Version</strong>: ' + DispositivosJSON[indice].OsVersion;
				tmpHtml += '			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
				tmpHtml += '			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
				tmpHtml += '			' + ownerBy;
				tmpHtml += '		</span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title">';
				tmpHtml += '			<strong>Solicita</strong>: ' + DispositivosJSON[indice].NombreDelSolicitante + '&nbsp;';
				tmpHtml += '			<strong>Fecha Solicitud:</strong>: ' + DispositivosJSON[indice].FechaCreacion;
				tmpHtml += '		</span>';
				tmpHtml += '	</span>';
				tmpHtml += '	<span class="mdl-list__item-secondary-content">';
				tmpHtml += '		<a class="mdl-list__item-secondary-action" href="#">';
				tmpHtml += '			<div class="btnsEditarDispositivos icon material-icons">edit</div>';
				tmpHtml += '		</a>';
				tmpHtml += '	</span>';
				tmpHtml += '</li>';
				if( indice != ( total - 1 ) ) {
					tmpHtml += '<hr class="view_' + DispositivosJSON[indice].DispositivoID + '">';	
				}
			}
			$listViewDispositivosPermitidos.html(tmpHtml);

			registerListViewItemsEvents();
		}
	}
}

function registerListViewItemsEvents() {
	var $btnsEditarDispositivos = $(".btnsEditarDispositivos");

	$btnsEditarDispositivos.unbind("click");
	$btnsEditarDispositivos.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			btnText = "APROBAR";
			
		evt.preventDefault();
		
		CacheDispositivo = {
			ID : parseInt( $ItemDataContainer.data("dispositivoid") ),
			Serial : $ItemDataContainer.data("dispositivoserial"),
			OsVersion : $ItemDataContainer.data("osversion"),
			NombreDelSolicitante : $ItemDataContainer.data("nombredelsolicitante"),
			OwnerID : parseInt( $ItemDataContainer.data("ownerid") ),
			Owner : $ItemDataContainer.data("owner"),
			Permitido : parseInt( $ItemDataContainer.data("permitido") )
		};

		btnText = ( CacheDispositivo.Permitido == 0 || CacheDispositivo.Permitido == "0" ) ? "APROBAR" : "DESAPROBAR";
		$cboUsuarios.find("option[value='" + CacheDispositivo.OwnerID + "']").prop("selected",true);
		$btnResetDispositivosPermitidosAction.removeClass("noDisplay");
		$btnAction.removeClass("noDisplay");		
		$(".bgColorAmarillo").removeClass("bgColorAmarillo");
		$(".view_" + CacheDispositivo.ID).addClass("bgColorAmarillo");
		$btnAction.text(btnText);
		$cboUsuarios.focus();
	});
}

function ResetAction() {
	CacheDispositivo = {
		ID : 0,
		Serial : null,
		OsVersion : null,
		NombreDelSolicitante : null,		
		OwnerID : 0,
		Owner : null,
		Permitido : 0
	};
	$btnAction.text("APROBAR");
	$(".bgColorAmarillo").removeClass("bgColorAmarillo"); 
	$btnAction.addClass("noDisplay");
	$btnResetDispositivosPermitidosAction.addClass("noDisplay");
	$cboUsuarios.find("option:eq(0)").prop("selected",true);
}

function UpdateDispositivo() {
	var 
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		titulo = ( CacheDispositivo.Permitido == 1 || CacheDispositivo.Permitido == "1" ) ? "DESAPROBADO" : "APROBADO";
		Objeto = {
			"opcion" : ( $btnAction.text() == "APROBAR" ) ? "AprobarDispositivo" : "DesaprobarDispositivo",
			"UsuarioModificadorID" : $spanUsuarioLogueado.data("usuarioid"),
			"UsuarioDispositivoID" : $cboUsuarios.val(),
			"DispositivoID" : CacheDispositivo.ID
		},
		mUrl = BaseDispositivosPermitidosUrl + "?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			ResetAction();
			if( ServerResponseJSON.Valid == "1" || ServerResponseJSON.Valid == 1 ) {
				swal({
				  title: titulo,
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ObtenerInformacionDispositivos();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}