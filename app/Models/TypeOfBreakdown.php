<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeOfBreakdown extends Model
{
    protected $table = 'type_of_breakdown';
    protected $primaryKey = 'ID_Type_Of_Breakdown';
    public $timestamps = false;

    protected $fillable = ['Name_of_Breakdown'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_Type_Of_Breakdown', 'ID_Type_Of_Breakdown');
    }
}
