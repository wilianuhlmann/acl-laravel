<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Post;
use Gate;

class User extends Authenticatable
{
    use Notifiable;

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

    public function roles()
    {
        //retorno todos os papeis que o usuario desempenhano sistema.
        return $this->belongsToMany(\App\Role::class);
    }

    public function hasPermission (Permission $permission)
    {
        //quais são os papeis que podem execultar essas tarefas?
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        //o usuario tem esse papel para execultar?
        if(is_array($roles) || is_object($roles) ) {
            return !! $roles->intersect($this->roles)->count();
        }
        //manager exemplo de nome
        return $this->roles->contains('name', $roles);

    }
}
