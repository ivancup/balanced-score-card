{{-- Titulo de la pagina --}}
@section('title', 'Home')
{{-- Contenido principal --}}
@extends('admin.layouts.app')

@section('content')
    @component('admin.components.panel')
        @slot('title', 'Bienvenido a Alpina.')
        
    @endcomponent
@endsection

@can('SUPERADMINISTRADOR')

    {{-- Scripts necesarios para el formulario --}} 
    @push('scripts')
    
    @endpush 

    {{-- Estilos necesarios para el formulario --}} 

    @push('styles')
    
    @endpush 
    
    {{-- Funciones necesarias por el formulario --}} 
    @push('functions')
    
    @endpush
@endcan