var
	$btnCerrarSession = $("#btnCerrarSession"),
	$btnsDesplegarModulos = $(".btnsDesplegarModulos"),
	$h4Modulo = $("#h4Modulo"),
	$spanUsuarioLogueado = $("#spanUsuarioLogueado"),
	dlgLoader = document.querySelector("#dlgLoader");


$btnCerrarSession.click(function() {
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