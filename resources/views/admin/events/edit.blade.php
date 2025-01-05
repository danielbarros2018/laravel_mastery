@extends('layouts.app')

@section('title')
    Editar Eventos -
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Editar Evento</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.events.update', ['event' => $event->id])}}" method="POST" class="form-group" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Titulo Evento</label>
                    <input name="title" type="text" class="form-control  @error('title') is-invalid @enderror" value="{{ $event->title }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Descrição Evento</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control  @error('title') is-invalid @enderror">{{ $event->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Quando vai acontecer</label>
                    <input name="start_date" type="text" class="form-control  @error('title') is-invalid @enderror" value="{{ $event->start_date->format('d/m/Y H:i') }}">
                    @error('start_date')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>

                <div class="form-group my-5">
                    <div class="row">
                        <div class="col-12">
                            Banner Evento
                            <hr>
                        </div>
{{--                        @if()--}}
                            <div class="col-4">
                                <img src="{{$event->banner ? asset('storage/' . $event->banner) : 'https://via.placeholder.com/640x480.png/002244?text=Sem%20Imagem'}}" alt="Banner do evento: {{$event->title}}" class="img-fluid">
                            </div>
{{--                        @endif--}}
                        <div class="col-8">
                            <label for="up_banner">Banner do evento</label>
                            <input type="file" name="banner" id="up_banner" class="form-control  @error('banner')is-invalid @enderror">
                            @error('banner')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label >Quais categorias o Evento pertence?</label>
                    <select name="sel_categories[]" id="sel_categories" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($event->categories->contains($category)) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-lg btn-success">Atualizar evento</button>
                
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let el = document.querySelector('input[name=start_date]');
        let im = new Inputmask('99/99/9999 99:99');
        im.mask(el);
    </script>
@endsection