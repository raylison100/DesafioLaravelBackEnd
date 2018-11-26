<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leed extends Model
{
    protected $fillable = [
        'name', 'specialty', 'cellPhone','description','photograph'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}

