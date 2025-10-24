<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderComment extends Model
{
    protected $table = 'Order_Comments';
    protected $primaryKey = 'ID_Comment';
    public $timestamps = false;

    protected $fillable = [
        'ID_Order',
        'ID_User',
        'Comment_Text',
        'Created_at'
    ];

    protected $dates = ['Created_at'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'ID_Order', 'ID_Order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User', 'ID_User');
    }
}
