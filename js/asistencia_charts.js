var 
    $btnGraficar = $("#btnGraficar"),
    $cboCongregaciones = $("#cboCongregaciones"),
    $cboCongregacionesContainer = $("#cboCongregacionesContainer"),
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

ObtenerInformacionCongregaciones();


$btnGraficar.click(function(evt) {
    evt.preventDefault();

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

function testChart() {
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
    
    myChart.data.labels = objetoJSON.labels;
    myChart.data.datasets = objetoJSON.datasets;
    myChart.update();   
}