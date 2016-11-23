<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Post;
use App\User;
use App\Permission;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
       /*
       \App\Post::class => \App\Policies\PostPolicy::class,
       */
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        /*$gate->define('update-post', function(User $user, Post $post){
           return $user->id == $post->user_id;
        });
        */


        //recuperar todas as permissoes e verificar se o usuario logado tem a permisssao
        $permissions = Permission::with('roles')->get();
        //listo elas aqui no foreach
        foreach($permissions as $permission)
        {
            $gate->define($permission->name, function(User $user) use ($permission) {
                return $user->hasPermission($permission);
            });
        }
        //passa antes de tudo pelo gate before.
        //se o usuario for adm não para pelo foreach anterior
        $gate->before(function (User $user, $ability){
            if ($user->hasAnyRoles('adm'))
                return true;
        });

    }
}
