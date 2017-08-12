var
	$btnGuardarAsociacionReunion = $("#btnGuardarAsociacionReunion"),
	$btnResetAsociacionReunionAction = $("#btnResetAsociacionReunionAction"),
	$cboReuniones = $("#cboReuniones"),
	$cboReunionesContainer = $("#cboReunionesContainer"),	
	$hdReunibleData = $("#hdReunibleData"),
	$listViewAsociacionReuniones = $("#listViewAsociacionReuniones"),
	$txtAsociacionHorario = $("#txtAsociacionHorario"),
	BaseUrl = "../controllers/AsociacionReunionesController.php",
	CacheReunibleData = JSON.parse( $hdReunibleData.val() ),
	CacheAsociacionReunionID = 0;


SetModuloTitle( "Reuniones de la " + CacheReunibleData.Type + " " + CacheReunibleData.Nombre );	

ObtenerInformacionReuniones();


$btnGuardarAsociacionReunion.click(function(evt) {
	var asociacionHorario = $txtAsociacionHorario.val(),
		reunionID = $cboReuniones.val(),
		opcion = ( $btnGuardarAsociacionReunion.text() == "AGREGAR" ) ? "AgregarAsociacionReunion" : "ActualizarAsociacionReunion",
		UsuarioID = $spanUsuarioLogueado.data("usuarioid");

	evt.preventDefault();
	GuardarAsociacionReunion( opcion , CacheAsociacionReunionID , asociacionHorario , reunionID , CacheReunibleData.Id, CacheReunibleData.Type, UsuarioID );
});

$btnResetAsociacionReunionAction.click(function(evt) {
	evt.preventDefault();
	ResetAsociacionReunionAction();
});


function ObtenerInformacionReuniones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionReuniones"
		},
		mUrl = BaseUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillCboReuniones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillCboReuniones(ReunionesJSON) {
	var tmpHtml = '',
		indice = 0,
		total = ReunionesJSON.length;

	$cboReuniones.empty();
	tmpHtml = '<option value="0">Selecciona una reunion:</opcion>'; 
	if( total > 0 ) {
		if( ReunionesJSON[0].Id > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				tmpHtml += '<option value="' + ReunionesJSON[indice].Id + '">' + ReunionesJSON[indice].Nombre + '</option>';
			}
		}
	}
	$cboReuniones.html(tmpHtml);
	$cboReuniones.focus();
	$cboReunionesContainer.addClass("is-dirty");	
	
	ObtenerInformacionAsociacionReuniones();
}

function ObtenerInformacionAsociacionReuniones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionAsociacionReuniones",
			"ReunibleID" : CacheReunibleData.Id,
			"ReunibleType" : CacheReunibleData.Type
		},
		mUrl = BaseUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			DisplayListadoAsociacionReuniones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function DisplayListadoAsociacionReuniones(AsociacionReunionesJSON) {
	var tmpHtml = '',
		indice = 0,
		icono = "",
		iconoColor = "",
		total = AsociacionReunionesJSON.length;

	$listViewAsociacionReuniones.empty();
	if( total > 0 ) {
		if( AsociacionReunionesJSON[0].AsociacionReunionId > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				icono = ( AsociacionReunionesJSON[indice].AsociacionReunionEstatus == 1 ) ? "highlight_off" : "check_circle";
				iconoColor = ( AsociacionReunionesJSON[indice].AsociacionReunionEstatus == 1 ) ? "redColor" : "greenColor";
			
				tmpHtml += '<li id="item_' + AsociacionReunionesJSON[indice].AsociacionReunionId + '" class="view_' + AsociacionReunionesJSON[indice].AsociacionReunionId + ' mdl-list__item mdl-list__item--two-line"  data-asociacionreunionid="' + AsociacionReunionesJSON[indice].AsociacionReunionId + '" data-asociacionreunionhorario="' + AsociacionReunionesJSON[indice].AsociacionReunionHorario + '" data-estatus="' + AsociacionReunionesJSON[indice].AsociacionReunionEstatus + '" data-reunionid="' + AsociacionReunionesJSON[indice].ReunionId + '" data-reunionnombre="' + AsociacionReunionesJSON[indice].ReunionNombre + '">';
				tmpHtml += '	<span class="mdl-list__item-primary-content">';
				tmpHtml += '		<span class="mdl-chip__contact mdl-color--blue mdl-color-text--white mdl-list__item-avatar">R</span>';
				tmpHtml += '		<span>' + AsociacionReunionesJSON[indice].ReunionNombre + '</span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title">' + AsociacionReunionesJSON[indice].AsociacionReunionHorario + '</span>';
				tmpHtml += '	</span>';
				tmpHtml += '	<span class="mdl-list__item-secondary-content">';
				tmpHtml += '		<a class="mdl-list__item-secondary-action" href="#">';
				tmpHtml += '			<div class="btnsEditarReuniones icon material-icons">edit</div>';
				tmpHtml += '			<div class="btnsManejoDeEstadosReuniones icon material-icons ' + iconoColor + '" >' + icono + '</div>';
				tmpHtml += '		</a>';
				tmpHtml += '	</span>';
				tmpHtml += '</li>';
				if( indice != ( total - 1 ) ) {
					tmpHtml += '<hr class="view_' + AsociacionReunionesJSON[indice].AsociacionReunionId + '">';	
				}
			}
			$listViewAsociacionReuniones.html(tmpHtml);

			registerListViewItemsEvents();
		}
	}
}

