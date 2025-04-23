<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'студент';
    protected $primaryKey = 'ID_студента';
    public $timestamps = false;

    protected $fillable = [
        'ФИО', 'Пол', 'Дата_рождения', 'ID_группы'
    ];
}
