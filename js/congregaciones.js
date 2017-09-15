var 
	$btnGuardarCongregacion = $("#btnGuardarCongregacion"),
	$btnResetCongregacionAction = $("#btnResetCongregacionAction"),
	$listViewCongregaciones = $("#listViewCongregaciones"),
	$txtNombreCongregacion = $("#txtNombreCongregacion"),
	BaseUrl = "../controllers/CongregacionesController.php",
	CacheCongregacionID = 0;


SetModuloTitle("Congregaciones");

ObtenerInformacionCongregaciones();


$btnGuardarCongregacion.click(function(evt) {
	var nombreCongregacion = $txtNombreCongregacion.val(),
		opcion = ( $btnGuardarCongregacion.text() == "AGREGAR" ) ? "AgregarCongregacion" : "ActualizarCongregacion",
		UsuarioID = $spanUsuarioLogueado.data("usuarioid");

	evt.preventDefault();
	GuardarCongregacion( opcion , CacheCongregacionID, nombreCongregacion, UsuarioID );
});

$btnResetCongregacionAction.click(function(evt) {
	evt.preventDefault();
	ResetCongregacionAction();
});


function ObtenerInformacionCongregaciones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionCongregaciones"
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
			DisplayListadoCongregaciones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function DisplayListadoCongregaciones(CongregacionesJSON) {
	var tmpHtml = '',
		indice = 0,
		icono = "",
		iconoColor = "",
		claseDesplegarSeccionesBtn = "",
		claseDesplegarReunionesBtn = "",
		total = CongregacionesJSON.length;

	$listViewCongregaciones.empty();
	if( total > 0 ) {
		if( CongregacionesJSON[0].Id > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				icono = ( CongregacionesJSON[indice].Estatus == 1 ) ? "highlight_off" : "check_circle";
				iconoColor = ( CongregacionesJSON[indice].Estatus == 1 ) ? "redColor" : "greenColor";
				claseDesplegarSeccionesBtn = ( CongregacionesJSON[indice].Estatus == 1 ) ? "btnsDesplegarSecciones" : "";
				claseDesplegarReunionesBtn = ( CongregacionesJSON[indice].Estatus == 1 ) ? "btnsDesplegarReuniones" : "";
			
				tmpHtml += '<li id="item_' + CongregacionesJSON[indice].Id + '" class="view_' + CongregacionesJSON[indice].Id + ' mdl-list__item mdl-list__item--two-line"  data-congregacionid="' + CongregacionesJSON[indice].Id + '" data-congregacionnombre="' + CongregacionesJSON[indice].Nombre + '" data-estatus="' + CongregacionesJSON[indice].Estatus + '">';
				tmpHtml += '	<span class="mdl-list__item-primary-content">';
				tmpHtml += '		<i class="material-icons mdl-list__item-avatar">group_work</i>';
				tmpHtml += '		<span>' + CongregacionesJSON[indice].Nombre + '</span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title"><a class="' + claseDesplegarSeccionesBtn + '" href="#">Secciones</a></span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title"><a class="' + claseDesplegarReunionesBtn + '" href="#">Reuniones</a></span>';
				tmpHtml += '	</span>';
				tmpHtml += '	<span class="mdl-list__item-secondary-content">';
				tmpHtml += '		<a class="mdl-list__item-secondary-action" href="#">';
				tmpHtml += '			<div class="btnsEditarCongregaciones icon material-icons">edit</div>';
				tmpHtml += '			<div class="btnsManejoDeEstadosCongregaciones icon material-icons ' + iconoColor + '" >' + icono + '</div>';
				tmpHtml += '		</a>';
				tmpHtml += '	</span>';
				tmpHtml += '</li>';
				if( indice != ( total - 1 ) ) {
					tmpHtml += '<hr class="view_' + CongregacionesJSON[indice].Id + '">';	
				}
			}
			$listViewCongregaciones.html(tmpHtml);

			registerListViewItemsEvents();
		}
	}
}

