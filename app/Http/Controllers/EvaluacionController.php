<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicador;
use App\Empleado;
use App\Area;
use App\EvaluacionEmpleado;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Carbon\Carbon;

class EvaluacionController extends Controller
{
    public function areas()
    {
        return view('alpina.evaluacion.areas');
    }

    public function areasData()
    {
        if(Auth::user()->hasRole('GERENTE')){
            $areas = Area::all();
            return Datatables::of($areas)
                ->make(true);
        }
        if (Auth::user()->hasRole('SUPERVISOR')) {
            $areas = Area::where('id', '=', Auth::user()->id_area);
            return Datatables::of($areas)
                ->make(true);
        }
    }

    public function empleados($id_area)
    {
        return view('alpina.evaluacion.empleados');
    }
    public function empleadosData(Request $request, $id_area)
    {
        $empleados = Empleado::with('area')
        ->where('id_area', '=', $id_area)
        ->get();
        return DataTables::of($empleados)
            ->removeColumn('created_at')
            ->removeColumn('updated_at')
            ->editColumn('fecha_nacimiento', function ($empleado) {
                return $empleado->fecha_nacimiento ? with(new Carbon($empleado->fecha_nacimiento))->format('d/m/Y') : '';
            })
            ->addColumn('area', function ($empleado) {
                return $empleado->area->nombre;
            })
            ->addColumn('evaluado', function ($empleado) {
                $evaluacion = EvaluacionEmpleado::where('id_empleado', '=', $empleado->id)->get();
                return isset($evaluacion[0]->id_empleado) ? '✔' : 'X';
            })

            ->make(true);
    }

    public function formularioEvaluarEmpleado($id_area, $id_empleado)
    {
        $indicadores = Indicador::all();
        $empleado = Empleado::findOrFail($id_empleado);
        return view('alpina.evaluacion.evaluacion_empleado', compact('indicadores', 'empleado'));
    }

    public function evaluarEmpleado(Request $request, $id_area, $id_empleado)
    {
        $respuestas = $request->except(['_token']);

        foreach ($respuestas as $key => $value) {
            $evaluacionEmpleado = EvaluacionEmpleado::updateOrCreate([
                'id_empleado' => $id_empleado, 
                'id_indicador' => $key,
            ],
            [
                'id_user' => Auth::user()->id,
                'valor' => $value
            ]);
        }

        return redirect()->route('admin.evaluacion.areas.empleados',['id_area' => $id_area])->with('msg', 'Evaluacion realizada exitosamente');
    }
}
