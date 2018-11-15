<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use Illuminate\Support\Facades\Auth;
use App\Empleado;
use App\EvaluacionEmpleado;

class ReportesController extends Controller
{
    public function reporteEmpleado()
    {
        
        if (Auth::user()->hasRole('GERENTE')) {
            $areas = Area::pluck('nombre', 'id');
            return view('alpina.reportes.reporte_empleado', compact('areas'));
        }
        if (Auth::user()->hasRole('SUPERVISOR')) {
            $areas = Area::where('id', '=', Auth::user()->id_area)->pluck('nombre', 'id');
            return view('alpina.reportes.reporte_empleado', compact('areas'));
        }
    }

    public function areaEmpleado($id_area)
    {
        $empleados = Empleado::where('id_area', '=', $id_area)->get()->pluck('nombre_empleado', 'id');
        return json_encode($empleados);
    }

    public function graficasEmpleado(Request $request)
    {
        $evaluacion = EvaluacionEmpleado::with('indicador')
            ->where('id_empleado', '=', $request->get('empleado'))
            ->get();

        $cuantitativos = [];
        $cualitativos = [];

        $label_cuantitativo = [];
        $label_cualitativo = [];

        foreach ($evaluacion as $key => $value) {
            if($value->indicador->tipo == 0){
                array_push($cuantitativos, $value->valor);
                array_push($label_cuantitativo, $value->indicador->nombre);
            }
            else{
                array_push($cualitativos, $value->valor);
                array_push($label_cualitativo, $value->indicador->nombre);
            }
        }

        $datos['cualitativos'] = array($cualitativos);
        $datos['cuantitativos'] = array($cuantitativos);

        $datos['label_cualitativo'] = $label_cualitativo;
        $datos['label_cuantitativo'] = $label_cuantitativo;

        return json_encode($datos);
    }

    public function reporteArea()
    {

        if (Auth::user()->hasRole('GERENTE')) {
            $areas = Area::pluck('nombre', 'id');
            return view('alpina.reportes.reporte_area', compact('areas'));
        }
        if (Auth::user()->hasRole('SUPERVISOR')) {
            $areas = Area::where('id', '=', Auth::user()->id_area)->pluck('nombre', 'id');
            return view('alpina.reportes.reporte_area', compact('areas'));
        }
    }

    public function graficasArea(Request $request)
    {
        $evaluacion = EvaluacionEmpleado::with('indicador')
        ->with(['empleado' => function ($query) use($request) {
                return $query->where('id_area', '=', $request->get('area'));
            }])
            ->get()
            ->groupBy('id_indicador');

        $cuantitativos = [];
        $cualitativos = [];

        $label_cuantitativo = [];
        $label_cualitativo = [];

        foreach ($evaluacion as $id_indicador => $indicador) {
            $bandera = false;
            $suma = 0;
            $tipo = 0;
            foreach ($indicador as $key => $value) {
                $suma += $value->valor; 
                if ($value->indicador->tipo == 0 && $bandera == false) {
                    $bandera = true;
                    array_push($label_cuantitativo, $value->indicador->nombre);
                }
                if ($value->indicador->tipo == 1 && $bandera == false) {
                    $tipo = 1;
                    $bandera = true;
                    array_push($label_cualitativo, $value->indicador->nombre);
                }
                if(!isset($value->empleado)){
                    $suma = 0;
                }
            }
            if($tipo == 0){
                array_push($cuantitativos, $suma/$indicador->count());
            }
            else{
                array_push($cualitativos, $suma / $indicador->count());
            }
            
        }

        $datos['cualitativos'] = array($cualitativos);
        $datos['cuantitativos'] = array($cuantitativos);

        $datos['label_cualitativo'] = $label_cualitativo;
        $datos['label_cuantitativo'] = $label_cuantitativo;

        return json_encode($datos);
    }
}
