<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    /**
     * Datos a aplicar un cast especifico, esto para que funcione correctamente
     * la consulta ajax
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];
}
