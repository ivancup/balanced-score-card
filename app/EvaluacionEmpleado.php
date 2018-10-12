<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionEmpleado extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'evaluaciones_empleados';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id');
    }

    public function indicador()
    {
        return $this->belongsTo(Indicador::class, 'id_indicador', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
