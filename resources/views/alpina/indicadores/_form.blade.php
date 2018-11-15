<div class="form-group">
    {!! Form::label('nombre','Nombre', ['class'=>'control-label col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-md-6 col-sm-6 col-xs-12">
        {!! Form::text('nombre', old('nombre'), [ 'class' => 'form-control col-md-6 col-sm-6 col-xs-12', 'required' => 'required',
        'data-parsley-length'=>'[5, 60]', 'data-parsley-trigger'=>"change" ] ) !!}
    </div>
</div>

<fieldset>
    <div class="form-group">
        <label class="col-xs-3 control-label">Tipo</label>
        <div class="col-xs-9">
            <div class="radio">
                <label>
      <input name="tipo" value="0" type="radio" {{$indicador->tipo == 0?'checked':''}}>
      Cuantitativo</label>
            </div>
            <div class="radio">
                <label>
      <input name="tipo" value="1" type="radio" {{$indicador->tipo == 1?'checked':''}}>
      Cualitativo</label>
            </div>
        </div>
    </div>
</fieldset>