Busqueda:  @foreach($busqueda as $vuscar) {{$vuscar}}@endforeach
<br>
<br>
<table class="table table-striped table-bordered compact display" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">Nro Solicitud</th>
        <th>Fecha de Solicitud</th>
        <th>Solicitante</th>
        <th>Bandera</th>
        <th>Matrícula</th>
        <th>Tipo Navegación</th>
        <th data-priority="2">Estatus</th>
        <th>Acciones</th>
    </tr>
    </thead>
    @foreach($permisos as $permiso)
        <tr>
            <td>{{ $permiso->nro_solicitud }}</td>
            <td>{{ $permiso->created_at }}</td>
            <td>{{ $permiso->user->nombres }} {{ $permiso->user->apellidos }}</td>
            <td>{{ $permiso->bandera }}</td>
            <td>{{ $permiso->matricula }}</td>
            <td>{{ $permiso->tipo_zarpe->nombre }}</td>
            @if ($permiso->status->id==1)
                <td class="text-success">{{ $permiso->status->nombre}} </td>
            @elseif($permiso->status->id==2)
                <td class="text-danger">{{ $permiso->status->nombre}} </td>
            @elseif($permiso->status->id==3)
                <td class="text-warning">{{ $permiso->status->nombre}} </td>
            @elseif($permiso->status->id==4)
                <td class="text-muted">{{ $permiso->status->nombre}} </td>
            @elseif($permiso->status->id==5)
                <td class="text-primary">{{ $permiso->status->nombre}} </td>
            @elseif($permiso->status->id==7)
                <td><span class="text-danger bg-dark">{{$permiso->status->nombre}}</span></td>
            @elseif($permiso->status->id==6)
                <td style="color: #fd7e14">{{$permiso->status->nombre}}</td>
            @elseif($permiso->status->id==14)
                <td style="color: green">{{$permiso->status->nombre}}</td>
            @else
                <td>{{ $permiso->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-zarpe')
                    @if ($permiso->descripcion_navegacion_id!==4)
                        <a class="btn btn-sm btn-primary"
                           href=" {{route('permisoszarpes.show',$permiso->id)}}">
                            <i class="fa fa-search"></i>
                        </a>
                    @else
                        <a class="btn btn-sm btn-primary"
                           href=" {{route('zarpeInternacional.show',$permiso->id)}}">
                            <i class="fa fa-search"></i>
                        </a>
                    @endif
                @endcan

                @if (($permiso->status->id==1)||($permiso->status->id==4)||($permiso->status->id==5))
                    <a class="btn btn-sm btn-dark"
                       href="{{route('zarpepdf',$permiso->id)}}" target="_blank" data-toggle="tooltip"
                       data-bs-placement="bottom" title="Descargar PDF">
                        <i class="fas fa-file-pdf"></i>
                    </a>
                @endif

            </td>
        </tr>
        @endforeach
        </tbody>
</table>
