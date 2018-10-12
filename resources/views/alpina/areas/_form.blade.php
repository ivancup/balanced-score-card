{!! Form::hidden('id', old('id'), ['id' => 'id']) !!}
<div class="item form-group">
    {!! Form::label('nombre_area','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('nombre_area', old('nombre'),[ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-length'=>'[5, 50]', 'data-parsley-trigger'=>"change",
        'id' => 'name' ] ) !!}
    </div>
</div>