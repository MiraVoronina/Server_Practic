<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfEquipment extends Model
{
    protected $table = 'Type_of_Equipment';
    protected $primaryKey = 'ID_Type_of_Equipment';
    public $timestamps = false;

    protected $fillable = ['Name_of_Type_of_Equipment'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'ID_Type_of_Equipment', 'ID_Type_of_Equipment');
    }

    public function orders()
    {
        return $this->hasManyThrough(
            Order::class,
            Equipment::class,
            'ID_Type_of_Equipment',
            'ID_Equipment',
            'ID_Type_of_Equipment',
            'ID_Equipment'
        );
    }
}
