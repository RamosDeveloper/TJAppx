var
	$btnAction = $("#btnAction"),
	$btnResetAction = $("#btnResetAction"),
	$cboTiposDeUsuario = $("#cboTiposDeUsuario"),
	$cboTiposDeUsuarioContainer = $("#cboTiposDeUsuarioContainer"),
	$listViewUsuarios = $("#listViewUsuarios"),
	$txtApellidoMaterno = $("#txtApellidoMaterno"),
	$txtApellidoMaternoContainer = $("#txtApellidoMaternoContainer"),
	$txtApellidoPaterno = $("#txtApellidoPaterno"),
	$txtApellidoPaternoContainer = $("#txtApellidoPaternoContainer"),
	$txtCorreo = $("#txtCorreo"),
	$txtCorreoContainer = $("#txtCorreoContainer"),
	$txtNombres = $("#txtNombres"),
	$txtNombresContainer = $("#txtNombresContainer"),
	$txtUsuario = $("#txtUsuario"),
	$txtUsuarioContainer = $("#txtUsuarioContainer"), 
	BaseUsuariosUrl = "../controllers/UsuariosController.php",
	BaseTiposUsuarioUrl = "../controllers/TiposUsuarioController.php",
	CacheUsuarioData = null;


SetModuloTitle("Usuarios");

ObtenerTiposDeUsuario();


$btnAction.click(function(evt) {
	var $This = $(this);
	evt.preventDefault();

	if( DidUserProvideRequirements() ) {
		if( $This.text() == "CREAR" ) {
			CreateOrUpdateUsuario( "CREATE" );
		}else {
			CreateOrUpdateUsuario( "UPDATE" );
		}
	}else {
		swal("Notificacion", "Falta informacion requerida", "warning");
	}
});

$btnResetAction.click(function(evt) {
	evt.preventDefault();
	ResetAction();
});


function ObtenerTiposDeUsuario() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerTiposDeUsuario"
		},
		mUrl = BaseTiposUsuarioUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillCboTiposDeUsuario(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillCboTiposDeUsuario(TiposDeUsuarioJSON) {
	var tmpHtml = '',
		indice = 0,
		total = TiposDeUsuarioJSON.length;

	$cboTiposDeUsuario.empty();
	tmpHtml = '<option value="0">Selecciona un tipo de usuario:</opcion>'; 
	if( total > 0 ) {
		if( TiposDeUsuarioJSON[0].Id > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				tmpHtml += '<option value="' + TiposDeUsuarioJSON[indice].Id + '">' + TiposDeUsuarioJSON[indice].Descripcion + '</option>';
			}
		}
	}
	$cboTiposDeUsuario.html(tmpHtml);
	$cboTiposDeUsuario.focus();
	$cboTiposDeUsuarioContainer.addClass("is-dirty");	

	ObtenerUsuarios();
}

