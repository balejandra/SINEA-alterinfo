<?php

namespace App\Models\Gmar;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LicenciasTitulosGmar01
 * @package App\Models
 * @version February 20, 2022, 3:52 pm UTC
 *
 * @property string $ci
 * @property string $nombre
 * @property string $apellido
 * @property string $solicitud
 * @property string $documento
 * @property string $nro_ctrl
 * @property string $fecha_solicitud
 * @property string $fecha_emision
 * @property string $fecha_vencimiento
 */
class LicenciasTitulosGmar01 extends Model
{

    use HasFactory;

    protected $connection = 'pgsql_gente_de_mar';
    public $table = 'licencias_titulos_gmar01';


    public $fillable = [
        'solicitud',
        'documento',
        'tipo_emision',
        'nro_ctrl',
        'fecha_emision',
        'fecha_vencimiento',
        'ci',
        'nombre',
        'apellido',
        'estatus',
        'fecha_solicitud',
        'id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'solicitud' => 'string',
        'documento' => 'string',
        'tipo_emision' => 'string',
        'nro_ctrl' => 'string',
        'fecha_emision' => 'string',
        'fecha_vencimiento' => 'datetime',
        'ci' => 'string',
        'nombre' => 'string',
        'apellido' => 'string',
        'estatus' => 'string',
        'fecha_solicitud' => 'date',
        'id' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'solicitud' => 'required',
        'documento' => 'required',
        'tipo_emision' => 'required',
        'nro_ctrl' => 'required',
        'fecha_emision' => 'required',
        'fecha_vencimiento' => 'required',
        'ci' => 'required',
        'nombre' => 'required',
        'apellido' => 'required',
        'estatus' => 'required',
        'fecha_solicitud' => 'required',
        'id' => 'required'


    ];
}
