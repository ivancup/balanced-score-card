<input type="hidden" id="focus" autofocus>
<h4>{!! Form::label('PK_DAE_Id', 'Bienvenido a la evaluacion del empleado ' . $empleado->nombre) !!}</h4>
<div id="smartwizard">
    <ul class="hidden">
        <li><a href="#descripcion"></a></li>
        @foreach($indicadores as $indicador)
            <li><a href="#{{$indicador->id }}"><br/></a></li>
        @endforeach
    </ul>
    <div>
        <div id="descripcion" class="">
            <font face="helvetica, arial">
                {!! Form::label('PK_DAE_Id','Por favor diligencie la evaluación del empleado, de acuerdo a los indicadores, evaluelo de una forma imparcial y de acuerdo a los datos conocidos del empleado') !!}
                <br/>
                <label>INSTRUCCIONES: </label><br/>
                {!! Form::label('Instrucciones','Para cada una de las preguntas, seleccione la opción que que se adecue al empleado, en caso de que se deba llenar un campo de texto hacerlo. Una vez seleccionada una respuesta, se habilitará la opción de continuar para finalizar la evaluación. ') !!}
            </font>
        </div>
        @foreach($indicadores as $indicador)
            <div id="{{$indicador->id }}">
                <font face="helvetica, arial"> <label>Pregunta Número {{$loop->iteration}} de {{count($indicadores)}}
                        :</label></font>
                <font face="helvetica, arial"> <label><p class="text-justify">{{$indicador->nombre}}</p>
                    </label> </font><br/>

                @if($indicador->tipo == 0)
                    <font face="helvetica, arial">
                        <div class="radio">
                            <label>
                                {{ Form::number($indicador->id, old($indicador->id),
                                    ['class' => 'radios','id'=>'preguntas',
                                    'autocomplete' => 'on']
                                ) }}<p class="text-justify"></p>
                            </label>
                        </div>
                    </font>
                @else

                <font face="helvetica, arial">
                    <div class="radio">
                        <label>
                            {{ Form::radio($indicador->id, '1',false,
                                ['class' => 'radios','id'=>'preguntas',
                            'autocomplete' => 'on']
                            ) }}<p class="text-justify"> Muy en desacuerdo</p>
                        </label>
                    </div>
                </font>
                <font face="helvetica, arial">
                    <div class="radio">
                        <label>
                            {{ Form::radio($indicador->id, '2',false,
                                ['class' => 'radios','id'=>'preguntas',
                            'autocomplete' => 'on']
                            ) }}<p class="text-justify"> Algo en desacuerdo</p>
                        </label>
                    </div>
                </font>
                <font face="helvetica, arial">
                    <div class="radio">
                        <label>
                            {{ Form::radio($indicador->id, '3',false,
                                ['class' => 'radios','id'=>'preguntas',
                            'autocomplete' => 'on']
                            ) }}<p class="text-justify"> Ni de acuerdo ni en desacuerdo</p>
                        </label>
                    </div>
                </font>
                <font face="helvetica, arial">
                    <div class="radio">
                        <label>
                            {{ Form::radio($indicador->id, '4',false,
                                ['class' => 'radios','id'=>'preguntas',
                            'autocomplete' => 'on']
                            ) }}<p class="text-justify"> Algo de acuerdo</p>
                        </label>
                    </div>
                </font>
                <font face="helvetica, arial">
                    <div class="radio">
                        <label>
                            {{ Form::radio($indicador->id, '5',false,
                                ['class' => 'radios','id'=>'preguntas',
                            'autocomplete' => 'on']
                            ) }}<p class="text-justify"> Muy de acuerdo</p>
                        </label>
                    </div>
                </font>

                @endif
                @if ($loop->last)
                    <div class="col-md-19 col-md-offset-9">
                        {!! Form::submit('Finalizar', ['class' => 'btn btn-success', 'id' => 'finalizar']) !!}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>