function ObtenerUsuarios() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerUsuarios"
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
			DisplayListadoUsuarios(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function DisplayListadoUsuarios( UsuariosJSON ) {
	var tmpHtml = '',
		indice = 0,
		icono = "",
		iconoColor = "",
		total = UsuariosJSON.length;	

	$listViewUsuarios.empty();	

	if( total > 0 ) {
		if( UsuariosJSON[0].UsuarioId > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				icono = ( UsuariosJSON[indice].Estatus == 1 ) ? "highlight_off" : "check_circle";
				iconoColor = ( UsuariosJSON[indice].Estatus == 1 ) ? "redColor" : "greenColor";
				tmpHtml += '<li id="item_' + UsuariosJSON[indice].UsuarioId + '" class="view_' + UsuariosJSON[indice].UsuarioId + ' mdl-list__item mdl-list__item--two-line" data-usuario-id="' + UsuariosJSON[indice].UsuarioId + '" data-usuario="' + UsuariosJSON[indice].Usuario + '" data-nombres="' + UsuariosJSON[indice].Nombres + '" data-apellido-paterno="' + UsuariosJSON[indice].ApellidoPaterno + '" data-apellido-materno="' + UsuariosJSON[indice].ApellidoMaterno + '" data-correo="' + UsuariosJSON[indice].Correo + '" data-estatus="' + UsuariosJSON[indice].Estatus + '" data-tipo-usuario-id="' + UsuariosJSON[indice].TipoUsuarioId + '" data-tipo-usuario-descripcion="' + UsuariosJSON[indice].TipoUsuarioDescripcion + '" data-tiene-dispositivo-asociado="' + UsuariosJSON[indice].TieneDispositivoAsociado + '">';
				tmpHtml += '	<span class="mdl-list__item-primary-content">';
				tmpHtml += '		<i class="material-icons mdl-list__item-avatar">account_box</i>';
				tmpHtml += '		<span>';
				tmpHtml += '			<strong>Usuario</strong>: ' + UsuariosJSON[indice].Usuario + '&nbsp;'
				tmpHtml += '			<strong>Nombres</strong>: ' + UsuariosJSON[indice].Nombres + '&nbsp;'
				tmpHtml += '			<strong>Apellido Paterno</strong>: ' + UsuariosJSON[indice].ApellidoPaterno + '&nbsp;'
				tmpHtml += '			<strong>Apellido Materno</strong>: ' + UsuariosJSON[indice].ApellidoMaterno + '&nbsp;'
				tmpHtml += '		</span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title">';
				tmpHtml += '			<strong>Tipo de Usuario</strong>: ' + UsuariosJSON[indice].TipoUsuarioDescripcion + '&nbsp;'
				tmpHtml += '			<strong>Correo:</strong>: ' + UsuariosJSON[indice].Correo + '&nbsp;'
				tmpHtml += '		</span>';
				tmpHtml += '	</span>';
				if( UsuariosJSON[indice].TieneDispositivoAsociado > 0 ) {
					tmpHtml += '	<i class="material-icons mdl-list__item-avatar">phonelink_setup</i>';	
				}
				tmpHtml += '	<span class="mdl-list__item-secondary-content">';
				tmpHtml += '		<a class="mdl-list__item-secondary-action" href="#">';
				tmpHtml += '			<div class="btnsEditarUsuarios icon material-icons">edit</div>';
				tmpHtml += '			<div class="btnsManejoDeEstatusUsuarios icon material-icons ' + iconoColor + '" >' + icono + '</div>';
				tmpHtml += '		</a>';
				tmpHtml += '	</span>';
				tmpHtml += '</li>';
				if( indice != ( total - 1 ) ) {
					tmpHtml += '<hr class="view_' + UsuariosJSON[indice].UsuarioId + '">';	
				}				
			}
			$listViewUsuarios.html(tmpHtml);

			registerListViewItemsEvents();
		}
	}
}

function registerListViewItemsEvents() {
	$btnsEditarUsuarios = $(".btnsEditarUsuarios"),
	$btnsManejoDeEstatusUsuarios = $(".btnsManejoDeEstatusUsuarios");

	$btnsEditarUsuarios.unbind("click");
	$btnsEditarUsuarios.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li");
			

		evt.preventDefault();
		CacheUsuarioData = $ItemDataContainer.data();
		$txtUsuario.val(CacheUsuarioData.usuario);
		$txtUsuarioContainer.addClass("is-dirty");
		$txtNombres.val(CacheUsuarioData.nombres);
		$txtNombresContainer.addClass("is-dirty");
		$txtApellidoPaterno.val(CacheUsuarioData.apellidoPaterno);
		$txtApellidoPaternoContainer.addClass("is-dirty");
		$txtApellidoMaterno.val(CacheUsuarioData.apellidoMaterno);
		$txtApellidoMaternoContainer.addClass("is-dirty");
		$txtCorreo.val(CacheUsuarioData.correo);
		$txtCorreoContainer.addClass("is-dirty");
		$cboTiposDeUsuario.find("option[value='" + CacheUsuarioData.tipoUsuarioId + "']").prop("selected",true);
		
		$btnResetAction.removeClass("noDisplay");
		$(".bgColorAmarillo").removeClass("bgColorAmarillo");
		$(".view_" + CacheUsuarioData.usuarioId).addClass("bgColorAmarillo");
		$btnAction.text("EDITAR");
		$txtNombresContainer.focus();
	});

	$btnsManejoDeEstatusUsuarios.unbind("click");
	$btnsManejoDeEstatusUsuarios.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			Accion = "";

			evt.preventDefault();	

		CacheUsuarioData = $ItemDataContainer.data();
		Accion = ( CacheUsuarioData.estatus == "1" || CacheUsuarioData.estatus == 1 ) ? "DESHABILITAR" : "HABILITAR";

		swal({
		  title: "Advertencia",
		  text: "Esta seguro(a) de querer " + Accion + " al usuario [" + CacheUsuarioData.usuario + "] ?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "SI",
		  cancelButtonText: "NO",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
			ManejoDeEstatusUsuario();		    
		  } else {
		    swal("Cancelada", "La operacion fue cancelada", "error");
		    ResetAction();
		  }
		});

	});
}

