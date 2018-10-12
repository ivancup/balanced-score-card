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

    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area', 'id');
    }
}
