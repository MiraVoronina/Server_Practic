<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UseRole extends Model
{
    protected $table = 'User_Role';
    protected $primaryKey = 'ID_User_Role';
    public $timestamps = false;

    protected $fillable = ['Role_Name'];

    public function users() {
        return $this->hasMany(User::class, 'ID_User_Role', 'ID_User_Role');
    }
}
