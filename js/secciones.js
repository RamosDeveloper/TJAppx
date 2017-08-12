var
	$btnGuardarSeccion = $("#btnGuardarSeccion"),
	$btnResetSeccionAction = $("#btnResetSeccionAction"),
	$hdCongregacionData = $("#hdCongregacionData"),
	$listViewSecciones = $("#listViewSecciones"),
	$txtNombreSeccion = $("#txtNombreSeccion"),
	BaseUrl = "../controllers/SeccionesController.php",
	CacheCongregacionData = JSON.parse( $hdCongregacionData.val() ),
	CacheSeccionID = 0;


SetModuloTitle( "Secciones de la Congregacion " + CacheCongregacionData.Nombre );

ObtenerInformacionSecciones();


$btnGuardarSeccion.click(function(evt) {
	var nombreSeccion = $txtNombreSeccion.val(),
		opcion = ( $btnGuardarSeccion.text() == "AGREGAR" ) ? "AgregarSeccion" : "ActualizarSeccion",
		UsuarioID = $spanUsuarioLogueado.data("usuarioid");

	evt.preventDefault();
	GuardarSeccion( opcion , CacheCongregacionData.Id , CacheSeccionID, nombreSeccion, UsuarioID );
});

$btnResetSeccionAction.click(function(evt) {
	evt.preventDefault();
	ResetSeccionAction();
});


function ObtenerInformacionSecciones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionSecciones",
			"CongregacionID" : CacheCongregacionData.Id
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
			DisplayListadoSecciones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function DisplayListadoSecciones(SeccionesJSON) {
	var tmpHtml = '',
		indice = 0,
		icono = "",
		iconoColor = "",
		total = SeccionesJSON.length;

	$listViewSecciones.empty();
	if( total > 0 ) {
		if( SeccionesJSON[0].Id > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				icono = ( SeccionesJSON[indice].Estatus == 1 ) ? "highlight_off" : "check_circle";
				iconoColor = ( SeccionesJSON[indice].Estatus == 1 ) ? "redColor" : "greenColor";
			
				tmpHtml += '<li id="item_' + SeccionesJSON[indice].Id + '" class="view_' + SeccionesJSON[indice].Id + ' mdl-list__item mdl-list__item--two-line"  data-congregacionid="' + SeccionesJSON[indice].CongregacionId + '" data-seccionid="' + SeccionesJSON[indice].Id + '" data-seccionnombre="' + SeccionesJSON[indice].Nombre + '" data-estatus="' + SeccionesJSON[indice].Estatus + '">';
				tmpHtml += '	<span class="mdl-list__item-primary-content">';
				tmpHtml += '		<i class="material-icons mdl-list__item-avatar">group_work</i>';
				tmpHtml += '		<span>' + SeccionesJSON[indice].Nombre + '</span>';
				tmpHtml += '		<span class="mdl-list__item-sub-title"><a class="btnsDesplegarReuniones" href="#">Reuniones</a></span>';
				tmpHtml += '	</span>';
				tmpHtml += '	<span class="mdl-list__item-secondary-content">';
				tmpHtml += '		<a class="mdl-list__item-secondary-action" href="#">';
				tmpHtml += '			<div class="btnsEditarSecciones icon material-icons">edit</div>';
				tmpHtml += '			<div class="btnsManejoDeEstadosSecciones icon material-icons ' + iconoColor + '" >' + icono + '</div>';
				tmpHtml += '		</a>';
				tmpHtml += '	</span>';
				tmpHtml += '</li>';
				if( indice != ( total - 1 ) ) {
					tmpHtml += '<hr class="view_' + SeccionesJSON[indice].Id + '">';	
				}
			}
			$listViewSecciones.html(tmpHtml);

			registerListViewItemsEvents();
		}
	}
}

function registerListViewItemsEvents() {
	var $btnsEditarSecciones = $(".btnsEditarSecciones"),
		$btnsManejoDeEstadosSecciones = $(".btnsManejoDeEstadosSecciones"),
		$btnsDesplegarReuniones = $(".btnsDesplegarReuniones");

	$btnsEditarSecciones.unbind("click");
	$btnsEditarSecciones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li");	
			
		evt.preventDefault();
		CacheSeccionID = parseInt( $ItemDataContainer.data("seccionid") );
		$btnResetSeccionAction.removeClass("noDisplay");
		$(".bgColorAmarillo").removeClass("bgColorAmarillo");
		$(".view_" + CacheSeccionID).addClass("bgColorAmarillo");
		$txtNombreSeccion.val( $ItemDataContainer.data("seccionnombre") ); 
		$btnGuardarSeccion.text("EDITAR");
		$txtNombreSeccion.focus();
	});

	$btnsManejoDeEstadosSecciones.unbind("click");
	$btnsManejoDeEstadosSecciones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			NombreSeccion = $ItemDataContainer.data("seccionnombre"),
			EstatusSeccion = $ItemDataContainer.data("estatus"),
			Accion = ( EstatusSeccion == "1" || EstatusSeccion == 1 ) ? "DESHABILITAR" : "HABILITAR",
			UsuarioID = $spanUsuarioLogueado.data("usuarioid");

		CacheSeccionID = parseInt( $ItemDataContainer.data("seccionid") );	
		evt.preventDefault();

		swal({
		  title: "Advertencia",
		  text: "Esta seguro(a) de querer " + Accion + " la seccion [" + NombreSeccion + "] ?",
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
		    ManejoDeEstadoSeccion( CacheCongregacionData.Id , CacheSeccionID, EstatusSeccion , UsuarioID );
		  } else {
		    swal("Cancelada", "La operacion fue cancelada", "error");
		    ResetSeccionAction();
		  }
		});
	});

	$btnsDesplegarReuniones.unbind("click");
	$btnsDesplegarReuniones.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("li"),
			modulo = "asociacion_reuniones",
			seccion_nombre = $ItemDataContainer.data("seccionnombre");
		evt.preventDefault();
		CacheSeccionID = parseInt( $ItemDataContainer.data("seccionid") );
		window.location.replace( 'main.php?modulo=' + modulo + '&reunible_id=' + CacheSeccionID + '&reunible_type=Seccion&reunible_nombre=' + seccion_nombre + '&random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );		
	});	
}

function ResetSeccionAction() {
	CacheSeccionID = 0;
	$btnGuardarSeccion.text("AGREGAR");
	$(".bgColorAmarillo").removeClass("bgColorAmarillo"); 
	$btnResetSeccionAction.addClass("noDisplay");
	$txtNombreSeccion.val("");
}

function GuardarSeccion( param_opcion , param_congregacion_id, param_seccion_id , param_nombre, param_usuario_id ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : param_opcion,
			"CongregacionID" : param_congregacion_id,
			"SeccionID" : param_seccion_id,
			"NombreSeccion" : param_nombre,
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
			ResetSeccionAction();
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
				  ObtenerInformacionSecciones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function ManejoDeEstadoSeccion( param_congregacion_id, param_seccion_id, param_estatus_seccion, param_usuario_id ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		titulo = ( param_estatus_seccion == 1 || param_estatus_seccion == "1" ) ? "DESHABILITADA" : "HABILITADA";
		Objeto = {
			"opcion" : "ManejoDeEstadoSeccion",
			"CongregacionID" : param_congregacion_id,
			"SeccionID" : param_seccion_id,
			"Estatus" : param_estatus_seccion,
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
			ResetSeccionAction();
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
				  ObtenerInformacionSecciones();
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}