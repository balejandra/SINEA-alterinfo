@extends('layouts.app')
@section("titulo")
    Tabla de Mandos
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('tablaMandos.index') !!}">Tabla de Mandos</a>
                </li>
                <li class="breadcrumb-item active">Crear</li>
            </ol>
        </nav>
    </div>
    </header>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('errors.messages')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-table"></i>
                            <strong>Crear Tabla de Mando</strong>
                            <div class="card-header-actions">
                            </div>
                        </div>
                        <div class="card-body">

                            {!! Form::open(['route' => 'tablaMandos.store']) !!}
                            <div class="row ">
                                <div class="col-md-2"></div>
                                <div class="col-md-8 border rounded p-3">
                            @include('zarpes.tabla_mando.fields')
                                </div>
                                <div class="col-md-2"></div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
