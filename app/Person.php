<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * Campos que se pueden diligenciar, esto para evitar errores massException
     * @var array
     */
    protected $fillable = array(
        'documentType',
        'document',
        'firstName',
        'lastName',
        'company',
        'emailAddress',
        'address',
        'city',
        'province',
        'country',
        'phone',
        'mobile',
    );
}
