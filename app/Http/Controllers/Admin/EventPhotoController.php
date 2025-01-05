<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckUserCanEditEventMiddleware;
use App\Http\Requests\EventPhotoRequest;
use App\Models\Event;
use App\Services\MessageServices;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventPhotoController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware(CheckUserCanEditEventMiddleware::class);
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return view('admin.events.photos', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventPhotoRequest $request, Event $event)
    {
        $uploadedPhotos = $this->multipleFilesUpload($request->file('photos'),'events/photos', 'photo');
        
        $event->photos()->createMany($uploadedPhotos);

        MessageServices::addFlash('success', 'Fotos adicionadas com sucesso!');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event, $photo)
    {
        $photo = $event->photos()->find($photo);
        
        if (!$photo) {
            return redirect()->route('admin.events.index');
        }
        
        if (Storage::disk('public')->exists($photo->photo)) {
            Storage::disk('public')->delete($photo->photo);
        }
        
        $photo->delete();

        MessageServices::addFlash('success', 'Foto removida com sucesso!');


        return redirect()->back();
    }
}
