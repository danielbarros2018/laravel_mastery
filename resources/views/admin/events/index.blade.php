@extends('layouts.app')

@section('title')
    Meus Eventos -
@endsection

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center align-items-center my-5">
            <h2>Meus Eventos</h2>
            <a href="{{route('admin.events.create')}}" class="btn btn-primary">Novo Evento</a>
        </div>
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Evento</th>
                    <th>Criado em</th>
                    <th width="16%">Ações</th>
                </tr>
                </thead>
                <tbody>
                @forelse($events as $event)
                    <tr>
                        <td>{{$event->id}}</td>
                        <td>{{$event->title}}</td>
                        <td>{{$event->created_at->format('d/m/Y H:i:s')}}</td>
                        <td class="d-flex justify-content-beetween">
                            <a href="{{route('admin.events.edit',    ['event' => $event->id])}}" class="btn btn-primary">Editar</a>
{{--                            <a href="{{route('admin.events.destroy', ['event' => $event->id])}}" class="btn btn-danger">Remover</a>--}}
 
                            <form action="" method="">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum evento cadastrado.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            {{$events->links()}}
        </div>
    </div>

@endsection
