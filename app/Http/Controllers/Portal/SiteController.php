<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Post;
use Gate;
use App\Role;
use App\Http\Controllers\Controller;


class SiteController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view ('portal.home.index');
    }

    /*
    public function update ($idPost)
    {
        $post = Post::find($idPost);

        //$this->authorize('update-post',$post);
        if( Gate::denies('update-post', $post))
                abort(403,'Não autorizado');

       return view ('post-update', compact('post'));
    }

    public function rolesPermissions()
    {
        //$nameUser = auth()->user()->name;
        //$auth = auth()->user();
        //var_dump("<h1>{$nameUser}</h1>");
        //var_dump("<h1>{$auth}</h1>");


        foreach ( auth()->user()->roles as $role){
            echo "$role->name -> ";

        $permissions = $role->permissions;
        foreach ($permissions as $permission) {
            echo " $permission->name , ";
        }
            echo "<hr";
        }
    }
    */


}