function registerListViewItemsEvents() {
	var $btnsEditarCongregaciones = $(".btnsEditarCongregaciones"),
		$btnsManejoDeEstadosCongregaciones = $(".btnsManejoDeEstadosCongregaciones"),
		$btnsDesplegarSecciones = $(".btnsDesplegarSecciones"),
		$btnsDesplegarReuniones = $(".btnsDesplegarReuniones");

	$btnsEditarCongregaciones.unbind("click");
	$btnsEditarCongregaciones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li");	
			
		evt.preventDefault();
		CacheCongregacionID = parseInt( $ItemDataContainer.data("congregacionid") );
		$btnResetCongregacionAction.removeClass("noDisplay");
		$(".bgColorAmarillo").removeClass("bgColorAmarillo");
		$(".view_" + CacheCongregacionID).addClass("bgColorAmarillo");
		$txtNombreCongregacion.val( $ItemDataContainer.data("congregacionnombre") ); 
		$btnGuardarCongregacion.text("EDITAR");
		$txtNombreCongregacion.focus();
	});

	$btnsManejoDeEstadosCongregaciones.unbind("click");
	$btnsManejoDeEstadosCongregaciones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			NombreCongregacion = $ItemDataContainer.data("congregacionnombre"),
			EstatusCongregacion = $ItemDataContainer.data("estatus"),
			Accion = ( EstatusCongregacion == "1" || EstatusCongregacion == 1 ) ? "DESHABILITAR" : "HABILITAR",
			UsuarioID = $spanUsuarioLogueado.data("usuarioid");

		CacheCongregacionID = parseInt( $ItemDataContainer.data("congregacionid") );	
		evt.preventDefault();

		swal({
		  title: "Advertencia",
		  text: "Esta seguro(a) de querer " + Accion + " la congregacion [" + NombreCongregacion + "] ?",
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
		    ManejoDeEstadoCongregacion( CacheCongregacionID, EstatusCongregacion , UsuarioID );
		  } else {
		    swal("Cancelada", "La operacion fue cancelada", "error");
		    ResetCongregacionAction();
		  }
		});
	});

	$btnsDesplegarSecciones.unbind("click");
	$btnsDesplegarSecciones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			modulo = "secciones",
			congregacion_nombre = $ItemDataContainer.data("congregacionnombre");
		evt.preventDefault();
		CacheCongregacionID = parseInt( $ItemDataContainer.data("congregacionid") );
		window.location.replace( 'main.php?modulo=' + modulo + '&congregacion_id=' + CacheCongregacionID + '&congregacion_nombre=' + congregacion_nombre + '&random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );
	});

	$btnsDesplegarReuniones.unbind("click");
	$btnsDesplegarReuniones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			modulo = "asociacion_reuniones",
			congregacion_nombre = $ItemDataContainer.data("congregacionnombre");
		evt.preventDefault();
		CacheCongregacionID = parseInt( $ItemDataContainer.data("congregacionid") );
		window.location.replace( 'main.php?modulo=' + modulo + '&reunible_id=' + CacheCongregacionID + '&reunible_type=Congregacion&reunible_nombre=' + congregacion_nombre + '&random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );		
	});
}

function ResetCongregacionAction() {
	CacheCongregacionID = 0;
	$btnGuardarCongregacion.text("AGREGAR");
	$(".bgColorAmarillo").removeClass("bgColorAmarillo"); 
	$btnResetCongregacionAction.addClass("noDisplay");
	$txtNombreCongregacion.val("");
}

function GuardarCongregacion( param_opcion , param_congregacion_id, param_nombre, param_usuario_id ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : param_opcion,
			"CongregacionID" : param_congregacion_id,
			"NombreCongregacion" : param_nombre,
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
			ResetCongregacionAction();
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
				  ObtenerInformacionCongregaciones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function ManejoDeEstadoCongregacion( param_congregacion_id, param_estatus_congregacion, param_usuario_id ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		titulo = ( param_estatus_congregacion == 1 || param_estatus_congregacion == "1" ) ? "DESHABILITADA" : "HABILITADA";
		Objeto = {
			"opcion" : "ManejoDeEstadoCongregacion",
			"CongregacionID" : param_congregacion_id,
			"Estatus" : param_estatus_congregacion,
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
			ResetCongregacionAction();
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
				  ObtenerInformacionCongregaciones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}