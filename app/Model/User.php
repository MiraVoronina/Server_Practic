<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class User extends Model implements IdentityInterface
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'employees';

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'login',
        'password',
        'position_id',
        'role'
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            $user->password = md5($user->password);
        });
    }

    public function findIdentity(int $id)
    {
        return self::where('id', $id)->first();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function attemptIdentity(array $credentials)
    {
        return self::where([
            'login' => $credentials['login'],
            'password' => md5($credentials['password']),
        ])->first();
    }

    public function getRoleAttribute(): ?string
    {
        return $this->attributes['role'] ?? null;
    }
}
