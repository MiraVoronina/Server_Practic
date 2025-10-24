<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'Order_Status';
    protected $primaryKey = 'ID_Status';
    public $timestamps = false;

    protected $fillable = ['Order_Status_Name'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_Status', 'ID_Status');
    }
}
