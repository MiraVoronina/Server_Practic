<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'ID_Order';
    public $timestamps = true;

    const CREATED_AT = 'Created_at';
    const UPDATED_AT = 'Updated_at';

    protected $fillable = [
        'ID_User',
        'ID_Equipment',
        'ID_Type_Of_Breakdown',
        'ID_Status',
        'Description',
        'Equipment_Photo',
        'Tracking_Number',
        'Order_Number',
        'Guest_Name',
        'Guest_Phone',
        'Guest_Email',
    ];

    protected $casts = [
        'Created_at' => 'datetime',
        'Updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User', 'ID_User');
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'ID_Equipment', 'ID_Equipment');
    }

    public function breakdown()
    {
        return $this->belongsTo(TypeOfBreakdown::class, 'ID_Type_Of_Breakdown', 'ID_Type_Of_Breakdown');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'ID_Status', 'ID_Status');
    }

    public function repairings()
    {
        return $this->hasMany(Repairing::class, 'ID_Order', 'ID_Order');
    }

    public function comments()
    {
        return $this->hasMany(OrderComment::class, 'ID_Order', 'ID_Order')->orderBy('Created_at', 'desc');
    }
}
