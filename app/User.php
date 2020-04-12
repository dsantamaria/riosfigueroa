<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Tool;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active'
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

    public function tools(){
        return $this->belongsToMany(Tool::class, 'denied_tools_user');
    }

    public function pending_subscriber(){
        return $this->hasOne('App\Pending_subscriber');
    }

    public function user_logins()
    {
        return $this->hasMany('App\User_login');
    }

    public function hasAccess(array $permissions) {
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function hasToolAccess(array $permissions) {
        foreach ($this->tools as $tool) {
            if($tool->hasToolAccess($permissions)){
                return true;
            }
        }
        return false;
    }

    public function inRole($rolesSlug){
        return $this->roles()->where('slug', $rolesSlug)->count() == 1;
    }

    public static function createAdmin($data){
        $admin = self::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
            'active'    => 1
        ]);
        
        $defaultRole = Role::where('slug', 'admin')->pluck('id');
        $admin->roles()->attach($defaultRole[0]);

        return $admin;
    }
}
