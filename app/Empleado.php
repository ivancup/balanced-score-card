<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'empleados';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['fecha_nacimiento'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }

    public function getNombreEmpleadoAttribute()
    {
        return "{$this->nombre} {$this->apellido}";
    }
}
