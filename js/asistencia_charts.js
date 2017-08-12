var 
    $btnGraficar = $("#btnGraficar"),
    $cboCongregaciones = $("#cboCongregaciones"),
    $cboCongregacionesContainer = $("#cboCongregacionesContainer"),
    $cboReuniones = $("#cboReuniones"),
    $cboReunionesContainer = $("#cboReunionesContainer"),   
    $cboSecciones = $("#cboSecciones"),
    $cboSeccionesContainer = $("#cboSeccionesContainer"),
    BaseCongregacionesUrl = "../controllers/CongregacionesController.php",
    BaseReunionesUrl = "../controllers/AsociacionReunionesController.php",
    BaseSeccionesUrl = "../controllers/SeccionesController.php",
    ctx = document.getElementById("myChart"),
    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },            
           maintainAspectRatio: false
        }
    });


SetModuloTitle("Grafica de Asistencia de Reuniones");

ObtenerInformacionReuniones(); 


$btnGraficar.click(function(evt) {
    var objetoJSON = {
        labels : [ "Semana #22" , "Semana #23" , "Semana #24" , "Semana #25" , "Semana #26" ],
        datasets : [
            {
                label: 'Vida y Ministerio [Seccion A]',
                data: [ 86 , 82 , 89 , 80 , 83 ],
                backgroundColor: 'red'
            },
            {
                label: 'Estudio de la Atalaya [Seccion A]',
                data: [ 92 , 90 , 95 , 88 , 92 ],
                backgroundColor: 'blue'
            },
            {
                label: 'Vida y Ministerio [Seccion B]',
                data : [ 98 , 100 , 89 , 98 , 105 ],
                backgroundColor: 'purple'
            },
            {
                label: 'Estudio de la Atalaya [Seccion B]',
                data: [ 115 , 108 , 97 , 105 , 113 ],
                backgroundColor: 'orange'
            }
        ]
    };
    evt.preventDefault();
    myChart.data.labels = objetoJSON.labels;
    myChart.data.datasets = objetoJSON.datasets;
    myChart.update();   
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
            "opcion" : "ObtenerInformacionCongregaciones"
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
            "opcion" : "ObtenerInformacionSecciones",
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
}