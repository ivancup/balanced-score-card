<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'areas';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Relacion de muchos a muchos de la tabla indicadores
     */
    public function indicadores()
    {
        return $this->belongsToMany(Indicador::class, 'areas_indicadores', 'id_area', 'id_indicador');
    }
}
