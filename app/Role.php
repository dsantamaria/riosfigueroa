<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    #protected $casts = [
    #   'permissions' => 'array',
    #];

    public function users(){
        return $this->belongsToMany(User::class, 'role_users');
    }

    public function hasAccess($permissions){
        foreach ($permissions as $permission) {
            if($this->hasPermissions($permission)){
                return true;
            }
        }
        return false;
    }

    public function hasPermissions($permission) {
        return $this->permissions == $permission;
    }
}
