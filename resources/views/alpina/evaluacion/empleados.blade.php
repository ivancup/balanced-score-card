{{-- Titulo de la pagina --}} 
@section('title', 'Evaluar Empleados') {{-- Contenido principal --}} 
@extends('admin.layouts.app')

@section('content') @component('admin.components.panel') 
@slot('title', 'Evaluar Empleados')
<div class="col-md-12">
    <div class="actions">
        <a href="{{ route('admin.evaluacion.areas') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-alt-circle-left"></i> Volver</a></div>
</div>
<br>
<br>
<br>
<div class="col-md-12">
    @component('admin.components.datatable', ['id' => 'empleados_table_ajax']) @slot('columns', [ 'id', 'Nombre', 'Apellido',
    'Fecha nacimiento', 'Telefono', 'Email', 'Area', 'Evaluado' => ['style' => 'width:55px;'],'Acciones' => ['style' => 'width:55px;']]) @endcomponent

</div>
@endcomponent
@endsection
 {{-- Scripts necesarios para el formulario --}} @push('scripts')
<!-- Datatables -->
<script src="{{asset('gentella/vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{asset('gentella/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
<!-- PNotify -->
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>



@endpush {{-- Estilos necesarios para el formulario --}} @push('styles')
<!-- Datatables -->
<link href="{{ asset('gentella/vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<!-- PNotify -->
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet"> 
@endpush {{-- Funciones necesarias por el formulario --}} @push('functions')
<script type="text/javascript">
    $(document).ready(function () {
        @if (session('msg'))
            new PNotify({
                title: 'Evaluacion realizada exitosamente',
                text: 'El empleado ha sido evaluado exitosamente',
                type: 'success',
                styling: 'bootstrap3'
            });
        @endif

            table = $('#empleados_table_ajax').DataTable({
                processing: true,
                serverSide: false,
                stateSave: true,
                keys: true,
                dom: 'lBfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                "ajax": {
                    "url": "{{ route('admin.evaluacion.areas.empleados.data', request()->route()->parameter('id_area')) }}",
                    complete: function () {
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                },
                "columns": [
                    {data: 'id', name: 'id', "visible": false},
                    {data: 'nombre', name: 'Nombre', className: "all"},
                    {data: 'apellido', name: 'Apellido', className: "all"},
                    {data: 'fecha_nacimiento', name: 'Fecha nacimiento', className: "min-phone-l"},
                    {data: 'telefono', name: 'Telefono', className: "min-phone-l"},
                    {data: 'email', name: 'Email', className: "min-phone-l"},
                    {data: 'area', name: 'Area', className: "min-phone-l"},
                    {data: 'evaluado', name: 'Evaluado', className: "min-phone-l"},
                    {
                        defaultContent: '<a data-toggle="tooltip" title="Evaluar empleado" href="javascript:;" class="btn btn-simple btn-info btn-sm evaluar"><i class="fas fa-book"></i></a>',

                        data: 'action',
                        name: 'action',
                        title: 'Acciones',
                        orderable: false,
                        searchable: false,
                        exportable: false,
                        printable: false,
                        className: 'text-right',
                        render: null,
                        responsivePriority: 2
                    }
                ],
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });

            table.on('click', '.evaluar', function (e) {
                e.preventDefault();
                $tr = $(this).closest('tr');
                var dataTable = table.row($tr).data();
                var route = '{{ url('admin/evaluaciones/areas') }}' + '/' 
                + {{ request()->route()->parameter('id_area') }} +'/empleados/' + dataTable.id;
                window.location.href = route;
            });

        });
</script>



@endpush