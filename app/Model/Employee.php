<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Employee extends Model implements IdentityInterface
{
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
        return self::find($id);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function attemptIdentity(array $credentials)
    {
        $login = $credentials['email'] ?? $credentials['login'] ?? null;
        $password = $credentials['password'] ?? null;

        if (!$login || !$password) {
            return null;
        }

        $employee = self::where('login', $login)->first();

        if (!$employee) {
            return null;
        }

        if (password_verify($password, $employee->password)) {
            return $employee;
        }

        return null;
    }
}
