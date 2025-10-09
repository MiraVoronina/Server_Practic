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
        'phone',
        'login',
        'password',
        'position_id',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

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
        // Получаем логин и пароль
        $login = $credentials['email'] ?? $credentials['login'] ?? null;
        $password = $credentials['password'] ?? null;

        if (!$login || !$password) {
            return null;
        }

        // Ищем пользователя по логину
        $user = self::where('login', $login)->first();

        if (!$user) {
            return null;
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }
}
