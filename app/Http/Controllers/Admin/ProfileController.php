<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\MessageServices;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user(); 
        
        // Cria perfil se user ainda não tem
        if (!$user->profile) {
            $user->profile()->create(['about' => '']);
        }
        
        return view('admin.profile', compact('user'));    
    }

    public function update(ProfileRequest $request)
    {
        $userData = $request->get('user');
        $profile = $request->get('profile');
        
        if ($userData['password']) {
            $userData['password'] = bcrypt($userData['password']);
        } else {
            unset($userData['password']);
        }
        
        $user = auth()->user();
        $user->update($userData);
        $user->profile()->update($profile);

        MessageServices::addFlash('success', 'Perfil atualizado com sucesso!');

        return redirect()->route('admin.profile.edit');
    }
    
}
