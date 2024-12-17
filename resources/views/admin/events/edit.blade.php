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
            <form action="{{route('admin.events.update', ['event' => $event->id])}}" method="POST" class="form-group"> 
                @csrf
                <div class="form-group">
                    <label>Titulo Evento</label>
                    <input name="title" type="text" class="form-control" value="{{ $event->title }}">
                </div>
                
                <div class="form-group">
                    <label>Descrição Evento</label>
                    <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $event->description }}</textarea>
                </div>
                
                <div class="form-group">
                    <label>Quando vai acontecer</label>
                    <input name="start_date" type="text" class="form-control" value="{{ $event->start_date }}">
                </div>
                
                <button type="submit" class="btn btn-lg btn-success">Atualizar evento</button>
                
            </form>
        </div>
    </div>
    
    
@endsection