<?php

namespace App;

use Illuminate\Support\Arr;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN_GLOBAL = 1;
    const ROLE_USER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    //<Work with const
    public static function getRolesList()
    {
        return [
            self::ROLE_ADMIN_GLOBAL => 'Global Admin',
            self::ROLE_USER => 'User',
        ];
    }

    public function getStatusName()
    {
        return Arr::get(self::getRolesList(), $this->role, 'Undefined');
    }

    public static function getRolesListForAdmin()
    {
        return [
            self::ROLE_ADMIN_GLOBAL => 'Global Admin',
        ];
    }
}
