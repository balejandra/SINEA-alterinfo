@extends('layouts.app')
@section("titulo")
    Estatus
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('status.index') }}">Estatus</a>
                </li>
                <li class="breadcrumb-item active">Consulta</li>
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
                            <i class="fa fa-clipboard-check fa-lg"></i>
                            <strong>Consultar Estatus</strong>
                            <div class="card-header-actions">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6 p-0 border rounded">
                                            @include('zarpes.status.show_fields')
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
