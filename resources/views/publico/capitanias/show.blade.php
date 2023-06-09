@extends('layouts.app')
@section("titulo")
    Capitanías
@endsection
@section('content')
    <div class="header-divider"></div>
    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item">
                    <a href="{{ route('capitanias.index') }}">Capitanía</a>
                </li>
                <li class="breadcrumb-item ">Consulta</li>
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
                             <i class="fa fa-building"></i>
                                 <strong>Consultar Capitanía</strong>
                                 <div class="card-header-actions">
                                 </div>
                             </div>
                             <div class="card-body">
                                 <div class="my-2">
                                     <div class="container">
                                 @include('publico.capitanias.show_fields')
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
          </div>
    </div>
@endsection
