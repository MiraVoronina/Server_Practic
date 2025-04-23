<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'посещаемость';
    protected $primaryKey = 'ID_посещаемости';
    public $timestamps = false;

    protected $fillable = [
        'ID_студента',
        'ID_расписания',
        'Статус'
    ];
}
