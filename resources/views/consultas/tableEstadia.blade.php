Busqueda:  @foreach($busqueda as $buscar) {{$buscar}}@endforeach
<br>
<br>
<table class="table table-striped table-bordered display2" style="width:100%">
    <thead>
    <tr>
        <th data-priority="1">Nro. Solicitud</th>
        <th>Fecha Solicitud</th>
        <th>Solicitante</th>
        <th>Nombre Buque</th>
        <th>Nro. Registro Buque</th>
        <th>Puerto Origen</th>
        <th>Puerto Destino</th>
        <th style="font-size: 12px; width: 5%">Días de Estadía aprobados en el País</th>
        <th data-priority="2">Estatus</th>
        <th style="width: max-content">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($permisos as $permisoEstadia)

        <tr>
            <td>{{ $permisoEstadia->nro_solicitud }}</td>
            <td>{{ $permisoEstadia->created_at }}</td>
            <td>{{ $permisoEstadia->user->nombres }} {{ $permisoEstadia->user->apellidos }}</td>
            <td>{{ $permisoEstadia->nombre_buque }}</td>
            <td>{{ $permisoEstadia->nro_registro }}</td>
            <td>{{ $permisoEstadia->puerto_origen }}</td>
            <td>{{ $permisoEstadia->capitania->nombre }}</td>
            @if (($permisoEstadia->status->id==1) or ($permisoEstadia->status->id==12))
                <td>{{$permisoEstadia->cantidad_solicitud*90}} días</td>
            @else
                <td></td>
            @endif

            @if ($permisoEstadia->status->id==1)
                <td class="text-success">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==2)
                <td class="text-danger">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==3)
                <td class="text-warning">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==6)
                <td style="color: #fd7e14">{{$permisoEstadia->status->nombre}}</td>
            @elseif($permisoEstadia->status->id==9)
                <td><span class="text-warning bg-dark">{{$permisoEstadia->status->nombre}}</span></td>
            @elseif($permisoEstadia->status->id==10)
                <td class="text-primary">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==11)
                <td style="color: #770bba">{{ $permisoEstadia->status->nombre}} </td>
            @elseif($permisoEstadia->status->id==12)
                <td class="text-muted">{{ $permisoEstadia->status->nombre}} </td>
            @else
                <td>{{ $permisoEstadia->status->nombre}} </td>
            @endif
            <td>
                @can('consultar-estadia')
                    <a class="btn btn-sm btn-success"
                       href="  {{ route('permisosestadia.show', $permisoEstadia['id']) }}">
                        <i class="fa fa-search"></i>
                    </a>
                @endcan


                @if ($permisoEstadia->status_id===1)
                    <a class="btn btn-sm btn-dark"
                       href="{{route('estadiapdf',$permisoEstadia->id)}}"
                       target="_blank" data-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Descargar PDF">
                        <i class="fas fa-file-pdf"></i>
                    </a>

                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
