<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $table = 'disciplines';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
