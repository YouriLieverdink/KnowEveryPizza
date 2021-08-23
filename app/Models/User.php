<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
    ];

    /**
     * Relation to the Role model.
     * 
     * @return App\Models\Role
     */
    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    /**
     * Whether the user has a specific role.
     * 
     * @param string $roleName
     * @return boolean
     */
    public function hasRole(string $roleName)
    {
        foreach ($this->roles()->get() as $role) {
            // Check whether this user has the provided role.
            if ($role->title == $roleName) {

                return true;
            }
        }

        return false;
    }
}
