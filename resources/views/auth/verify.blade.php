@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirme o seu email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo link para a verificação da sua conta foi enviado.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar é necessário verificar se o endereço de email está correto através do link enviado para o endereço de email informado.') }}
                    {{ __('Se você não recebeu o email ') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para receber um novo link.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
