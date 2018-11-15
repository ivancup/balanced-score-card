{{-- Titulo de la pagina --}} 
@section('title', 'Evaluar Empleado') {{-- Contenido principal --}} 
@extends('admin.layouts.app')

@section('content') @component('admin.components.panel') 
@slot('title', 'Evaluar Empleado')

    <form method="POST" action="{{ route('admin.evaluacion.areas.empleados.evaluar', 
    [
        'id_area' => request()->route()->parameter('id_area'),
        'id_empleado' => request()->route()->parameter('id_empleado')
        ]) }}" accept-charset="UTF-8" id="form_evaluar_empleado" class="form-horizontal form-label-left"
        novalidate>
        @csrf
        @include('alpina.evaluacion.wizard')
    </form>
@endcomponent
@endsection


 {{-- Scripts necesarios para el formulario --}} 
 @push('scripts')
<!-- Datatables -->
<script src="{{asset('gentella/vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{asset('gentella/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
<!-- PNotify -->
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>
<script src="{{ asset('gentella/vendors/SmartWizard/dist/js/jquery.smartWizard.min.js') }}"></script>
@endpush {{-- Estilos necesarios para el formulario --}} 
@push('styles')
<!-- Datatables -->
<link href="{{ asset('gentella/vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<!-- PNotify -->
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet"> 
<link href="{{ asset('gentella/vendors/SmartWizard/dist/css/smart_wizard.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('gentella/vendors/SmartWizard/dist/css/smart_wizard_theme_dots.css') }}" rel="stylesheet" type="text/css"
/>
@endpush 
{{-- Funciones necesarias por el formulario --}} @push('functions')
<script type="text/javascript">
    $(document).ready(function () {
        $(window).keydown(function (event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
        });

        $('#smartwizard').smartWizard({
                selected: 0,
                showStepURLhash: false,
                lang: {
                    next: 'Siguiente',
                    previous: 'Anterior',
                },
                toolbarSettings: {
                    showNextButton: true,
                    showPreviousButton: false,
                }, 
            });
            var contador = 0;
            $('.sw-btn-next').bind('click', function () {
                if(contador >= {{count($indicadores)}}){
                    $('.sw-btn-next').prop("disabled", false);}
                else{
                    $('.sw-btn-next').prop("disabled", true);
                    $('#finalizar').prop("disabled", true);}
                contador++;
                window.scrollTo(0, 350);
            });
            $('input').on('keyup', function() {
                $('.sw-btn-next').prop("disabled", false);
                $('#finalizar').prop("disabled", false);
            });
            $(".radios").change(function () {
                $('.sw-btn-next').prop("disabled", false);
                $('#finalizar').prop("disabled", false);
            });
            $(document).ajaxStart(function () {
                $('#finalizar').prop("disabled", true);
                }).ajaxStop(function () {
                $('#finalizar').prop("disabled", false);
            });

            form.submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response, NULL, jqXHR) {
                        new PNotify({
                            title: response.title,
                            text: response.msg,
                            type: 'success',
                            styling: 'bootstrap3'
                        });
                        window.location.href = " {{ url()->previous() }} ";
                    },
                    error: function (data) {
                        var errores = data.responseJSON.errors;
                        var msg = '';
                        $.each(errores, function (name, val) {
                            msg += val + '<br>';
                        });
                        new PNotify({
                            title: "Error!",
                            text: msg,
                            type: 'error',
                            styling: 'bootstrap3'
                        });
                        window.location.href = " {{ url()->previous() }} ";
                    }
                });
            });
    });
    window.location.hash = '';

</script>




@endpush