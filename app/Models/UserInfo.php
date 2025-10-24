<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'User_Info';
    protected $primaryKey = 'ID_User';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'ID_User', 'Name', 'Surname', 'Phone_Number', 'Photo', 'Email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User', 'ID_User');
    }
}
