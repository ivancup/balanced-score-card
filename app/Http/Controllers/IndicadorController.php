<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Indicador;
use App\Http\Requests\IndicadorRequest;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alpina.indicadores.index');
    }

    public function data(Request $request)
    {
        if ($request->ajax() && $request->isMethod('GET')) {
            $indicadores = Indicador::all();
            return DataTables::of($indicadores)
                ->editColumn('tipo', function ($indicador) {
                    return $indicador->tipo == 0? 'Cuantitativo' : 'Cualitativo';
                })
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alpina.indicadores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndicadorRequest $request)
    {
        $indicador = new Indicador();
        $indicador->nombre = $request->get('nombre');
        $indicador->tipo =$request->get('tipo');
        $indicador->save();

        return response([
            'msg' => 'Indicador registrado correctamente.',
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
        $indicador = Indicador::findOrFail($id);
        return view('alpina.indicadores.edit', compact('indicador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndicadorRequest $request, $id)
    {
        $indicador = Indicador::findOrFail($id);
        $indicador->nombre = $request->get('nombre');
        $indicador->tipo = $request->get('tipo');
        $indicador->update();

        return response([
            'msg' => 'Indicador registrado correctamente.',
            'title' => '¡Registro exitoso!'
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
        $indicador = Indicador::findOrFail($id);
        $indicador->delete();

        return response([
            'msg' => 'El indicador se ha sido eliminado exitosamente.',
            'title' => 'Indicador Eliminado!'
        ], 200)// 200 Status Code: Standard response for successful HTTP request
            ->header('Content-Type', 'application/json');
    }
}
