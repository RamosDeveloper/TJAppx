var
	$btnCambiarContrasena = $("#btnCambiarContrasena"),
	$btnCancelarCambio = $("#btnCancelarCambio"),
	$btnCerrarSession = $("#btnCerrarSession"),
	$btnsDesplegarModulos = $(".btnsDesplegarModulos"),
	$btnDesplegarModalCambiarContrasena = $("#btnDesplegarModalCambiarContrasena"),
	$h4Modulo = $("#h4Modulo"),
	$pswNuevaContrasena = $("#pswNuevaContrasena"),
	$pswNuevaContrasenaConfirmacion = $("#pswNuevaContrasenaConfirmacion"),
	$spanUsuarioLogueado = $("#spanUsuarioLogueado"),
	dlgContenedorCambiarContrasena = document.querySelector("#dlgContenedorCambiarContrasena"),
	dlgLoader = document.querySelector("#dlgLoader"),
	BaseUsuariosUrl = "../controllers/UsuariosController.php";


if (! dlgContenedorCambiarContrasena.showModal) {
	dialogPolyfill.registerDialog(dlgContenedorCambiarContrasena);
}

if (! dlgLoader.showModal) {
	dialogPolyfill.registerDialog(dlgLoader);
}


$btnCambiarContrasena.click(function(evt) {
	evt.preventDefault();

	if( ( $pswNuevaContrasena.val() != "" && $pswNuevaContrasena.val() != " " && $pswNuevaContrasena.val().length > 0 ) && ( $pswNuevaContrasenaConfirmacion.val() != "" && $pswNuevaContrasenaConfirmacion.val() != " " && $pswNuevaContrasenaConfirmacion.val().length > 0 ) ) {
		if( $pswNuevaContrasena.val() == $pswNuevaContrasenaConfirmacion.val() ) {
			CambiarContrasena();
		}else {
			dlgContenedorCambiarContrasena.close();
			swal("Notificacion", "Las contrasenas no coinciden", "warning");
		}
	}else {
		dlgContenedorCambiarContrasena.close();
		swal("Notificacion", "Falta informacion requerida", "warning");
	}
});

$btnCancelarCambio.click(function(evt) {
	evt.preventDefault();
	dlgContenedorCambiarContrasena.close();
});

$btnDesplegarModalCambiarContrasena.click(function(evt) {
	evt.preventDefault();
	dlgContenedorCambiarContrasena.showModal();
});

$btnCerrarSession.click(function(evt) {
	evt.preventDefault();
	KillSession();
});

$btnsDesplegarModulos.click(function(evt) {
	var $This = $( this ),
		modulo = $This.data("modulo");
	evt.preventDefault();
	window.location.replace( 'main.php?modulo=' + modulo + '&random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );
});


function KillSession() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "KillSession"
		},
		mUrl = "../controllers/CerberusController.php?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom;	
	
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			window.location.replace( '../index.php?random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );
		},  
		type: "GET"
	});	
}

function SetModuloTitle(titulo) {
	$h4Modulo.text( titulo );
}

function CambiarContrasena() {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "CambiarContrasena",
			"UsuarioID" : $spanUsuarioLogueado.data("usuarioid"),
			"Contrasena" : $pswNuevaContrasena.val()
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
			dlgContenedorCambiarContrasena.close();
			if( ServerResponseJSON.Valid == "1" || ServerResponseJSON.Valid == 1 ) {
				swal({
				  title: "CAMBIADA",
				  text: ServerResponseJSON.Mensaje,
				  type: "success",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "OK!",
				  closeOnConfirm: true
				},
				function(){
				  ResetCambiarContrasenaAction();
				});
			}else {
				ResetCambiarContrasenaAction();
				swal( "SQL issue." , ServerResponseJSON.Mensaje , "error" );
			}			
		},  
		type: "POST"
	});
}

function ResetCambiarContrasenaAction() {
	$pswNuevaContrasena.val("");
	$pswNuevaContrasenaConfirmacion.val("");
}