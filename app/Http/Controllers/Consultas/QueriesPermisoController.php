<?php

namespace App\Http\Controllers\Consultas;
use App\Http\Controllers\Controller;
use App\Models\Publico\Capitania;
use App\Models\Zarpes\EstablecimientoNautico;
use App\Models\Zarpes\PermisoEstadia;
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
        return view('consultas.permisos')
            ->with('capitania', $capitanias)
            ->with('establecimientos', $estable)
            ->with('queries',$queries);
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
        $permiso=$request->input('permiso');
        $capitania = $request->input('capitania_id');
        $establecimiento = $request->input('establecimiento_nautico_id');
        $filtro_fecha = $request->input('filtro_fecha');
        $fecha_unica = $request->input('fecha_unica');
        $rango_fecha = $request->input('rango_fecha');
        $capitanias = Capitania::pluck('nombre', 'id');
        $estable = EstablecimientoNautico::pluck('nombre', 'id');

        if ($request->permiso === 'Zarpe Nacional') {
        $queryPermiso = PermisoZarpe::when($permiso,function (Builder $q){
            $q->where('descripcion_navegacion_id', '<>', 4);
        })
            ->when($capitania, static function (Builder $query, string $capitania) {
                $query->whereIn('establecimiento_nautico_id', EstablecimientoNautico::select('id')->where('capitania_id', $capitania)->get());
            })
            ->when($establecimiento, function (Builder $q, string $establecimiento) {
                $q->where('establecimiento_nautico_id',$establecimiento );
            })
            ->when($rango_fecha, function ($q) use ($request)  {
                $q->whereBetween($request->filtro_fecha, [$request->fecha_inicial, $request->fecha_final]);
            })
            ->when($fecha_unica, function ($q) use ($request)  {
                $q->whereDate($request->filtro_fecha,$request->input('fecha_unica') );
            })
            ->get();

        } if ($request->permiso === 'Zarpe Internacional') {
        $queryPermiso = PermisoZarpe::when($permiso,function (Builder $q){
            $q->where('descripcion_navegacion_id', '=', 4);
        })
            ->when($capitania, static function (Builder $query, string $capitania) {
                $query->whereIn('establecimiento_nautico_id', EstablecimientoNautico::select('id')->where('capitania_id', $capitania)->get());
            })
            ->when($establecimiento, function (Builder $q, string $establecimiento) {
                $q->where('establecimiento_nautico_id',$establecimiento );
            })
            ->when($fecha_unica, function ($q) use ($request)  {
                $q->whereDate($request->filtro_fecha,$request->input('fecha_unica') );
            })
            ->when($rango_fecha, function ($q) use ($request)  {
                $q->whereBetween($request->filtro_fecha,[$request->fecha_inicial ,$request->fecha_final]);
            })

            ->get();

        }if ($request->permiso === 'Estadia') {
        $queryPermiso = PermisoEstadia::when($permiso,function (Builder $q){
            $q->orderBy('created_at', 'asc');
        })
            ->when($capitania, static function (Builder $query, string $capitania) {
                $query->where('capitania_id', $capitania );
            })
            ->when($establecimiento, function (Builder $q, string $establecimiento) {
                $q->where('establecimiento_nautico_id',$establecimiento );
            })
            ->when($fecha_unica, function ($q) use ($request)  {
                $q->whereDate($request->filtro_fecha,$request->input('fecha_unica') );
            })
            ->when($rango_fecha, function ($q) use ($request)  {
                $q->whereBetween($request->filtro_fecha,[$request->fecha_inicial ,$request->fecha_final]);

            })

            ->get();
    }
        $busqueda=[];
        ($permiso) ? $busqueda[]=$permiso :null  ;
        ($capitania) ? $busqueda[]='por Capitania: '.$request->capitania_name : null  ;
        ($establecimiento) ? $busqueda[]='por Establecimiento: '.$request->establecimiento_name : null  ;
        ($filtro_fecha) ? $busqueda[]='por: '.$request->filtro_name : null  ;
        ($fecha_unica) ? $busqueda[]=$fecha_unica : null  ;
        ($rango_fecha) ? $busqueda[]='Rango: del '.$request->fecha_inicial. ' al '.$request->fecha_final : null  ;
     //  dd($busqueda);
        return view('consultas.permisos')
            ->with('capitania', $capitanias)
            ->with('establecimientos', $estable)
            ->with('queries',$permiso)
            ->with('permisos',$queryPermiso)
            ->with('busqueda',$busqueda);



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
