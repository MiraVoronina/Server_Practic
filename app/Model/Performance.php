<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'успеваемость';
    protected $primaryKey = 'ID_успеваемости';
    public $timestamps = false;

    protected $fillable = [
        'ID_студента',
        'ID_дисциплины',
        'Оценка'
    ];
}
