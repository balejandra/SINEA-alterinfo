function changeOrigen() {
    var permiso=$('select[id="permiso"] option:selected').text()
    capitania=document.getElementById('capitania_destino_div')
    establecimiento=document.getElementById('establecimiento_destino_div')
    divOrigenInternacional=document.getElementById('paises_div')
    if (permiso==='Zarpe Nacional'){
        document.getElementById("bandera").disabled = false;
        capitania.style.display='block';
        establecimiento.style.display='block';
        divOrigenInternacional.style.display='none';
        $('#capitania_id_origen').prop('disabled', false);
        $('#capitania_id_origen').selectpicker('refresh');
        document.getElementById("establecimientos_origen").disabled = false;
        document.getElementById('paises_id').selectedIndex = '';
    } if (permiso==='Zarpe Internacional'){
        $('#capitania_id_origen').prop('disabled', false);
        $('#capitania_id_origen').selectpicker('refresh');
        document.getElementById("establecimientos_origen").disabled = false;
        document.getElementById('paises_id').selectedIndex = '';
        $('#capitania_id_destino').selectpicker('deselectAll');
        $('#capitania_id_destino').selectpicker('refresh');
        document.getElementById('establecimientos_destino').selectedIndex = '';
        document.getElementById("bandera").disabled = false;
        capitania.style.display='none';
        establecimiento.style.display='none';
        divOrigenInternacional.style.display='block';
        document.getElementById("paises_id").disabled = false;

    }if (permiso==='Estadia'){
        document.getElementById('bandera').selectedIndex = '';
        document.getElementById("bandera").disabled = true;

        $('#capitania_id_origen').selectpicker('deselectAll');
        $('#capitania_id_origen').prop('disabled', true);
        $('#capitania_id_origen').selectpicker('refresh');
        document.getElementById('establecimientos_origen').selectedIndex = '';
        document.getElementById("establecimientos_origen").disabled = true;
        document.getElementById('paises_id').selectedIndex = '';
        document.getElementById("paises_id").disabled = true;
        capitania.style.display='block';
        establecimiento.style.display='block';
        divOrigenInternacional.style.display='none';
    }
}

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
$(".select_capOrigen").on("changed.bs.select",
    function(e) {
        var valores = $.map(
            $('#capitania_id_origen option:selected'),
            function(o, i) { return $(o).text(); });
        $('input[name="capitania_name_origen"]').val(valores.join(''));
        var idCapitania = $(this).val();
        if (idCapitania.length==1){
            var capi=$('select[id="capitania_id_origen"] option:selected').text()
            $('input[name="capitania_name_origen"]').val(capi);
            $.ajax({
                url: route('AsignarEstablecimiento'),
                data: {idcap: idCapitania }

            })// This will be called on success
                .done(function (response) {
                    //  alert(response);
                    respuesta = JSON.parse(response);
                    let establecimientos=respuesta[0];
                    let select=document.getElementById("establecimientos_origen");
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

        }else{
            let select=document.getElementById("establecimientos_origen");
            $("#establecimientos_origen").find('option').not(':first').remove();
            let options="<option value=>Escoja una Capitanía para cargar los Establecimientos...</option>";
            select.innerHTML=options;
        }


    });

$(".select_capDestino").on("changed.bs.select",
    function(e) {
        var valores = $.map(
            $('#capitania_id_destino option:selected'),
            function(o, i) { return $(o).text(); });
        $('input[name="capitania_name_destino"]').val(valores.join(''));

        var idCapitania = $(this).val();
        if (idCapitania.length==1){
            var capi=$('select[id="capitania_id_destino"] option:selected').text()
            $('input[name="capitania_name_destino"]').val(capi);
            $.ajax({
                url: route('AsignarEstablecimiento'),
                data: {idcap: idCapitania }

            })// This will be called on success
                .done(function (response) {
                    //  alert(response);
                    respuesta = JSON.parse(response);
                    let establecimientos=respuesta[0];
                    let select=document.getElementById("establecimientos_destino");
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

        }else{
            let select=document.getElementById("establecimientos_destino");
            $("#establecimientos_destino").find('option').not(':first').remove();
            let options="<option value=>Escoja una Capitanía para cargar los Establecimientos...</option>";
            select.innerHTML=options;
        }


    });




function esta_name_origen() {
    var esta=$('select[name="establecimiento_nautico_id_origen"] option:selected').text()
    $('input[name="establecimiento_name_origen"]').val(esta);
}


function changeEstatusName() {
    var estatus=$('select[name="estatus"] option:selected').text()
    $('input[name="estatus_name"]').val(estatus);
}

function changePaisesName() {
    var pais=$('select[name="paises_id"] option:selected').text()
    $('input[name="paises_name"]').val(pais);
}

function esta_name_destino() {
    var esta=$('select[name="establecimiento_nautico_id_destino"] option:selected').text()
    $('input[name="establecimiento_name_destino"]').val(esta);
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