function ResetAction() {
	CacheUsuarioData = null;
	$txtUsuario.val("");
	$txtUsuarioContainer.removeClass("is-dirty");
	$txtNombres.val("");
	$txtNombresContainer.removeClass("is-dirty");
	$txtApellidoPaterno.val("");
	$txtApellidoPaternoContainer.removeClass("is-dirty");
	$txtApellidoMaterno.val("");
	$txtApellidoMaternoContainer.removeClass("is-dirty");
	$txtCorreo.val("");
	$txtCorreoContainer.removeClass("is-dirty");
	$cboTiposDeUsuario.find("option:eq(0)").prop("selected",true);
	$btnAction.text("CREAR");
	$(".bgColorAmarillo").removeClass("bgColorAmarillo"); 
	$btnResetAction.addClass("noDisplay");
	$(".tjppx-control").addClass("is-invalid");
}

function ManejoDeEstatusUsuario() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		titulo = ( CacheUsuarioData.estatus == 1 || CacheUsuarioData.estatus == "1" ) ? "DESHABILITADA" : "HABILITADA";
		Objeto = {
			"opcion" : "ManejoDeEstatusUsuario",
			"UsuarioID" : CacheUsuarioData.usuarioId,
			"Estatus" : CacheUsuarioData.estatus
		},
		mUrl = BaseUsuariosUrl + "?mRandom" + mRandom;	

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
				  ObtenerUsuarios();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function CreateOrUpdateUsuario( mAccion ) {
	var
		mTituloAccion = ( mAccion == "CREATE" ) ?  "CREADO" : "MODIFICADO";
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : ( mAccion == "CREATE" ) ? "CrearUsuario" : "UpdateUsuario",
			"UsuarioID" : ( mAccion == "CREATE" ) ? 0 : CacheUsuarioData.usuarioId,
			"usuario" : $txtUsuario.val(),
			"Nombres" : $txtNombres.val(),
			"ApellidoPaterno" : $txtApellidoPaterno.val(),
			"ApellidoMaterno" : $txtApellidoMaterno.val(),
			"Correo" : $txtCorreo.val(),
			"TipoUsuarioID" : $cboTiposDeUsuario.val()
		},
		mUrl = BaseUsuariosUrl + "?mRandom" + mRandom;	

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
				  title: mTituloAccion,
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ObtenerUsuarios();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function IsNotNullOrEmpty( TextBoxValue ) {
	var bIsNotNullOrEmpty = false;
	if( TextBoxValue != "" && TextBoxValue != " " && TextBoxValue.length > 0 ) {
		bIsNotNullOrEmpty = true;
	}	
	return bIsNotNullOrEmpty;
}

function DidUserProvideRequirements() {
	var bDidUserProvideRequirements = false;
	if( IsNotNullOrEmpty( $txtUsuario.val() ) ) {
		if( IsNotNullOrEmpty( $txtNombres.val() ) ) {
			if( IsNotNullOrEmpty( $txtApellidoPaterno.val() ) ) {
				if( IsNotNullOrEmpty( $txtApellidoMaterno.val() ) ) {
					if( IsNotNullOrEmpty( $txtCorreo.val() ) ) {
						if( $cboTiposDeUsuario.val() != "0" && $cboTiposDeUsuario.val() != 0 ) {
							bDidUserProvideRequirements = true;
						}
					}
				}
			}
		}
	}
	return bDidUserProvideRequirements;	
}