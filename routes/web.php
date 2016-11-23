<?php

//Route::get('/', 'Portal\SiteController@index');
Route::get('/', function () {
    return view('portal.home.index');
});



Auth::routes();

Route::group(['prefix' => 'painel'], function(){
    //postcontroller
    Route::get('posts', 'Painel\PostController@index');
    //permissioncontroller
    Route::get('permissions', 'Painel\PermissionController@index');
    Route::get('permission/{id}/roles', 'Painel\PermissionController@roles');

    //rolescontroller
    Route::get('roles', 'Painel\RoleController@index');
    Route::get('role/{id}/permissions', 'Painel\RoleController@permissions');
    //Userscontroller
    Route::get('users', 'Painel\UserController@index');
    Route::get('user/{id}/roles', 'Painel\UserController@roles');

    //painelController
    //homepage
    //precisa se autenticar
    Route::get('/', 'Painel\PainelController@index');
});

