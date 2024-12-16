@extends('layout.site')

@section('Title')
    Evento - {{$event->title}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>{{ $event->title }}</h2>
            <p>{{ $event->start_date->format('d/m/Y H:i') }}</p>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" role="tab" href="#about"
                       aria-controls="home-tab-pane" aria-selected="true">Sobre</a>
                </li>
                @if($event->photos->count())
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="home-tab" data-bs-toggle="tab" role="tab" href="#photos"
                           aria-controls="home-tab-pane" aria-selected="true">Fotos</a>
                    </li>
                @endif
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-5" id="about" role="tabpanel" aria-labelledby="about-tab"
                     tabindex="0">
                    {{ $event->description }}
                </div>

                @if($event->photos->count())
                    <div class="tab-pane fade pt-5" id="photos" role="tabpanel" aria-labelledby="photos-tab"
                         tabindex="0">
                        <div class="row">
                            @foreach($event->photos as $photo)
                                <div class="col-3 pb-3">
                                    <img src="{{ $photo->photo }}" alt="Foto do evento {{ $event->title }}"
                                         class="img-fluid">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection