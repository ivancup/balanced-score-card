<div class="item form-group">
    {!! Form::label('name','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('name', old('name'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required', 'data-parsley-pattern'
        => '^[a-zA-Z\s]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length' => "[1,
        50]", 'data-parsley-trigger'=>"change"] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('lastname','Apellido', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('lastname', old('lastname'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-pattern' => '^[a-zA-Z\s]*$', 'data-parsley-pattern-message' => 'Por favor escriba solo letras', 'data-parsley-length'
        => "[1, 50]", 'data-parsley-trigger'=>"change" ]) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('email','Email', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::email('email', old('email'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' =>
        'required' ] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('password','Contraseña', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::password('password',[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', isset($edit) ? '' : 'required' =>
        'required' ] ) !!}
    </div>
</div>
<div class="item form-group">
    {!! Form::label('id_estado','Estado', [ 'class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('id_estado', $estados, old('id_estado', isset($user)? $user->id_estado:''), [ 'class' => 'select2_user form-control',
        'required']) !!}
    </div>
</div>

<div class="item form-group">
    {!! Form::label('roles', 'Roles', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('roles', $roles,
        old('roles', isset($roles, $user)? $user->roles()->pluck('name', 'name') : ''),
        ['class' => 'select2_roles form-control', 'required'
        => '', 'id'=>'select_rol']) !!}
    </div>
</div>

<div class="item form-group" id='areas'>
    {!! Form::label('area', 'Area', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::select('area', $areas, old('area', isset($areas, $user)? $user->id_area : ''), ['class'
        => 'select2_roles form-control', 'id'=>'select_area', 'placeholder' => 'Por favor seleccione una area']) !!}
    </div>
</div>



