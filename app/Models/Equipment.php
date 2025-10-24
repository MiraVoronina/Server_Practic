<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $primaryKey = 'ID_Equipment';
    public $timestamps = true;

    const CREATED_AT = 'Created_at';
    const UPDATED_AT = 'Updated_at';

    protected $fillable = [
        'ID_Type_Of_Equipment',
        'ID_Brand',
        'Serial_Number',
        'Equipment_Name',
        'Description'
    ];

    public function typeOfEquipment()
    {
        return $this->belongsTo(TypeOfEquipment::class, 'ID_Type_Of_Equipment', 'ID_Equipment');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'ID_Brand', 'ID_Brand');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_Equipment', 'ID_Equipment');
    }
}