function registerListViewItemsEvents() {
	var $btnsEditarReuniones = $(".btnsEditarReuniones"),
		$btnsManejoDeEstadosReuniones = $(".btnsManejoDeEstadosReuniones");

	$btnsEditarReuniones.unbind("click");
	$btnsEditarReuniones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			reunionID = parseInt( $ItemDataContainer.data("reunionid") );	
			
		evt.preventDefault();
		$cboReuniones.find("option[value='" + reunionID + "']").prop("selected",true);
		CacheAsociacionReunionID = parseInt( $ItemDataContainer.data("asociacionreunionid") );
		$btnResetAsociacionReunionAction.removeClass("noDisplay");
		$(".bgColorAmarillo").removeClass("bgColorAmarillo");
		$(".view_" + CacheAsociacionReunionID).addClass("bgColorAmarillo");
		$txtAsociacionHorario.val( $ItemDataContainer.data("asociacionreunionhorario") ); 
		$btnGuardarAsociacionReunion.text("EDITAR");
		$txtAsociacionHorario.focus();
	});

	$btnsManejoDeEstadosReuniones.unbind("click");
	$btnsManejoDeEstadosReuniones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			AsociacionReunionID = $ItemDataContainer.data("asociacionreunionid"),
			ReunionNombre = $ItemDataContainer.data("reunionnombre"),
			AsociacionReunionEstatus = $ItemDataContainer.data("estatus"),
			Accion = ( AsociacionReunionEstatus == "1" || AsociacionReunionEstatus == 1 ) ? "DESHABILITAR" : "HABILITAR",
			UsuarioID = $spanUsuarioLogueado.data("usuarioid");

		evt.preventDefault();

		swal({
		  title: "Advertencia",
		  text: "Esta seguro(a) de querer " + Accion + " la reunion [" + ReunionNombre + "] ?",
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
		    ManejoDeEstadoAsociacionReunion( AsociacionReunionEstatus , AsociacionReunionID );
		  } else {
		    swal("Cancelada", "La operacion fue cancelada", "error");
		    ResetAsociacionReunionAction();
		  }
		});
	});	
}

function ResetAsociacionReunionAction() {
	CacheAsociacionReunionID = 0;
	$btnGuardarAsociacionReunion.text("AGREGAR");
	$(".bgColorAmarillo").removeClass("bgColorAmarillo"); 
	$btnResetAsociacionReunionAction.addClass("noDisplay");
	$txtAsociacionHorario.val("");
	$cboReuniones.find("option:eq(0)").prop("selected",true);
}

function GuardarAsociacionReunion( param_opcion , param_asociacion_reunion_id , param_asociacion_reunion_horario , param_reunion_id ,  param_reunible_id, param_reunible_type, param_usuario_id ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : param_opcion,
			"AsociacionReunionID" : param_asociacion_reunion_id,
			"AsociacionHorario" : param_asociacion_reunion_horario,
			"ReunionID" : param_reunion_id,
			"ReunibleID" : param_reunible_id,
			"ReunibleType" : param_reunible_type,
			"UsuarioID" : param_usuario_id
		},
		mUrl = BaseUrl + "?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			ResetAsociacionReunionAction();
			if( ServerResponseJSON.Valid == "1" || ServerResponseJSON.Valid == 1 ) {
				swal({
				  title: "GRABADO",
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ObtenerInformacionAsociacionReuniones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function ManejoDeEstadoAsociacionReunion( param_asociacion_reunion_estatus , param_asociacion_reunion_id ) {

	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		titulo = ( param_asociacion_reunion_estatus == 1 || param_asociacion_reunion_estatus == "1" ) ? "DESHABILITADA" : "HABILITADA";
		Objeto = {
			"opcion" : "ManejoDeEstadoAsociacionReunion",
			"AsociacionEstatus" : param_asociacion_reunion_estatus,
			"AsociacionReunionID" : param_asociacion_reunion_id
		},
		mUrl = BaseUrl + "?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			ResetAsociacionReunionAction();
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
				  ObtenerInformacionAsociacionReuniones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}