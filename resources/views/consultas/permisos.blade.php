@extends('layouts.app')
@section("titulo")
    Zarpes | Busqueda
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/consultas.js')}}"></script>
        <script src="{{asset('js/buscador.js')}}"></script>
    @endpush
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Busqueda</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-search-plus"></i>
                            <strong>Busqueda</strong>
                            <div class="card-header-actions">

                            </div>
                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            {!! Form::open(['route' => 'busquedaPermisos.queries']) !!}
                            <div class="row align-self-start">
                                <span class="title-estadia">Busqueda de Permisos</span>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('permiso', 'Permiso:') !!}
                                    {!! Form::select('permiso', ['Zarpe Nacional' => 'Zarpe Nacional',
                                                                 'Zarpe Internacional' => 'Zarpe Internacional',
                                                                 'Estadia'=>'Estadia'
                                                                 ], null, ['class'=>'form-control custom-select','placeholder' => 'Seleccione','required',
                                                                 'onclick="changeOrigen();"',
                                                                 'autocomplete'=>'off']) !!}
                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('nro_solicitud', 'Nro de Solicitud:') !!}
                                    {!! Form::text('nro_solicitud', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-2">

                                    {!! Form::label('solicitante', 'Solicitante:') !!}
                                    {!! Form::text('solicitante',null, null, ['id'=>'solicitante',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Seleccione un usuario']) !!}
                                    <input type="text" name="solicitante_id" id="solicitante_id" hidden>
                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('bandera', 'Bandera') !!}
                                    {!! Form::select('bandera', ['nacional' => 'Nacional', 'extranjera' => 'Extranjera'], null,
                                                        ['id'=>'bandera',
                                                        'class'=>'form-control custom-select',
                                                        'placeholder' => 'Bandera...']) !!}
                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('matricula', 'Matrícula o Nro de Registro:') !!}
                                    {!! Form::text('matricula', null, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('estatus', 'Estatus') !!}
                                    {!! Form::select('estatus', $estatus, null, ['id'=>'estatus','class'=>'form-control custom-select',
                                                        'placeholder' => 'Estatus...',
                                                         'onclick="changeEstatusName();"']) !!}
                                    <input type="text" name="estatus_name" hidden>
                                </div>
                                <div class="clearfix"></div>


                                <div class="row">
                                    <input type="text" name="capitania_name_origen" hidden>
                                    <input type="text" name="establecimiento_name_origen" hidden>
                                    <div class="col-sm-6" id="origen-div" style="display: block">
                                        <div class="card mb-3">
                                            <div class="card-header card-header-consulta text-center">Origen:<br>

                                                <div class="row">
                                                    <div class="col" id="capitania_div">

                                                        {!! Form::label('capitania', 'Capitanía:') !!}
                                                        {!! Form::select('capitania_id_origen', $capitania, null, ['id'=>'capitania_id_origen',
                                                                            'class' => 'form-control custom-select',
                                                                            'placeholder' => 'Seleccione una capitania',
                                                                            'onclick="Establecimiento_origen();"']) !!}
                                                    </div>
                                                    <div class="col" id="establecimiento_div">

                                                        {!! Form::label('capitania', 'Establecimiento:') !!}
                                                        {!! Form::select('establecimiento_nautico_id_origen',[], null,
                                                                            ['id'=>'establecimientos_origen',
                                                                            'class' => ' form-control custom-select',
                                                                            'placeholder' => 'Escoja una Capitanía para cargar los Establecimientos...',
                                                                            'onclick="esta_name_origen();"']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card mb-3">
                                            <div class="card-header card-header-consulta text-center">Destino:<br>
                                                <div class="row">
                                                    <div class="col" id="capitania_destino_div">
                                                        <input type="text" name="capitania_name_destino" hidden>
                                                        {!! Form::label('capitania', 'Capitanía:') !!}
                                                        {!! Form::select('capitania_id_destino', $capitania, null, ['id'=>'capitania_id_destino',
                                                                            'class' => 'form-control custom-select',
                                                                            'placeholder' => 'Seleccione una capitania',
                                                                            'onclick="Establecimiento_destino();"']) !!}
                                                    </div>
                                                    <div class="col" id="establecimiento_destino_div">
                                                        <input type="text" name="establecimiento_name_destino" hidden>
                                                        {!! Form::label('capitania', 'Establecimiento:') !!}
                                                        {!! Form::select('establecimiento_nautico_id_destino',[], null,
                                                                            ['id'=>'establecimientos_destino',
                                                                            'class' => ' form-control custom-select',
                                                                            'placeholder' => 'Escoja una Capitanía para cargar los Establecimientos...',
                                                                            'onclick="esta_name_destino();"']) !!}
                                                    </div>
                                                    <div class="col" id="paises_div" style="display: none">
                                                        <input type="text" name="paises_name" hidden>
                                                        {!! Form::label('paises_id', 'Pais:') !!}
                                                        {!! Form::select('paises_id', $paises, null, ['id'=>'paises_id',
                                                                            'class' => 'form-control custom-select',
                                                                            'placeholder' => 'Seleccione un País',
                                                                             'onclick="changePaisesName();"']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="clearfix"></div>
                                <input type="text" name="filtro_name" hidden>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('capitania', 'Campo Fecha:') !!}
                                    {!! Form::select('filtro_fecha', ['fecha_hora_salida' => 'Fecha Salida', 'fecha_hora_regreso' => 'Fecha Regreso','fecha_arribo'=>'Fecha Arribo (Estadia)'], null, ['id'=>'filtro_fecha','class'=>'form-control custom-select','placeholder' => 'Filtro de Fecha...','onclick="changeFiltro();"']) !!}

                                </div>
                                <div class="form-group col-sm-2">
                                    {!! Form::label('Fecha', 'Fecha:') !!}
                                    <input type="date" class="form-control" id="fecha_unica" name="fecha_unica"
                                           maxlength="10" onchange="changeFiltroFecha();" onemptied="">
                                </div>
                                <div class="form-group mt-4 col-sm-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="rango_fecha"
                                               id="rango_fecha" value="1"
                                               onclick="mostrarRangoFechas()" autocomplete="off">
                                        <label class="form-check-label" for="natural">
                                            Rango de Fechas
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-sm-2" id="rangoFechainicio-div" style="display: none">
                                    {!! Form::label('fecha_inicial', 'Fecha Inicio:') !!}
                                    <input type="date" class="form-control" id="fecha_inicial" name="fecha_inicial"
                                           maxlength="10">
                                </div>
                                <div class="form-group col-sm-2" id="rangoFechafin-div" style="display: none">
                                    {!! Form::label('fecha_final', 'Fecha Fin:') !!}
                                    <input type="date" class="form-control" id="fecha_final" name="fecha_final"
                                           maxlength="10">
                                </div>

                                <div class="form-group col-sm-2 d-flex align-items-end">
                                    {!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
                                </div>
                                <br>
                            </div>
                            <hr class="dropdown-divider">
                            <br>
                            {!! Form::close() !!}
                            @includeWhen($queries==='Zarpe Nacional', 'consultas.tableZarpe')
                            @includeWhen($queries==='Zarpe Internacional', 'consultas.tableZarpe')
                            @includeWhen($queries==='Estadia', 'consultas.tableEstadia')
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
