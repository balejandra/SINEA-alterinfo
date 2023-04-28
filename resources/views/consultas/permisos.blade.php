@extends('layouts.app')
@section("titulo")
    Zarpes
@endsection
@section('content')
    @push('scripts')
        <script src="{{asset('js/consultas.js')}}"></script>
    @endpush
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">Consulta</li>
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
                            <strong>Consulta</strong>
                            <div class="card-header-actions">

                            </div>
                        </div>
                        <div class="card-body" style="min-height: 350px;">
                            {!! Form::open(['route' => 'consultasPermiso.queries']) !!}
                            <div class="row align-self-start">
                                <span class="title-estadia">Consulta de Permisos</span>
                                <div class="form-group col-sm-3">
                                    {!! Form::label('permiso', 'Permiso:') !!}
                                    {!! Form::select('permiso', ['Zarpe Nacional' => 'Zarpe Nacional',
                                                                 'Zarpe Internacional' => 'Zarpe Internacional',
                                                                 'Estadia'=>'Estadia'
                                                                 ], null, ['class'=>'form-control custom-select','placeholder' => 'Seleccione','required']) !!}
                                </div>
                                <input type="text" name="capitania_name"  hidden>
                                <div class="form-group col-sm-3">
                                    {!! Form::label('capitania', 'Capitanía:') !!}
                                    {!! Form::select('capitania_id', $capitania, null, ['id'=>'capitania_id','class' => 'form-control custom-select','placeholder' => 'Seleccione una capitania','onclick="Establecimiento1();"']) !!}

                                </div>
                                <input type="text" name="establecimiento_name"  hidden>
                                <div class="form-group col-sm-3" id="divestablecimiento">
                                    {!! Form::label('capitania', 'Establecimiento:') !!}
                                    {!! Form::select('establecimiento_nautico_id',[], null, ['id'=>'establecimientos','class' => ' form-control custom-select','placeholder' => 'Escoja una Capitanía para cargar los Establecimientos...','onclick="esta_name();"']) !!}

                                </div>
                              <div class="clearfix"></div>
                                <input type="text" name="filtro_name"  hidden>
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
                                    <input class="form-check-input" type="checkbox" name="rango_fecha" id="rango_fecha" value="1"
                                           onclick="mostrarRangoFechas()" autocomplete="off" >
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
