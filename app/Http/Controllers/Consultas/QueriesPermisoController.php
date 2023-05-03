<?php

namespace App\Http\Controllers\Consultas;
use App\Http\Controllers\Controller;
use App\Models\Publico\Capitania;
use App\Models\Publico\Paises;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\PermisoEstadia;
use App\Models\Zarpes\Status;
use Flash;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Zarpes\PermisoZarpe;



class QueriesPermisoController extends Controller
{

    public function __construct()
    {

        /* $this->middleware('permission:listar-permiso', ['only'=>['index'] ]);
         $this->middleware('permission:crear-permiso', ['only'=>['create','store']]);
         $this->middleware('permission:editar-permiso', ['only'=>['edit','update']]);
         $this->middleware('permission:consultar-permiso', ['only'=>['show'] ]);
         $this->middleware('permission:eliminar-permiso', ['only'=>['destroy'] ]);*/

    }
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $queries=false;
        $capitanias = Capitania::pluck('nombre', 'id');
        $estable = EstablecimientoNautico::pluck('nombre', 'id');
        $estatus= Status::pluck('nombre','id');
        $paises= Paises::pluck('name','id');

        return view('consultas.permisos')
            ->with('capitania', $capitanias)
            ->with('establecimientos', $estable)
            ->with('queries',$queries)
            ->with('estatus',$estatus)
            ->with('paises',$paises);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|Factory|View
     */
    public function querie(Request $request)
    {
        /*CONSULTA PARA LLENAR LOS SELECTS*/
        $capitanias = Capitania::pluck('nombre', 'id');
        $estable = EstablecimientoNautico::pluck('nombre', 'id');
        $estatus= Status::pluck('nombre','id');
        $paises= Paises::pluck('name','id');

        /*REQUEST PARA QUERIE*/
        $permiso=$request->input('permiso');
        $capitania_origen = $request->input('capitania_id_origen');
        $capitania_destino = $request->input('capitania_id_destino');
        $establecimiento_origen = $request->input('establecimiento_nautico_id_origen');
        $establecimiento_destino = $request->input('establecimiento_nautico_id_destino');
        $filtro_fecha = $request->input('filtro_fecha');
        $fecha_unica = $request->input('fecha_unica');
        $rango_fecha = $request->input('rango_fecha');
        $nro_solicitud=$request->input('nro_solicitud');
        $solicitante_id=$request->input('solicitante_id');
        $bandera=$request->input('bandera');
        $pais=$request->input('paises_id');
        $matricula=$request->input('matricula');
        $status_id=$request->input('estatus');
        $Nacional=false;
        $Internacional=false;
        if ($request->permiso === 'Zarpe Nacional'){
            $Nacional=true;
        }if ($request->permiso === 'Zarpe Internacional') {
        $Internacional=true;
    }

//dd($request);
        if ($request->permiso === 'Estadia') {
            $queryPermiso = PermisoEstadia::when($permiso,function (Builder $q){
                $q->orderBy('created_at', 'asc');
            })
                ->when($nro_solicitud, static function (Builder $query, string $nro_solicitud) {
                    $query->where('nro_solicitud', $nro_solicitud );
                })
                ->when($solicitante_id, function (Builder $q, string $solicitante_id) {
                    $q->where('user_id',$solicitante_id );
                })
                ->when($matricula, function (Builder $q, string $matricula) {
                    $q->where('nro_registro',$matricula );
                })
                ->when($status_id, function (Builder $q, string $status_id) {
                    $q->where('status_id',$status_id );
                })
                ->when($capitania_destino, static function (Builder $query, string $capitania_destino) {
                    $query->where('capitania_id', $capitania_destino );
                })
                ->when($establecimiento_destino, function (Builder $q, string $establecimiento_destino) {
                    $q->where('establecimiento_nautico_id',$establecimiento_destino );
                })
                ->when($fecha_unica, function ($q) use ($request)  {
                    $q->whereDate($request->filtro_fecha,$request->input('fecha_unica') );
                })
                ->when($rango_fecha, function ($q) use ($request)  {
                    $q->whereBetween($request->filtro_fecha,[$request->fecha_inicial ,$request->fecha_final]);

                })
                ->get();
        }else{
            $queryPermiso = PermisoZarpe::when($Nacional,function (Builder $q){
                $q->where('descripcion_navegacion_id', '<>', 4);
            })
                ->when($Internacional,function (Builder $q){
                    $q->where('descripcion_navegacion_id', '=', 4);
                })
                ->when($nro_solicitud, function (Builder $q, string $nro_solicitud) {
                    $q->where('nro_solicitud',$nro_solicitud );
                })
                ->when($solicitante_id, function (Builder $q, string $solicitante_id) {
                    $q->where('user_id',$solicitante_id );
                })
                ->when($bandera, function (Builder $q, string $bandera) {
                    $q->where('bandera',$bandera );
                })
                ->when($matricula, function (Builder $q, string $matricula) {
                    $q->where('matricula',$matricula );
                })
                ->when($status_id, function (Builder $q, string $status_id) {
                    $q->where('status_id',$status_id );
                })
                ->when($capitania_origen, static function (Builder $query, string $capitania_origen) {
                    $query->whereIn('establecimiento_nautico_id', EstablecimientoNautico::select('id')->where('capitania_id', $capitania_origen)->get());
                })
                ->when($establecimiento_origen, function (Builder $q, string $establecimiento_origen) {
                    $q->where('establecimiento_nautico_id',$establecimiento_origen );
                })
                ->when($capitania_destino, static function (Builder $query, string $capitania_destino) {
                    $query->where('destino_capitania_id', $capitania_destino);
                })
                ->when($establecimiento_destino, function (Builder $q, string $establecimiento_destino) {
                    $q->where('establecimiento_nautico_destino_id',$establecimiento_destino );
                })
                ->when($pais, function (Builder $q, string $pais) {
                    $q->where('paises_id',$pais );
                })
                ->when($rango_fecha, function ($q) use ($request)  {
                    $q->whereBetween($request->filtro_fecha, [$request->fecha_inicial, $request->fecha_final]);
                })
                ->when($fecha_unica, function ($q) use ($request)  {
                    $q->whereDate($request->filtro_fecha,$request->input('fecha_unica') );
                })
                ->get();

        }


        $busqueda=[];
        ($permiso) ? $busqueda[]=$permiso :null  ;
        ($nro_solicitud) ? $busqueda[]='| Nro de solicitud: '.$nro_solicitud : null  ;
        ($solicitante_id) ? $busqueda[]='| Solicitante: '.$request->solicitante : null  ;
        ($bandera) ? $busqueda[]='| Bandera: '.$bandera : null  ;
        ($matricula) ? $busqueda[]='| Matrícula o Nro Registro: '.$matricula : null  ;
        ($status_id) ? $busqueda[]='| Estatus: '.$request->estatus_name : null  ;
        ($capitania_origen) ? $busqueda[]='| Capitania Origen: '.$request->capitania_name_origen : null  ;
        ($establecimiento_origen) ? $busqueda[]='| Establecimiento Origen: '.$request->establecimiento_name_origen : null  ;
        ($capitania_destino) ? $busqueda[]='| Capitania Destino: '.$request->capitania_name_destino : null  ;
        ($establecimiento_destino) ? $busqueda[]='| Establecimiento Destino: '.$request->establecimiento_name_destino : null  ;
        ($pais) ? $busqueda[]='| País Destino: '.$request->paises_name : null  ;
        ($filtro_fecha) ? $busqueda[]='|: '.$request->filtro_name : null  ;
        ($fecha_unica) ? $busqueda[]=$fecha_unica : null  ;
        ($rango_fecha) ? $busqueda[]='Rango: del '.$request->fecha_inicial. ' al '.$request->fecha_final : null  ;
        //  dd($busqueda);
        return view('consultas.permisos')
            ->with('capitania', $capitanias)
            ->with('establecimientos', $estable)
            ->with('queries',$permiso)
            ->with('permisos',$queryPermiso)
            ->with('busqueda',$busqueda)
            ->with('estatus',$estatus)
            ->with('paises',$paises);

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     */
    public function show(Request $request)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit()
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request,$id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {

    }

}
