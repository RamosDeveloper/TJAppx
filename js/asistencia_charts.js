var 
    $btnGraficar = $("#btnGraficar"),
    $cboCongregaciones = $("#cboCongregaciones"),
    $cboCongregacionesContainer = $("#cboCongregacionesContainer"),
    $dpFecha = $("#dpFecha"),
    BaseCongregacionesUrl = "../controllers/CongregacionesController.php",
    BaseAsistenciaGraficasUrl = "../controllers/AsistenciaGraficasController.php",
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

ObtenerInformacionCongregaciones();


$btnGraficar.click(function(evt) {
    var FechaCaptura = $dpFecha.val(),
        CongregacionID = $cboCongregaciones.val();

    evt.preventDefault();

    if( CongregacionID != "0" && CongregacionID != 0 ) {
        ObtenerAsistenciaGraficaMes( FechaCaptura, CongregacionID );
    }else {
        swal("Notificacion", "Falta especificar la congregacion", "warning");
    }
});


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

function ObtenerAsistenciaGraficaMes( FechaCaptura , CongregacionID ) {
    var
        mRandom = ( Math.round( ( 999 - 1 ) * Math.random() + 1 ) ),
        Objeto = {
            "opcion" : "ObtenerAsistenciaGraficaMes",
            "FechaCaptura" : FechaCaptura,
            "CongregacionID" : CongregacionID
        },
        mUrl = BaseAsistenciaGraficasUrl + "?Parametros=" + JSON.stringify( Objeto ) + "&mRandom=" + mRandom; 

    dlgLoader.showModal();  
    $.ajax({
        url: mUrl,
        async:true,
        cache: false,
        dataType: 'json',
        success: function( ServerResponseJSON ) {
            dlgLoader.close();
            if( ServerResponseJSON.Valid == "false" ) {
                swal("Notificacion", "No existe informacion de esa congregacion en ese mes.", "warning");           
            }
            UpdateChart( ServerResponseJSON );
        },  
        type: "GET"
    });     
}

function UpdateChart( ChartData ) {
    myChart.data.labels = ChartData.labels;
    myChart.data.datasets = ChartData.datasets;
    myChart.update(); 
}