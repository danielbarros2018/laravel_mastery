<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckUserCanEditEventMiddleware;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
        $this->middleware(CheckUserCanEditEventMiddleware::class)->only(['edit', 'update']);
    }

    public function index()
    {
//        $events = $this->event->paginate(10);
        $events = auth()->user()->events()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function show($event)
    {
        return "Event " . $event;
    }
    
    public function create()
    {
        return view('admin.events.create');
    }
    
    public function store(EventRequest $request)
    {
//        dd('Controller metodo ' . __METHOD__);
//        dd(request()->all());
//        $number = rand(1, 100);
//        $event = [
//            'title' => 'Evento Attribuição em Massa ' . $number,
//            'description' => 'Descrição do evento',
//            'body' => 'Corpo do evento',
//            'slug' => 'evento-atribuicao-em-massa-' . $number,
//            'start_date' => date('Y-m-d H:i:s'),
//        ];
//
//        $request->validate([
//            'title' => 'required',
//            'description' => 'required|string|max:255|min:5',
//            'start_date' => 'required|date|after:today',
//        ],[
//            'required' => 'O campo :attribute é obrigatório',
//            'min' => 'O tamanho mínimo é :min caracteres',
//            'max' => 'O tamanho é :max caracteres',
//            'string' => 'Este campo deve ser uma string',
//            'date' => 'Este campo deve ser uma data',
//            'after' => 'A data deve ser maior que a data atual',
//        ]);
        
        $event = $request->all();
//        $event['slug'] = Str::slug($event['title']);
        $event['slug'] = $event['title'];
        
        $ev = $this->event->create($event);
        $ev->owner()->associate(auth()->user());
        $ev->save();
        
        return redirect()->route('admin.events.index');
    }

    public function edit($event_id)
    {
        $event = $this->event->findOrFail($event_id);
        return view('admin.events.edit', compact('event'));
    }
    
    public function update($event, EventRequest $request)
    {
//        $eventData = [
//            'title' => 'Evento Attribuição em Massa ' . rand(1, 100),
//        ];

        $event = $this->event->findOrFail($event);

        $event->update($request->all());
        
        return redirect()->route('admin.events.index');
        
    }

    public function destroy($event)
    {
        $event = $this->event->findOrFail($event);

        $event->delete();
        
        return redirect()->route('admin.events.index');
    }

}
