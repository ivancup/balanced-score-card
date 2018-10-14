<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Empleado;
use App\Area;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\EmpleadoRequest;

class EmpleadosController extends Controller
{

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $empleados = Empleado::with('area')->get();
            return DataTables::of($empleados)
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->editColumn('fecha_nacimiento', function ($empleado) {
                    return $empleado->fecha_nacimiento ? with(new Carbon($empleado->fecha_nacimiento))->format('d/m/Y') : '';
                })
                ->addColumn('area', function ($empleado) {
                    return $empleado->area->nombre;
                })
                
                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alpina.empleados.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::pluck('nombre', 'id');
        return view('alpina.empleados.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->get('fecha_nacimiento'));

        $empleado = new Empleado();
        $empleado->nombre = $request->get('nombre');
        $empleado->apellido = $request->get('apellido');
        $empleado->fecha_nacimiento = $fecha_nacimiento;
        $empleado->telefono = $request->get('telefono');
        $empleado->email = $request->get('email');
        $empleado->id_area = $request->get('area');
        $empleado->save();

        return response([
            'msg' => 'Empleado registrado correctamente.',
            'title' => '¡Registro exitoso!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areas = Area::pluck('nombre', 'id');
        $empleado = Empleado::findOrFail($id);
        return view(
            'alpina.empleados.edit',
            compact('areas', 'empleado')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoRequest $request, $id)
    {
        $fecha_nacimiento = Carbon::createFromFormat('d/m/Y', $request->get('fecha_nacimiento'));
        $empleado = Empleado::findOrFail($id);
        $empleado->nombre = $request->get('nombre');
        $empleado->apellido = $request->get('apellido');
        $empleado->fecha_nacimiento = $fecha_nacimiento;
        $empleado->telefono = $request->get('telefono');
        $empleado->email = $request->get('email');
        $empleado->id_area = $request->get('area');
        $empleado->update();

        return response([
            'msg' => 'El usuario ha sido modificado exitosamente.',
            'title' => '¡Usuario Modificado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Empleado::destroy($id);

        return response([
            'msg' => 'El empleado se ha sido eliminado exitosamente.',
            'title' => '¡Empleado Eliminado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }
}
