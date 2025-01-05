@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-12">
            <form action="{{route('admin.profile.update')}}" method="post">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-12">
                        <h3>Dados de acesso</h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Nome completo</label>
                    <input id="name" type="text" class="form-control @error('user.name') is-invalid @enderror" name="user[name]" value="{{$user->name}}">
                    @error('user.name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input id="email" type="text" class="form-control @error('user.email') is-invalid @enderror" name="user[email]" value="{{$user->email}}">
                    @error('user.email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input id="password" type="password" class="form-control @error('user.password') is-invalid @enderror" name="user[password]" placeholder="Informe a nova senha para atualizar">
                    @error('user.password')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirmar da Senha</label>
                    <input id="password_confirmation" type="password" class="form-control" name="user[password_confirmation]">
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <h3>Dados de perfil</h3>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="about">Sobre</label>
                    <textarea id="about" cols="30" rows="10" class="form-control" name="profile[about]">{{$user->profile->about}}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="contact">Contato</label>
                    <input id="contact" type="text" class="form-control" name="profile[phone]" value="{{$user->profile->phone}}">
                </div>

                <div class="form-group">
                    <label for="social_networks">Redes Sociais</label>
                    <hr>
                    @php $socialNetworks = $user->profile->social_networks; @endphp
                    @php $socialNetworks ??= []; @endphp
{{--                    @dump($socialNetworks)--}}
                    
                    <label>Facebook</label>
                    <input id="social_networks" type="text" class="form-control" name="profile[social_networks][facebook]"  value="{{array_key_exists('facebook', $socialNetworks) ? $socialNetworks['facebook'] : null}}">
                    
                    <label>Twitter</label>
                    <input id="social_networks" type="text" class="form-control" name="profile[social_networks][Twitter]"   value="{{array_key_exists('twitter',  $socialNetworks) ? $socialNetworks['twitter']  : null}}">
                    
                    <label>Instagram</label>
                    <input id="social_networks" type="text" class="form-control" name="profile[social_networks][Instagram]" value="{{array_key_exists('instagram', $socialNetworks) ? $socialNetworks['instagram'] : null}}">
                    
                </div>

                <button class="btn btn-success btn-lg">Atualizar Perfil</button>
            </form>
        </div>
    </div>
@endsection