<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $array, array[] $array1)
 */
class Translate extends Model
{
    protected $table = 'translate';

    protected $fillable = [
        'model',
        'column',
        'key',
        'locale',
        'value',
    ];

    public $timestamps = false;
}
