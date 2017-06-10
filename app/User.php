<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function hasAccess(array $permissions) {
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function inRole($rolesSlug){
        return $this->roles()->where('slug', $rolesSlug)->count() == 1;
    }
}
