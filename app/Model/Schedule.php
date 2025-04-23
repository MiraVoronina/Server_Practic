<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'расписание';
    protected $primaryKey = 'ID_расписания';
    public $timestamps = false;

    protected $fillable = [
        'ID_дисциплины',
        'ID_группы',
        'ID_сотрудника',
        'Дата',
        'Время'
    ];
}
