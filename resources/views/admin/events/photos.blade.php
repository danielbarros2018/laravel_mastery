@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-12">
            <form action="{{route('admin.events.photos.store', $event)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="up_photos">Subir fotos do evento</label>
                    <input type="file" name="photos[]" id="up_photos" class="form-control @error('photos.*') is-invalid @enderror" multiple>
                    
                    @error('photos.*')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <button class="btn btn-lg btn-success">Enviar Fotos</button>
                
            </form>
            
{{--            @foreach($event->photos as $photo)--}}
{{--                <div class="tab-pane fade pt-5" id="photos" role="tabpanel" aria-labelledby="photos-tab" tabindex="0">--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-3 pb-3">--}}
{{--                            <img src="{{ $photo->photo }}" alt="Foto do evento {{ $event->title }}" class="img-fluid">--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
            
        </div>
        <hr>
    </div>
    
    <div class="row">
        @forelse($event->photos as $photo) 
            <div class="col-4 mb-4">
                <img src="{{asset('storage/' . $photo->photo)}}" alt="Fotos do Evento {{ $event->title }}" class="img-fluid">
                
                <form action="{{route('admin.events.photos.destroy', [$event, $photo])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm mt-1">
                        Remover Foto
                    </button>
                </form>
                
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Nenhuma foto para este evento...</div>
            </div>
        @endforelse
    </div>
@endsection