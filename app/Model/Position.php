<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public $timestamps = false;

    protected $table = 'positions';

    protected $fillable = [
        'name'
    ];
}
