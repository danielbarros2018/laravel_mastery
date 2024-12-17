<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }
    
    public function store(Request $request)
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

        $event = $request->all();
        $event['slug'] = Str::slug($event['title']);
        
        Event::create($event);
        
        return redirect()->route('admin.events.index');
    }

    public function edit($event_id)
    {
        $event = Event::findOrFail($event_id);
        return view('admin.events.edit', compact('event'));
    }
    
    public function update($event, Request $request)
    {
//        $eventData = [
//            'title' => 'Evento Attribuição em Massa ' . rand(1, 100),
//        ];

        $event = Event::findOrFail($event);

        $event->update($request->all());
        
        return redirect()->route('admin.events.index');
        
    }

    public function destroy($event)
    {
        $event = Event::findOrFail($event);

        $event->delete();
        
        return redirect()->route('admin.events.index');
    }

}
