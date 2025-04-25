<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table = 'performance';
    public $timestamps = false;

    protected $fillable = [
        'schedule_id',
        'student_id',
        'type',
        'grade',
        'hours'
    ];
}
