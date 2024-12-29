<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;

class HomeController extends Controller
{
    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function index()
    {
        $byCategory = request()->has('category') 
            ? Category::whereSlug(request()->get('category'))->first()->events()
            : null;
        
        $events = $this->event->getEventsHome($byCategory)->paginate(15);
        
        return view('home', compact('events'));
    }

    public function show($slug)
    {
        $event = $this->event->whereSlug($slug)->first();
        return view('event', compact('event'));
    }
}
