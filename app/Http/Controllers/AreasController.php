<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use DataTables;
use App\Http\Requests\AreaRequest;

class AreasController extends Controller
{

    public function data(Request $request)
    {
        $areas = Area::all();
        return Datatables::of($areas)
            ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alpina.areas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        $area = new Area();
        $area->nombre = $request->get('nombre_area');
        $area->save();

        return response([
            'msg' => 'Area registrada correctamente.',
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $areas = Area::findOrFail($id);
        $areas->nombre = $request->get('nombre_area');
        $areas->update();


        return response([
            'msg' => 'El Area ha sido modificada exitosamente.',
            'title' => 'Area Modificada!'
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
        $area = Area::findOrFail($id);
        $area->delete();


        return response([
            'msg' => 'El Area ha sido eliminada exitosamente.',
            'title' => '¡Area Eliminada!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }

    public function asignar($id_area)
    {
        return view('alpina.areas.asignar_supervisor');
    }

    public function dataAsignar(Request $request, $id_area)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $usuarios = User::where('id_area', '=', $id_area)->get();
            return DataTables::of($usuarios)
                ->addColumn('seleccion', function ($usuario) use ($id) {
                    $checked = '';
                    foreach ($usuario->procesos as $proceso) {
                        if ($proceso->PK_PCS_Id == $id) {
                            $checked = 'checked';
                            break;
                        }
                    }
                    return '<input type="checkbox" class="ids_usuarios" name="seleccion" value="' . $usuario->id . '" ' . $checked . ' />';
                })
                ->rawColumns(['seleccion'])
                ->removeColumn('created_at')
                ->removeColumn('updated_at')
                ->make(true);
        }
    }

    public function asignarSupervisor(Request $request, $id_area)
    {
        
    }
}
