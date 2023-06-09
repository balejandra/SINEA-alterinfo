@extends('layouts.app')
@section("titulo")
    Menús
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{!! route('menus.index') !!}">{{$titulo}}</a>
                </li>
                <li class="breadcrumb-item">Crear</li>
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
                                <i class="fa fa-bars fa-lg"></i>
                                <strong>Crear {{$titulo}}</strong>

                                <div class="card-header-actions">

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-2 col-md-3"></div>
                                    <div class=" border col-lg-8 col-md-12 col-sm-12 col-xs-12 p-3">

                                        {!! Form::open(['route' => 'menus.store']) !!}

                                        @include('publico.menus.fields')

                                        {!! Form::close() !!}
                                    </div>
                                    <div class=" col-lg-2 col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
    </div>
@endsection
