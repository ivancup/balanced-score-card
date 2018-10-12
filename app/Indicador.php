<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
    /**
     * Tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'indicadores';

    /**
     * Atributos del modelo que no pueden ser asignados en masa.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Relacion de muchos a muchos de la tabla indicadores
     */
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'areas_indicadores', 'id_indicador', 'id_area');
    }
}
