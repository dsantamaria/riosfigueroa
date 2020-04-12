<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];


    public function users(){
        return $this->belongsToMany(User::class, 'denied_tools_user');
    }

    public function hasToolAccess($permissions){
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
