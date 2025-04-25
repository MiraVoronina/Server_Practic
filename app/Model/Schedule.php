<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedule';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'time',
        'discipline_id',
        'auditorium',
        'employee_id',
        'group_id'
    ];
}
