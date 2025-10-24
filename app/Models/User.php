<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'ID_User';
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['ID_User_Role', 'Login', 'Password'];
    protected $hidden = ['Password'];

    public function getAuthPassword()
    {
        return $this->Password;
    }

    public function getAuthIdentifierName()
    {
        return 'ID_User';
    }

    public function getAuthIdentifier()
    {
        return $this->ID_User;
    }

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class, 'ID_User', 'ID_User');
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'ID_User_Role', 'ID_User_Role');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'ID_User', 'ID_User');
    }
}
