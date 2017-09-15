var
	$btnCapturarAsistencia = $("#btnCapturarAsistencia"),
	$btnGoToAsistenciaCharts = $("#btnGoToAsistenciaCharts"),
	$cboCongregaciones = $("#cboCongregaciones"),
	$cboCongregacionesContainer = $("#cboCongregacionesContainer"),
	$cboReuniones = $("#cboReuniones"),
	$cboReunionesContainer = $("#cboReunionesContainer"),	
	$cboSecciones = $("#cboSecciones"),
	$cboSeccionesContainer = $("#cboSeccionesContainer"),
	$dpFechaCaptura = $("#dpFechaCaptura"),
	$txtAsistencia = $("#txtAsistencia"),
	$tbAsistenciaBody = $("#tbAsistenciaBody"),
	BaseCongregacionesUrl = "../controllers/CongregacionesController.php",
	BaseReunionesUrl = "../controllers/AsociacionReunionesController.php",
	BaseSeccionesUrl = "../controllers/SeccionesController.php",
	BaseAsistenciaUrl = "../controllers/AsistenciaController.php";


SetModuloTitle("Asistencia a las Reuniones");

ObtenerInformacionReuniones();


$btnCapturarAsistencia.click(function(evt) {
	var ReunionID = $cboReuniones.val(),
		CongregacionID = $cboCongregaciones.val(),
		SeccionID = $cboSecciones.val(),
		NumeroAsistentes = $txtAsistencia.val(),
		UsuarioID = $spanUsuarioLogueado.data("usuarioid"),
		FechaCaptura = $dpFechaCaptura.val();

	evt.preventDefault();

	if( ReunionID != "0" && ReunionID != 0 ) {
		if( CongregacionID != "0" && CongregacionID != 0 ) {
			CapturarAsistencia(ReunionID, CongregacionID, SeccionID, NumeroAsistentes, UsuarioID, FechaCaptura);
		}else {
			swal("Notificacion", "Falta especificar la congregacion", "warning");
		}
	}else {
		swal("Notificacion", "Falta especificar la reunion", "warning");
	}
});

$btnGoToAsistenciaCharts.click(function(evt) {
	evt.preventDefault();
	window.location.replace( 'main.php?modulo=asistencia_charts&random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );
});

$cboCongregaciones.change(function() {
	ObtenerInformacionSecciones( $( this ).val() );
});


function ObtenerInformacionReuniones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionReuniones"
		},
		mUrl = BaseReunionesUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

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

	ObtenerInformacionCongregaciones();
}

function ObtenerInformacionCongregaciones() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerCongregacionesActivas"
		},
		mUrl = BaseCongregacionesUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillCboCongregaciones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillCboCongregaciones(CongregacionesJSON) {
	var tmpHtml = '',
		indice = 0,
		total = CongregacionesJSON.length;

	$cboCongregaciones.empty();
	tmpHtml = '<option value="0">Selecciona una congregacion:</opcion>'; 
	if( total > 0 ) {
		if( CongregacionesJSON[0].Id > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				tmpHtml += '<option value="' + CongregacionesJSON[indice].Id + '">' + CongregacionesJSON[indice].Nombre + '</option>';
			}
		}
	}
	$cboCongregaciones.html(tmpHtml);
	$cboCongregaciones.focus();
	$cboCongregacionesContainer.addClass("is-dirty");	
}

function ObtenerInformacionSecciones( CongregacionId ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerSeccionesActivas",
			"CongregacionID" : CongregacionId
		},
		mUrl = BaseSeccionesUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillCboSecciones(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillCboSecciones(SeccionesJSON) {
	var tmpHtml = '',
		indice = 0,
		total = SeccionesJSON.length;

	$cboSecciones.empty();
	tmpHtml = '<option value="0">TODAS</opcion>';
	if( total > 0 ) {
		if( SeccionesJSON[0].Id > 0 ) { 
			for(indice = 0 ; indice < total ; indice++) {				
				tmpHtml += '<option value="' + SeccionesJSON[indice].Id + '">' + SeccionesJSON[indice].Nombre + '</option>';
			}			
		}
	}
	$cboSecciones.html(tmpHtml);
	$cboSeccionesContainer.focus();
	$cboSeccionesContainer.addClass("is-dirty");	

	ObtenerInformacionAsistenciaTop14();
}

function ObtenerInformacionAsistenciaTop14() {
	var
		CongregacionID = $cboCongregaciones.val(),
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "ObtenerInformacionAsistenciaTop14",
			"CongregacionID" : CongregacionID
		},
		mUrl = BaseAsistenciaUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			FillTbAsistenciaBody(ServerResponseJSON);
		},  
		type: "GET"
	});	
}

