<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use Gate;

class PermissionController extends Controller
{
    private $post;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        if(Gate::denies('adm'))
            return abort (403,'Não Autorizado!');
    }


    /*
     * Exemplo:
     * //bloqueia o acesso mesmo se digitar o link
        if(Gate::denies('view_post'))
            // retorna para a ultima url de acesso
            return redirect()->back();
            //mostra o erro
            //abort(403,'Você não tem permissão para listar post.');
    Exemplo 2:
    Para criar checagem para item unico
    private function checkPermission()
    {
        if(Gate::denies('adm'))
            return abort(403,'nao autorizado');


    colocar o $this->checkPermission();  nas funçõe a serem bloqueadas
    }
     */
    public function index()
    {
        $permissions = $this->permission->all();

        return view('painel.permissions.index',compact('permissions'));
    }

    public function roles($id)
    {
        //recupera permission
        $permission = $this->permission->find($id);
        //recupera permissions
        $roles = $permission->roles()->get();
        return view('painel.permissions.roles',compact('permission', 'roles'));

    }
}
