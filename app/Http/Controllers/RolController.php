<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolRequest;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RolController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alpina.roles.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * Esta funcion lista en el datatable los roles que se puedan ver depende si eres administrador
     */
    public function data(Request $request)
    {
        $roles = Role::all();
        return Datatables::of($roles)
            ->make(true);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Cuando se crea un rol tienen que aparecer los permisos existentes
     * para asignarlos, depende si eres administrador o no
     */
    public function create()
    {
        $permisos = Permission::pluck('name', 'name');
        return view('alpina.roles.create', compact('permisos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion crea los roles
     */
    public function store(RolRequest $request)
    {
        $rol = Role::create($request->except('permission'));
        // $permisos = $request->input('permission') ? $request->input('permission') : [];
        // $rol->givePermissionTo($permisos);


        return response([
            'msg' => 'Rol registrado correctamente.',
            'title' => '¡Registro exitoso!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Cuando se edita un rol tienen que aparecer los permisos existentes
     * para asignarlos, depende si eres administrador o no
     */
    public function edit($id)
    {

        $permisos = Permission::pluck('name', 'name');
        $rol = Role::findOrFail($id);
        $edit = true;
        return view(
            'alpina.roles.edit',
            compact('rol', 'permisos', 'edit')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Est funcion actualiza el rol
     */
    public function update(RolRequest $request, $id)
    {

        $rol = Role::findOrFail($id);
        $rol->update($request->except('permission'));
        // $permisos = $request->input('permission') ? $request->input('permission') : [];
        // $rol->syncPermissions($permisos);


        return response([
            'msg' => 'El Rol ha sido modificado exitosamente.',
            'title' => 'Rol Modificado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Esta funcion elimina el rol
     */
    public function destroy($id)
    {
        $rol = Role::findOrFail($id);
        $rol->delete();

        return response([
            'msg' => 'El Rol ha sido eliminado exitosamente.',
            'title' => '¡Rol Eliminado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }
}
