var 
	$txtUsuario = $("#txtUsuario"),
	$pswContrasena = $("#pswContrasena"),
	$btnLogin = $("#btnLogin"),
	dlgLoader = document.querySelector("#dlgLoader");


if (! dlgLoader.showModal) {
	dialogPolyfill.registerDialog(dlgLoader);
}


$btnLogin.click(function(evt) {
	evt.preventDefault();
	LocalLogin( $txtUsuario.val() , $pswContrasena.val() );
});


function LocalLogin( param_usuario , param_contrasena ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "LocalLogin",
			"usuario" : param_usuario,
			"contrasena" : param_contrasena
		},
		mUrl = "controllers/CerberusController.php?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			if( ServerResponseJSON.Valid == "1" ) {
				BeginSession( param_usuario );
			}else {
				swal( ServerResponseJSON.Mensaje , "usuario o contrasena incorrectos." , "warning" );
			}
		},  
		type: "POST"
	});
}

function BeginSession( param_usuario ) {
	var
		mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
		Objeto = {
			"opcion" : "BeginSession",
			"usuario" : param_usuario
		},
		mUrl = "controllers/UsuariosController.php?mRandom" + mRandom;	

	dlgLoader.showModal();
	$.ajax({
		url: mUrl,
		async:true,
		cache: false,
		data: { "Parametros" : JSON.stringify( Objeto ) },
		dataType: 'json',
		success: function( ServerResponseJSON ) {
			dlgLoader.close();
			window.location.replace( 'views/main.php?random=' + encodeURIComponent( ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ) ) );
		},  
		type: "POST"
	});
}