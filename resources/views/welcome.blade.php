@extends('layout.site')

@section('title')
    Eventos
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Events</h2>
            <hr>
        </div>
    </div>

    <div class="row mb-4">
        @forelse($events as $event)
            <div class="col-4">
            <div class="card">
                <img src="https://via.placeholder.com/640x480.png/002244?text=Sem%20Imagem" alt="" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{$event->title}}</h5>
                    <h6>Em: {{$event->start_date->format('d/m/Y H:i')}}</h6>
{{--                    <h6>Em: {{$event->created_at->format('d/m/Y H:i:s')}}</h6>--}}
                    <p class="card-text">{{$event->description}}</p>
                    <a href="/eventos/{{$event->slug}}" class="btn btn-primary">Ver evento</a>
                </div>
            </div>
            </div>
            @if($loop->iteration % 3 == 0)
            </div>    
            <div class="row mb-4">
            @endif
        @empty
            <div class="col-12">
                <div class="alert alert-warning">
                    Não tem evento...
                </div>
            </div>
        @endforelse

    </div>
@endsection
