<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        $users = $this->user->all();

        return view('painel.users.index',compact('users'));
    }
    public function roles($id)
    {
        //recupera usuario
        $user = $this->user->find($id);
        //recupera roles
        $roles = $user->roles()->get();
        return view('painel.users.roles',compact('user', 'roles'));

    }
}
