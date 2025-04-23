<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    protected $table = 'дисциплина';
    protected $primaryKey = 'ID_дисциплины';
    public $timestamps = false;

    protected $fillable = ['Название'];
}
