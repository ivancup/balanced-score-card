{{-- Titulo de la pagina --}} 
@section('title', 'Graficas') {{-- Contenido principal --}} 
@extends('admin.layouts.app') 
@section('content')
    @component('admin.components.panel') 
        @slot('title', 'Reporte Empleado.')


        <div class="row">
        <form action="{{ route('admin.reporte.empleados.formulario') }}" method="post" id="form_selecionar_area">
            @csrf
                <div class=" col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('area', 'Area', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!} {!! Form::select('area', isset($areas)?$areas:[],
                    old('area'), ['class' => 'select2 form-control', 'placeholder' => 'Seleccione una area', 'required' => '', 'id'
                    => 'area']) !!}
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('empleado', 'Empleado', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!} {!! Form::select('empleado',
                    isset($empleado)?$empleado:[], old('empleado'), ['class' => 'select2 form-control', 'placeholder'
                    => 'Seleccione un empleado', 'required' => '', 'id' => 'empleado']) !!}
                </div>
            </form>
        </div>
        <br>
        <br>


        <div id="graficas" class="hidden">
        
            <div class="row">
                    <canvas id="cualitativos" height="180"></canvas>
            </div>
            <br>
            <br>
            <div class="row">
                <canvas id="cuantitativos" height="180"></canvas>
            </div>
        </div>
    @endcomponent
@endsection


{{-- Scripts necesarios para el formulario --}}
@push('scripts')
    <!-- Char js -->
    <script src="{{ asset('gentella/vendors/Chart.js/Chart.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('gentella/vendors/select2/dist/js/select2.full.min.js') }}"></script>
@endpush

{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">

    
@endpush

{{-- Funciones necesarias por el formulario --}} @push('functions')
<script type="text/javascript">
    $(document).ready(function () {
        var form = $('#form_selecionar_area');
        $('#area').select2({
            language: "es"
        });
        $('#empleado').select2({language: "es"});
        selectDinamico("#area", "#empleado", "{{url('admin/reportes/empleados')}}");

        $("#empleado").change(function (e) {
                if (this.value != '') {
                    $.ajax({
                        url: form.attr('action'),
                        type: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (r) {
                            console.log(r.label_cualitativo);
                            console.log(r.cualitativo);
                            $('#graficas').removeClass('hidden');
                            if(chartCualitativo != null && chartCuantitativo != null){
                                chartCualitativo.destroy();
                                chartCuantitativo.destroy();
                            }
                            var chartCualitativo = crearGrafica(
                                'cualitativos',
                                'horizontalBar', 
                                'Evaluacion Cualitativa',
                                r.label_cualitativo,
                                ['resultados cualitativos'],
                                r.cualitativos 
                            );

                            var chartCuantitativo = crearGrafica(
                                'cuantitativos',
                                'horizontalBar', 
                                'Evaluacion Cuantitativa',
                                r.label_cuantitativo,
                                ['resultados cuantitativos'],
                                r.cuantitativos
                            );
                        }
                            
                });
                }
        });
    });

    

    
</script>

@endpush