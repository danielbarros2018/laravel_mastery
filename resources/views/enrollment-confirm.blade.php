@extends('layouts.site')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Confirmação de Inscrição</h2>
            <hr>
        </div>
    </div>    
    <div class="row">
        <div class="col-12">
            <p>
                Evento: 
                <strong>
                    {{$event->title}}
                </strong>
                <br>
                Data
                <strong>
                    {{$event->start_date->format('d/m/Y H:i')}}
                </strong>
            </p>
            <p>
                <a href="{{route('enrollment.process')}}" class="btn btn-lg btn-success">Confirmar Inscrição</a>
            </p>
        </div>
    </div>
@endsection
