<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'Brands';
    protected $primaryKey = 'ID_Brand';
    public $timestamps = false;

    protected $fillable = ['Brand_Name'];

    public function equipment()
    {
        return $this->hasMany(Equipment::class, 'ID_Brand', 'ID_Brand');
    }
}
