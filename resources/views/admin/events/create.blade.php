@extends('layouts.app')

@section('title')
    Criar Eventos -
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <h2>Criar Evento</h2>
        </div>
    </div>

    {{-- 
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    --}}
    
    
    
    <div class="row">
        <div class="col-12">
            <form action="{{route('admin.events.store')}}" method="POST" class="form-group"> 
                @csrf
                <div class="form-group">
                    <label>Titulo Evento</label>
                    <input name="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                    @error('title')                
                        <div class="invalid-feedback">
{{--                            @foreach($errors->get('title') as $error)--}}
{{--                                {{$error}}--}}
{{--                            @endforeach--}}
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Descrição Evento</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control @error('description')is-invalid @enderror" > {{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
{{--                            @foreach($errors->get('description') as $error)--}}
{{--                                {{$error}}--}}
{{--                            @endforeach--}}
                            {{$message}}
                        </div>
                    @enderror                
                </div>
                
                <div class="form-group">
                    <label>Quando vai acontecer</label>
                    <input name="start_date" type="text" class="form-control @error('start_date')is-invalid @enderror" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')
                        <div class="invalid-feedback">
{{--                            @foreach($errors->get('start_date') as $error)--}}
{{--                                {{$error}}--}}
{{--                            @endforeach--}}
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-lg btn-success">Criar evento</button>
                
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