function FillTbAsistenciaBody(AsistenciaJSON) {
	var tmpHtml = '',
		indice = 0,
		total = AsistenciaJSON.length;

	$tbAsistenciaBody.empty();
	if( total > 0 ) {
		if( AsistenciaJSON[0].AsistenciaId > 0 ) {
			for(indice = 0 ; indice < total ; indice++) {
				tmpHtml += '<tr data-asistencia-id="' + AsistenciaJSON[indice].AsistenciaId + '" data-reunion-nombre="' + AsistenciaJSON[indice].ReunionNombre + '" data-fecha-captura="' + AsistenciaJSON[indice].FechaCaptura + '" data-reunion-id="' + AsistenciaJSON[indice].ReunionId + '" data-congregacion-id="' + AsistenciaJSON[indice].CongregacionId + '" data-seccion-id="' + AsistenciaJSON[indice].SeccionId + '">';
				tmpHtml += '	<td class="mdl-data-table__cell--non-numeric">' + AsistenciaJSON[indice].CongregacionNombre + '</td>';
				tmpHtml += '	<td class="mdl-data-table__cell--non-numeric">' + AsistenciaJSON[indice].SeccionNombre + '</td>';
				tmpHtml += '	<td class="mdl-data-table__cell--non-numeric">' + AsistenciaJSON[indice].ReunionNombre + '</td>';
				tmpHtml += '	<td class="mdl-data-table__cell--non-numeric">' + AsistenciaJSON[indice].FechaCaptura + '</td>';
				tmpHtml += '	<td>' + AsistenciaJSON[indice].NumeroAsistentes + '</td>';
				tmpHtml += '	<td><div class="btnsDeleteAsistencia icon material-icons redColor cursorPointer" >highlight_off</div></td>';
				tmpHtml += '</tr>';
			}
			$tbAsistenciaBody.html(tmpHtml);
			registerTrItemsEvents();
		}
	}										
}

function registerTrItemsEvents() {
	var $btnsDeleteAsistencia = $(".btnsDeleteAsistencia");

	$btnsDeleteAsistencia.unbind("click");
	$btnsDeleteAsistencia.click(function(evt) {
		var $This = $( this ),
			$ItemDataContainer = $This.closest("tr"),
			AsistenciaID = $ItemDataContainer.data("asistenciaId"),
			ReunionNombre = $ItemDataContainer.data("reunionNombre"),
			FechaCaptura = $ItemDataContainer.data("fechaCaptura");

		evt.preventDefault();

		swal({
		  title: "Advertencia",
		  text: "Esta seguro(a) de querer eliminar la asistencia a la reunion [" + ReunionNombre + "] del [" + FechaCaptura + "] ?",
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
		    EliminarAsistencia( AsistenciaID );
		  } else {
		    swal("Cancelada", "La operacion fue cancelada", "error");
		    $txtAsistencia.val("");
		  }
		});
	});		
}

function ResetAsistenciaAction() {
	$cboReuniones.find("option:eq(0)").prop("selected",true);
	$cboCongregaciones.find("option:eq(0)").prop("selected",true);
	$cboSecciones.find("option:eq(0)").prop("selected",true);
	$txtAsistencia.val("");
}

function CapturarAsistencia(ReunionID, CongregacionID, SeccionID, NumeroAsistentes, UsuarioID, FechaCaptura) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "CapturarAsistencia",
			"ReunionID" : ReunionID,
			"CongregacionID" : CongregacionID,
			"SeccionID" : SeccionID,
			"NumeroAsistentes" : NumeroAsistentes,
			"UsuarioID" : UsuarioID,
			"FechaCaptura" : FechaCaptura
		},
		mUrl = BaseAsistenciaUrl + "?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			$txtAsistencia.val("");
			if( ServerResponseJSON.Valid == "1" || ServerResponseJSON.Valid == 1 ) {
				swal({
				  title: "CAPTURADA",
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ObtenerInformacionAsistenciaTop14();	
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function EliminarAsistencia( AsistenciaID ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "EliminarAsistencia",
			"AsistenciaID" : AsistenciaID
		},
		mUrl = BaseAsistenciaUrl + "?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			$txtAsistencia.val("");
			if( ServerResponseJSON.Valid == "1" || ServerResponseJSON.Valid == 1 ) {
				swal({
				  title: "ELIMINADA",
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ObtenerInformacionAsistenciaTop14();	
				});
			}else {
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}