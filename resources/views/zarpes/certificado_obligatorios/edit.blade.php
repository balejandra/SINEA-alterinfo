@extends('layouts.app')
@section("titulo")
    Certificados
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('certificadoObligatorios.index') !!}">Certificados</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
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
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Editar Certificado Obligatorio</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($certificadoObligatorio, ['route' => ['certificadoObligatorios.update', $certificadoObligatorio->id], 'method' => 'patch']) !!}

                              @include('zarpes.certificado_obligatorios.fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection
