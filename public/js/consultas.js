function mostrarRangoFechas() {
    rangoFechaI=document.getElementById('rangoFechainicio-div')
    rangoFechaF=document.getElementById('rangoFechafin-div')
    fecha=document.getElementById('fecha_unica')
    filtro=document.getElementById('filtro_fecha')
    if($("#rango_fecha").is(':checked')){
        rangoFechaI.style.display='block';
        rangoFechaF.style.display='block';
        fecha.value="";
        fecha.readOnly = true;
        $('#fecha_inicial').prop("required", true);
        $('#fecha_final').prop("required", true);
        $('#filtro_fecha').prop("required", true);
    }else {
        rangoFechaI.style.display='none';
        rangoFechaF.style.display='none';
        fecha.readOnly = false;
        $('#fecha_inicial').prop("required", false);
        $('#fecha_final').prop("required", false);
        $('#filtro_fecha').prop("required", false);
    }
}

function Establecimiento1(){

        var idCapitania = $("#capitania_id").val();
        var capi=$('select[id="capitania_id"] option:selected').text()
        $('input[name="capitania_name"]').val(capi);
        $.ajax({
            url: route('AsignarEstablecimiento'),
            data: {idcap: idCapitania }

        })// This will be called on success
            .done(function (response) {
                //  alert(response);
                respuesta = JSON.parse(response);
                let establecimientos=respuesta[0];
                let select=document.getElementById("establecimientos");
                let options="<option value=>Puede asignar un Establecimiento...</option>";
                for (var i = 0; i < establecimientos.length; i++) {
                    options+="<option value='"+establecimientos[i].id+"'>"+establecimientos[i].nombre+"</option>"
                }
                select.innerHTML=options;
                // console.log(options);
            })

            // This will be called on error
            .fail(function (response) {
                console.log("fallo al buscar establecimientos nautico ");
            });

}

function esta_name() {
    var esta=$('select[name="establecimiento_nautico_id"] option:selected').text()
    $('input[name="establecimiento_name"]').val(esta);
}

function changeFiltro() {
    var filtro=$('select[name="filtro_fecha"] option:selected').text()
    console.log(filtro)
    $('input[name="filtro_name"]').val(filtro);
}

function changeFiltroFecha() {
    if ($('input[name="fecha_unica"]').val()==''){

        console.log('emp') ;
        $('#filtro_fecha').removeAttr("required");
        $('#filtro_fecha').prop("required", false);

    }
    $('#filtro_fecha').prop("required", true);
}
