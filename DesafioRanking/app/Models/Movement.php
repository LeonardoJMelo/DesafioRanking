<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    protected $table = 'movement';
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
