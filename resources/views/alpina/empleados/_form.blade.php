<div class="form-group">
    {!! Form::label('nombre','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('nombre', old('nombre'), [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-length'=>'[5, 60]', 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('apellido','Apellido', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('apellido', old('apelido'), [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-length'=>'[5, 60]', 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('fecha_nacimiento','Fecha Nacimiento', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('fecha_nacimiento', 
        old('fecha_nacimiento', isset($empleado)?(string)$empleado->fecha_nacimiento->format('d/m/Y'):''), 
        [ 
            'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 
            'required' => 'required',
            'id' => 'fecha_nacimiento'
        ] ) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('telefono','Telefono', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('telefono', old('telefono'), [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-length'=>'[5, 60]', 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('email','Email', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::email('email', old('email'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required' ]
        ) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('area', 'Area', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">

        {!! Form::select('area', $areas, old('area', isset($empleado)? $empleado->id_area: ''), [ 'placeholder'
        => 'Seleccione una area', 'class' => 'select2 form-control', 'required' => '', 'id' => 'area']) !!}
    </div>
</div>

