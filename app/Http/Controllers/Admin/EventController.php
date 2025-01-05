<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckUserCanEditEventMiddleware;
use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Services\MessageServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadTrait;

class EventController extends Controller
{
    use UploadTrait;
    
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
        $categories = Category::all(['id', 'name']);
        return view('admin.events.create', compact('categories'));
    }
    
    public function store(EventRequest $request)
    {
/*      
        dd('Controller metodo ' . __METHOD__);
        dd(request()->all());
        $number = rand(1, 100);
        $event = [
            'title' => 'Evento Attribuição em Massa ' . $number,
            'description' => 'Descrição do evento',
            'body' => 'Corpo do evento',
            'slug' => 'evento-atribuicao-em-massa-' . $number,
            'start_date' => date('Y-m-d H:i:s'),
        ];

        $request->validate([
            'title' => 'required',
            'description' => 'required|string|max:255|min:5',
            'start_date' => 'required|date|after:today',
        ],[
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O tamanho mínimo é :min caracteres',
            'max' => 'O tamanho é :max caracteres',
            'string' => 'Este campo deve ser uma string',
            'date' => 'Este campo deve ser uma data',
            'after' => 'A data deve ser maior que a data atual',
        ]);
*/
        $event = $request->all();
        if ($banner = $request->file('banner')) {
            $event['banner'] = $this->upload($banner, 'events/banner'); //$banner->store('banner', ['disk' => 'public']);
        }
//        $event['slug'] = Str::slug($event['title']);
        $event['slug'] = $event['title'];

        $event = $this->event->create($event);
        $event->owner()->associate(auth()->user());
        $event->save();
        
        if ($categories = $request->get('sel_categories')) {
            $event->categories()->sync($categories);
        }
        MessageServices::addFlash('success', 'Evento criado com sucesso!');

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        $categories = Category::all(['id', 'name']);
        return view('admin.events.edit', compact('event', 'categories'));
    }
    
    public function update(Event $event, EventRequest $request)
    {
        $eventData = $request->all();

        if ($banner = $request->file('banner')) {
            if (Storage::disk('public')->exists($event->banner)) {
                Storage::disk('public')->delete($event->banner);
            }
            
//            $eventData['banner'] = $banner->store('banner', ['disk' => 'public']);
            $eventData['banner'] = $this->upload($banner, 'events/banner');

        }

        $event->update($eventData);

        if ($categories = $request->get('sel_categories')) {
            $event->categories()->sync($categories);
        }
        
//        return redirect()->route('admin.events.index');
        MessageServices::addFlash('success', 'Evento atualizado com sucesso!');

        return redirect()->back();
        
    }

    public function destroy(Event $event)
    {
        $event->delete();
        
        MessageServices::addFlash('success', 'Evento removido com sucesso!');

        return redirect()->route('admin.events.index');
    }

}
